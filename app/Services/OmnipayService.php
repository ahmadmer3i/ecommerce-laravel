<?php

namespace App\Services;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Omnipay;

class OmnipayService
{
    protected $gateway = '';

    public function __construct($payment_method = 'PayPal_Express')
    {
        if (is_null($payment_method) || $payment_method == 'PayPal_Express') {
            $this->gateway = Omnipay::create('PayPal_Express');
            $this->gateway->setUsername(config('services.paypal.username'));
            $this->gateway->setPassword(config('services.paypal.password'));
            $this->gateway->setSignature(config('services.paypal.signature'));
            $this->gateway->setTestMode(config('services.paypal.sandbox'));
        }
        return $this->gateway;
    }

    public function purchase(array $parameter)
    {
        return $this->gateway->purchase($parameter)->send();
    }

    public function complete(array $parameter)
    {
        return $this->gateway->completePurchase($parameter)->send();
    }

    public function refund(array $parameter)
    {
        return $this->gateway->refund($parameter)->send();
    }

    public function getCancelUrl($order_id): string
    {
        return route('checkout.cancel', $order_id);
    }

    public function getReturnUrl($order_id): string
    {
        return route('checkout.complete', $order_id);
    }

    public function getNotifyUrl($order): string
    {
        $env = config('services.paypal.sandbox') ? 'sandbox' : 'live';
        return route('checkout.webhook.ipn', [ $order, $env ]);
    }
}
