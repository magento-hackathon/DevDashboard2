<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class PhpVersion implements ArgumentInterface
{
    public function getPhpVersion()
    {
        $phpVersionSplit = explode('-', PHP_VERSION, 2);
        return reset($phpVersionSplit);
    }
}
