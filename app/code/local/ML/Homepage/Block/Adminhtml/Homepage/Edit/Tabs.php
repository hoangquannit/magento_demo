<?php

class ML_Homepage_Block_Adminhtml_Homepage_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs {
 
    public function __construct() {
        parent::__construct();
        $this->setId('homepage_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('ml_homepage')->__('Home Page Template'));
    }
 
    protected function _beforeToHtml(){
        $this->addTab('form_homepage', array(
            'label'        => Mage::helper('ml_homepage')->__('Template Information'),
            'title'        => Mage::helper('ml_homepage')->__('Template Information'),
            'content'     => $this->getLayout()->createBlock('ml_homepage/adminhtml_homepage_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

    public function getHomepage(){
        return Mage::registry('current_homepage');
    }
}
