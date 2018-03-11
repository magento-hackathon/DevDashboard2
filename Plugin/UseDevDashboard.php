<?php

namespace Firegento\DevDashboard\Plugin;


class UseDevDashboard
{

    /** @var \Magento\Backend\Model\Auth\Session */
    protected $_authSession;

    /** @var \Firegento\DevDashboard\Model\ConfigRepository */
    protected $_configRepository;

    /**
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Firegento\DevDashboard\Model\ConfigRepository
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        \Firegento\DevDashboard\Model\ConfigRepository $configRepository
    )
    {
        $this->_authSession = $authSession;
        $this->_configRepository = $configRepository;
    }

    public function aroundGetStartupPageUrl(\Magento\Backend\Model\Url $subject, callable $callable) {

        $userId = $this->_authSession->getUser()->getId();
        $config = $this->_configRepository->getByUserId($userId);
        if($config->getData('use_devdashboard')) {
            return 'devdashboard/index/index';
        }
        else {
            return $callable();
        }

    }
}