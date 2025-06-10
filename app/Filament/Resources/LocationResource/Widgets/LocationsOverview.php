<?php

namespace App\Filament\Resources\LocationResource\Widgets;

use App\Models\Location;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LocationsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Locations', Location::count())
                ->description('All locations in the system')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('success'),
        ];
    }
}
