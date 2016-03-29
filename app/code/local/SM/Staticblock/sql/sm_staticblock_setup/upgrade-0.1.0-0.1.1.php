<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Homepage Shipping and delivery',
        'homepage_shipping_and_delivery',
        '<div class="container">
         <div class="row"> 
        <div class="vel-html shipping clear-both col-md-12 col-sm-12 col-xs-12 ">
        <div class="block vel-wrap">
        <div class="block_content">
        <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="head-block-content clearfix"><em class="icon icon-truck"></em>
        <p><span class="title-bold">FREE SHIPPING On Order Over $99</span></p>
        </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="head-block-content clearfix"><em class="icon icon-comment-alt"></em>
        <p><span class="title-bold">CUSTOMER SUPPORT SERVICE</span></p>
        </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="head-block-content clearfix"><em class="icon icon-star-empty"></em>
        <p><span class="title-bold">5% discunt one order over $200</span></p>
        </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="head-block-content clearfix"><em class="icon icon-money"></em>
        <p><span class="title-bold">30 DAYS MONEY BACK 100%</span></p>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>'),
);
foreach ($blocks as $key => $blockData) {
    list($title, $identifier, $content) = $blockData;

    // if exists then delete
    if (Mage::getModel('cms/block')->load($identifier)->getBlockId()){
        Mage::getModel('cms/block')->load($identifier)->delete();
    }
    // add block
    $block = Mage::getModel('cms/block')
        ->setTitle($title)
        ->setIdentifier($identifier)
        ->setContent($content)
        ->setStores(array(0))
        ->save()
    ;
}
$installer->endSetup();


