<?php

namespace Solwin\Bannerslider\Model\System\Config\Source;

class Controlnav implements \Magento\Framework\Option\ArrayInterface {

    const CONTROL_TRUE = 'true';
    const CONTROL_THUM = 'thumbnails';
    const CONTROL_NONE = 'false';

    public function toOptionArray() {
        return [self::CONTROL_TRUE => __('Normal'), self::CONTROL_THUM => __('Thumbnails'), self::CONTROL_NONE => __('None')];
    }
}