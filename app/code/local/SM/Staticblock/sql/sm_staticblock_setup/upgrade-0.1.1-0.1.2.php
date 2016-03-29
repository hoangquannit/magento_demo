<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Homepage Browse CATEGORIES',
        'homepage_browse_categories',
        '<div class="vel-html margin-40 col-sm-12  col-xs-12 hidden-xs col-md-6 col-sm-6 col-xs-12 ">
         <div class="block vel-wrap">
         <h4 class="title_block">
        <span>BROWSE CATEGORIES</span>
           </h4>
            <div class="block_content">
           <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="box-container">
        <div class="box-content"><a class="animation-line " title="banner1" href="#"> <img class="img-responsive" src="{{media url="wysiwyg/banner1.jpg"}}" alt=""> </a>
        <div class="dec-adv">
        <h3 class="box-title"><a title="Top picks" href="/best-sales">Bags</a></h3>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="box-container">
        <div class="box-content"><a class="animation-line " title="banner1" href="#"> <img class="img-responsive" src="{{media url="wysiwyg/banner2.jpg"}}" alt=""> </a>
        <div class="dec-adv">
        <h3 class="box-title"><a title="Top picks" href="/best-sales">Men</a></h3>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="box-container">
        <div class="box-content"><a class="animation-line " title="banner1" href="#"> <img class="img-responsive" src="{{media url="wysiwyg/banner3.jpg"}}" alt=""> </a>
        <div class="dec-adv">
        <h3 class="box-title"><a title="Top picks" href="/best-sales">Women</a></h3>
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


