<?php

class ML_Homepage_Block_Homepage extends Mage_Core_Block_Template
{
    const HOMEPAGE_TEMPLATE_1 = 1;
    const HOMEPAGE_TEMPLATE_2 = 2;
    const HOMEPAGE_TEMPLATE_3 = 3;
    const HOMEPAGE_TEMPLATE_4 = 4;
    const HOMEPAGE_TEMPLATE_5 = 5;

    protected $_homepageTemplate;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate("ml_homepage/homepage.phtml");
    }

    public function setHomePageTemplate($template)
    {
        $this->_homepageTemplate = $template;
        return $this;
    }

    public function getHomePageContent()
    {
        $homepageModel = Mage::getModel('ml_homepage/homepage')->load($this->_homepageTemplate);
        return $homepageModel;
    }

    public function getFlipBookCarousel()
    {
        $flipbookCarousel = $this->getLayout()->createBlock('ml_flipbookcarousel/flipbookCarousel');

        if($this->_homepageTemplate == self::HOMEPAGE_TEMPLATE_1){
            $flipbookCarousel->setFlipbookTemplate(2);
        } elseif($this->_homepageTemplate == self::HOMEPAGE_TEMPLATE_2){
            $flipbookCarousel->setFlipbookTemplate(1);
        } elseif($this->_homepageTemplate == self::HOMEPAGE_TEMPLATE_4){
            $flipbookCarousel->setFlipbookTemplate(2);
        }else
        {
            return;
        }

        return $flipbookCarousel->toHtml();
    }

    public function getFeaturedProducts()
    {
        $featuredProducts = $this->getLayout()->createBlock('featuredproduct/featuredproduct')
            ->setTemplate('featuredproduct/featuredproduct.phtml');
        return $featuredProducts->toHtml();
    }

    public function getDesigner()
    {
        $attribute = Mage::getModel('eav/entity_attribute')
            ->loadByCode('catalog_product', 'designer');

        $url = Mage::getModel('catalog/product_url');

        $designerCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')
            ->setAttributeFilter($attribute->getData('attribute_id'))
            ->setStoreFilter(0, false);
        ;

        $designerArray = array();

        foreach($designerCollection as $key => $designer){
            $designerArray[$key]['name'] = $designer->getValue();
            $url = Mage::getModel('attributeSplash/page')->load($designer->getOptionId(),'option_id')->getUrl();
            $designerArray[$key]['url'] = $url;
        }
        usort($designerArray,function($a, $b){
            return strcasecmp($a['name'], $b['name']);
        });
        return $designerArray;
    }
}