<?php

namespace Solwin\Cpanel\Model\Source;

class Columnwidth extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => '1/12', 'value' => '1'),
                array('label' => '2/12', 'value' => '2'),
                array('label' => '3/12', 'value' => '3'),
                array('label' => '4/12', 'value' => '4'),
                array('label' => '5/12', 'value' => '5'),
                array('label' => '6/12', 'value' => '6'),
                array('label' => '7/12', 'value' => '7'),
                array('label' => '8/12', 'value' => '8'),
                array('label' => '9/12', 'value' => '9'),
                array('label' => '10/12', 'value' => '10'),
                array('label' => '11/12', 'value' => '11'),
                array('label' => '12/12', 'value' => '12'),
            );
        }
        return $this->_options;
    }

}
