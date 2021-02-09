<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // add reCaptcha validator method
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
