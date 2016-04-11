<?php

class SM_Blog_Block_Adminhtml_Post_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        if (Mage::registry('post_data'))
        {
            $data = Mage::registry('post_data')->getData();
        }
        else
        {
            $data = array();
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'general',array(
                'legend' => $this->__('Form EAV')
            )
        );

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label'     => Mage::helper('blog')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'title'      => 'Tiêu đề',
            'note'     => Mage::helper('blog')->__('The name of post.'),
        ));

        $fieldset->addField('avatar_id', 'file', array(
            'label'     => Mage::helper('blog')->__('Avatar'),
            'required'  => false,
            'name'      => 'avatar',
        ));

        $fieldset->addField('url', 'text', array(
            'name' => 'url',
            'label'     => Mage::helper('blog')->__('URL'),
            'class'     => 'required-entry',
            'required'  => true,
            'url'      => 'url'
        ));

        $fieldset->addField('content', 'textarea', array(
            'name' => 'content',
            'label'     => Mage::helper('blog')->__('Content'),
            'class'     => 'required-entry',
            'required'  => true,
            'content'      => 'content',

        ));

        $fieldset->addField('is_active', 'select', array(
            'name'     => 'is_active',
            'label'     => Mage::helper('blog')->__('is active'),
            'class'     => 'required-entry',
            'required'  => true,
            'options'   => array(
                1 => 'Enabled',
                0 => 'Disabled',
            ),
        ));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}