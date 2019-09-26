<?php
/**
 * Solwin Infotech
 * Solwin Flickr Extension
 * 
 * @category   Solwin
 * @package    Solwin_Flickr
 * @copyright  Copyright © 2006-2016 Solwin (https://www.solwininfotech.com)
 * @license    https://www.solwininfotech.com/magento-extension-license/
 */
namespace Solwin\Flickr\Model\System\Config\Source;

class OrderImage implements \Magento\Framework\Option\ArrayInterface
{

    const LATEST = 'latest';
    const RANDOM = 'random';

    public function toOptionArray() {
        return [
            self::LATEST => __('Latest'),
            self::RANDOM => __('Random'),
        ];
    }

}
