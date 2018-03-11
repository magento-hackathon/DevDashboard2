<?php

namespace Firegento\DevDashboard\Model;

use Firegento\DevDashboard\Api\Data\ConfigInterface;
use Firegento\DevDashboard\Model\ResourceModel\Config\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;

class ConfigRepository implements \Firegento\DevDashboard\Api\ConfigRepositoryInterface
{
    protected $objectFactory;
    protected $collectionFactory;
    /**
     * @var ResourceModel\Config
     */
    private $resource;

    public function __construct(
        ConfigFactory $objectFactory,
        CollectionFactory $collectionFactory,
        ResourceModel\Config $resource
    ) {
        $this->objectFactory = $objectFactory;
        $this->collectionFactory = $collectionFactory;
        $this->resource = $resource;
    }

    /**
     * @param ConfigInterface|AbstractModel $object
     * @return ConfigInterface
     * @throws CouldNotSaveException
     */
    public function save(ConfigInterface $object)
    {
        try {
            $this->resource->save($object);
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
        $this->resource->load($object, $userId, 'user_id');
        $object->setData('user_id', $userId);
        return $object;
    }
}
