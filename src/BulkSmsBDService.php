<?php

namespace Bigraja\BulkSmsBD;

use Illuminate\Support\Facades\Http;
use Bigraja\BulkSmsBD\Models\SmsLog;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function getBalance(): int
    {
        try {
            $response = Http::get('http://bulksmsbd.net/api/getBalanceApi', [
                'api_key' => config('bulksmsbd.api_key'),
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['balance'])) {
                    return $data['balance'];
                } else {
                    Log::error('SMS API response missing balance field.', ['response' => $data]);
                    return 0;
                }
            } else {
                Log::error('Failed to fetch SMS balance.', ['status' => $response->status(), 'body' => $response->body()]);
                return 0;
            }
        } catch (Exception $e) {
            Log::error('Exception while fetching SMS balance: ' . $e->getMessage());
            return 0;
        }
    }
}
