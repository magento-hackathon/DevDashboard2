<?php
namespace Firegento\DevDashboard\Model;

class Config extends \Magento\Framework\Model\AbstractModel implements \Firegento\DevDashboard\Api\Data\ConfigInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'firegento_devdashboard_config';

    protected function _construct()
    {
        $this->_init('Firegento\DevDashboard\Model\ResourceModel\Config');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
