<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Observer\Frontend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

readonly class DisableAmazonPayCheckout implements ObserverInterface
{
    public function __construct(
        private AmazonPayCheckout $amazonPayCheckout
    ) {
    }

    public function execute(Observer $observer)
    {
        $this->amazonPayCheckout->deactivateCheckout();
    }
}
