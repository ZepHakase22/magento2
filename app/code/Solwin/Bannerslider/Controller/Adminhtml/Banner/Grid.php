<?php

namespace Solwin\Bannerslider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Grid extends \Magento\Backend\App\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    Context $context, PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute() {

        return $this->resultPageFactory->create();
    }

}
