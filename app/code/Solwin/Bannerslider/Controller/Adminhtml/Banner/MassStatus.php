<?php
namespace Solwin\Bannerslider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * Update Banner Member(s) status action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $bannerimageIds = $this->getRequest()->getParam('bannerimage');
        if (!is_array($bannerimageIds) || empty($bannerimageIds)) {
            $this->messageManager->addError(__('Please select Banner(s).'));
        } else {
            try {
                $status = (int) $this->getRequest()->getParam('status');
                foreach ($bannerimageIds as $postId) {
                    $post = $this->_objectManager->get('Solwin\Bannerslider\Model\BannerImages')->load($postId);
                    $post->setStatus($status)->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been updated.', count($bannerimageIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('bannerslider/*/index');
    }

}
