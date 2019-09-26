<?php

namespace Solwin\Bannerslider\Block\Adminhtml\Banner;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Solwin\Bannerslider\Model\BannerMembersFactory
     */
    protected $_bannerImageFactory;

    /**
     * @var \Solwin\Bannerslider\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Solwin\Bannerslider\Model\BannerImagesFactory $bannerImageFactory
     * @param \Solwin\Bannerslider\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Solwin\Bannerslider\Model\BannerImagesFactory $bannerImageFactory, \Solwin\Bannerslider\Model\Status $status, \Magento\Framework\Module\Manager $moduleManager, array $data = []
    ) {
        $this->_bannerImageFactory = $bannerImageFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection() {
        $collection = $this->_bannerImageFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns() {
        $this->addColumn(
                'banner_id', [
            'header' => __('ID'),
            'type' => 'number',
            'index' => 'banner_id',
            'header_css_class' => 'col-id',
            'column_css_class' => 'col-id'
                ]
        );

        $this->addColumn(
                'image', array(
            'header' => __('Image'),
            'index' => 'image',
            'class' => 'xxx',
            "renderer" => "Solwin\Bannerslider\Block\Adminhtml\Banner\Renderer\Image",
                )
        );

        $this->addColumn(
                'title', [
            'header' => __('Title'),
            'index' => 'title',
            'class' => 'xxx'
                ]
        );
        
      if (!$this->_storeManager->isSingleStoreMode()) {
    $this->addColumn('store_id', array(
        'header'        => __('Store View'),
        'index'         => 'store_id',
        'type'          => 'store',
        'store_all'     => true,
        'store_view'    => true,
        'sortable'      => true,
        'filter_condition_callback' => array($this,
            '_filterStoreCondition'),
    ));
}

        $this->addColumn(
                'url', [
            'header' => __('URL'),
            'index' => 'url',
            'class' => 'xxx'
                ]
        );

        $this->addColumn(
                'imageorder', [
            'header' => __('Sort Order'),
            'index' => 'imageorder',
            'class' => 'xxx'
                ]
        );

        $this->addColumn(
                'status', [
            'header' => __('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => $this->_status->getOptionArray()
                ]
        );

        $this->addColumn(
                'edit', [
            'header' => __('Edit'),
            'type' => 'action',
            'getter' => 'getId',
            'actions' => [
                [
                    'caption' => __('Edit'),
                    'url' => [
                        'base' => '*/*/edit'
                    ],
                    'field' => 'banner_id'
                ]
            ],
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'header_css_class' => 'col-action',
            'column_css_class' => 'col-action'
                ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setTemplate('Solwin_Bannerslider::bannerslider/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('bannerimage');

        $this->getMassactionBlock()->addItem(
                'delete', [
            'label' => __('Delete'),
            'url' => $this->getUrl('bannerslider/*/massDelete'),
            'confirm' => __('Are you sure?')
                ]
        );

        $statuses = $this->_status->getOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
                'status', [
            'label' => __('Change status'),
            'url' => $this->getUrl('bannerslider/*/massStatus', ['_current' => true]),
            'additional' => [
                'visibility' => [
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => __('Status'),
                    'values' => $statuses
                ]
            ]
                ]
        );


        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl() {
        return $this->getUrl('bannerslider/*/grid', ['_current' => true]);
    }

    /**
     * @param \Solwin\Bannerslider\Model\BannerImages|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl(
                        'bannerslider/*/edit', ['banner_id' => $row->getId()]
        );
    }

}
