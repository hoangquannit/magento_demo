<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Home page video',
        'home_page_video',
        '<div class="vel-html col-sm-12  col-xs-12 col-md-6 col-sm-6 col-xs-12 ">
          <div class="block vel-wrap">
             <h4 class="title_block">
                 <span>video</span>
             </h4>
             <div class="block_content">
               <div class="video-container"><iframe src="https://www.youtube.com/embed/gsw8lzUNNSg" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
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
