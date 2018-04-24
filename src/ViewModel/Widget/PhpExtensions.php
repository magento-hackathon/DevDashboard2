<?php

namespace Firegento\DevDashboard\ViewModel\Widget;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Composer\ComposerInformation;
use Magento\Setup\Model\PhpInformation;

class PhpExtensions implements ArgumentInterface
{
    private $composerInformation;

    private $phpInformation;

    public function __construct(
        ComposerInformation $composerInformation,
        PhpInformation $phpInformation
    ) {
        $this->composerInformation = $composerInformation;
        $this->phpInformation = $phpInformation;
    }

    public function getPhpExtensions()
    {
        $required = $this->composerInformation->getRequiredExtensions();
        $current = $this->phpInformation->getCurrent();
        return array_values($required + $current);
    }

    public function getPhpExtensionStatus($extension)
    {
        $required = $this->composerInformation->getRequiredExtensions();
        $current = $this->phpInformation->getCurrent();

        $requiredInstalledPhpExtensions = array_intersect($required, $current);
        $requiredMissingPhpExtensions = array_diff($required, $current);

        if (in_array($extension, $requiredInstalledPhpExtensions)) {
            return 'required-installed';
        }
        if (in_array($extension, $requiredMissingPhpExtensions)) {
            return 'required-missing';
        }
        return 'optional-installed';
    }
}
