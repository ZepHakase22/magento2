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
namespace Solwin\Flickr\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    
     /**
     * Return brand config value by key and store
     *
     * @param string $key
     * @param \Magento\Store\Model\Store|int|string $store
     * @return string|null
     */
    public function getConfig($key)
    {
        $result = $this->scopeConfig->getValue($key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $result;
    }

}