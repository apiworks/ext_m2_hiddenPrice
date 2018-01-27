<?php

namespace Apiworks\HiddenPrice\Model\Config\Source;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Option\ArrayInterface;

class CmsBlock implements ArrayInterface
{
    protected $blockRepository;
    protected $options;
    protected $searchCriteriaBuilder;

    public function __construct(\Magento\Cms\Model\BlockRepository $blockRepository, \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->blockRepository = $blockRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $items = $this->blockRepository->getList($this->searchCriteriaBuilder->create())->getItems();
            foreach ($items as $item) {
                $this->options[] = ['value' => $item->getBlockId(), 'label' => $item->getTitle()];
            }
        }
        return $this->options;
    }
}