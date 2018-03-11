<?php

namespace Firegento\DevDashboard\Model;

use Firegento\DevDashboard\Api\Data\ConfigInterface;
use Firegento\DevDashboard\Model\ConfigFactory;
use Firegento\DevDashboard\Model\ResourceModel\Config\CollectionFactory;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

class ConfigRepository implements \Firegento\DevDashboard\Api\ConfigRepositoryInterface
{
    protected $objectFactory;
    protected $collectionFactory;

    public function __construct(
        ConfigFactory $objectFactory,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->objectFactory = $objectFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
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
     * @param int $user_id
     * @return Config
     */
    public function getByUserId($user_id)
    {
        /** @var \Firegento\DevDashboard\Model\Config $object */
        $object = $this->objectFactory->create();
        $object->load($user_id, 'user_id');
        return $object;
    }

}