<?php

namespace App\Providers;

use App\Models\Deliverycharge;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Retrieve delivery charge data
        // $deliveryChargeData = Deliverycharge::get();
        $deliveryChargeData = Deliverycharge::distinct()->select('from_location')->get();

        // Share the data with the view
        view()->share('deliveryChargeData', $deliveryChargeData);

        // Use Bootstrap for pagination
        Paginator::useBootstrap();
    }
}
