<?php
namespace Firegento\DevDashboard\Block\Backend;

class Cache extends \Magento\Backend\Block\Cache
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'cache';
        $this->_headerText = __('Cache Storage Management');
        \Magento\Backend\Block\Widget\Container::_construct();
    }
}
