<?php

namespace Firegento\DevDashboard\Plugin;

use Magento\Backend\Controller\Adminhtml\Cache\MassRefresh as Subject;

class BackendCacheMassAbstract
{
    /**
     * @var \Magento\Store\App\Response\Redirect
     */
    protected $redirect;

    public function __construct(\Magento\Framework\App\Action\Context $context)
    {
        $this->redirect = $context->getRedirect();
    }
}
