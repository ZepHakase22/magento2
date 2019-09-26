<?php

namespace Solwin\Bannerslider\Block;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Element\Template;

class Bannerslider extends Template {

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;
    protected $_config;
    protected $_collection;
    protected $_filesystem;
    protected $_assetRepo;
    protected $_scopeConfig;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\View\Asset\Repository $assetRepo, \Magento\Cms\Model\Template\FilterProvider $filterProvider, \Magento\Framework\Filesystem $filesystem, \Solwin\Bannerslider\Model\Resource\BannerImages\Collection $collection, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, array $data = []
    ) {
        $this->_filesystem = $filesystem;
        $this->_assetRepo = $assetRepo;
        $this->_filterProvider = $filterProvider;
        $this->_collection = $collection;
        $this->_config = $scopeConfig->getValue('bannersection/bannergroup');
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getBannerData() {
        $collection = $this->_collection
                ->addStoreFilter($this->_storeManager->getStore()->getId())
                ->addFieldToFilter('status', 1);

        $collection->getSelect()
                ->order('imageorder');


        return $collection;
    }

    public function getEnableModule() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getAnimationType() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/animation', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getControlNav() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/controlnav', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSlideshowSpeed() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/slideshowSpeed', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getDirection() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/direction', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getAnimationLoop() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/animationLoop', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSmoothHeight() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/smoothHeight', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getStartAt() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/startAt', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSlideshow() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/slideshow', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getAnimationSpeed() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/animationSpeed', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getInitDelay() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/initDelay', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getPauseOnHover() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/pauseOnHover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getTouch() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/touch', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getDirectionNav() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/directionNav', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getKeyboard() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/keyboard', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMousewheel() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/mousewheel', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * get base url with store code
     */
    public function getBaseUrlWithStoreCode() {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * get base url without store code
     */
    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }

    public function getMediaPath() {
        return $this->_filesystem->getDirectoryRead(
                        DirectoryList::MEDIA
                )->getAbsolutePath('');
    }

    /* get previous button text */

    public function getPrevText() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/prevText', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get next button text */

    public function getNextText() {
        return $this->_scopeConfig->getValue('bannersection/bannergroup/nextText', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
