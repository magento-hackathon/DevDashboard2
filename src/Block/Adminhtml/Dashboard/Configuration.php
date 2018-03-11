<?php

namespace Firegento\DevDashboard\Block\Adminhtml\Dashboard;

class Configuration extends \Magento\Config\Block\System\Config\Edit
{

    /**
     * @var mixed
     */
    public $originalParams;

    /**
     * Configuration constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Config\Model\Config\Structure  $configStructure
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Config\Model\Config\Structure $configStructure,
        array $data = []
    ) {
        parent::__construct($context, $configStructure, $data);

        $this->_prepareRequestParams();
        $this->setTitle(__('Developer configurations'));
        $this->_resetRequestParams();
    }

    /**
     * @return $this
     */
    public function _prepareLayout()
    {
        $this->_prepareRequestParams();
        parent::_prepareLayout();

        return $this;
    }

    /**
     *
     */
    public function _prepareRequestParams()
    {
        $this->originalParams = $this->getRequest()->getParam('section');
        $this->getRequest()->setParams(['section', 'dev']);
    }

    /**
     *
     */
    public function _resetRequestParams()
    {
        $this->getRequest()->setParams(['section', $this->originalParams]);
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('adminhtml/system_config/save', ['section' => 'dev']);
    }
}
