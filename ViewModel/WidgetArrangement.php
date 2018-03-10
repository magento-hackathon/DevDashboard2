<?php

namespace Firegento\DevDashboard\ViewModel;

use Magento\Backend\Block\Template;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class WidgetArrangement implements ArgumentInterface
{
    /**
     * @param AbstractBlock $block
     * @return AbstractBlock[][]
     */
    public function getChildrenInColumns(AbstractBlock $block): array
    {
        $children = $block->getLayout()->getChildBlocks($block->getNameInLayout());
        return $this->arrange($children);
    }

    /**
     * @param AbstractBlock[] $children
     * @return AbstractBlock[][]
     */
    public function arrange(array $children): array
    {
        $columns = $this->getColumnCount();
        $result = [];
        foreach (array_values($children) as $index => $child) {
            $result[$index % $columns][] = $child;
        }
        return $result;
    }

    private function getColumnCount(): int
    {
        return 3;
    }
}