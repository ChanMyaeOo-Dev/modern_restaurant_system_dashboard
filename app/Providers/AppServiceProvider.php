<?php

namespace App\Providers;

use App\Models\Feedback;
use App\Models\Item;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\OrderItem;

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
        View::composer('*', function ($view) {
            $view->with('orderCount', Order::where('is_completed', '0')->count());
            $view->with('orderItemCount', OrderItem::count());
            $view->with('itemCount', Item::count());
            $view->with('feedbackCount', Feedback::count());
        });
    }
}
