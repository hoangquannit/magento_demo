<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Homepage banner categories sale two',
        'homepage_categories_sale_two',
        '<div class="vel-html  col-md-12 col-sm-12 col-xs-12 ">
         <div class="block vel-wrap">
            <div class="block_content">
                <div class="box-container">
                    <div class="box-content"><a class="animation-line " title="banner1" href="#"> <img class="img-responsive" src="{{media url="wysiwyg/banner5.jpg"}}" alt=""> </a></div>
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


