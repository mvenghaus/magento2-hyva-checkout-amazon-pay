<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Magewire;

use Magewirephp\Magewire\Component;
use Hyva\AmazonPay\Model\AmazonPayCheckout;
use Hyva\Checkout\Model\Session as SessionCheckoutConfig;

class Toolbar extends Component
{
    public function __construct(
        private readonly SessionCheckoutConfig $sessionCheckoutConfig,
        private readonly AmazonPayCheckout $amazonPayCheckout
    ) {
    }

    public function backToStandard(): void
    {
        $this->sessionCheckoutConfig->setCurrentStep('shipping');

        $this->amazonPayCheckout->deactivateCheckout();

        $this->redirect('checkout');
    }

    public function changeAmazonInformation(): void
    {
        $this->sessionCheckoutConfig->setCurrentStep('shipping');

        $this->redirect($this->amazonPayCheckout->getChangeUrl());
    }
}
