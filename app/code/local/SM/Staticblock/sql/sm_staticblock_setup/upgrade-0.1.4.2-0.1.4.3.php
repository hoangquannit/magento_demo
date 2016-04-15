<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Footer contact us ml',
        'footer_contact_us_ml',
        '<div class="vel-html col-sm-6 min-height col-md-4 col-sm-4 col-xs-12 ">
         <div class="block vel-wrap">
             <h4 class="title_block">
            <span>Contact</span>
           </h4>
            <div class="block_content">
            <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
            <ul class="vel-contactinfo">
                <li><em class="icon icon-map-marker">&nbsp; </em>Address: Avenue of the American Independent,Lorem Ipsum</li>
                <li><em class="icon icon-envelope">&nbsp; </em>Email:Demo@demo.com</li>
                <li><em class="icon icon-mobile-phone">&nbsp; </em>Phone:+01 888 (000) 1234</li>
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
