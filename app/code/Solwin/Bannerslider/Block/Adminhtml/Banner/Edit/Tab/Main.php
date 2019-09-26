<?php

namespace Solwin\Bannerslider\Block\Adminhtml\Banner\Edit\Tab;

/**
 * Banner edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Solwin\Bannerslider\Model\Status
     */
    protected $_status;

    /**
     * @var \Solwin\Bannerslider\Model\Showdesc
     */
    protected $_showdesc;

    /**
     * @var \Solwin\Bannerslider\Model\Showdesc
     */
    protected $_target;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, \Solwin\Bannerslider\Model\Status $status, \Solwin\Bannerslider\Model\Showdesc $showdesc, \Solwin\Bannerslider\Model\Target $target, array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        $this->_showdesc = $showdesc;
        $this->_target = $target;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm() {
        /* @var $model \Solwin\Bannerslider\Model\BannerImages */
        $model = $this->_coreRegistry->registry('our_banner');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Banner Information')]);

        if ($model->getId()) {
            $fieldset->addField('banner_id', 'hidden', ['name' => 'banner_id']);
        }

        $fieldset->addField(
                'title', 'text', [
            'name' => 'title',
            'label' => __('Title'),
            'title' => __('Title'),
            'required' => true,
            'disabled' => $isElementDisabled
                ]
        );
        
        /**
         * Check is single store mode
         */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled,
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }


        $fieldset->addField(
                'image', 'image', [
            'name' => 'image',
            'label' => __('Upload Banner'),
            'title' => __('Upload Banner'),
            'required' => true,
            'disabled' => $isElementDisabled,
            'note' => '(*.jpg, *.png, *.gif)'
                ]
        );

        $fieldset->addField(
                'url', 'text', [
            'name' => 'url',
            'label' => __('URL'),
            'title' => __('URL'),
            'required' => false,
            'disabled' => $isElementDisabled
                ]
        );

        $fieldset->addField(
                'target', 'select', [
            'label' => __('Open link in'),
            'title' => __('Open link in'),
            'name' => 'target',
            'required' => true,
            'options' => $this->_target->getOptionArray(),
            'disabled' => $isElementDisabled
                ]
        );
        
        $fieldset->addField(
                'imageorder', 'text', [
            'name' => 'imageorder',
            'label' => __('Sort Order'),
            'title' => __('Sort Order'),
            'required' => false,
            'disabled' => $isElementDisabled
                ]
        );

        $fieldset->addField(
                'status', 'select', [
            'label' => __('Status'),
            'title' => __('Status'),
            'name' => 'status',
            'required' => true,
            'options' => $this->_status->getOptionArray(),
            'disabled' => $isElementDisabled
                ]
        );
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '0' : '1');
        }

        $dateFormat = date("Y-m-d h:i:sa");

        if ($model->getId()) {
            $fieldset->addField('update_time', 'hidden', ['name' => 'update_time']);
            $model->setData('update_time', $dateFormat);
        }
        
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel() {
        return __('Banner Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle() {
        return __('Banner Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden() {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId) {
        return $this->_authorization->isAllowed($resourceId);
    }

}
