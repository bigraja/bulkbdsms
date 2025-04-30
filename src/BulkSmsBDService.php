<?php

namespace Bigraja\BulkSmsBD;

use Illuminate\Support\Facades\Http;
use Bigraja\BulkSmsBD\Models\SmsLog;

class BulkSmsBDService
{
    public function send($to, $message)
    {
        $response = Http::get('http://bulksmsbd.net/api/smsapi', [
            'api_key'  => config('bulksmsbd.api_key'),
            'type'     => 'text',
            'number'   => $to,
            'senderid' => config('bulksmsbd.sender_id'),
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
            'api_key' => config('bulksmsbd.api_key'),
        ]);

        return $response->body();
    }
}
