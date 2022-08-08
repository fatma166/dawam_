<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Notifications_log;
use Illuminate\Support\Facades\Blade;

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
     $this->app->bind(NotificationManager::class,function($app){
            
    return new NotificationManager();
    });        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(app()->environment('production')) {
            error_reporting(0);
        }
        
        Schema::defaultStringLength(191);
        View::share('notfys',Notifications_log::select('notifications_logs.*','users.avatar','users.name')->join('users', 'users.id', '=','notifications_logs.notify_from')->take(5)->get());
        Blade::directive('parse', function ($expression) {
            
          
            return "<?php 
            if($expression){
                echo  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$expression)->locale('ar')->diffForHumans();
            }
             ?>";
           
        
        });
        //
    }
}
