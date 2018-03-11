<?php

namespace Firegento\DevDashboard\Plugin;

class AddUserTab
{

    /**
     * @param \Magento\User\Block\User\Edit\Tabs $subject
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeToHtml(\Magento\User\Block\User\Edit\Tabs $subject)
    {
        $subject->addTabAfter(
            'devdashboardconfig',
            [
                'label' => __('Dashboard Config'),
                'title' => __('Dashboard Config'),
                'content' => $subject->getLayout()->createBlock('\Firegento\DevDashboard\Block\UserEditTab')->toHtml(),
                'active' => true
            ],
            'roles_section'
        );

        return [];
    }
}
