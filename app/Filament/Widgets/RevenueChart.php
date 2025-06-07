<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends LineChartWidget
{
    protected static ?string $heading = 'Revenue Over Time';
    protected static ?int $sort = 2;

    public ?string $filter = '6months';

    protected function getFilters(): ?array
    {
        return [
            '1month' => 'Last Month',
            '3months' => 'Last 3 Months',
            '6months' => 'Last 6 Months',
            '1year' => 'Last Year',
        ];
    }

    protected function getData(): array
    {
        $startDate = match($this->filter) {
            '1month' => now()->subMonth(),
            '3months' => now()->subMonths(3),
            '6months' => now()->subMonths(6),
            '1year' => now()->subYear(),
            default => now()->subMonths(6),
        };

        // Daily revenue data
        $dailyData = Invoice::selectRaw('date(invoice_date) as date, SUM(total_amount) as total')
            ->where('status', 'paid')
            ->where('invoice_date', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Monthly totals
        $monthlyData = Invoice::selectRaw('strftime("%Y-%m", invoice_date) as month, SUM(total_amount) as total')
            ->where('status', 'paid')
            ->where('invoice_date', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Calculate daily average
        $dailyAverage = $dailyData->avg('total');

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue',
                    'data' => $dailyData->pluck('total')->toArray(),
                    'borderColor' => '#10B981', // Emerald color
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Monthly Total',
                    'data' => $monthlyData->pluck('total')->toArray(),
                    'borderColor' => '#6366F1', // Indigo color
                    'tension' => 0.3,
                    'borderDash' => [5, 5],
                ],
                [
                    'label' => 'Daily Average',
                    'data' => array_fill(0, count($dailyData), $dailyAverage),
                    'borderColor' => '#F59E0B', // Amber color
                    'tension' => 0,
                    'borderDash' => [2, 2],
                ],
            ],
            'labels' => $dailyData->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('M d, Y');
            })->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "$" + value.toLocaleString(); }',
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.dataset.label + ": $" + context.raw.toLocaleString(); }',
                    ],
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
} 