<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form {
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('flipbookcarousel_');
        $form->setFieldNameSuffix('flipbookcarousel');
        $this->setForm($form);
        $fieldset = $form->addFieldset('flipbookcarousel_form', array('legend'=>Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel')));
        $fieldset->addType('image', Mage::getConfig()->getBlockClassName('ml_flipbookcarousel/adminhtml_flipbookcarousel_helper_image'));
        $fieldset->addType('file', Mage::getConfig()->getBlockClassName('ml_flipbookcarousel/adminhtml_flipbookcarousel_helper_file'));
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Item Name'),
            'name'  => 'name',
            'required'  => true,
            'class' => 'required-entry',

        ));

        $fieldset->addField('template', 'select', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Template'),
            'name'  => 'template',
            'required'  => true,
            'class' => 'required-entry',

            'values'=> Mage::getModel('ml_flipbookcarousel/flipbookcarousel_attribute_source_template')->getAllOptions(true),
        ));

        $type = $fieldset->addField('type', 'select', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Type'),
            'name'  => 'type',
            'required'  => true,
            'class' => 'required-entry',

            'values'=> Mage::getModel('ml_flipbookcarousel/flipbookcarousel_attribute_source_type')->getAllOptions(true),
        ));

        $text = $fieldset->addField('text', 'editor', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Content'),
            'name'  => 'text',
            'config' => $wysiwygConfig,
            'required'  => true,
            'class' => 'required-entry',

        ));

        $image = $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Image'),
            'name'  => 'image',
            'required'  => true,
            'class' => 'required-entry',

        ));

        $video = $fieldset->addField('video', 'file', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Video'),
            'name'  => 'video',
        ));

        $poster = $fieldset->addField('poster', 'image', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Poster'),
            'name'  => 'poster',
        ));

        $fieldset->addField('item_order', 'text', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Order'),
            'name'  => 'item_order',
            'required'  => true,
            'class' => 'required-entry',

        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('ml_flipbookcarousel')->__('Status'),
            'name'  => 'status',
            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('ml_flipbookcarousel')->__('Enabled'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('ml_flipbookcarousel')->__('Disabled'),
                ),
            ),
        ));
        if (Mage::app()->isSingleStoreMode()){
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_flipbookcarousel')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $formValues = Mage::registry('current_flipbookcarousel')->getDefaultValues();
        if (!is_array($formValues)){
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getFlipbookcarouselData()){
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getFlipbookcarouselData());
            Mage::getSingleton('adminhtml/session')->setFlipbookcarouselData(null);
        }
        elseif (Mage::registry('current_flipbookcarousel')){
            $formValues = array_merge($formValues, Mage::registry('current_flipbookcarousel')->getData());
        }
        $form->setValues($formValues);

        $this->setChild('form_after', $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap($type->getHtmlId(), $type->getName())
                ->addFieldMap($text->getHtmlId(), $text->getName())
                ->addFieldMap($image->getHtmlId(), $image->getName())
                ->addFieldMap($video->getHtmlId(), $video->getName())
                ->addFieldMap($poster->getHtmlId(), $poster->getName())
                ->addFieldDependence(
                    $text->getName(),
                    $type->getName(),
                    1
                )
                ->addFieldDependence(
                    $image->getName(),
                    $type->getName(),
                    2
                )
                ->addFieldDependence(
                    $video->getName(),
                    $type->getName(),
                    3
                )
                ->addFieldDependence(
                    $poster->getName(),
                    $type->getName(),
                    3
                )
        );

        return parent::_prepareForm();
    }
}
