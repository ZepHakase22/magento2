<?php

namespace Solwin\Cpanel\Model\Source;

class Footermiddle extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    public function getAllOptions() {
        if (!$this->_options) {
            $this->_options = array(
                array('label' => 'None', 'value' => ''),
                array('label' => 'Static Block', 'value' => 'static'),
                array('label' => 'Information Block', 'value' => 'info'),
                array('label' => 'Flickr', 'value' => 'flickr'),
                array('label' => 'Instagram', 'value' => 'instagram'),
                array('label' => 'Newsletter and Socials', 'value' => 'newsltter_socials'),
            );
        }
        return $this->_options;
    }

}
