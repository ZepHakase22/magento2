<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Solwin\Megamenu\Block\System\Config\Form\Field;

/**
 * Backend system config array field renderer
 */
class Solmegamenu extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray {

    /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $_elementFactory;

    /**
     * @var \Magento\Framework\View\Design\Theme\LabelFactory
     */
    protected $_labelFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Data\Form\Element\Factory $elementFactory
     * @param \Magento\Framework\View\Design\Theme\LabelFactory $labelFactory
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Data\Form\Element\Factory $elementFactory, \Magento\Framework\View\Design\Theme\LabelFactory $labelFactory, array $data = []
    ) {
        $this->_elementFactory = $elementFactory;
        $this->_labelFactory = $labelFactory;
        parent::__construct($context, $data);
    }

    /**
     * Initialise form fields
     *
     * @return void
     */
    protected function _construct() {
        $this->addColumn('title', ['label' => __('Title')]);
        $this->addColumn('val', ['label' => __('ID or URL')]);
        $this->addColumn('type', ['label' => __('Menu Type')]);
        $this->addColumn('position', ['label' => __('Position')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
        parent::_construct();
    }

    /**
     * Render array cell for prototypeJS template
     *
     * @param string $columnName
     * @return string
     */
    public function renderCellTemplate($columnName) {
        if ($columnName == 'type' && isset($this->_columns[$columnName])) {
            /** @var $label \Magento\Framework\View\Design\Theme\Label */
            $label = $this->_labelFactory->create();

            $options = array();
            $options = array(
                array('value' => 'page', 'label' => 'CMS page'),
                array('value' => 'block', 'label' => 'Static Block'),
                array('value' => 'customurl', 'label' => 'Custom URL'),
                array('value' => 'url', 'label' => 'External URL')
            );

            $element = $this->_elementFactory->create('select');
            $element->setForm(
                    $this->getForm()
            )->setName(
                    $this->_getCellInputElementName($columnName)
            )->setHtmlId(
                    $this->_getCellInputElementId('<%- _id %>', $columnName)
            )->setValues(
                    $options
            );
            return str_replace("\n", '', $element->getElementHtml());
        }

        if ($columnName == 'position' && isset($this->_columns[$columnName])) {
            /** @var $label \Magento\Framework\View\Design\Theme\Label */
            $label = $this->_labelFactory->create();

            $options = array();
            $options = array(
                array('value' => 'after', 'label' => 'After'),
                array('value' => 'before', 'label' => 'Before')
            );

            $element = $this->_elementFactory->create('select');
            $element->setForm(
                    $this->getForm()
            )->setName(
                    $this->_getCellInputElementName($columnName)
            )->setHtmlId(
                    $this->_getCellInputElementId('<%- _id %>', $columnName)
            )->setValues(
                    $options
            );
            return str_replace("\n", '', $element->getElementHtml());
        }

        return parent::renderCellTemplate($columnName);
    }

}
