<?php
/**
 * Created by PhpStorm.
 * User: willi
 * Date: 11.03.18
 * Time: 12:51
 */

namespace Firegento\DevDashboard\Controller\Adminhtml\Ajax;

use Firegento\DevDashboard\Model\Config;

/**
 * Loads dashboard configuration (widget arrangements etc.) for current user
 */
class Getconfig extends \Magento\Backend\App\Action
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
     * @param \Magento\Backend\Model\Auth\Session $authSession,
     * @param \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Firegento\DevDashboard\Api\ConfigRepositoryInterface $configRepository
    ) {

        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_authSession = $authSession;
        $this->_configRepository = $configRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {

        $message = null;

        $userId = $this->_authSession->getUser()->getId();

        try {
            /** @var  Config $config */
            $config = $this->_configRepository->getByUserId($userId);
            if ($config->getId()) {
                $message = [
                    'success' => true,
                    'user_id' => $config->getData('user_id'),
                    'use_devdashboard' => $config->getData('use_devdashboard'),
                    'configuration' => $config->getData('configuration')
                ];
            }
        } catch (\Exception $e) {
            $message = [
              'success' => false,
              'message' => $e->getMessage()
            ];
        }

        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->_resultJsonFactory->create();
        return $result->setData($message);
    }
}
