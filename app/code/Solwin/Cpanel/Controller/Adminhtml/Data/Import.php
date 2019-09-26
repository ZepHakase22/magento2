<?php

namespace Solwin\Cpanel\Controller\Adminhtml\Data;

use Magento\Backend\App\Action;

class Import extends \Magento\Backend\App\Action {

    protected $_helper;
    protected $_modelBannerImagesFactory;

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, \Solwin\Bannerslider\Model\BannerImages $modelBannerImagesFactory, \Solwin\Cpanel\Helper\Data $helper) {
        $this->_modelBannerImagesFactory = $modelBannerImagesFactory;
        parent::__construct($context);
        $this->_helper = $helper;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $resultRedirect = $this->resultRedirectFactory->create();
        $i = 0;

        try {
            // insert banner slider data
            $bannerData = array(
                'title' => 'Home Banner 1',
                'image' => 'bannerslider/shiney-banner.png',
                'url' => '#',
                'target' => '_new',
                'imageorder' => 1,  
                'status' => 1,
                'store_id' => 0
            );
            $this->_modelBannerImagesFactory->setData($bannerData)->save();
            
            $bannerData = array(
                'title' => 'Home Banner 2',
                'image' => 'bannerslider/shiney-banner.png',
                'url' => '#',
                'target' => '_new',
                'imageorder' => 2,
                'status' => 1,
                'store_id' => 0
            );
            $this->_modelBannerImagesFactory->setData($bannerData)->save();
            
            $i++;
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Unable to import some data.'));
            return $resultRedirect->setPath('adminhtml/system_config/edit/section/cpanelsection');
        }
        if ($i) {
            $this->messageManager->addSuccess(__('Data was(were) imported.'));
        } else {
            $this->messageManager->addError(__('No data were imported.'));
        }
        return $resultRedirect->setPath('adminhtml/system_config/edit/section/cpanelsection');
    }

}