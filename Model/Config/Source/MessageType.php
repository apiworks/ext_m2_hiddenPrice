<?php

namespace Apiworks\HiddenPrice\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class MessageType implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [['value' => 'text', 'label' => __('Text')], ['value' => 'cms_block', 'label' => __('CMS Block')]];
    }
}