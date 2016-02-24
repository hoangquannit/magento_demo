<?php

class ML_FlipbookCarousel_Model_Adminhtml_Search_Flipbookcarousel
    extends Varien_Object {
 
    public function load(){
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('ml_flipbookcarousel/flipbookcarousel_collection')
            ->addFieldToFilter('name', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $flipbookcarousel) {
            $arr[] = array(
                'id'=> 'flipbookcarousel/1/'.$flipbookcarousel->getId(),
                'type'  => Mage::helper('ml_flipbookcarousel')->__('Flipbook Carousel'),
                'name'  => $flipbookcarousel->getName(),
                'description'   => $flipbookcarousel->getName(),
                'url' => Mage::helper('adminhtml')->getUrl('*/flipbookcarousel_flipbookcarousel/edit', array('id'=>$flipbookcarousel->getId())),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
