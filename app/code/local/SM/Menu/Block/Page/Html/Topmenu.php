<?php
class SM_Menu_Block_Page_Html_Topmenu extends Mage_Page_Block_Html_Topmenu
{
    protected function _getMenuItemClasses(Varien_Data_Tree_Node $item)
    {
        $classes = array();

        $classes[] = 'level' . $item->getLevel();
        $classes[] = $item->getPositionClass();

        $_category = Mage::getModel('catalog/category')->load($item->getCateId());
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_category','type_dropdown_menu');

        $type_menu = $attribute->getSource()->getOptionText($_category->getTypeDropdownMenu());

        if ($item->getIsFirst()) {
            $classes[] = 'first';
        }

        if ($item->getIsActive()) {
            $classes[] = 'active';
        }

        if ($item->getIsLast()) {
            $classes[] = 'last';
        }

        if ($item->getClass()) {
            $classes[] = $item->getClass();
        }

        if ($item->hasChildren()) {
            if(strpos(strtolower($type_menu),'sale') ||strpos(strtolower($type_menu),'list') ){
                $classes[] = 'parent full-width';
            }else{
                $classes[] = 'parent';
            }

        }

        return $classes;
    }
}
			