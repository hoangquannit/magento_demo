<?php

class ML_Homepage_Block_Adminhtml_Homepage_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'ml_homepage';
        $this->_controller = 'adminhtml_homepage';
        $this->_updateButton('save', 'label', Mage::helper('ml_homepage')->__('Save Home Page Template'));
        $this->_removeButton('delete');
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('ml_homepage')->__('Save And Continue Edit'),
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
        if( Mage::registry('current_homepage') && Mage::registry('current_homepage')->getId() ) {
            return Mage::helper('ml_homepage')->__("Edit Home Page '%s'", $this->escapeHtml(Mage::registry('current_homepage')->getName()));
        }
        else {
            return Mage::helper('ml_homepage')->__('Add Home Page');
        }
    }
}
