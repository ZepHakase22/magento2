<?php

namespace Solwin\Cpanel\Block\Adminhtml\Button\Import;

class Demo extends \Magento\Config\Block\System\Config\Form\Field {

    protected $_storeManager;
    
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $data = $element->getOriginalData();
        if (isset($data['process'])) {
            $process = $data['process'];
        } else {
            return '<div>Action was not specified</div>';
        }

        if (isset($data['demo'])) {
            $demo = $data['demo'];
        } else {
            return '<div>Demo param was not specified</div>';
        }

        $buttonSuffix = '';
        if (isset($data['label'])) {
            $buttonSuffix = ' ' . $data['label'];
        }

        $url = $this->getUrl('cpanel/demo/import/' . $process) . 'demoversion/' . $demo;
        
        if (strlen($code = $this->_storeManager->getStore()->getCode())) // store level
        {
            $url .= "/store/".$code;
        }
        
        $html = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
                ->setType('button')
                ->setClass('import-cms')
                ->setLabel('Import' . $buttonSuffix)
                ->setOnClick("setLocation('$url')")
                ->toHtml();

        return $html;
    }

}
