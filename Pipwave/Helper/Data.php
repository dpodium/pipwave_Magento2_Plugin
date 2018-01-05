<?php
namespace Dpodium\Pipwave\Helper;

//admin configuration data
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $scopeConfig;
    public function __construct(\Magento\Framework\App\Helper\Context $context) {
        parent::__construct($context);
        $this->scopeConfig = $context->getScopeConfig();
    }

    //from etc\adminhtml\system.xml
    const API_KEY = 'payment/pipwave/api_key';
    const API_SECRET = 'payment/pipwave/api_secret';
    const TEST_MODE = 'payment/pipwave/test_mode';
    const PROCESSING_FEE = 'payment/pipwave/processing_fee';
    const AUTO_SHIPPING = 'payment/pipwave/auto_shipping';
    const AUTO_INVOICE = 'payment/pipwave/auto_invoice';
    const FAIL_URL = 'payment/pipwave/fail_url';
    const SUCCESS_URL = 'payment/pipwave/success_url';

    public function getApiKey() {
        return $this->scopeConfig->getValue(
            self::API_KEY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getApiSecret() {
        return $this->scopeConfig->getValue(
            self::API_SECRET,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getTestMode() {
        return $this->scopeConfig->getValue(
            self::TEST_MODE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getProcessingFeeGroup()
    {
        return $this->scopeConfig->getValue(
            self::PROCESSING_FEE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function isShippingEnabled()
    {
        return $this->scopeConfig->getValue(
            self::AUTO_SHIPPING,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function isInvoiceEnabled()
    {
        return $this->scopeConfig->getValue(
            self::AUTO_INVOICE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getFailUrl() {
        return $this->scopeConfig->getValue(
            self::FAIL_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getSuccessUrl() {
        return $this->scopeConfig->getValue(
            self::SUCCESS_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}