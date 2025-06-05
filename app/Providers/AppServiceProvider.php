<?php

namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

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
        //
        Route::middleware('role', RoleMiddleware::class);

        View::composer('*', function ($view) {
            $notifikasiBaru = PengajuanSurat::where('status', 'pending')
                ->whereDate('created_at', Carbon::today())
                ->count();

            $view->with('notifikasiBaru', $notifikasiBaru);
        });
    }
}
