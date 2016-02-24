<?php

class ml_FlipbookCarousel_Model_Flipbookcarousel
    extends Mage_Core_Model_Abstract {
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'ml_flipbookcarousel_flipbookcarousel';
    const CACHE_TAG = 'ml_flipbookcarousel_flipbookcarousel';
    const TYPE_TEXT = 1;
    const TYPE_IMAGE = 2;
    const TYPE_VIDEO = 3;
    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'ml_flipbookcarousel_flipbookcarousel';

    protected $_eventObject = 'flipbookcarousel';

    public function _construct(){
        parent::_construct();
        $this->_init('ml_flipbookcarousel/flipbookcarousel');
    }

    protected function _beforeSave(){
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()){
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);

        $allTypes = $this->_getAllTypes();

        foreach($allTypes as $key => $type){
            if($type != $this->getType()){
                $this->setData($key, null);
            }
        }
        return $this;
    }

    public function getText(){
        $text = $this->getData('text');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($text);
        return $html;
    }

    protected function _afterSave() {
        return parent::_afterSave();
    }

    public function getDefaultValues() {
        $values = array();
        $values['status'] = 1;
        return $values;
    }

    protected function _getAllTypes()
    {
        return array(
            'text' => self::TYPE_TEXT,
            'image' => self::TYPE_IMAGE,
            'video' => self::TYPE_VIDEO
        );
    }
}
