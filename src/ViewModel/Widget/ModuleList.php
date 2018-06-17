<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Module\ModuleListInterface;

class ModuleList implements ArgumentInterface
{
    private $moduleListInterface;

    public function __construct(ModuleListInterface $moduleListInterface)
    {
        $this->moduleListInterface = $moduleListInterface;
    }

    public function getModuleList()
    {
        return array_map(function($module) {
            $module['type'] = (strpos($module['name'], 'Magento_') !== false) ?
                __('Core') : __('External');
            return $module;
        }, $this->moduleListInterface->getAll());
    }
}
