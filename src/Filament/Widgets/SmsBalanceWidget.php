<?php

namespace Bigraja\BulkSmsBD\Filament\Widgets;

use Filament\Widgets\Widget;
use Bigraja\BulkSmsBD\BulkSmsBDService;

class SmsBalanceWidget extends Widget
{
    protected static string $view = 'bulksmsbd::widgets.sms-balance-widget';

    public function getViewData(): array
    {
        $balance = app(BulkSmsBDService::class)->getBalance();

        return [
            'balance' => $balance,
        ];
    }
}
