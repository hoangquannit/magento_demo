<?php
class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs {
    public function __construct() {
        parent::__construct();
        $this->setId('flipbookcarousel_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel Item'));
    }
    protected function _beforeToHtml(){
        $this->addTab('form_flipbookcarousel', array(
            'label'        => Mage::helper('ml_flipbookcarousel')->__('Information'),
            'title'        => Mage::helper('ml_flipbookcarousel')->__('Information'),
            'content'     => $this->getLayout()->createBlock('ml_flipbookcarousel/adminhtml_flipbookcarousel_edit_tab_form')->toHtml(),
        ));
        if (!Mage::app()->isSingleStoreMode()){
            $this->addTab('form_store_flipbookcarousel', array(
                'label'        => Mage::helper('ml_flipbookcarousel')->__('Store views'),
                'title'        => Mage::helper('ml_flipbookcarousel')->__('Store views'),
                'content'     => $this->getLayout()->createBlock('ml_flipbookcarousel/adminhtml_flipbookcarousel_edit_tab_stores')->toHtml(),
            ));
        }
        return parent::_beforeToHtml();
    }

    public function getFlipbookcarousel(){
        return Mage::registry('current_flipbookcarousel');
    }
}
