<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use App\Models\Prospect;
use App\Models\Instructor;
use App\Models\Membership;
use App\Models\Event;
use App\Models\Location;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Members', Member::count())
                ->description('Total number of registered members')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Prospects', Prospect::count())
                ->description('Total number of prospects')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),

            Stat::make('Total Instructors', Instructor::count())
                ->description('Total number of instructors')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Total Memberships', Membership::count())
                ->description('All memberships in the system')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Events', Event::count())
                ->description('All events in the system')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),

            Stat::make('Total Locations', Location::count())
                ->description('All locations in the system')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('success'),
        ];
    }
} 