<?php
class ML_FlipbookCarousel_Block_FlipbookCarousel extends Mage_Core_Block_Template
{
    const FLIPBOOK_TEMPLATE_1_IMAGE = 1;
    const FLIPBOOK_TEMPLATE_2_IMAGES = 2;

    protected $_flipbookTemplate;

    public function setFlipbookTemplate($template)
    {
        if($template == self::FLIPBOOK_TEMPLATE_1_IMAGE){
            $this->setTemplate("ml_flipbookcarousel/flipbook_1_image.phtml");
        }else{
            $this->setTemplate("ml_flipbookcarousel/flipbook_2_images.phtml");
        }

        $this->_flipbookTemplate = $template;
        return $this;
    }

    public function getFlipbookTemplate()
    {
        return $this->_flipbookTemplate;
    }

    public function getItems()
    {
        $items = Mage::getModel('ml_flipbookcarousel/flipbookcarousel')
            ->getCollection()
            ->addFieldToFilter('template',$this->_flipbookTemplate)
            ->addFieldToFilter('status',1)
            ->setOrder('item_order','asc');
        return $items;
    }
}