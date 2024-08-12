<?php
namespace App\Actions\Payment;

use App\Models\Payment;
use Illuminate\Support\Str;

class StoreAction
{
    public function execute(array $data) : Payment
    {
        $payment                        = new Payment();
        $payment->reference             = $data['reference'];
        $payment->description           = $data['description'];
        $payment->amount                = $data['amount'];
        $payment->currency_id           = $data['currency_id'];
        $payment->status                = $data['status'];
        $payment->gateway               = $data['gateway'];
        $payment->process_identifier    = $data['process_identifier'];
        $payment->expiration            = now()->addMinutes($data['expiration'] ?? 30);
        $payment->fields_data           = $data['fields_data'];
        $payment->site_id               = $data['site_id'];
        $payment->user_id               = $data['user_id'];
        $payment->save();
        return $payment;
    }
}
