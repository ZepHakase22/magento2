<?php

namespace Solwin\Newsletter\Model\Source;

class Animation extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'fade', 'value' => 'fade'),
                array('label' => 'elastic', 'value' => 'elastic'),
                array('label' => 'none', 'value' => 'none')
            );
        }
        return $this->_options;
    }

}