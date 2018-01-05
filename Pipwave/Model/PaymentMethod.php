<?php
namespace Dpodium\Pipwave\Model;

class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod
{
    //type payment method code here
    protected $_code='custompayment';

    //to get 'pending' state for newOrderStatus
    protected $_isInitializeNeeded = true;

    //run all
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
        return parent::isAvailable($quote);
    }

    //not used?
    function authorize(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if (!$this->canAuthorize()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The authorize action is not available.'));
        }
        return $this;
    }
    
    //not used?
    function capture(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if (!$this->canCapture()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The capture action is not available.'));
        }
        return $this;
    }
    
    //not used?
    function refund(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if (!$this->canRefund()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The refund action is not available.'));
        }
        return $this;
    }
}