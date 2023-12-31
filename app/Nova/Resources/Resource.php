<?php

namespace App\Nova\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class Resource extends NovaResource
{
    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static $perPageOptions = [20, 50, 100];

    /**
     * Whether to show borders for each column on the X-axis.
     *
     * @var bool
     */
    public static $showColumnBorders = false;

    /**
     * The click action to use when clicking on the resource in the table.
     * Can be one of: 'detail' (default), 'edit', 'select', 'preview', or 'ignore'.
     *
     * @var string
     */
    public static $clickAction = 'ignore';

    /**
     * The visual style used for the table. Available options are 'tight' and 'default'.
     *
     * @var string
     */
    public static $tableStyle = 'default';

    /**
     * The column by which to sort as default
     *
     * @var string
     */
    public static string $defaultSort = '';

    /**
     * Sort ascending or descending as default
     *
     * @var string
     */
    public static string $defaultOrder = 'desc';

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __(parent::label());
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __(Str::singular(Str::title(Str::snake(class_basename(get_called_class()), ' '))));
    }

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
        return $query;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $query = static::indexFilter($request, $query);

        if (static::$defaultSort && static::$defaultOrder && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(static::$defaultSort, static::$defaultOrder);
        }

        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Scout\Builder $query
     *
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query): Builder
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query): Builder
    {
        return parent::relatableQuery($request, $query);
    }

    /******************
     * Default fields *
     *****************/
    /**
     * Show in this resource the DateTime field `created_at`
     *
     * @var bool
     */
    public bool $showCreatedAtField = true;

    public function showCreatedAtField(NovaRequest $request): bool
    {
        return $this->showCreatedAtField;
    }

    /**
     * Show in this resource the DateTime field `updated_at`
     *
     * @var bool
     */
    public bool $showUpdatedAtField = true;

    public function showUpdatedAtField(NovaRequest $request): bool
    {
        return $this->showUpdatedAtField;
    }

    /**
     * Default fields for every resource
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    protected function defaultFields(NovaRequest $request): array
    {
        $fields = [];

        if ($this->showCreatedAtField($request) && static::$model::CREATED_AT) {
            $fields = array_merge($fields, [
                DateTime::make(__('Created at'), 'created_at')
                    ->sortable()->filterable()->exceptOnForms(),
            ]);
        }

        if ($this->showUpdatedAtField($request) && static::$model::UPDATED_AT) {
            $fields = array_merge($fields, [
                DateTime::make(__('Updated at'), 'updated_at')
                    ->sortable()->filterable()->exceptOnForms(),
            ]);
        }

        /*
         * For SoftDeletes
         * */
        if ($request->input('trashed')) {
            $fields = array_merge($fields, [
                DateTime::make(__('Deleted at'), 'deleted_at')
                    ->sortable()->filterable()->exceptOnForms(),
            ]);
        }

        /*
         * For spatie/laravel-activitylog
         * */
        if (method_exists(static::$model, 'getLogName') && class_exists('App\Nova\Resources\Activity')) {
            $fields = array_merge($fields, [
                MorphMany::make(__('Activities'), 'activities', Activity::class),
            ]);
        }

        return $fields;
    }

    /**
     * Get the fields that are available for the given request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return FieldCollection
     */
    public function availableFields(NovaRequest $request): FieldCollection
    {
        $method = $this->fieldsMethod($request);
        $fields = array_merge($this->{$method}($request), $this->defaultFields($request));

        return FieldCollection::make(array_values($this->filter($fields)));
    }

    /**
     * Get the fields that are available for the given request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param array $methods
     *
     * @return FieldCollection
     */
    public function buildAvailableFields(NovaRequest $request, array $methods): FieldCollection
    {
        $fields = collect([
            method_exists($this, 'fields') ? array_merge($this->fields($request), $this->defaultFields($request)) : [],
        ]);

        collect($methods)
            ->filter(function ($method) {
                return $method != 'fields' && method_exists($this, $method);
            })->each(function ($method) use ($request, $fields) {
                $fields->push([$this->{$method}($request)]);
            });

        return FieldCollection::make(array_values($this->filter($fields->flatten()->all())));
    }
}
