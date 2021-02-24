<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Hyva\Admin\Api\HyvaGridArrayProviderInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Module\ModuleListInterface;

class ModuleList implements ArgumentInterface, HyvaGridArrayProviderInterface
{
    private $moduleListInterface;

    public function __construct(ModuleListInterface $moduleListInterface)
    {
        $this->moduleListInterface = $moduleListInterface;
    }

    public function getModuleList()
    {
        $n = 1;
        return array_map(function ($module) use (&$n) {
            unset($module['sequence']);
            $module['type'] = (strpos($module['name'], 'Magento_') !== false) ?
                'Core' : 'External';
            return ['load_order' => $n++] + $module;
        }, $this->moduleListInterface->getAll());
    }

    /**
     * @return array[]
     */
    public function getHyvaGridData(): array
    {
        return $this->getModuleList();
    }
}
