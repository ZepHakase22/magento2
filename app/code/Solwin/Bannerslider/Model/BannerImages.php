<?php
namespace Solwin\Bannerslider\Model;

class BannerImages extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Solwin\Bannerslider\Model\Resource\BannerImages');
    }
}