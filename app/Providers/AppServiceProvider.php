<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'ptdgm9bnztrc334v',
                'publicKey' => '7j2h8qbd3fw46wgd',
                'privateKey' => '0f5767bab7fc0b3d3ba1ee3da7e450f9'
            ]);
        });
    }
}
