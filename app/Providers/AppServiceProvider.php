<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Route;

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
        // Update defaultStringLength
        Builder::defaultStringLength(191);
        KTBootstrap::init();

        Route::middleware('api')
        ->prefix('user')
        ->group(base_path('routes/user.php'));
        Route::middleware('api')
        ->prefix('admin_app')
        ->group(base_path('routes/admin.php'));
        Route::middleware('api')
        ->prefix('parent')
        ->group(base_path('routes/parent.php'));
    }
}
