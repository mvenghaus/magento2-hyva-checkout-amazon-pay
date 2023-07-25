<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Plugin\Hyva\Checkout\ViewModel\Checkout\AddressView;

use Hyva\AmazonPay\Model\AmazonPayCheckout;
use Hyva\Checkout\Model\Component\AddressTypeShipping;
use Hyva\Checkout\ViewModel\Checkout\AddressView\AddressViewShipping;

readonly class AddressViewShippingPlugin
{
    public function __construct(
        private AmazonPayCheckout $amazonPayCheckout,
        private AddressTypeShipping $addressTypeShipping,
    ) {
    }

    public function aroundRenderView(AddressViewShipping $subject, callable $proceed): string
    {
        if ($this->amazonPayCheckout->isCheckoutActive()) {
            return $this->addressTypeShipping->getFormBlock()->toHtml();
        }

        return $proceed();
    }
}
