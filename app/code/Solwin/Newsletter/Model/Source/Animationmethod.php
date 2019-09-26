<?php

namespace Solwin\Newsletter\Model\Source;

class Animationmethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'zoomOut', 'value' => 'zoomOut'),
                array('label' => 'zoomIn', 'value' => 'zoomIn')
            );
        }
        return $this->_options;
    }

}