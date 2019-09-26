<?php

namespace Solwin\Bannerslider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('bannerslider')
        )->addColumn(
            'banner_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true, 'nullable' => false, 'primary' => true),
            'Banner ID'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Title'
	)->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Image'
	)->addColumn(
            'url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            100,
            array('nullable' => false),
            'Image URL'
	)->addColumn(
            'target',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            100,
            array('nullable' => false),
            'Target'
	)->addColumn(
            'imageorder',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            '11',
            array('nullable' => false),
            'Sort Order'
        )->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            array(),
            'Active Status'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            array('default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT),
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            array(),
            'Modification Time'
        )->setComment(
            'Bannerslider Table'
        );
        $installer->getConnection()->createTable($table);
        
        
        /**
         * Create table 'bannerslider_store'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('bannerslider_store')
        )->addColumn(
            'banner_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'primary' => true],
            'Post ID'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'primary' => true],
            'Store ID'
        )->addIndex(
            $installer->getIdxName('bannerslider_store', ['store_id']),
            ['store_id']
        )->addForeignKey(
            $installer->getFkName('bannerslider_store', 'banner_id', 'bannerslider', 'banner_id'),
            'banner_id',
            $installer->getTable('bannerslider'),
            'banner_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('bannerslider_store', 'store_id', 'store', 'store_id'),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Banner Slider To Store Linkage Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
