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
        return $this->moduleListInterface->getAll();
    }
}