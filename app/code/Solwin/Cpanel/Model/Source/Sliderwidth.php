<?php

namespace Solwin\Cpanel\Model\Source;

class Sliderwidth extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'Box-width', 'value' => 'box'),
                array('label' => 'Full-width', 'value' => 'full')
            );
        }
        return $this->_options;
    }

}
