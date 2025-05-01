<?php

namespace Bigraja\BulkSmsBD;

use Bigraja\BulkSmsBD\Models\BulkSmsBDLog;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;

class BulkSmsBDService
{
    public function send(string $to, string $message): bool
    {
        try {
            $response = Http::timeout(10)->get('http://bulksmsbd.net/api/smsapi', [
                'api_key'  => config('bulksmsbd.api_key'),
                'type'     => 'text',
                'number'   => $to,
                'senderid' => config('bulksmsbd.sender_id'),
                'message'  => urlencode($message),
            ]);

            $statusCode = $response->status();
            $responseBody = $response->body();

            // Save to log table regardless of success/failure
            BulkSmsBDLog::create([
                'to'       => $to,
                'message'  => $message,
                'status'   => $statusCode,
                'response' => $responseBody,
            ]);

            // API Success Code = 202
            return $responseBody === '202';
        } catch (Exception $e) {
            // Log failed attempt
            BulkSmsBDLog::create([
                'to'       => $to,
                'message'  => $message,
                'status'   => 'error',
                'response' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function sendBulk(array $recipients, string $message): bool
    {
        try {
            // Convert array of numbers to comma-separated string
            $numbers = implode(',', $recipients);

            // Send a single API request for all numbers
            $response = Http::timeout(10)->get('http://bulksmsbd.net/api/smsapi', [
                'api_key'  => config('bulksmsbd.api_key'),
                'type'     => 'text',
                'number'   => $numbers,
                'senderid' => config('bulksmsbd.sender_id'),
                'message'  => urlencode($message),
            ]);

            $responseBody = $response->body();
            $statusCode = $response->status();

            // Log message for each individual recipient
            foreach ($recipients as $number) {
                BulkSmsBDLog::create([
                    'to'       => $number,
                    'message'  => $message,
                    'status'   => $statusCode,
                    'response' => $responseBody,
                ]);
            }

            // Check if the API returned success code 202
            return $responseBody === '202';
        } catch (Exception $e) {
            // In case of error, log for each recipient
            foreach ($recipients as $number) {
                BulkSmsBDLog::create([
                    'to'       => $number,
                    'message'  => $message,
                    'status'   => 'error',
                    'response' => $e->getMessage(),
                ]);
            }

            return false;
        }
    }

    public function getBalance(): float
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
