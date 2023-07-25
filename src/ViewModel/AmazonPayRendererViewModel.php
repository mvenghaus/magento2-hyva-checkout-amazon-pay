<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\ViewModel;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\LayoutInterface;
use Hyva\AmazonPay\Block\PayButton;
use Hyva\AmazonPay\Helper\Config\RendererConfig;

class AmazonPayRendererViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly LayoutInterface $layout,
        private readonly RendererConfig $rendererConfig,
        private readonly Escaper $escaper
    ) {
    }

    public function renderScriptAttributes(): string
    {
        $scriptAttributes = $this->rendererConfig->getScriptAttributes();

        $renderedAttributes = [];
        foreach ($scriptAttributes as $name => $value) {
            $renderedAttributes[] = sprintf(
                '%s="%s"',
                $this->escaper->escapeHtml($name),
                $this->escaper->escapeHtmlAttr($value)
            );
        }

        return implode(' ', $renderedAttributes);
    }

    public function renderPayButton(): string
    {
        return $this->layout->createBlock(PayButton::class)
            ->toHtml();
    }
}
