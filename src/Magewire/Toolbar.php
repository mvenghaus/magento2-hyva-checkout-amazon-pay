<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Magewire;

use Magewirephp\Magewire\Component;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

class Toolbar extends Component
{
    public function __construct(
        private readonly AmazonPayCheckout $amazonPayCheckout
    ) {
    }

    public function backToStandard(): void
    {
        $this->amazonPayCheckout->deactivateCheckout();

        $this->redirect('checkout');
    }

    public function changeAmazonInformation(): void
    {
        $this->redirect($this->amazonPayCheckout->getChangeUrl());
    }
}
