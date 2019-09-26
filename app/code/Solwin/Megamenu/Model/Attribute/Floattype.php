<?php
/**
 * Copyright © 2015 Solwin Infotech. All rights reserved.
 */

namespace Solwin\Megamenu\Model\Attribute;

class Floattype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['value' => '', 'label' => __('Default')],
                ['value' => 'left', 'label' => __('Left')],
                ['value' => 'right', 'label' => __('Right')]
            ];
        }
        
        return $this->_options;
    }
}