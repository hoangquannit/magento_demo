<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Footer banner support',
        'footer_banner_support',
        '<div class="vel-html banner-support col-sm-6 col-xs-12 col-md-4 col-sm-4 col-xs-12 ">
             <div class="block vel-wrap">
                <div class="block_content">
                   <p><a class="animation-line " title="banner1" href="#"> <img class="img-responsive" src="http://velatheme.com/demo/elise_multi/vel_elise/modules/velpagemanage/img/support.jpg" alt=""> </a></p>
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
