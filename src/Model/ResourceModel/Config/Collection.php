<?php
namespace Firegento\DevDashboard\Model\ResourceModel\Config;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Firegento\DevDashboard\Model\Config', 'Firegento\DevDashboard\Model\ResourceModel\Config');
    }
}
