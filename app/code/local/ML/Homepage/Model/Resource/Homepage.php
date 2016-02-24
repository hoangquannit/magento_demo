<?php

class ML_Homepage_Model_Resource_Homepage
    extends Mage_Core_Model_Resource_Db_Abstract {

    public function _construct(){
        $this->_init('ml_homepage/homepage', 'entity_id');
    }
}
