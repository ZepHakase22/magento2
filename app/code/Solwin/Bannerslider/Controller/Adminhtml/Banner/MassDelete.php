<?php
namespace Solwin\Bannerslider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $bannerimageIds = $this->getRequest()->getParam('bannerimage');
        if (!is_array($bannerimageIds) || empty($bannerimageIds)) {
            $this->messageManager->addError(__('Please select Banner(s).'));
        } else {
            try {
                foreach ($bannerimageIds as $postId) {
                    $post = $this->_objectManager->get('Solwin\Bannerslider\Model\BannerImages')->load($postId);
                    $post->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($bannerimageIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('bannerslider/*/index');
    }
}
