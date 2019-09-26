<?php

namespace Solwin\Cpanel\Helper;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Element\Template;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $logoblock;
    protected $_scopeConfig;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Framework\UrlInterface $urlinterface, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Theme\Block\Html\Header\Logo $logoblock, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->logoblock = $logoblock;
        $this->_storeManager = $storeManager;
        $this->_urlinterface = $urlinterface;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getIsHomePage() {
        return $this->logoblock->isHomePage();
    }

    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getCurrentUrl() {
        return $this->_urlinterface->getCurrentUrl(); // Give the current url of recently viewed page
    }

    public function getCpanelConfigValue($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    /* Get show contact page google map Embeded Code */

    public function getGooglemapembedcode() {
        return $this->_scopeConfig->getValue('cpanelsection/contactpagegroup/embedcode', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
