<?php
class SM_Blog_Block_Adminhtml_Post extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function _construct()
    {
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_post';
        $this->_headerText = Mage::helper('blog')->__('Post Manager');
        parent::_construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl(
            'post/adminhtml_post/edit'
        );
    }
}