<?php

namespace App\Providers;

use App\Console\Commands\Development\MigrateMakeCommand;
use App\Services\ActivityLogger;
use App\Services\MigrationCreator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Spatie\Activitylog\ActivityLogger as SpatieActivityLogger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        SpatieActivityLogger::class => ActivityLogger::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->runningInConsole() && (app()->isLocal()) || app()->runningUnitTests()) {
            $this->registerCustomMigrationCreator();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(static function () {
            return Password::min(12)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        $this->bindJobProcessingStatus();
    }

    /**
     * Register a job processing binding.
     */
    protected function bindJobProcessingStatus(): void
    {
        $this->app->bind('JobProcessing', function ($app) {
            return false;
        });
        Queue::before(function (JobProcessing $event) {
            $this->app->bind('JobProcessing', function ($app) {
                return true;
            });
        });
        Queue::after(function (JobProcessed $event) {
            $this->app->bind('JobProcessing', function ($app) {
                return false;
            });
        });
    }

    /**
     * Register the migration creator.
     */
    protected function registerCustomMigrationCreator(): void
    {
        $this->app->singleton(MigrateMakeCommand::class, function (Application $app) {
            $creator = new MigrationCreator($app['files'], $app->basePath('stubs'));

            $composer = $app['composer'];

            return new MigrateMakeCommand($creator, $composer);
        });

        $this->app->singleton('migration.creator', function ($app) {
            return new MigrationCreator($app['files'], $app->basePath('stubs'));
        });
    }
}
