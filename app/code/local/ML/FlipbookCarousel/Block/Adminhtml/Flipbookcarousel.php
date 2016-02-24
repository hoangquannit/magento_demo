<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel
    extends Mage_Adminhtml_Block_Widget_Grid_Container {
 
    public function __construct(){
        $this->_controller         = 'adminhtml_flipbookcarousel';
        $this->_blockGroup         = 'ml_flipbookcarousel';
        parent::__construct();
        $this->_headerText         = Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel');
        $this->_updateButton('add', 'label', Mage::helper('ml_flipbookcarousel')->__('Add Flipbook Carousel'));

    }
}
