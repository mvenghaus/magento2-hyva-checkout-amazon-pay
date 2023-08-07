<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Model;

use Magento\Customer\Model\Data\Customer;
use Magento\Quote\Model\Quote;

class AddressManagement
{
    public function updateQuoteAddress(Quote $quote, array $amazonShippingAddressData, Customer $customer): void
    {
        $quote
            ->getShippingAddress()
            ->setCustomerId($customer->getId())
            ->setCompany($amazonShippingAddressData['company'] ?? '')
            ->setFirstname($amazonShippingAddressData['firstname'] ?? '')
            ->setLastname($amazonShippingAddressData['lastname'] ?? '')
            ->setStreet($amazonShippingAddressData['street'] ?? '')
            ->setPostcode($amazonShippingAddressData['postcode'] ?? '')
            ->setCity($amazonShippingAddressData['city'] ?? '')
            ->setRegion($amazonData['region'] ?? '')
            ->setRegionId((int)($amazonData['region_id'] ?? ''))
            ->setCountryId($amazonShippingAddressData['country_id'] ?? '')
            ->setTelephone($amazonShippingAddressData['telephone'] ?? '')
            ->setSameAsBilling(true);

        $quote
            ->getBillingAddress()
            ->setCustomerId($customer->getId())
            ->setCompany($amazonShippingAddressData['company'] ?? '')
            ->setFirstname($amazonShippingAddressData['firstname'] ?? '')
            ->setLastname($amazonShippingAddressData['lastname'] ?? '')
            ->setStreet($amazonShippingAddressData['street'] ?? '')
            ->setPostcode($amazonShippingAddressData['postcode'] ?? '')
            ->setCity($amazonShippingAddressData['city'] ?? '')
            ->setRegion($amazonData['region'] ?? '')
            ->setRegionId((int)($amazonData['region_id'] ?? ''))
            ->setCountryId($amazonShippingAddressData['country_id'] ?? '')
            ->setTelephone($amazonShippingAddressData['telephone'] ?? '');
    }
}
