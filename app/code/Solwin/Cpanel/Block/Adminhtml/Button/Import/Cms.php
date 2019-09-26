<?php

namespace Solwin\Cpanel\Block\Adminhtml\Button\Import;

class Cms extends \Magento\Config\Block\System\Config\Form\Field {

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $data = $element->getOriginalData();
        if (isset($data['process']))
            $process = $data['process'];
        else
            return '<div>Action was not specified</div>';

        $buttonSuffix = '';
        if (isset($data['label']))
            $buttonSuffix = ' ' . $data['label'];

        $url = $this->getUrl('cpanel/blocks/import/' . $process);

        $html = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
                ->setType('button')
                ->setClass('import-cms')
                ->setLabel('Import' . $buttonSuffix)
                ->setOnClick("setLocation('$url')")
                ->toHtml();

        return $html;
    }

}
