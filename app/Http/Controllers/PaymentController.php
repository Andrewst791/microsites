<?php

namespace App\Http\Controllers;

use App\Actions\Payment\StoreAction;
use App\Constants\PaymentStatus;
use App\Contracts\PaymentService;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Site;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StorePaymentRequest $request, StoreAction $storeAction)
    {
        $gateway = $request->gateway;
        $site_id = $request->site_id;
        $site = Site::find($site_id);
        $payment = $storeAction->execute($request->validated());

        $paymentService = app(PaymentService::class, [
            'payment' => $payment,
            'gateway' => $gateway,
        ]);

        $response = $paymentService->create($payment->buyer);
        if ($response->status === 'exception') {
            return back()->withErrors(['message' => $response->message]);
        }

        return Inertia::location($response->url);
    }

    public function show(Payment $payment) : Response
    {
        $paymentService = app(PaymentService::class, [
            'payment' => $payment,
            'gateway' => $payment->gateway,
        ]);

        if ($payment->status === PaymentStatus::PENDING->value) {
            $payment = $paymentService->query();
        }

        return Inertia::render('Payment/Show', [
            'payment' => $payment,
        ]);
    }

    public function edit(Payment $payment)
    {
        //
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    public function destroy(Payment $payment)
    {
        //
    }
}
