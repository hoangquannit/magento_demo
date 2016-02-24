<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('ml_homepage/homepage'),
        'nav_color',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Navigation Color'
        )
    );
$installer->endSetup();