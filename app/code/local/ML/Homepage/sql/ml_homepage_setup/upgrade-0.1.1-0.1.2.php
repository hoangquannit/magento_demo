<?php

$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('ml_homepage/homepage'),
        'main_image_url',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => 255,
            'comment' => 'Main image url'
        )
    );
$installer->endSetup();