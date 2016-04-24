<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Categories women landing page',
        'categories_women_landing_page',
        '<h1 class="page-heading product-listing"><span class="cat-name">Women&nbsp;</span></h1>
<div class="content_scene_cat">
    <div class="content_scene_cat_bg">
        <img class="img-responsive" src="{{media url="wysiwyg/women.jpg"}}">
        <div class="cat_desc">
            <div class="rte">
            	<p><strong>You will find here all woman fashion collections.</strong></p>
				<p>This category includes all the basics of your wardrobe and much more:</p>
				<p>shoes, accessories, printed t-shirts, feminine dresses, women jeans!</p>
			</div>
        </div>
    </div>
</div>
<div id="subcategories">
	<p class="subcategory-heading">Subcategories</p>
		<ul class="row clearfix">
			<li class="col-sx-12 col-sm-3 col-md-4">
                <div class="subcategory-image">
					<a href="{{config path="web/secure/base_url"}}women/women-new-arrivals.html" title="Tops" class="img">
						<img class="replace-2x" src="{{media url="wysiwyg/tops.jpg"}}" alt="" width="335" height="115">
					</a>
                </div>
		        <h5><a class="subcategory-name" href="{{config path="web/secure/base_url"}}women/women-new-arrivals.html">Tops</a></h5>
			</li>
			<li class="col-sx-12 col-sm-3 col-md-4">
                <div class="subcategory-image">
					<a href="{{config path="web/secure/base_url"}}women/tops-blouses.html" title="Dresses" class="img">
						<img class="replace-2x" src="{{media url="wysiwyg/dresses.jpg"}}" alt="" width="335" height="115">
					</a>
                </div>
			    <h5><a class="subcategory-name" href="{{config path="web/secure/base_url"}}women/tops-blouses.html">Dresses</a></h5>
			</li>
			<li class="col-sx-12 col-sm-3 col-md-4">
                <div class="subcategory-image">
						<a href="{{config path="web/secure/base_url"}}women/women-pants-denim.html" title="Beachwear" class="img">
						<img class="replace-2x" src="{{media url="wysiwyg/beachwear.jpg"}}" alt="" width="335" height="115">
						</a>
                   	</div>
					<h5><a class="subcategory-name" href="{{config path="web/secure/base_url"}}women/women-pants-denim.html">Beachwear</a></h5>
			</li>
			<li class="col-sx-12 col-sm-3 col-md-4">
                <div class="subcategory-image">
					<a href="{{config path="web/secure/base_url"}}women/dresses-skirts.html" title="Accessories" class="img">
					<img class="replace-2x" src="{{media url="wysiwyg/accessories.jpg"}}" alt="" width="335" height="115">
					</a>
                </div>
				<h5><a class="subcategory-name" href="{{config path="web/secure/base_url"}}women/dresses-skirts.html">Accessories</a></h5>

			</li>
		</ul>
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
