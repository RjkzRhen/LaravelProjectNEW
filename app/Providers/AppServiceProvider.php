<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\UserCSV;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserCSV::class, function ($app) {
            return new UserCSV();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
