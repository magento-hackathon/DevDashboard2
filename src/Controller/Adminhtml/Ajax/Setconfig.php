<?php

namespace Firegento\DevDashboard\Controller\Adminhtml\Ajax;

use Firegento\DevDashboard\Model\Config;
use Magento\Backend\App\Action;

class Setconfig extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_authSession;

    /**
     * @var \Firegento\DevDashboard\Api\ConfigRepositoryInterface
     */
    protected $_configRepository;

    const ADMIN_RESOURCE = 'Firegento_DevDashboard::devdashboard';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepository
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepository
    ) {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_authSession = $authSession;
        $this->_configRepository = $configRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $configuration = $this->getRequest()->getParam('configuration');
        $useDevdashboard = $this->getRequest()->getParam('use_devdashboard');

        if ($configuration === null || $useDevdashboard === null) {
            $message = [
                'success' => false,
                'message' => 'You should at least give configuration or dev-dashboard'
            ];
        } else {
            $userId = $this->_authSession->getUser()->getId();
            try {

                /** @var Config $config */
                $config = $this->_configRepository->getByUserId($userId);

                if ($configuration !== null) {
                    $config->setData('configuration', $configuration);
                }

                if ($useDevdashboard !== null) {
                    $config->setData('use_devdashboard', $useDevdashboard);
                }

                $this->_configRepository->save($config);

                $message = [
                    'success' => true,
                    'user_id' => $config->getData('user_id'),
                    'configuration' => $config->getData('configuration'),
                    'use_devdashboard' => $config->getData('use_devdashboard')
                ];
            } catch (\Exception $e) {
                $message = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }


        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->_resultJsonFactory->create();
        return $result->setData($message);
    }
}
