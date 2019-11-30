<?php

namespace App\Providers;
// use App\Providers\Blade;

use Illuminate\Support\ServiceProvider;

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
        \Blade::directive('convert', function ($money) {
            return "<?php echo '&euro; &nbsp;' . number_format($money, 2); ?>";
        });
    }
}
