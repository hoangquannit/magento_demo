<?php
class ML_FlipbookCarousel_Block_Adminhtml_Renderer_Content extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $text = $row->getText();
        $video = $row->getVideo();
        $image = $row->getImage();

        if($text){
            return $text;
        } elseif($image){
            $url = Mage::helper('ml_flipbookcarousel/flipbookcarousel_image')->getImageBaseUrl().$image;
            $html = "<img src='$url' width='100px' height='100px'/>";
            return $html;
        } elseif($video){
            return $video;
        }

        return "";
    }
}