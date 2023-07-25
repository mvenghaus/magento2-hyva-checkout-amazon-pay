<?php

declare(strict_types=1);

namespace Hyva\AmazonPay\Observer\Frontend;

use Amazon\Pay\Api\CheckoutSessionManagementInterface as AmazonCheckoutSessionManagementInterface;
use Amazon\Pay\Gateway\Config\Config;
use Hyva\AmazonPay\Model\AddressManagement;
use Hyva\AmazonPay\Model\AmazonPayCheckout;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\UrlInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteRepository;

readonly class ProcessAmazonInformation implements ObserverInterface
{
    public function __construct(
        private RequestInterface $request,
        private UrlInterface $url,
        private CheckoutSession $checkoutSession,
        private AmazonPayCheckout $amazonPayCheckout,
        private AmazonCheckoutSessionManagementInterface $amazonCheckoutSessionManagement,
        private QuoteRepository $quoteRepository,
        private AddressManagement $addressManagement,
    ) {
    }

    public function execute(Observer $observer): void
    {
        $amazonCheckoutSessionId = $this->request->getParam('amazonCheckoutSessionId');
        if (!empty($amazonCheckoutSessionId)) {
            $quote = $this->checkoutSession->getQuote();

            $this->amazonPayCheckout->setCheckoutSessionId($amazonCheckoutSessionId);
            $this->amazonPayCheckout->setProcessingUrl(
                $this->amazonCheckoutSessionManagement->updateCheckoutSession($amazonCheckoutSessionId)
            );

            $this->processAddresses($quote, $amazonCheckoutSessionId);
            $this->processPayment($quote);

            $this->quoteRepository->save($quote);
            $quote->collectTotals();

            /** @var \Hyva\Checkout\Controller\Index\Index $controllerAction */
            $controllerAction = $observer->getData('controller_action');
            $controllerAction->getResponse()->setRedirect($this->url->getUrl('checkout'));
        }
    }

    private function processAddresses(Quote $quote, string $amazonCheckoutSessionId): void
    {
        $amazonShippingAddresses = $this->amazonCheckoutSessionManagement->getShippingAddress($amazonCheckoutSessionId);
        $amazonShippingAddressData = $amazonShippingAddresses[0] ?? null;

        if (!empty($amazonShippingAddressData)) {
            $this->addressManagement->updateQuoteAddress($quote, $amazonShippingAddressData, $quote->getCustomer());
        }
    }

    private function processPayment(Quote $quote): void
    {
        $quote
            ->getPayment()
            ->setQuote($quote)
            ->setMethod(Config::CODE)
            ->getMethodInstance();
    }
}
