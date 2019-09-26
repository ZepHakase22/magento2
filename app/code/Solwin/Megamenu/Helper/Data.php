<?php
/**
 * Copyright © 2015 Solwin Infotech. All rights reserved.
 */
namespace Solwin\Megamenu\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $_objectManager;
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        $this->_objectManager= $objectManager;
        parent::__construct($context);
    }
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    public function getHomeUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getModel($model) {
        return $this->_objectManager->create($model);
    }
    public function getCurrentStore() {
        return $this->_storeManager->getStore();
    }
}
