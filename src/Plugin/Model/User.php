<?php
declare(strict_types=1);

namespace Firegento\DevDashboard\Plugin\Model;

class User
{
    protected $_configRepository;

    public function __construct(\Firegento\DevDashboard\Model\ConfigRepository $configRepository)
    {
        $this->_configRepository = $configRepository;
    }

    public function afterLoad(\Magento\User\Model\User $subject, $result)
    {
        $userConfig = $this->_configRepository->getByUserId($subject->getId());
        $result->setData('use_devdashboard', $userConfig->getData('use_devdashboard'));
        return $result;
    }
}
