<?php
namespace Dpodium\Pipwave\Model;

class NotificationInformation extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        //parent::_construct();
        $this->_init('Dpodium\Pipwave\Model\ResourceModel\NotificationInformation');
    }
}