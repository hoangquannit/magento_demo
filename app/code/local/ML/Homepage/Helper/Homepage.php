<?php 

class ML_Homepage_Helper_Homepage
    extends Mage_Core_Helper_Abstract {

    public function getFileBaseDir(){
        return Mage::getBaseDir('media').DS.'homepage'.DS.'file';
    }

    public function getFileBaseUrl(){
        return Mage::getBaseUrl('media').'homepage'.'/'.'file';
    }
}
