<?php

namespace App\Providers;

use App\Http\Controllers\AppointmentController;
use App\Http\Repositories\UserInterface;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind('app\Http\Controllers\AppointmentController', AppointmentController::class);
    }
}
