<?php
namespace Firegento\DevDashboard\Model\ResourceModel\Config;

use Firegento\DevDashboard\Model\Config;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Config::class, \Firegento\DevDashboard\Model\ResourceModel\Config::class);
    }
}
