<?php
declare(strict_types=1);

namespace Firegento\DevDashboard\Plugin;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\ObjectManager\ObjectManager;

class SaveUserConfig
{
    protected $_configRepository;

    protected $_messageManager;

    protected $_session;

    /**
     * SaveConfig constructor.
     * @param \Firegento\DevDashboard\Model\ConfigRepository $configRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Firegento\DevDashboard\Model\ConfigRepository $configRepository,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Backend\Model\Auth\Session $session
    ) {
        $this->_configRepository = $configRepository;
        $this->_messageManager = $messageManager;
        $this->_session = $session;
    }

    /**
     * @param \Magento\User\Controller\Adminhtml\User\Save $subject
     * @return array
     * @throws \Exception
     */
    public function afterExecute(\Magento\Backend\Controller\Adminhtml\System\Account\Save $subject, $result)
    {
        $userId = $this->_session->getUser()->getId();
        if ($userId === 0) {
            return [];
        }
        $data = (bool) $subject->getRequest()->getParam('use_devdashboard', false);

        try {
            /** @var \Firegento\DevDashboard\Model\Config $configModel */
            $configModel = $this->_configRepository->getByUserId($userId);
            $configModel->setData('use_devdashboard', $data);
            $this->_configRepository->save($configModel);
        } catch (\Exception $e) {
            $this->_messageManager->addErrorMessage($e->getMessage());
        }

        return $result;
    }
}
