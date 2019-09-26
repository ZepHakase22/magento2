<?php

namespace Solwin\Cpanel\Model\Source;

class Listblocks extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    
    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => '3-blocks', 'value' => 3),
                array('label' => '4-blocks', 'value' => 4)
            );
        }
        return $this->_options;
    }
}