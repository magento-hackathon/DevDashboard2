<?php
namespace Firegento\DevDashboard\Api;

use Firegento\DevDashboard\Api\Data\ConfigInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ConfigRepositoryInterface 
{
    public function save(ConfigInterface $page);

    public function getByUserId($user_id);

}
