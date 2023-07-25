<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Plugin\Hyva\Checkout\ViewModel\Checkout\Payment;

use Amazon\Pay\Gateway\Config\Config;
use Hyva\Checkout\ViewModel\Checkout\Payment\Method;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

readonly class MethodPlugin
{
    public function __construct(
        private AmazonPayCheckout $amazonPayCheckout
    ) {
    }

    public function afterGetList(Method $subject, array|null $result): ?array
    {
        if ($result === null) {
            return null;
        }

        if ($this->amazonPayCheckout->isCheckoutActive()) {
            return array_filter($result, fn($payment) => $payment->getCode() === Config::CODE);
        }

        return array_filter($result, fn($payment) => $payment->getCode() !== Config::CODE);
    }
}
