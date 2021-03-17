<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
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

    //public function fieldsForIndex(NovaRequest $request)
    //{
    //    return array_filter([
    //        ID::make()->sortable(),
    //    ]);
    //}

    public function fields(Request $request)
    {
        return array_filter([
            ID::make()->sortable(),

            new Panel('Waiver Agreements', $this->waiverFields()),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function waiverFields()
    {
        return [
            Textarea::make('Waiver Agreement', 'waiver'),
            Textarea::make('Minor Agreement', 'waiver_minor'),
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
