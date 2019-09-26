<?php

namespace Solwin\Cpanel\Model\Source;

class Maxwidth extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => '1170', 'value' => '1170'),
                array('label' => '1280 (Default)', 'value' => '1280'),
            );
        }
        return $this->_options;
    }
}
