<?php

namespace Solwin\Cpanel\Controller\Adminhtml\Demo;

use \Magento\Framework\Simplexml\Config;
use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as BlockCollectionFactory;

class Import extends \Magento\Backend\App\Action {

    protected $_uploaderFactory;

    /**
     * Filesystem facade
     *
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;

    /**
     * File Uploader factory
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_dir;
    protected $_fileUploaderFactory;
    protected $_importPath;
    protected $_blockFactory;
    protected $_helper;
    protected $blockCollectionFactory;
    protected $_configFactory;
    protected $_parser;

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configFactory, BlockCollectionFactory $blockCollectionFactory, \Magento\Cms\Model\Block $blockFactory, \Solwin\Cpanel\Helper\Data $helper, \Magento\Framework\Filesystem\DirectoryList $dir, \Magento\Framework\Filesystem $filesystem, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory) {
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_dir = $dir;
        $this->_configFactory = $configFactory;
        parent::__construct($context);
        $this->_blockFactory = $blockFactory;
        $this->_helper = $helper;
        $this->_importPath = $this->_dir->getRoot() . '/app/code/Solwin/Cpanel/etc/import/';
        $this->_parser = new \Magento\Framework\Xml\Parser();
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {

        $store = $this->getRequest()->getParam('store');
        $website = NULL;
        $demo_version = $this->getRequest()->getParam('demoversion');

        try {
            $xmlPath = $this->_importPath . $demo_version . '.xml';

            if (!is_readable($xmlPath)) {
                throw new \Exception(
                __("Can't get the data file for import " . $demo_version . ": " . $xmlPath)
                );
            }

            $data = $this->_parser->load($xmlPath)->xmlToArray();
            $scope = "default";
            $scope_id = 0;
            if ($store && $store > 0) { // store level
                $scope = "stores";
                $scope_id = $store;
            } elseif ($website && $website > 0) { // website level
                $scope = "websites";
                $scope_id = $website;
            }
            foreach ($data['root']['config'] as $b_name => $b) {
                foreach ($b as $c_name => $c) {
                    foreach ($c as $d_name => $d) {
                        $this->_configFactory->saveConfig($b_name . '/' . $c_name . '/' . $d_name, $d, $scope, $scope_id);
                    }
                }
            }
            $this->messageManager->addSuccess(__('Success to Import ' . $demo_version . '.'));
        } catch (\Exception $exception) {
            $this->messageManager->addError(__('Error during Import ' . $demo_version . '.'));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('adminhtml/system_config/edit/section/cpanelsection');
    }

}
