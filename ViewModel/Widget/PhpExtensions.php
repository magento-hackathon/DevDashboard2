<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class PhpExtensions implements ArgumentInterface
{
    public function getPhpExtensions()
    {
        return \get_loaded_extensions();
    }
}