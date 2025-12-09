<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\SchoolClass;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('All registered students')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),
                
            Stat::make('Total Classes', SchoolClass::count())
                ->description('Active classes')
                ->descriptionIcon('heroicon-o-rectangle-group')
                ->color('primary'),
        ];
    }
}
