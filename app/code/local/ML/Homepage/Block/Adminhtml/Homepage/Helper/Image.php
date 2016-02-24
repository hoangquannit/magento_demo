<?php

class ML_Homepage_Block_Adminhtml_Homepage_Helper_Image
    extends Varien_Data_Form_Element_Image {

    protected function _getUrl(){
        $url = false;
        if ($this->getValue()) {
            $url = Mage::helper('ml_homepage/homepage_image')->getImageBaseUrl().$this->getValue();
        }
        return $url;
    }
}
