<?php

class ML_Homepage_Model_Homepage
    extends Mage_Core_Model_Abstract {

    const ENTITY    = 'ml_homepage_homepage';
    const CACHE_TAG = 'ml_homepage_homepage';

    protected $_eventPrefix = 'ml_homepage_homepage';


    protected $_eventObject = 'homepage';

    public function _construct(){
        parent::_construct();
        $this->_init('ml_homepage/homepage');
    }

    protected function _beforeSave(){
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()){
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    public function getPromotionList(){
        $promotion_list = $this->getData('promotion_list');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($promotion_list);
        return $html;
    }

    public function getVideoList(){
        $video_list = $this->getData('video_list');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($video_list);
        return $html;
    }

    public function getClientComplain(){
        $client_complain = $this->getData('client_complain');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($client_complain);
        return $html;
    }

    public function getListLogo(){
        $list_logo = $this->getData('list_logo');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($list_logo);
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

}
