<?php

namespace Firegento\DevDashboard\Model;

use Firegento\DevDashboard\Api\Data\ConfigInterface;
use Firegento\DevDashboard\Model\ResourceModel\Config\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;

class ConfigRepository implements \Firegento\DevDashboard\Api\ConfigRepositoryInterface
{
    protected $objectFactory;
    protected $collectionFactory;

    public function __construct(
        ConfigFactory $objectFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->objectFactory = $objectFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param ConfigInterface $object
     * @return ConfigInterface
     * @throws CouldNotSaveException
     */
    public function save(ConfigInterface $object)
    {
        try {
            $object->save();
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $object;
    }

    /**
     * @param int $userId
     * @return Config
     */
    public function getByUserId($userId)
    {
        /** @var \Firegento\DevDashboard\Model\Config $object */
        $object = $this->objectFactory->create();
        $object->load($userId, 'user_id');
        $object->setData('user_id', $userId);
        return $object;
    }

}