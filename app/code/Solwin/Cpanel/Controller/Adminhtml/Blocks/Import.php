<?php

namespace Solwin\Cpanel\Controller\Adminhtml\Blocks;

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

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, BlockCollectionFactory $blockCollectionFactory, \Magento\Cms\Model\Block $blockFactory, \Solwin\Cpanel\Helper\Data $helper, \Magento\Framework\Filesystem\DirectoryList $dir, \Magento\Framework\Filesystem $filesystem, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory) {
        $this->blockCollectionFactory = $blockCollectionFactory;

        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_dir = $dir;
        parent::__construct($context);
        $this->_blockFactory = $blockFactory;
        $this->_helper = $helper;
        $this->_importPath = $this->_dir->getRoot() . '/app/code/Solwin/Cpanel/etc/import/';
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {

        $modelString = 'cms/block';
        $itemContainerNodeString = 'blocks';
        $overwrite = $this->_helper->getCpanelConfigValue('cpanelsection/importgroup/overwrite_block');
        
        $xmlPath = $this->_importPath . $itemContainerNodeString . '.xml';
        if (!is_readable($xmlPath)) {
            return "Can't get the data file for import cms blocks";
        }

        $xmlObj = new Config($xmlPath);

        $conflictingOldItems = array();
        $i = 0;

        foreach ($xmlObj->getNode($itemContainerNodeString)->children() as $b) {

            $collection = $this->blockCollectionFactory->create();
            $oldBlocks = $collection->addFieldToFilter('identifier', $b->identifier);

            if ($overwrite) {
                if (count($oldBlocks->getData()) > 0) {
                    $conflictingOldItems[] = $b->identifier;
                    foreach ($oldBlocks as $old)
                        $old->delete();
                }
            } else {
                if (count($oldBlocks->getData()) > 0) {
                    $conflictingOldItems[] = $b->identifier;
                    continue;
                }
            }

            $staticBlock = array(
                'title' => $b->title,
                'identifier' => $b->identifier,
                'content' => $b->content,
                'is_active' => $b->is_active,
                'stores' => array(0)
            );

            $this->_blockFactory->setData($staticBlock)->save();

            $i++;
        }

        if ($i) {
            $this->messageManager->addSuccess(__('Item(s) was(were) imported.'));
        } else {
            $this->messageManager->addError(__('No items were imported.'));
        }

        if ($overwrite) {
            if ($conflictingOldItems) {
                $this->messageManager->addSuccess(__('Item(s) was(were) overwritten.'));
            }
        } else {
            if ($conflictingOldItems) {
                $this->messageManager->addNotice(__('Unable to import some items (they already exist in the database)'));
            }
        }

//        echo 'hello';
        //exit;

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('adminhtml/system_config/edit/section/cpanelsection');
    }

}
