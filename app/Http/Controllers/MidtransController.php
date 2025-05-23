<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Midtrans\Notification;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handleCallback(Request $request)
    {
        try {
            $notif = new Notification();

            $transactionStatus = $notif->transaction_status;
            $paymentType = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            Log::info("Midtrans Callback: $transactionStatus - Order ID: $orderId");

            // Cek jika status sukses
            if ($transactionStatus == 'settlement') {
                DB::table('carts')
                    ->where('invoice', $orderId)
                    ->update(['status' => 1]); // status 1 = Lunas
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
                DB::table('carts')
                    ->where('invoice', $orderId)
                    ->update(['status' => 2]); // status 2 = Dibatalkan
            }

            return response()->json(['message' => 'Callback handled']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['error' => 'Callback failed'], 500);
        }
    }
}
