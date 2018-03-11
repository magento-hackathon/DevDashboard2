<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class DeployMode implements ArgumentInterface
{
    private $appState;

    public function __construct(\Magento\Framework\App\State $appState)
    {
        $this->appState = $appState;
    }

    public function getDeployMode()
    {
        return $this->appState->getMode();
    }
}
