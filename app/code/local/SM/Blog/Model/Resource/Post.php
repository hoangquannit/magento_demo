<?php

class SM_Blog_Model_Resource_Post extends Mage_Eav_Model_Entity_Abstract
{
    public function __construct()
    {
        $resource = Mage::getSingleton('core/resource');
        
        $this->setType(SM_Blog_Model_Post::ENTITY); 
 
        $this->setConnection(
            $resource->getConnection('sm_blog_read'),
            $resource->getConnection('sm_blog_write')
        );
    }
}
