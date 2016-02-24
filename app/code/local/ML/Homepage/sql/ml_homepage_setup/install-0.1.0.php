<?php

$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('ml_homepage/homepage'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Home Page ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Name')

    ->addColumn('main_image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Main Image')

    ->addColumn('main_image_enable', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable')

    ->addColumn('slide_image',Varien_Db_Ddl_Table::TYPE_TEXT,'64k',
        array(
            'comment' => 'Slide image'
        )
     )

    ->addColumn('slide_image_enable',Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'comment' => 'Enable slide image'
        )
    )

    ->addColumn('promotion_list', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Promotion list ')

    ->addColumn('promotion_list_enable', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable promotion')

    ->addColumn('video_list', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Video list')

    ->addColumn('video_list_enable', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable video')

    ->addColumn('client_complain', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Client complain')

    ->addColumn('client_complain_enable', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable client complain')

    ->addColumn('list_logo', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'List logo')

    ->addColumn('list_logo_enable', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable list logo')

    ->addColumn('best_seller', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable best seller')

    ->addColumn('hot_deals', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable hot deals')

    ->addColumn('featured_products', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enable Featured Products')

    ->addColumn('template', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Template')
    ->setComment('Home Page Table');
$this->getConnection()->createTable($table);
$this->run("
    INSERT INTO `{$this->getTable('ml_homepage/homepage')}`(name,template) VALUES ('Homepage Template 1',1);
    INSERT INTO `{$this->getTable('ml_homepage/homepage')}`(name,template) VALUES ('Homepage Template 2',2);
    INSERT INTO `{$this->getTable('ml_homepage/homepage')}`(name,template) VALUES ('Homepage Template 3',3);
    INSERT INTO `{$this->getTable('ml_homepage/homepage')}`(name,template) VALUES ('Homepage Template 4',4);
    INSERT INTO `{$this->getTable('ml_homepage/homepage')}`(name,template) VALUES ('Homepage Template 5',5);
");
$this->endSetup();
