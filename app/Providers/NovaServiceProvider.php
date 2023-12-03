<?php

namespace App\Providers;

use App\Models\User as UserModel;
use App\Nova\Dashboards\Main;
use App\Nova\Resources\Team;
use App\Nova\Resources\Url;
use App\Nova\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use NormanHuth\NovaMenu\MenuItem;
use NormanHuth\NovaMenu\MenuSection;
use NormanHuth\NovaPerspectives\Menu\PerspektiveSelect;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        Nova::footer(function ($request) {
            return str_replace('<a ', '<a target="_blank" ', Nova::defaultFooter($request));
        });

        Nova::mainMenu(function (Request $request) {
            return [
                PerspektiveSelect::make(),
                MenuSection::make(__('Shortener'), [
                    MenuItem::resource(Url::class),
                ])->svgIcon(resource_path('icons/link.svg')),
                MenuSection::make('Team', [
                    MenuItem::resource(Team::class),
                    MenuItem::resource(User::class),
                ])->svgIcon(resource_path('icons/users.svg')),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (UserModel $user) {
            return true;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [
            new Main(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources(): void
    {
        Nova::resourcesIn(app_path('Nova/Resources'));
    }
}
