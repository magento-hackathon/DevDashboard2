<?php

namespace Firegento\DevDashboard\Model;

use Firegento\DevDashboard\Api\Data\ConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Config extends \Magento\Framework\Model\AbstractModel implements ConfigInterface, IdentityInterface
{
    const CACHE_TAG = 'firegento_devdashboard_config';

    protected function _construct()
    {
        $this->_init(\Firegento\DevDashboard\Model\ResourceModel\Config::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
