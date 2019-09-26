<?php

namespace Solwin\Megamenu\Helper;

class Css extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $generatedCssFolder;
    protected $generatedCssPath;
    protected $generatedCssDir;
    protected $_scopeConfig;
    protected $_coreRegistry;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\UrlInterface $urlinterface, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Theme\Block\Html\Header\Logo $logoblock, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        $base = BP;


        $this->generatedCssFolder = 'megamenu/generated_css/';
        $this->generatedCssPath = 'pub/media/' . $this->generatedCssFolder;
        $this->generatedCssDir = $base . '/' . $this->generatedCssPath;
        $this->logoblock = $logoblock;
        $this->_urlinterface = $urlinterface;
        $this->_scopeConfig = $scopeConfig;
        $this->_coreRegistry = $coreRegistry;
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

    public function getBaseMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getCssConfigDir() {
        return $this->generatedCssDir;
    }

    public function getMegamenuFile() {
        $megamenuFilePath = $this->generatedCssDir . 'megamenu_' . $this->_storeManager->getStore()->getCode() . '.css';
        if (file_exists($megamenuFilePath)) {
            return $this->getBaseMediaUrl() . $this->generatedCssFolder . 'megamenu_' . $this->_storeManager->getStore()->getCode() . '.css';
        } else {
            return 0;
        }
    }

    public function getMenuDesignConfig($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMegamenuStoreConfig($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->_coreRegistry->registry('cssgen_store'));
    }

}
