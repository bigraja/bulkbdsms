<?php

namespace Bigraja\BulkBDSms\Filament\Widgets;

use Filament\Widgets\Widget;
use Bigraja\BulkBDSms\BulkBDSmsService;

class SmsBalanceWidget extends Widget
{
    protected static string $view = 'bulksmsbd::widgets.sms-balance-widget';

    public function getViewData(): array
    {
        $balance = app(BulkBDSmsService::class)->getBalance();

        return [
            'balance' => $balance,
        ];
    }
}
