<?php

namespace Firegento\DevDashboard\Plugin;


use Firegento\DevDashboard\Model\Config;

class UseDevDashboard
{

    /** @var \Magento\Backend\Model\Auth\Session */
    protected $_authSession;

    /** @var \Firegento\DevDashboard\Api\ConfigRepositoryInterface */
    protected $_configRepository;

    /**
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepositoryInterface
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepository
    )
    {
        $this->_authSession = $authSession;
        $this->_configRepository = $configRepository;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \Magento\Backend\Model\Url $subject
     * @param callable $callable
     * @return string
     */
    public function aroundGetStartupPageUrl(\Magento\Backend\Model\Url $subject, callable $callable) {

        $userId = $this->_authSession->getUser()->getId();

        /** @var Config $config */
        $config = $this->_configRepository->getByUserId($userId);
        if($config->getData('use_devdashboard')) {
            return 'devdashboard/index/index';
        }

        return $callable();

    }
}