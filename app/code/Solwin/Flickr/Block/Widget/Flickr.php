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
namespace Solwin\Flickr\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Flickr extends Template  implements BlockInterface
{
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->setTemplate('widget/flickr.phtml');
    }
    

}