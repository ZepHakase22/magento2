<?php

namespace Solwin\Newsletter\Model\Source;

class TrueFalse extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'True', 'value' => 'true'),
                array('label' => 'False', 'value' => 'false')
            );
        }
        return $this->_options;
    }

}
