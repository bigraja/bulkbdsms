<?php

namespace Bigraja\BulkBDSms;

use Illuminate\Support\Facades\Http;
use Bigraja\BulkBDSms\Models\SmsLog;

class BulkBDSmsService
{
    public function send($to, $message)
    {
        $response = Http::get('http://bulksmsbd.net/api/smsapi', [
            'api_key'  => config('bulkbdsms.api_key'),
            'type'     => 'text',
            'number'   => $to,
            'senderid' => config('bulkbdsms.sender_id'),
            'message'  => $message,
        ]);

        SmsLog::create([
            'to' => $to,
            'message' => $message,
            'status' => $response->body(),
            'response' => $response->body(),
        ]);

        return $response->body();
    }

    public function getBalance()
    {
        $response = Http::get('http://bulksmsbd.net/api/getBalanceApi', [
            'api_key' => config('bulkbdsms.api_key'),
        ]);

        return $response->body();
    }
}
