<?php

class SM_Blog_IndexController extends Mage_Core_Controller_Front_Action
{
    public function  _construct() {
        Mage::helper('blog')->setUrl('');
        parent::_construct();
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function viewAction()
    {
        $raw_url = $this->getRequest()->getParams();
        $url = $raw_url['url'];

        Mage::helper('blog')->setUrl($url);

        $this->loadLayout()->renderLayout();
    }

    protected function _getModelPost()
    {
        return Mage::getModel('sm_blog/post');
    }
}