<?php

namespace Solwin\Bannerslider\Model;

class Target {
    /* 
     * Show description value
     */

    const TARGET_NEW = '_new';
    const TARGET_BLANK = '_blank';

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray() {
        return [self::TARGET_NEW => __('New Tab/Window'), self::TARGET_BLANK => __('Same Tab/Window')];
    }

}
