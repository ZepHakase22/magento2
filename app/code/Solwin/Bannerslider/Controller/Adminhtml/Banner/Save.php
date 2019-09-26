<?php

namespace Solwin\Bannerslider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action {

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
    protected $_fileUploaderFactory;

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, \Magento\Framework\Filesystem $filesystem, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory) {
        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Solwin\Bannerslider\Model\BannerImages');

            try {

                if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {

                    // Remove Image from the directory and Database
                    $deletepath = $this->_filesystem->getDirectoryRead(
                                    DirectoryList::MEDIA
                            )->getAbsolutePath('');

                    // Un link image
                    if (isset($data['image']['value']) && $data['image']['value'] != '') {
                        unlink($deletepath . '/' . $data['image']['value']);
                    }

                    //unset image data
                    $data['image'] = '';
                } else {
                    unset($data['image']);
                    if (isset($_FILES)) {
                        if ($_FILES['image']['name']) {
                            // Image Saving Code
                            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
                            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(true);

                            $path = $this->_filesystem->getDirectoryRead(
                                            DirectoryList::MEDIA
                                    )->getAbsolutePath(
                                    'bannerslider/'
                            );
                            $result = $uploader->save($path);
                            $data['image'] = 'bannerslider' . $result['file'];
                        }
                    }
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }

            $id = $this->getRequest()->getParam('banner_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Banner has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Banner.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
