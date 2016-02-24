<?php

$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('ml_flipbookcarousel/flipbookcarousel'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Flipbook Carousel ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Item Name')

    ->addColumn('template', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Template')

    ->addColumn('text', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'nullable'  => false,
        ), 'Content')

    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Image')

    ->addColumn('video', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Video')

    ->addColumn('poster', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Poster')

    ->addColumn('item_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'unsigned'  => true,
        ), 'Order')

    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Type')

    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enabled')

     ->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Flipbook Carousel Status')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            ), 'Flipbook Carousel Modification Time')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Flipbook Carousel Creation Time')
    ->setComment('Flipbook Carousel Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
    ->newTable($this->getTable('ml_flipbookcarousel/flipbookcarousel_store'))
    ->addColumn('flipbookcarousel_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'primary'   => true,
        ), 'Flipbook Carousel ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Store ID')
    ->addIndex($this->getIdxName('ml_flipbookcarousel/flipbookcarousel_store', array('store_id')), array('store_id'))
    ->addForeignKey($this->getFkName('ml_flipbookcarousel/flipbookcarousel_store', 'flipbookcarousel_id', 'ml_flipbookcarousel/flipbookcarousel', 'entity_id'), 'flipbookcarousel_id', $this->getTable('ml_flipbookcarousel/flipbookcarousel'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($this->getFkName('ml_flipbookcarousel/flipbookcarousel_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Flipbook Carousels To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();
