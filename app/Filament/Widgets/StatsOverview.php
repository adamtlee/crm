<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use App\Models\Prospect;
use App\Models\Instructor;
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
        ];
    }
} 