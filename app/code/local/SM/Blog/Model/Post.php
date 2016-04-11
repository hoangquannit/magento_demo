<?php

class SM_Blog_Model_Post extends Mage_Core_Model_Abstract
{
    const ENTITY = 'sm_blog_post';
    protected $_eventPrefix = 'sm_blog';
    protected $_eventObject = 'post';
 
    function _construct()
    {
        $this->_init('sm_blog/post');
    }
}
