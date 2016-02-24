<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'ml_flipbookcarousel';
        $this->_controller = 'adminhtml_flipbookcarousel';
        $this->_updateButton('save', 'label', Mage::helper('ml_flipbookcarousel')->__('Save Flipbook Carousel Item'));
        $this->_updateButton('delete', 'label', Mage::helper('ml_flipbookcarousel')->__('Delete Flipbook Carousel Item'));
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('ml_flipbookcarousel')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText(){
        if( Mage::registry('current_flipbookcarousel') && Mage::registry('current_flipbookcarousel')->getId() ) {
            return Mage::helper('ml_flipbookcarousel')->__("Edit Flipbook Carousel Item '%s'", $this->escapeHtml(Mage::registry('current_flipbookcarousel')->getName()));
        }
        else {
            return Mage::helper('ml_flipbookcarousel')->__('Add Flipbook Carousel Item');
        }
    }
}
