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
namespace Solwin\Flickr\Block;

use Magento\Framework\View\Element\Template;

class Flickr extends Template {
    
    
    protected function _prepareLayout() {
        
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Flickr'));
    }
    

}