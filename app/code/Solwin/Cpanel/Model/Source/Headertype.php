<?php

namespace Solwin\Cpanel\Model\Source;

class Headertype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    
    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'Header Type 1', 'value' => '1'),
                array('label' => 'Header Type 2', 'value' => '2'),
                array('label' => 'Header Type 3', 'value' => '3'),
                array('label' => 'Header Type 4', 'value' => '6'),
                array('label' => 'Header Type 5', 'value' => '7')
            );
        }
        return $this->_options;
    }
}
