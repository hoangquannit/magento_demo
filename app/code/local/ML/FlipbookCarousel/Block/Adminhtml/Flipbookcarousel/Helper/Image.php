<?php

class ML_FlipbookCarousel_Block_Adminhtml_Flipbookcarousel_Helper_Image
    extends Varien_Data_Form_Element_Image {
   
    protected function _getUrl(){
        $url = false;
        if ($this->getValue()) {
            $url = Mage::helper('ml_flipbookcarousel/flipbookcarousel_image')->getImageBaseUrl().$this->getValue();
        }
        return $url;
    }
}
