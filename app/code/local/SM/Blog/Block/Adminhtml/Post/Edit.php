<?php

class SM_Blog_Block_Adminhtml_Post_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_post';
        $this->_mode = 'edit';

       /* $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);*/
        $this->_updateButton('save', 'label', Mage::helper('blog')->__('Save Post'));

    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    public function getHeaderText()
    {
        if (Mage::registry('post_data') && Mage::registry('post_data')->getId())
        {
            return Mage::helper('blog')->__('Edit Post (%s)', $this->htmlEscape(Mage::registry('post_data')->getTitle()));
        } else {
            return Mage::helper('blog')->__('New Post');
        }
    }
}