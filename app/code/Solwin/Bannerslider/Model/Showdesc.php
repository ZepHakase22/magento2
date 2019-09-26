<?php

namespace Solwin\Bannerslider\Model;

class Showdesc {
    /* 
     * Show description value
     */

    const SHOWDESC_NO = 0;
    const SHOWDESC_YES = 1;

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray() {
        return [self::SHOWDESC_NO => __('No'), self::SHOWDESC_YES => __('Yes')];
    }

}
