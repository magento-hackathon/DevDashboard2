<?php
namespace Firegento\DevDashboard\Api;

use Firegento\DevDashboard\Api\Data\ConfigInterface;

interface ConfigRepositoryInterface
{
    /**
     * @param ConfigInterface $page
     * @return ConfigInterface
     */
    public function save(ConfigInterface $page);

    /**
     * @param int $userId
     * @return ConfigInterface
     */
    public function getByUserId($userId);
}
