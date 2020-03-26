<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\ApiDiscount;
use App\MediaApiCost;
use App\UserPayment;
use Carbon\Carbon;
use RandomLib\Factory;
use App\User;

use Paypal;

use App\FB_api_resource;
use App\FB_api_group_full_mode;
use App\FB_api_group_partial_mode;
use App\FB_api_partial_mode;
use App\FB_api_info;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret')
        );

        $this->apiContext->setConfig(array(
            'mode' => config( 'app.paypal_mode' ),
            'service.EndPoint' => config( 'app.paypal_api_url' ),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal/main.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function index( Request $request )
    {
        $monthNo = $request[ 'month_payment' ];
        $apiRate = $request[ 'service_number' ];
        $monthlyCost = MediaApiCost::getMonthlyCost( $apiRate );
        if( !is_numeric($monthNo) )
            return redirect( route('api.checkout.index') );

        if( !($monthNo > 0 && $monthNo < 13) )
            return redirect( route('api.checkout.index') );



        $discounts = ApiDiscount::where( 'monthNo', '<=', $monthNo )->get()->toArray();
        $discount = sizeof($discounts) == 0 ? 0 : $discounts[ sizeof($discounts) - 1 ][ 'discount%' ];
        $cost = $this->getDiscount( $monthlyCost, $monthNo, $discount );



        $payer = Paypal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = Paypal::Amount();
        $amount->setCurrency('EUR');
        $amount->setTotal( $cost ); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = Paypal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription( 'Api for user: ' . auth()->user()[ 'email' ] );

        $redirectUrls = Paypal::RedirectUrls();
        $redirectUrls->setReturnUrl(action('PayPalController@done'));
        $redirectUrls->setCancelUrl(action('PayPalController@cancel'));

        $payment = Paypal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to( $redirectUrl );
    }

    public function done(Request $request)
    {
        $paymentID = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = Paypal::getById($paymentID, $this->apiContext);

        $paymentExecution = Paypal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        try {
            $executePayment = $payment->execute($paymentExecution, $this->apiContext);
        }
        catch( \Exception $error ) {
            $loggerStream = new StreamHandler(storage_path('logs/paypal') . '/payment.log', Logger::DEBUG);
            $logger = new Logger( 'Payment' );
            $logger->pushHandler( $loggerStream );

            $logger->addCritical( "Payment execution error ".  json_encode($error) );
            return redirect( route('api.checkout.error') );
        }

        $total = $executePayment->transactions[ 0 ]->amount->total;

        UserPayment::create([
            'paymentID' => $paymentID,
            'user_email' => auth()->user()[ 'email' ],
            'payerID' => $payer_id,
            'token' => $token,
            'created_at' => Carbon::now(),
            'finish_at' => Carbon::now()->addMonths( 10 )
        ]);

        $this->store( $paymentID );

        // Thank the user for the purchase
        return $this->purchaseDone($paymentID, $total);
    }

    public function cancel( Request $request ) {
        $token = $request[ 'token' ];
        $payment = UserPayment::where( 'token', $token )->get();

        if( sizeof($payment) == 1 ) {
            $payment = $payment[ 0 ];
            $paymentID = $payment[ 'paymentID' ];
            $token = $payment[ 'token' ];

            return view( 'user.api.create.checkout_cancel', compact( 'paymentID', 'token' ) );
        }

        return view( 'user.api.create.checkout_cancel' );
    }

    public function error() {
        return view( 'user.api.create.checkout_error' );
    }

    /**
     * Creating a new resource about media, STEP 8.
     *
     * @return  \Illuminate\Http\Response
     */
    public function store( $paymentID = null ) {
        if( !(User::isAdmin() || User::isModerator()) && is_null($paymentID) )
            return redirect( route('dashboard') );



        $whiteListDomain = session( 'apisSettings.whiteListDomain' );
        $whiteListStagingIP = session( 'apisSettings.whiteListStagingIP' );
        $missingDaysToWhiteList = session( 'apisSettings.missingDaysToWhiteList' );
        $isInfo = session( 'mode.isInfo' );



        if( $isInfo )
            $this->storeInfo( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID );
        else
            $this->storeMedia( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID );

        session()->forget( 'apis' );
        session()->forget( 'edges' );
        session()->forget( 'infoFields' );
        session()->forget( 'apisSettings' );
        session()->forget( 'mode' );
    }

    /**
     * Creating a new resource about media, STEP 8.1.
     *
     * @return  \Illuminate\Http\Response
     */
    private function storeInfo( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID )
    {
        $factory = new Factory();
        $generator = $factory->getLowStrengthGenerator();

        $source = session( 'sourcePage' );
        $fields = session('infoFields');



        do {
            $basePathKey = $generator->generateString( 32, 7 );

            $groups = FB_api_group_full_mode::all()->where( 'basePathKey', $basePathKey );
        } while( sizeof($groups) == 1 );

        FB_api_info::createWithFields(
            [
                'user' => Auth::user()->id,
                'source' => $source,
                'whiteListDomain' => $whiteListDomain,
                'whiteListStagingIP' => $whiteListStagingIP,
                'basePathKey' => $basePathKey,
                'missingDaysToWhiteList' => $missingDaysToWhiteList,
                'paymentID' => $paymentID
            ],
            $fields
        );

        Artisan::call( 'fbapi:info', [
            'basePathKey' => $basePathKey
        ]);
    }

    /**
     * Creating a new resource about media, STEP 8.1.
     *
     * @return  \Illuminate\Http\Response
     */
    private function storeMedia( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID )
    {
        $factory = new Factory();
        $generator = $factory->getLowStrengthGenerator();

        $apis = session( 'apis' );
        $source = session( 'sourcePage' );

        $whiteListDomain = '';
        $whiteListStagingIP = '';           /*  imagijnsdojgnsdijogosjdngojsdngojsndgojsndgojnsdogjnsdojgnojsdgnojsdng  */

        foreach( $apis as $api ) {

            if( $api[ 'isFull' ] ) {
                do {
                    $basePathKey = $generator->generateString( 32, 7 );

                    $groups = FB_api_resource::where( 'basePathKey', $basePathKey );
                } while( is_object($groups) == 1 );

                $apiGroup = FB_api_group_full_mode::create([
                    'user' => Auth::user()->id,
                    'whiteListDomain' => $whiteListDomain,
                    'whiteListStagingIP' => $whiteListStagingIP,
                    'pageEdge' => $api[ 'edge' ],
                    'basePathKey' => $basePathKey,
                    'source' => $source,
                    'missingDaysToWhiteList' => $missingDaysToWhiteList,
                    'paymentID' => $paymentID
                ]);

                FB_api_group_full_mode::linkEdges( $api[ 'mediaSelector' ], $apiGroup );
                Artisan::call( 'fbapi:full', [
                    'basePathKey' => $basePathKey
                ]);
            }
            else {
                do {
                    $basePathKey = $generator->generateString( 32, 7 );

                    $groups = FB_api_resource::where( 'basePathKey', $basePathKey );
                } while( sizeof($groups) == 1 );

                $apiGroup = FB_api_group_partial_mode::create([
                    'user' => Auth::user()->id,
                    'whiteListDomain' => $whiteListDomain,
                    'whiteListStagingIP' => $whiteListStagingIP,
                    'pageEdge' => $api[ 'edge' ],
                    'basePathKey' => $basePathKey,
                    'source' => $source,
                    'missingDaysToWhiteList' => $missingDaysToWhiteList,
                    'paymentID' => $paymentID
                ]);

                FB_api_partial_mode::createCollection( $api, $apiGroup );
            }
        }
    }

    /**
     * Creating a new resource about media, STEP 8.
     *
     * @return  \Illuminate\Http\Response
     */
    public function storeByAdmin() {
        if( !(User::isAdmin() || User::isModerator()) )
            return redirect( abort(404) );



        $whiteListDomain = session( 'apisSettings.whiteListDomain' );
        $whiteListStagingIP = session( 'apisSettings.whiteListStagingIP' );
        $missingDaysToWhiteList = session( 'apisSettings.missingDaysToWhiteList' );
        $isInfo = session( 'mode.isInfo' );
        $paymentID = 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX';
        $total = '100.000';



        if( $isInfo )
            $this->storeInfo( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID );
        else
            $this->storeMedia( $whiteListDomain, $whiteListStagingIP, $missingDaysToWhiteList, $paymentID );

        session()->forget( 'apis' );
        session()->forget( 'edges' );
        session()->forget( 'infoFields' );
        session()->forget( 'apisSettings' );
        session()->forget( 'mode' );

        return view( 'user.api.store.index', compact('paymentID', 'total') );
    }

    private function purchaseDone( $paymentID, $total ) {
        return view( 'user.api.create.checkout_done', compact( 'paymentID', 'total' ) );
    }

    private function getDiscount( $monthlyCost, $monthNo, $discount ) {
        $cost = $monthlyCost * $monthNo;
        $costDiscount = $cost * $discount / 100;

        return $cost - $costDiscount;
    }
}
