<?php

class SM_Blog_Block_Adminhtml_Post_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('product_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('blog')->__('Related product'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('blog')->__('Post Manager'),
            'title' => Mage::helper('blog')->__('Post Manager'),
            'content' => $this->getLayout()->createBlock('blog/adminhtml_post_edit_tab_form')->toHtml(),
        ));

        $this->addTab('related_section', array(
            'label' => Mage::helper('blog')->__('Related Product'),
            'title' => Mage::helper('blog')->__('Related Product'),
            'content' => $this->getLayout()->createBlock('blog/adminhtml_post_edit_tab_productlist')->toHtml()
        ));
        return parent::_beforeToHtml();
    }
}




























