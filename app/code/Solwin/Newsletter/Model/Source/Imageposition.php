<?php

namespace Solwin\Newsletter\Model\Source;

class Imageposition extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'Left', 'value' => 'left'),
                array('label' => 'Right', 'value' => 'right')
            );
        }
        return $this->_options;
    }

}