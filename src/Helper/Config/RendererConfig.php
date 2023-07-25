<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Helper\Config;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class RendererConfig extends AbstractHelper
{
    public const XML_PATH_SCRIPT_ATTRIBUTES = 'payment/amazon_pay/advanced/hyva_checkout/script_attributes';

    public function getScriptAttributes(): array
    {
        $rawScriptAttributes = $this->scopeConfig->getValue(
            self::XML_PATH_SCRIPT_ATTRIBUTES,
            ScopeInterface::SCOPE_STORE
        );
        if (!empty($rawScriptAttributes)) {
            $scriptAttributes = json_decode($rawScriptAttributes, true);
            if (empty($scriptAttributes)) {
                return [];
            }

            return $this->validateScriptAttributes($scriptAttributes);
        }

        return [];
    }

    private function validateScriptAttributes(array $scriptAttributes): array
    {
        $invalidAttributes = ['src'];
        return array_filter(
            $scriptAttributes,
            fn(string $attribute) => !in_array($attribute, $invalidAttributes),
            ARRAY_FILTER_USE_KEY
        );
    }
}
