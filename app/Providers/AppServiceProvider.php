<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Jika proyek Laravel di /home/user/isc dan web root di /home/user/public_html
        $this->app->bind('path.public', function () {
            // Path ini mengasumsikan struktur:
            // - .../ (folder induk)
            //   - isc/ (base_path() Laravel Anda)
            //   - public_html/ (document root web server Anda)
            return realpath(base_path().'/../public_html/public'); 
        });
    }

    public function boot(): void
    {
        //
    }
}

