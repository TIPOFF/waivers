<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Waiver extends BaseResource
{
    public static $model = \Tipoff\Waivers\Models\Waiver::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            nova('location') ? BelongsTo::make('Location', 'location', nova('location'))->sortable() : null,
            Date::make('Released At', 'released_at')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            ID::make()->sortable(),

            nova('location') ? BelongsTo::make('Location', 'location', nova('location')) : null,

            Date::make('Released At', 'released_at'),

            new Panel('Waiver Agreements', $this->waiverFields()),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function waiverFields()
    {
        return [
            Textarea::make('Waiver Agreement', 'waiver'),
            Textarea::make('Minor Agreement', 'minor_statement'),
        ];
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
