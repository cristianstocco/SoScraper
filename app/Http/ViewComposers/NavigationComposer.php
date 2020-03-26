<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/03/16
 * Time: 2:53 PM
 */


class NavigationComposer extends ServiceProvider
{
    public function __construct()
    {
        //
    }

    public function compose( $view )
    {
        $isLoggedInUser = !is_null( Auth::user() ) && !is_numeric(strpos(request()->route()->getName(), 'static_')) && !is_numeric(strpos(request()->route()->getName(), 'forum'));

        $view->with('toSupportLoggedInBar', $isLoggedInUser);

        //always true
        $this->setMenu( $view );
        $this->setBody( $view );
    }

    public function register()
    {
        //
    }

    /* - - - PRIVATE - - - */
    /**
     * Returns the menu classes.
     *
     * @param  $name  view name
     * @return bool   keyname for "/resources/views/partials/menu.blade.php"
     */
    private function getMenuHTML( $name ) {
        switch( $name ) {
            case "welcome":
                return "home";

            case "news.index":
                return "news";

            case "documentation":
                return "doc";

            case "auth.login":
                return "login";

            case "user.dashboard":
                return "dashboard";

            default:
                return "";
        }
    }

    /**
     * Sets the $var for Front-End.
     *
     * @param  $view
     * @return bool   wether the class is set
     */
    private function setMenu( $view ) {
        return !array_key_exists( 'menuActive', $view->getData() ) && $view->with( 'menuActive', $this->getMenuHTML( $view->getName() ) );
    }

    /**
     * Returns the body classes.
     *
     * @param  $name  view name
     * @return bool   wether the class is set
     */
    private function getBodyClasses( $name ) {
        switch( $name ) {
            case "welcome":
                return "home";

            default:
                return "page";
        }
    }

    /**
     * Sets the $var for Front-End.
     *
     * @param  $view
     * @return bool   wether the class is set
     */
    private function setBody( $view ) {
        return !array_key_exists( 'bodyClasses', $view->getData() ) && $view->with( 'bodyClasses', $this->getBodyClasses( $view->getName() ) );
    }
}
