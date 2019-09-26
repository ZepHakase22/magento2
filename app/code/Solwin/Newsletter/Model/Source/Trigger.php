<?php

namespace Solwin\Newsletter\Model\Source;

class Trigger extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'At Page End', 'value' => 'atendpage'),
                array('label' => 'On Load', 'value' => 'onload'),
                array('label' => 'On Idle', 'value' => 'onidle'),
            );
        }
        return $this->_options;
    }

}
