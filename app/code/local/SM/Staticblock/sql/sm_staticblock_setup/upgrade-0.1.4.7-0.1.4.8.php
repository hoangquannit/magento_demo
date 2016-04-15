<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Footer payments',
        'footer_payments',
        '<div class="vel-copyright col-xs-12">
		   <div class="row">
		     <div class="vel-html col-sm-12 text-center col-md-6 col-sm-6 col-xs-12 ">
                 <div class="block vel-wrap">
                    <div class="block_content">
                       <p class="payment-link">
                           <a href="#">
                               <img src="{{media url="wysiwyg/payment.png"}}" alt="">
                           </a>
                           <a href="#">
                               <img src="{{media url="wysiwyg/payment-1.png"}}" alt="">
                           </a>
                           <a href="#">
                               <img src="{{media url="wysiwyg/payment-2.png"}}" alt="">
                           </a>
                           <a href="#">
                               <img src="{{media url="wysiwyg/payment-3.png"}}" alt="">
                           </a>
                       </p>
                    </div>
                 </div>
             </div>
             <div class="vel-modules col-sm-12 col-md-6 col-xs-12"><div class="block vel-wrap">
                <div id="social_block" class="block">
                    <span class="title-social">follow us</span>
                    <div class="block_content">
                        <ul class="list-inline">
                             <li class="facebook">
                                <a target="_blank" href="http://www.facebook.com/prestashop">
                                    <span class="icon icon-facebook"></span>
                                </a>
                             </li>
                             <li class="twitter">
                                <a target="_blank" href="http://www.twitter.com/prestashop">
                                    <span class="icon icon-twitter"></span>
                                </a>
                             </li>
                             <li class="rss">
                                <a target="_blank" href="http://www.prestashop.com/blog/en/">
                                    <span class="icon icon-rss"></span>
                                </a>
                             </li>
                             <li class="google-plus">
                                <a target="_blank" href="https://www.google.com/+prestashop">
                                    <span class="icon icon-google-plus"></span>
                                </a>
                             </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div></div>
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
