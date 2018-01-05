<?php
namespace Dpodium\Pipwave\Model\ResourceModel\NotificationInformation;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Dpodium\Pipwave\Model\NotificationInformation',
            'Dpodium\Pipwave\Model\ResourceModel\NotificationInformation'
            );
    }
}