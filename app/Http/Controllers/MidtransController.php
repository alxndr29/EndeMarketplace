<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    //
    public function config()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-NQzZhOE4mVPzJPoeY5CIObIU';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
    public function index()
    {
        $this->config();
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 20000,
            ),
            'customer_details' => array(
                'first_name' => 'Alexander',
                'last_name' => 'Evan',
                'email' => 'alexevan2810@gmail.com',
                'phone' => '08111222333',
            ),
        );
        /*
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user.midtrans', compact('snapToken'));
       */
        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
            return redirect($paymentUrl);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function getStatus()
    {
        $this->config();
        $status = \Midtrans\Transaction::status(441798310);
        dd($status);
    }
    public function cancelPayment()
    {
        $this->config();
        $cancel = \Midtrans\Transaction::cancel(1906485419);
        dd($cancel);
    }
    public function payment_handling(Request $request)
    {

        $this->config();
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }
}
