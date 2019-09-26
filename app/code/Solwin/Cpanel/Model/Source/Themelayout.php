<?php

namespace Solwin\Cpanel\Model\Source;

class Themelayout extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    
    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'Full-width Layout', 'value' => 'full'),
                array('label' => 'Box Layout', 'value' => 'box')
            );
        }
        return $this->_options;
    }
}
