<?php

namespace Altelma\LaravelMailChimp;

use Illuminate\Support\ServiceProvider;

class MailchimpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {        
        $this->publishes([
            __DIR__.'/../config/mailchimp.php' => config_path('mailchimp.php'),
        ], 'mailchimp');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {        
        $this->mergeConfigFrom(__DIR__.'/../config/mailchimp.php', 'mailchimp');
        $this->app->singleton('MailChimp', function ($app) {
            $config = $app->make('config');
            $token = $config->get('mailchimp.apikey');
            return new MailChimpService($token);
        });
    }
    
    public function provides()
    {
        return ['MailChimp'];
    }
}
