<?php

namespace Solwin\Bannerslider\Model\System\Config\Source;

class Direction implements \Magento\Framework\Option\ArrayInterface {

    const DIRECTION_HORIZONTAL = 'horizontal';
    const DIRECTION_VERTICAL = 'vertical';

    public function toOptionArray() {
        return [self::DIRECTION_HORIZONTAL => __('Horizontal'), self::DIRECTION_VERTICAL => __('Vertical')];
    }

}
