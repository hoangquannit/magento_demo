<?php 


class ML_FlipbookCarousel_Helper_Flipbookcarousel
    extends Mage_Core_Helper_Abstract {

    public function getFileBaseDir(){
        return Mage::getBaseDir('media').DS.'flipbookcarousel'.DS.'file';
    }

    public function getFileBaseUrl(){
        return Mage::getBaseUrl('media').'flipbookcarousel'.'/'.'file';
    }
}
