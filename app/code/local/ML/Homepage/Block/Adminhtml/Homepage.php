<?php

class ML_Homepage_Block_Adminhtml_Homepage
    extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct(){
        $this->_controller         = 'adminhtml_homepage';
        $this->_blockGroup         = 'ml_homepage';
        parent::__construct();
        $this->_headerText         = Mage::helper('ml_homepage')->__('Home Page Templates');
        $this->_removeButton('add');

    }
}
