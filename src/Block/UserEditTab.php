<?php
/**
 * Created by PhpStorm.
 * User: willi
 * Date: 10.03.18
 * Time: 17:54
 */

namespace Firegento\DevDashboard\Block;

class UserEditTab extends \Magento\Backend\Block\Widget\Form\Generic
{
    /** @var \Firegento\DevDashboard\Model\ConfigRepository */
    protected $_configRepository;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Firegento\DevDashboard\Model\ConfigRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Firegento\DevDashboard\Model\ConfigRepository $configRepository,
        array $data = []
    ) {
        $this->_configRepository = $configRepository;

        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        /** @var $model \Magento\User\Model\User */
        $model = $this->_coreRegistry->registry('permissions_user');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('devdashboard_');

        $baseFieldset = $form->addFieldset('base_fieldset', ['legend' => __('Dashboard Configuration')]);


        $config = $this->_configRepository->getByUserId($model->getId() ? $model->getId() : null);

        $baseFieldset->addField(
            'configuration',
            'textarea',
            [
                'name' => 'configuration',
                'label' => __('Configuration'),
                'id' => 'configuration',
                'title' => __('Configuration'),
                'required' => false
            ]
        );

        $baseFieldset->addField(
            'use_devdashboard',
            'select',
            [
                'name' => 'use_devdashboard',
                'label' => __('Use developer dashboard as default'),
                'id' => 'use_devdashboard',
                'title' => __('Use developer dashboard'),
                'class' => 'input-select',
                'options' => ['1' => __('Yes'), '0' => __('No')]
            ]
        );

        $data = $config->getData();
        $form->setValues($data);

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
