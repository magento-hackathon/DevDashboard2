<?php
namespace Firegento\DevDashboard\Model\ResourceModel;

class Config extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('firegento_devdashboard_config', 'firegento_devdashboard_config_id');
    }
}
