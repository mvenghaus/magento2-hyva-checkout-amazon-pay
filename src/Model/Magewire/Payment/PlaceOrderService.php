<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Model\Magewire\Payment;

use Amazon\Pay\Model\Adapter\AmazonPayAdapter;
use Hyva\Checkout\Model\Magewire\Payment\AbstractPlaceOrderService;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\Quote;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

class PlaceOrderService extends AbstractPlaceOrderService
{
    public function __construct(
        private readonly AmazonPayCheckout $amazonCheckout,
        private readonly AmazonPayAdapter $amazonPayAdapter,
        CartManagementInterface $cartManagement
    ) {
        parent::__construct($cartManagement);
    }

    public function placeOrder(Quote $quote): int
    {
        $paymentIntent = AmazonPayAdapter::PAYMENT_INTENT_AUTHORIZE;

        $this->amazonPayAdapter->updateCheckoutSession(
            $quote,
            $this->amazonCheckout->getCheckoutSessionId(),
            $paymentIntent
        );

        return 1;
    }

    public function canRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl(Quote $quote, ?int $orderId = null): string
    {
        return $this->amazonCheckout->getProcessingUrl();
    }
}
