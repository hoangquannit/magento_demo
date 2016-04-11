<?php

$installer = new SM_Blog_Model_Resource_Setup('sm_blog_setup');
$installer->startSetup();

$installer->endSetup();
 
$installer->installEntities();
