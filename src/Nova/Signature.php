<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class Signature extends BaseResource
{
    public static $model = \Tipoff\Waivers\Models\Signature::class;

    public static function label()
    {
        return 'Waiver Signatures';
    }

    public static function singularLabel()
    {
        return 'Signature';
    }

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->hasRole([
            'Admin',
            'Owner',
            'Accountant',
            'Executive',
            'Reservation Manager',
            'Reservationist',
        ])) {
            return $query;
        }

        return $query->whereHas('room', function ($roomlocation) use ($request) {
            return $roomlocation->whereIn('location_id', $request->user()->locations->pluck('id'));
        });
    }

    public static $group = 'Reporting';

    /** @psalm-suppress UndefinedClass */
    protected array $filterClassList = [
        \Tipoff\EscapeRoom\Nova\Filters\RoomLocation::class,
        \Tipoff\EscapeRoom\Nova\Filters\Room::class,
    ];

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Name', function () {
                return $this->name.' '.$this->name_last;
            }),
            nova('participant') ? BelongsTo::make('Participant', 'participant', nova('participant'))->sortable() : null,
            nova('room') ? BelongsTo::make('Room', 'room', nova('room'))->sortable() : null,
            DateTime::make('Signed', 'created_at')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('First Name', 'name'),
            Text::make('Last Name', 'name_last'),
            DateTime::make('Signed', 'created_at'),
            Boolean::make('Playing'),
            nova('participant') ? BelongsTo::make('Participant', 'participant', nova('participant')) : null,
            nova('room') ? BelongsTo::make('Room', 'room', nova('room')) : null,
            Date::make('Date of Birth', 'dob'),
            Number::make('Minors'),
            KeyValue::make('List of Minors', 'minors_names')->rules('json')
                ->keyLabel('#')
                ->valueLabel('Name')
                ->resolveUsing(function ($minors) {
                    $collection = collect($minors);
                    $keyed = $collection->mapWithKeys(function ($item) {
                        return [$item['id'] => $item['name']];
                    });

                    return $keyed->all();
                }),
            DateTime::make('Email Sent', 'emailed_at'),
            Boolean::make('Valid Email'),
            ID::make(),
        ]);
    }
}
