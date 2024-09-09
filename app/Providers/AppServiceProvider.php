<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use App\Constants\PaymentGateway;
use App\Contracts\PaymentGateway as PaymentGatewayContract;
use App\Contracts\PaymentService as PaymentServiceContract;
use App\Services\Payments\Gateways\PaypalGateway;
use App\Services\Payments\Gateways\PlacetoPayGateway;
use App\Services\Payments\PaymentService;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceContract::class, function (Application $app, array $data) {
            ['payment' => $payment, 'gateway' => $gateway] = $data;

            $gateway = $app->make(PaymentGatewayContract::class, ['gateway' => $gateway, 'payment' => $payment]);

            return new PaymentService($payment, $gateway);
        });

        $this->app->bind(PaymentGatewayContract::class, function (Application $app, array $data) {
            $method_payment = $data['gateway'];
            $expiration = $data['payment']->expiration;

            return match (PaymentGateway::from($method_payment)) {
                PaymentGateway::PLACETOPAY => new PlacetoPayGateway($expiration),
                PaymentGateway::PAYPAL => new PaypalGateway(),
                default => throw new InvalidArgumentException("Unsupported site type: $method_payment"),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
