<?php

namespace Solwin\Bannerslider\Model\Resource\BannerImages;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    
     /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    

     public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);

      
        $this->_storeManager = $storeManager;
    }
    
    protected function _construct() {
        $this->_init('Solwin\Bannerslider\Model\BannerImages', 'Solwin\Bannerslider\Model\Resource\BannerImages');
        $this->_map['fields']['banner_id'] = 'main_table.banner_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * Prepare page's statuses.
     * Available event cms_page_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses() {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    
    /**
     * Add field filter to collection
     *
     * @param string|array $field
     * @param null|string|array $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'store_id') {
            return $this->addStoreFilter($condition, false);
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Add store filter to collection
     * @param array|int|\Magento\Store\Model\Store  $store
     * @param boolean $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {   
        if (!$this->getFlag('store_filter_added')) {
            if ($store instanceof \Magento\Store\Model\Store) {
                $store = [$store->getId()];
            }

            if (!is_array($store)) {
                $store = [$store];
            }

            if ($withAdmin) {
                $store[] = \Magento\Store\Model\Store::DEFAULT_STORE_ID;
            }
            //print_r($store); exit;
            $this->addFilter('store', ['in' => $store], 'public');
        }
        return $this;
    }
    
     /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {   
        $items = $this->getColumnValues('banner_id');
        if (count($items)) {
            $connection = $this->getConnection();
            $select = $connection->select()->from(['cps' => $this->getTable('bannerslider_store')])
                ->where('cps.banner_id IN (?)', $items);
            $result = $connection->fetchPairs($select);

            if ($result) {
                foreach ($this as $item) {
                    $bannerId = $item->getData('banner_id');
                    if (!isset($result[$bannerId])) {
                        continue;
                    }
                    if ($result[$bannerId] == 0) {
                        $stores = $this->_storeManager->getStores(false, true);
                        $storeId = current($stores)->getId();
                        $storeCode = key($stores);
                    } else {
                        $storeId = $result[$item->getData('banner_id')];
                        $storeCode = $this->_storeManager->getStore($storeId)->getCode();
                    }
                    $item->setData('_first_store_id', $storeId);
                    $item->setData('store_code', $storeCode);
                    $item->setData('store_id', [$result[$bannerId]]);
                }
            }

           
        }

        $this->_previewFlag = false;
        return parent::_afterLoad();
    }
    /**
     * Join store relation table if there is store filter
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        if ($this->getFilter('store')) {
            $this->getSelect()->join(
                ['store_table' => $this->getTable('bannerslider_store')],
                'main_table.banner_id = store_table.banner_id',
                []
            )->group(
                'main_table.banner_id'
            );
        }
        parent::_renderFiltersBefore();
    }

}
