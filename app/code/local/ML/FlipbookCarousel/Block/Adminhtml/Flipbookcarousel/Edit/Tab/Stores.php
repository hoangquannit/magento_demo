<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Edit_Tab_Stores
    extends Mage_Adminhtml_Block_Widget_Form {
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setFieldNameSuffix('flipbookcarousel');
        $this->setForm($form);
        $fieldset = $form->addFieldset('flipbookcarousel_stores_form', array('legend'=>Mage::helper('ml_flipbookcarousel')->__('Store views')));
        $field = $fieldset->addField('store_id', 'multiselect', array(
            'name'  => 'stores[]',
            'label' => Mage::helper('ml_flipbookcarousel')->__('Store Views'),
            'title' => Mage::helper('ml_flipbookcarousel')->__('Store Views'),
            'required'  => true,
            'values'=> Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
        ));
        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
        $field->setRenderer($renderer);
          $form->addValues(Mage::registry('current_flipbookcarousel')->getData());
        return parent::_prepareForm();
    }
}
