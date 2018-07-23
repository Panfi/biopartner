<?php

namespace biopartnering\biopartnering;

use Illuminate\Support\ServiceProvider;
use Config;
use App;
use DB;
use Log;

class BioPartneringServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'biopartnering');

        if (!$this->app->routesAreCached())
        {
            require __DIR__.'/routes/web.php';
        }

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/biopartnering'),
        ], 'public');

        DB::listen(function ($query)
        {
            // $query->time

           //Log::info($query->sql, $query->bindings);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('notification', function()
        {
            return new NotificationsManager;
        });

        $this->app->bind('message', function()
        {
            return new MessagesManager;
        });

        $this->app->register('Collective\Html\HtmlServiceProvider');
        $this->app->register('MaddHatter\LaravelFullcalendar\ServiceProvider');

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Notification', 'biopartnering\biopartnering\Facades\Notification');
        $loader->alias('Msg', 'biopartnering\biopartnering\Facades\Message');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Calendar', 'MaddHatter\LaravelFullcalendar\Facades\Calendar');

        Config::set('auth.providers.users', ['driver' => 'eloquent', 'model' => \biopartnering\biopartnering\Models\User::class]);
    }
}
