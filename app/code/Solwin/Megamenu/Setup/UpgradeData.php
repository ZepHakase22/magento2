<?php

namespace Solwin\Megamenu\Setup;

use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface {

    /**
     * Category setup factory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * Init
     *
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(CategorySetupFactory $categorySetupFactory) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Category::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);

        $menu_attributes = [
            'menu_back_color' => [
                'type' => 'varchar',
                'label' => 'Background Color',
                'input' => 'text',
                'required' => false,
                'sort_order' => 150,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_back_img' => [
                'type' => 'varchar',
                'label' => 'Background Image',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 160,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_back_style' => [
                'type' => 'text',
                'label' => 'Background Custom Style',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 170,
                'wysiwyg_enabled' => false,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
        ];

        foreach ($menu_attributes as $item => $data) {
            $categorySetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, $item, $data);
        }

        $idg = $categorySetup->getAttributeGroupId($entityTypeId, $attributeSetId, 'Mega Menu');

        foreach ($menu_attributes as $item => $data) {
            $categorySetup->addAttributeToGroup(
                    $entityTypeId, $attributeSetId, $idg, $item, $data['sort_order']
            );
        }

        $installer->endSetup();
    }

}
