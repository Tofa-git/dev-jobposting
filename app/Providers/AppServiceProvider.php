<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\app_properties;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $mail = app_properties::select('mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption')
            -> first();
//        dd(base64_decode($mail->mail_password));

        if($mail && !is_null($mail->mail_driver) && !is_null($mail->mail_host) && !is_null($mail->mail_port) && !is_null($mail->mail_username) && !is_null($mail->mail_password) && !is_null($mail->mail_encryption)){
            $config = array(
                'transport'     => $mail->mail_driver,
                'host'          => $mail->mail_host,
                'port'          => $mail->mail_port,
                'encryption'    => $mail->mail_encryption,
                'username'      => $mail->mail_username,
                'password'      => base64_decode($mail->mail_password),
            );
            Config::set('mail.mailers.smtp', $config);
        }
    }
}
