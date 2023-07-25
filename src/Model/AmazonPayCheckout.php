<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Model;

use Amazon\Pay\Api\CheckoutSessionManagementInterface as AmazonCheckoutSessionManagementInterface;
use Amazon\Pay\Model\AmazonConfig;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteRepository;

readonly class AmazonPayCheckout
{
    public function __construct(
        private AmazonConfig $amazonConfig,
        private CheckoutSession $checkoutSession,
        private QuoteRepository $quoteRepository,
        private AmazonCheckoutSessionManagementInterface $amazonCheckoutSessionManagement,
        private array $paymentRegionStaticUrls,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->amazonConfig->isEnabled();
    }

    public function getCheckoutSessionConfig(): array
    {
        return $this->amazonCheckoutSessionManagement->getConfig();
    }

    public function setCheckoutSessionId(?string $checkoutSessionId): void
    {
        $this->checkoutSession->setAmazonPayCheckoutSessionId($checkoutSessionId);
    }

    public function getCheckoutSessionId(): ?string
    {
        return $this->checkoutSession->getAmazonPayCheckoutSessionId();
    }

    public function isCheckoutActive(): bool
    {
        return !empty($this->getCheckoutSessionId());
    }

    public function deactivateCheckout(): void
    {
        $this->setCheckoutSessionId(null);
        $this->setProcessingUrl(null);

        $quote = $this->checkoutSession->getQuote();
        $quote->getPayment()->setMethod('');
        $this->quoteRepository->save($quote);
    }

    public function setProcessingUrl(?string $processingUrl): void
    {
        $this->checkoutSession->setAmazonPayProcessingUrl($processingUrl);
    }

    public function getProcessingUrl(): string
    {
        return $this->checkoutSession->getAmazonPayProcessingUrl();
    }

    public function getChangeUrl(): string
    {
        return str_replace('/processing', '', $this->getProcessingUrl());
    }

    public function getStaticUrl(): string
    {
        return $this->paymentRegionStaticUrls[$this->amazonConfig->getPaymentRegion()] ?? '';
    }
}
