<?php

namespace App\Nova\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Url extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Url::class;

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
        $teamId = (int) $request->input('viaPerspective');
        /* @var \Illuminate\Database\Eloquent\Builder|\App\Models\Url $query */
        if (!in_array($teamId, $request->user()->teamIds())) {
            return $query->whereNull('team_id');
        }

        return $query->where('team_id', $teamId);
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
        'path',
        'name',
        'target',
        'team.name',
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
            BelongsTo::make(__('Team'), 'team')
                ->readonly()
                ->onlyOnForms()
                ->default($request->input('viaPerspective')),
            Text::make(__('Path'), 'path')
                ->sortable()
                ->rules('required', 'max:100', function ($attribute, $value, $fail) {
                    appLog(config('app.url') . '/' . $value);
                    if (!Str::isUrl(config('app.url') . '/' . $value)) {
                        return $fail('The ' . $attribute . ' field must be a valid URL path.');
                    }

                    return true;
                }),
            Text::make(__('Target'), 'target')
                ->sortable()->rules('required', 'max:255', 'url'),
            Boolean::make(__('Active'), 'active')
                ->sortable()->default(true),

            Number::make(__('Visits'), 'visits')
                ->sortable()->exceptOnForms(),
            Number::make(__('Total visits'), 'visits_total')
                ->sortable()->exceptOnForms(),
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
