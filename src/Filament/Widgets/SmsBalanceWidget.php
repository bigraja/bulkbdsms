<?php

namespace Bigraja\BulkSmsBD\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Bigraja\BulkSmsBD\BulkSmsBDService;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SmsBalanceWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $balance = app(BulkSmsBDService::class)->getBalance();

        $formattedBalance = $balance !== null
            ? number_format($balance, 2) . ' BDT'
            : 'Unavailable';

        return [
            Stat::make('Total Balance', $formattedBalance)
                ->description('Total Bulk SMS BD amount')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color($balance !== null ? 'success' : 'gray'),
        ];
    }
}
