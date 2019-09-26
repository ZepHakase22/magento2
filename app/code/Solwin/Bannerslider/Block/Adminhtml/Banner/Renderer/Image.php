<?php

namespace Solwin\Bannerslider\Block\Adminhtml\Banner\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer {

    protected $storeManager;

    public function __construct(
    \Magento\Backend\Block\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, array $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getMediaUrl() {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function render(\Magento\Framework\DataObject $row) {
        $mediaUrl = self::getMediaUrl();
        $value = $row->getData($this->getColumn()->getIndex());
        return '<p style="text-align:center;padding-top:10px;"><img src="' . $mediaUrl . $value . '"  style="width:100px;height:auto;text-align:center;"/></p>';
    }

}
