<?php

namespace Solwin\Megamenu\Block;

class Topmenu extends \Magento\Framework\View\Element\Template {

    protected $_categoryHelper;
    protected $_categoryFlatConfig;
    protected $_topMenu;
    protected $_categoryFactory;
    protected $_helper;
    protected $_filterProvider;
    protected $_blockFactory;
    protected $_megamenuConfig;
    protected $_storeManager;
    protected $_cmsPageHelper;
    protected $_navigation;
    protected $_page;
    protected $_urlinterface;
    protected $_logoBlock;
    protected $serialize;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context, 
    \Magento\Theme\Block\Html\Header\Logo $logoBlock, 
    \Magento\Framework\UrlInterface $urlinterface, 
    \Magento\Catalog\Block\Navigation $navigation, 
    \Magento\Catalog\Helper\Category $categoryHelper, 
    \Solwin\Megamenu\Helper\Data $helper, 
    \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState, 
    \Magento\Catalog\Model\CategoryFactory $categoryFactory, 
    \Magento\Theme\Block\Html\Topmenu $topMenu, 
    \Magento\Cms\Model\Template\FilterProvider $filterProvider, 
    \Magento\Cms\Model\BlockFactory $blockFactory, 
    \Magento\Store\Model\StoreManagerInterface $storeManager, 
    \Magento\Cms\Helper\Page $cmsPageHelper,
    \Magento\Framework\Serialize\Serializer\Json $serialize, 
    \Magento\Cms\Model\Page $page
    ) {

        $this->_navigation = $navigation;
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryFlatConfig = $categoryFlatState;
        $this->_categoryFactory = $categoryFactory;
        $this->_topMenu = $topMenu;
        $this->_helper = $helper;
        $this->_filterProvider = $filterProvider;
        $this->_blockFactory = $blockFactory;
        $this->_storeManager = $storeManager;
        $this->_cmsPageHelper = $cmsPageHelper;
        $this->_page = $page;
        $this->_urlinterface = $urlinterface;
        $this->_logoBlock = $logoBlock;
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    public function getCategoryHelper() {
        return $this->_categoryHelper;
    }

    public function getCategoryModel($id) {
        $_category = $this->_categoryFactory->create();
        $_category->load($id);

        return $_category;
    }

    public function getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0) {
        return $this->_topMenu->getHtml($outermostClass, $childrenWrapClass, $limit);
    }

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true) {
        return $this->_categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
    }

    public function getChildCategories($category) {
        if ($this->_categoryFlatConfig->isFlatEnabled() && $category->getUseFlatResource()) {
            $subcategories = (array) $category->getChildrenNodes();
        } else {
            $subcategories = $category->getChildren();
        }

        return $subcategories;
    }

    public function getActiveChildCategories($category) {
        $children = [];
        if ($this->_categoryFlatConfig->isFlatEnabled() && $category->getUseFlatResource()) {
            $subcategories = (array) $category->getChildrenNodes();
        } else {
            $subcategories = $category->getChildren();
        }
        foreach ($subcategories as $category) {
            if (!$category->getIsActive()) {
                continue;
            }
            $children[] = $category;
        }
        return $children;
    }

    public function getBlockContent($content = '') {
        if (!$this->_filterProvider)
            return $content;
        return $this->_filterProvider->getBlockFilter()->filter(trim($content));
    }

    public function getHomeMenu() {
        $html = '';

        $showHomeLink = $this->_megamenuConfig['general']['show_home_link'];
        if ($showHomeLink) {
            $showHomeIcon = $this->_megamenuConfig['general']['show_home_icon'];
            
            $isHomeActive = $this->_logoBlock->isHomePage();
            $activeClass = '';
            if($isHomeActive){
                $activeClass = 'active';    
            }
            
            if ($showHomeIcon) {
                $homeIcon = $this->_megamenuConfig['general']['home_icon'];
                $html = '<li class="level0 ui-menu-item '.$activeClass.'"><a href="'.$this->_helper->getHomeUrl().'" class="level-top"><span><img title="Home" alt="Home" src="' . $this->_helper->getBaseUrl() . 'megamenu/' . $homeIcon . '"></span></a></li>';
            } else {
                $html = '<li class="level0 ui-menu-item '.$activeClass.'"><a href="'.$this->_helper->getHomeUrl().'" class="level-top"><span>Home</span></a></li>';
            }
        }

        if (!$html) {
            return false;
        }

        return $html;
    }

    public function getCustomBlocks($position = 'after') {
        $html = array();

        $getCustomBlocks = $this->_megamenuConfig['custom_links']['custommenu'];
        if($getCustomBlocks != ""){
            $getCustomBlocks = $this->serialize->unserialize($getCustomBlocks);
            if(is_array($getCustomBlocks)) {
                foreach ($getCustomBlocks AS $key => $val) {
                    if (($val['position'] == $position) && ($val['title'] != '')) {
                        if ($val['type'] == 'url') {
                            $html[] = '<li class="level0 ui-menu-item"><a href="' . $val['val'] . '" class="level-top" target="_blank"><span>' . $val['title'] . '</span></a></li>';
                        } else if ($val['type'] == 'customurl') {
                            $curr_url = $this->_urlinterface->getCurrentUrl();
                            $active = '';
                            if ($val['val'] == $curr_url) {
                                $active = 'active';
                            }
                            $html[] = '<li class="level0 ui-menu-item ' . $active . '"><a href="' . $val['val'] . '" class="level-top"><span>' . $val['title'] . '</span></a></li>';
                        } else if ($val['type'] == 'page') {
                            $cmsPageURL = $this->_cmsPageHelper->getPageUrl($val['val']);

                            $active = '';
                            if ($this->_page->getIdentifier() == $val['val'])
                                $active = ' active';

                            $html[] = '<li class="level0 ui-menu-item ' . $active . '"><a href="' . $cmsPageURL . '" class="level-top"><span>' . $val['title'] . '</span></a></li>';
                        } else if ($val['type'] == 'block') {

                            $block = $this->_blockFactory->create()->load($val['val']);
                            if (!$block)
                                continue;

                            $storeId = $this->_storeManager->getStore()->getId();
                            $blockHTML = $this->_filterProvider->getBlockFilter()->setStoreId($storeId)->filter($block->getContent());
                            $html[] = '<li class="level0 ui-menu-item first level-top parent ui-menu-item fullwidth" role="presentation"><div class="open-children-toggle"></div>'
                                    . '<a class="level-top ui-corner-all" href="#" aria-haspopup="true" id="ui-id-4" tabindex="-1" role="menuitem">'
                                    . '<span class="ui-menu-icon ui-icon ui-icon-carat-1-e">'
                                    . '</span><span>' . $val['title'] . '</span>'
                                    . '</a>'
                                    . '<div class="level0 submenu">'
                                    . '<div class="row">'
                                    . $blockHTML . '</div>'
                                    . '</div>'
                                    . '</li>';
                        }
                    }
                }
            }
        }

        if (!$html) {
            return;
        }

        $html = implode("\n", $html);
        return $html;
    }

    public function getSubmenuItemsHtml($children, $level = 1, $max_level = 0, $column_width = 12, $menu_type = 'fullwidth', $columns = null) {
        $html = '';

        if (!$max_level || ($max_level && $max_level == 0) || ($max_level && $max_level > 0 && $max_level - 1 >= $level)) {
            $column_class = "";
            if ($level == 1 && $columns && ($menu_type == 'fullwidth' || $menu_type == 'staticwidth')) {
                $column_class = "col-sm-" . $column_width . " ";
                $column_class .= "mega-columns columns" . $columns;
            }
            $html = '<ul class="subchildmenu ' . $column_class . '">';
            foreach ($children as $child) {
                $cat_model = $this->getCategoryModel($child->getId());

                $menu_hide_item = $cat_model->getData('menu_hide_item');

                if (!$menu_hide_item) {
                    $sub_children = $this->getActiveChildCategories($child);

                    $active = '';
                    if ($this->_navigation->isCategoryActive($child))
                        $active = ' active';

                    $menu_cat_label = $cat_model->getData('menu_cat_label');
                    $menu_icon_img = $cat_model->getData('menu_icon_img');
                    $menu_font_icon = $cat_model->getData('menu_font_icon');

                    $item_class = 'level' . $level . ' ';
                    if (count($sub_children) > 0)
                        $item_class .= 'parent ';
                    $html .= '<li class="ui-menu-item ' . $item_class . $active . '">';
                    if (count($sub_children) > 0) {
                        $html .= '<div class="open-children-toggle"></div>';
                    }
                    if ($level == 1 && $menu_icon_img != 1 && $menu_icon_img != '') {
                        $html .= '<div class="menu-thumb-img"><a class="menu-thumb-link" href="' . $this->_categoryHelper->getCategoryUrl($child) . '"><img src="' . $this->_helper->getBaseUrl() . 'catalog/category/' . $menu_icon_img . '" alt="' . $child->getName() . '"/></a></div>';
                    }
                    $html .= '<a href="' . $this->_categoryHelper->getCategoryUrl($child) . '">';
                    if ($level > 1 && $menu_icon_img != 1 && $menu_icon_img != '')
                        $html .= '<img class="menu-thumb-icon" src="' . $this->_helper->getBaseUrl() . 'catalog/category/' . $menu_icon_img . '" alt="' . $child->getName() . '"/>';
                    elseif ($menu_font_icon)
                        $html .= '<em class="menu-thumb-icon ' . menu_font_icon . '"></em>';
                    $html .= '<span>' . $child->getName();
                    if ($menu_cat_label)
                        $html .= '<span class="cat-label cat-label-' . $menu_cat_label . '">' . $this->_megamenuConfig['cat_labels'][$menu_cat_label] . '</span>';
                    $html .= '</span></a>';
                    if (count($sub_children) > 0) {
                        $html .= $this->getSubmenuItemsHtml($sub_children, $level + 1, $max_level, $column_width, $menu_type);
                    }
                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
        }

        return $html;
    }

    public function getMegamenuHtml() {
        $html = '';

        $categories = $this->getStoreCategories(true, false, true);

        $this->_megamenuConfig = $this->_helper->getConfig('megamenu');

        $max_level = $this->_megamenuConfig['general']['max_level'];

        $html .= $this->getHomeMenu();
        $html .= $this->getCustomBlocks('before');
        foreach ($categories as $category) {
            if (!$category->getIsActive()) {
                continue;
            }

            $cat_model = $this->getCategoryModel($category->getId());

            $menu_hide_item = $cat_model->getData('menu_hide_item');

            if (!$menu_hide_item) {
                $children = $this->getActiveChildCategories($category);

                $active = '';
                if ($this->_navigation->isCategoryActive($category))
                    $active = ' active';

                $menu_cat_label = $cat_model->getData('menu_cat_label');
                $menu_icon_img = $cat_model->getData('menu_icon_img');
                $menu_font_icon = $cat_model->getData('menu_font_icon');
                $menu_cat_columns = $cat_model->getData('menu_cat_columns');
                $menu_float_type = $cat_model->getData('menu_float_type');

                $menu_back_color = $cat_model->getData('menu_back_color');
                $menu_back_img = $cat_model->getData('menu_back_img');
                $menu_back_style = $cat_model->getData('menu_back_style');

                if (!$menu_cat_columns) {
                    $menu_cat_columns = 4;
                }

                $menu_type = $cat_model->getData('menu_type');
                if (!$menu_type)
                    $menu_type = $this->_megamenuConfig['general']['menu_type'];

                $custom_style = '';
                if ($menu_type == "staticwidth")
                    $custom_style = 'width: 500px;';

                $menu_static_width = $cat_model->getData('menu_static_width');
                if ($menu_type == "staticwidth" && $menu_static_width)
                    $custom_style = 'width: ' . $menu_static_width . ';';


                $custom_back_style = '';
                if ($menu_back_img != 1 && $menu_back_img != '') {
                    $back_custom_image = $this->_helper->getBaseUrl() . 'catalog/category/' . $menu_back_img;
                    if ($menu_back_style != '') {
                        $custom_back_style = "background-image: url('" . $back_custom_image . "');" . $menu_back_style;
                    } else {
                        $custom_back_style = "background-image: url('" . $back_custom_image . "');";
                    }
                } else if ($menu_back_color != '') {
                    $custom_back_style = 'background-color:' . $menu_back_color . ';';
                }

                $item_class = 'level0 ';
                $item_class .= $menu_type . ' ';

                $menu_top_content = $cat_model->getData('menu_block_top_content');
                $menu_left_content = $cat_model->getData('menu_block_left_content');
                $menu_left_width = $cat_model->getData('menu_block_left_width');
                if (!$menu_left_content || !$menu_left_width)
                    $menu_left_width = 0;
                $menu_right_content = $cat_model->getData('menu_block_right_content');
                $menu_right_width = $cat_model->getData('menu_block_right_width');
                if (!$menu_right_content || !$menu_right_width)
                    $menu_right_width = 0;
                $menu_bottom_content = $cat_model->getData('menu_block_bottom_content');
                if ($menu_float_type)
                    $menu_float_type = 'fl-' . $menu_float_type . ' ';
                if (count($children) > 0 || (($menu_type == "fullwidth" || $menu_type == "staticwidth") && ($menu_top_content || $menu_left_content || $menu_right_content || $menu_bottom_content)))
                    $item_class .= 'parent ';
                $html .= '<li class="ui-menu-item ' . $item_class . $menu_float_type . $active . '">';
                if (count($children) > 0) {
                    $html .= '<div class="open-children-toggle"></div>';
                }
                $html .= '<a href="' . $this->_categoryHelper->getCategoryUrl($category) . '" class="level-top">';
                if ($menu_icon_img != 1 && $menu_icon_img != '')
                    $html .= '<img class="menu-thumb-icon" src="' . $this->_helper->getBaseUrl() . 'catalog/category/' . $menu_icon_img . '" alt="' . $category->getName() . '"/>';
                elseif ($menu_font_icon)
                    $html .= '<em class="menu-thumb-icon ' . $menu_font_icon . '"></em>';
                $html .= '<span>' . $category->getName() . '</span>';
                if ($menu_cat_label)
                    $html .= '<span class="cat-label cat-label-' . $menu_cat_label . '">' . $this->_megamenuConfig['cat_labels'][$menu_cat_label] . '</span>';
                $html .= '</a>';
                if (count($children) > 0 || (($menu_type == "fullwidth" || $menu_type == "staticwidth") && ($menu_top_content || $menu_left_content || $menu_right_content || $menu_bottom_content))) {
                    $html .= '<div class="level0 submenu" style="' . $custom_style . $custom_back_style . '">';
                    if (($menu_type == "fullwidth" || $menu_type == "staticwidth") && $menu_top_content) {
                        $html .= '<div class="menu-top-block">' . $this->getBlockContent($menu_top_content) . '</div>';
                    }
                    if (count($children) > 0 || (($menu_type == "fullwidth" || $menu_type == "staticwidth") && ($menu_left_content || $menu_right_content))) {
                        $html .= '<div class="row">';
                        if (($menu_type == "fullwidth" || $menu_type == "staticwidth") && $menu_left_content && $menu_left_width > 0) {
                            $html .= '<div class="menu-left-block col-sm-' . $menu_left_width . '">' . $this->getBlockContent($menu_left_content) . '</div>';
                        }
                        $html .= $this->getSubmenuItemsHtml($children, 1, $max_level, 12 - $menu_left_width - $menu_right_width, $menu_type, $menu_cat_columns);
                        if (($menu_type == "fullwidth" || $menu_type == "staticwidth") && $menu_right_content && $menu_right_width > 0) {
                            $html .= '<div class="menu-right-block col-sm-' . $menu_right_width . '">' . $this->getBlockContent($menu_right_content) . '</div>';
                        }
                        $html .= '</div>';
                    }
                    if (($menu_type == "fullwidth" || $menu_type == "staticwidth") && $menu_bottom_content) {
                        $html .= '<div class="menu-bottom-block">' . $this->getBlockContent($menu_bottom_content) . '</div>';
                    }
                    $html .= '</div>';
                }
                $html .= '</li>';
            }
        }
        $html .= $this->getCustomBlocks('after');

        return $html;
    }

}
