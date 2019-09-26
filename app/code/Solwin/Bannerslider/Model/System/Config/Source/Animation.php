<?php

namespace Solwin\Bannerslider\Model\System\Config\Source;

class Animation implements \Magento\Framework\Option\ArrayInterface {

    const ANIMATION_FADE = 'fade';
    const ANIMATION_SLIDE = 'slide';

    public function toOptionArray() {
        return [self::ANIMATION_FADE => __('Fade'), self::ANIMATION_SLIDE => __('Slide')];
    }

}
