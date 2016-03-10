<?php

namespace Tokenly\XCallerReceiver;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

/*
* XCallerReceiverServiceProvider
*/
class XCallerReceiverServiceProvider extends ServiceProvider
{

    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindConfig();

        $this->app->bind('Tokenly\XCallerReceiver\WebHookReceiver', function($app) {
            $webhook_receiver = new \Tokenly\XCallerReceiver\WebHookReceiver(Config::get('xcaller.api_token'), Config::get('xcaller.api_key'));
            return $webhook_receiver;
        });
    }

    protected function bindConfig()
    {
        // simple config
        $config = [
            'xcaller.api_token'      => env('XCALLER_API_TOKEN', null),
            'xcaller.api_key'        => env('XCALLER_API_KEY'  , null),
        ];

        // set the laravel config
        Config::set($config);

        return $config;
    }

}

