<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

class AmazonPayCheckoutViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly AmazonPayCheckout $amazonCheckout
    ) {
    }

    public function getCheckoutSessionConfig(): array
    {
        return $this->amazonCheckout->getCheckoutSessionConfig();
    }

    public function isCheckoutActive(): bool
    {
        return $this->amazonCheckout->isCheckoutActive();
    }

    public function getStaticUrl(): string
    {
        return $this->amazonCheckout->getStaticUrl();
    }
}
