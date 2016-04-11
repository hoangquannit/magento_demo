<?php

/**
 * Created by PhpStorm.
 * User: jasontrinh
 * Date: 11/21/14
 * Time: 2:55 PM
 */
class SM_Blog_Block_Index extends Mage_Core_Block_Template
{

    public function getAllPost()
    {
        $post_data = array();
        $collections = Mage::getModel('sm_blog/post')->getCollection()->addAttributeToSelect('*');
        foreach ($collections as $post)
        {
            $post_data[] = $post;
        }
        return $post_data;
    }

    public function getDataBlog($url = '') {

        $data = '';
        if($url != null) {
            $data = Mage::getModel('sm_blog/post')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('url',$url)
                ->getFirstItem();
        }
        return $data;
    }

}