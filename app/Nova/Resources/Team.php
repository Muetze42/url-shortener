<?php

namespace App\Nova\Resources;

use App\Enums\TeamUserRoleEnum;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use NormanHuth\FontAwesomeField\FontAwesome;
use NormanHuth\NovaRadioField\Radio;

class Team extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Team::class;

    /**
     * Build an "index" query filter for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexFilter(NovaRequest $request, Builder $query): Builder
    {
        /* @var \Illuminate\Database\Eloquent\Builder|\App\Models\Team $query */
        if ($request->user()->is_admin) {
            return $query;
        }

        return $query->whereIn('id', $request->user()->teamIds());
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'user.name',
        'user.email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            Text::make(__('Name'), 'name')
                ->rules('required', 'max:255')
                ->sortable(),
            FontAwesome::make('icon')->nullable(),

            BelongsToMany::make(__('Users'), 'users')
                ->fields(function (NovaRequest $request) {
                    $roles = $request->isFormRequest() ? [
                        TeamUserRoleEnum::MEMBER->value => TeamUserRoleEnum::MEMBER->label(),
                        TeamUserRoleEnum::ADMIN->value => TeamUserRoleEnum::ADMIN->label(),
                    ] : [
                        TeamUserRoleEnum::MEMBER->value => TeamUserRoleEnum::MEMBER->label(),
                        TeamUserRoleEnum::ADMIN->value => TeamUserRoleEnum::ADMIN->label(),
                        TeamUserRoleEnum::OWNER->value => TeamUserRoleEnum::OWNER->label(),
                    ];

                    return [
                        Radio::make(__('Role'), 'role')
                            ->options($roles)
                            ->rules('required')
                            ->default(TeamUserRoleEnum::MEMBER)
                            ->displayUsingLabels(),
                    ];
                }),

            HasMany::make(__('URLs'), 'urls'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
