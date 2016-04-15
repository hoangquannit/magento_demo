<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Footer various links',
        'footer_various_links',
        '<div class="vel-modules col-sm-6 min-height col-md-2 col-xs-12"><div class="block vel-wrap">
	<!-- MODULE Block footer -->
	<section class="footer-block" id="block_various_links_footer">
		<h4 class="title_block"><span>Information</span></h4>
		<ul class="toggle-footer" style="">
			<li class="item">
                <a href="http://velatheme.com/demo/elise_multi/vel_elise/en/prices-drop" title="Specials">
                    Specials
                </a>
			</li>
			<li class="item">
				<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/new-products" title="New products">
					New products
				</a>
			</li>
			<li class="item">
                <a href="http://velatheme.com/demo/elise_multi/vel_elise/en/best-sales" title="Top sellers">
                    Top sellers
                </a>
			</li>
			<li class="item">
				<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/contact-us" title="Contact us">
					Contact us
				</a>
			</li>
			<li class="item">
                <a href="http://velatheme.com/demo/elise_multi/vel_elise/en/content/4-about-us" title="About us">
                    About us
                </a>
			</li>
			<li>
				<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/sitemap" title="Sitemap">
					Sitemap
				</a>
			</li>
</ul>
</section>
</div></div>'),
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
