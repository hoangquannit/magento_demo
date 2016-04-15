<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Footer support link',
        'footer_support_link',
        '<div class="vel-html col-sm-6 col-md-2 col-sm-2 col-xs-12 ">
             <div class="block vel-wrap">
                 <h4 class="title_block">
                   <span>support</span>
                 </h4>
               <div class="block_content">
               <ul class="toggle-footer">
                    <li><a href="#">Validate License</a></li>
                    <li><a href="#l">Terms of Service</a></li>
                    <li><a href="#">Discount Coupons</a></li>
                    <li><a href="#">Sed non mauris vitae</a></li>
                    <li><a href="#">Cerat consequat</a></li>
                    <li><a href="#">Nam nec tellus</a></li>
                </ul>
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
