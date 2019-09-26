<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Solwin\Cpanel\Helper;

class CssSetting extends \Magento\Framework\App\Helper\AbstractHelper {

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


        $this->generatedCssFolder = 'themecss/generated_css/';
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

    public function getSettingsFile() {
        $settingsFilePath = $this->generatedCssDir . 'settings_' . $this->_storeManager->getStore()->getCode() . '.css';
        if (file_exists($settingsFilePath)) {
            return $this->getBaseMediaUrl() . $this->generatedCssFolder . 'settings_' . $this->_storeManager->getStore()->getCode() . '.css';
        } else {
            return 0;
        }
    }

    public function getDesignFile() {
        $designFilePath = $this->generatedCssDir . 'design_' . $this->_storeManager->getStore()->getCode() . '.css';
        if (file_exists($designFilePath)) {
            return $this->getBaseMediaUrl() . $this->generatedCssFolder . 'design_' . $this->_storeManager->getStore()->getCode() . '.css';
        } else {
            return 0;
        }
    }

    public function getCpanelDesignConfig($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getCpanelStoreConfig($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->_coreRegistry->registry('cssgen_store'));
    }

    public function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

}
