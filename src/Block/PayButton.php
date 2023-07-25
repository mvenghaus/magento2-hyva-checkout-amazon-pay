<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Block;

use Magento\Catalog\Block\ShortcutInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Hyva\AmazonPay\Model\AmazonPayCheckout;

class PayButton extends Template implements ShortcutInterface
{
    protected $_template = 'Hyva_AmazonPay::pay-button.phtml';

    public function __construct(
        private readonly AmazonPayCheckout $amazonPayCheckout,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getAlias()
    {
        return 'amazon_pay';
    }

    protected function _toHtml()
    {
        if (!$this->amazonPayCheckout->isEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}
