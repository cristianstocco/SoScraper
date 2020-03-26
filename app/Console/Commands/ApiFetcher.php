<?php

namespace App\Console\Commands;

use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

if( !array_key_exists( 'Facebook', get_defined_constants() ) )
    define( 'Facebook', app_path() . '/Facebook/src/Facebook/' );
require_once( Facebook . 'autoload.php' );

class ApiFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The scheduler processor which fetches data from Facebook.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('fbapi:info');
        Artisan::call('fbapi:partial');
        Artisan::call('fbapi:full');
    }

}