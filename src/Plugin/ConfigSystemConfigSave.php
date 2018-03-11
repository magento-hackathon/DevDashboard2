<?php

namespace Firegento\DevDashboard\Plugin;

use Magento\Config\Controller\Adminhtml\System\Config\Save as Subject;

class ConfigSystemConfigSave
{
    /**
     * @var \Magento\Store\App\Response\Redirect
     */
    protected $redirect;

    public function __construct(\Magento\Framework\App\Action\Context $context)
    {
        $this->redirect = $context->getRedirect();
    }

    public function afterExecute(Subject $subject, \Magento\Backend\Model\View\Result\Redirect $resultRedirect)
    {
        if (false !== strpos($this->redirect->getRefererUrl(), 'devdashboard/index/index')) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            return $resultRedirect->setPath('devdashboard/index/index');
        }
        return $resultRedirect;
    }
}