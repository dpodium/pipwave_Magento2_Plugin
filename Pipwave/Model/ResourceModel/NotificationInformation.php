<?php
namespace Dpodium\Pipwave\Model\ResourceModel;

class NotificationInformation extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('pipwave_order_information', 'order_id');
    }
    protected $_isPkAutoIncrement = false;
}