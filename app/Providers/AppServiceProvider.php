<?php

namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
            // Ambil semua notifikasi terbaru (maksimal 5 untuk dropdown)
            $notifikasi = Notifikasi::with(['pengaju', 'pengajuanSurat', 'jenisSurat'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            // Hitung notifikasi yang belum dibaca oleh operator hari ini
            $notifikasiBaru = Notifikasi::where('sudah_dibaca_operator', false)
                ->whereDate('created_at', Carbon::today())
                ->count();
            
            $view->with([
                'notifikasi' => $notifikasi,
                'notifikasiBaru' => $notifikasiBaru
            ]);
        });

        View::composer('*', function ($view) {
        // Ambil user yang sedang login
        $currentUser = Auth::user();

            // Hitung notifikasi untuk user yang sedang login
            $notifikasiUserBaru = 0;
            if ($currentUser) {
                $notifikasiUserBaru = Notifikasi::whereHas('pengajuanSurat', function ($query) use ($currentUser) {
                        $query->where('user_id', $currentUser->id);
                    })
                    ->where('sudah_dibaca_masyarakat', false)
                    ->whereDate('created_at', Carbon::today())
                    ->count();
            }

            // Ambil notifikasi khusus untuk user yang sedang login
            $notifikasiUser = collect();
            if ($currentUser) {
                $notifikasiUser = Notifikasi::with(['pengaju', 'pengajuanSurat', 'jenisSurat'])
                    ->whereHas('pengajuanSurat', function ($query) use ($currentUser) {
                        $query->where('user_id', $currentUser->id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            }

            $view->with([
                'notifikasiUserBaru' => $notifikasiUserBaru,
                'notifikasiUser' => $notifikasiUser
            ]);
        });
    }
}
