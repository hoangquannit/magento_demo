<?php

class SM_Blog_Helper_Data extends Mage_Core_Helper_Data
{
    public $_url = '';


    public function setUrl($url = '') {
        $this->_url = $url;
    }

    public function getUrl() {
        return $this->_url;
    }

}
