<?php

namespace Solwin\Cpanel\Model\Source;

class Loaderdisplay extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'Only On Home Page', 'value' => 'homep'),
                array('label' => 'All Pages', 'value' => 'allp')
            );
        }
        return $this->_options;
    }

}