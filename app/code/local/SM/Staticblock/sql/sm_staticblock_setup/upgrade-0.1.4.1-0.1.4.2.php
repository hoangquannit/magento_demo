<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Home page footer logo slider',
        'home_page_footer_logo_slider',
        '<div class="vel-footer-top clearfix">
	<div class="container">
		<div class="row">
		   <div class="vel-manufacture  col-md-12 col-sm-12 col-xs-12 ">
		        <div class="block_content">
		            <div class="row">
		                <div id="manufacture-footer" class="owl-carousel owl-theme">
                            <div class="item">
		    	                <div class="logo-manu">
					               <a href="http://velatheme.com/demo/elise_multi/vel_elise/en/1_fashion-manufacturer" title="view products">
					               <img class="img-responsive" src="{{media url="wysiwyg/1-Manufacturers.jpg"}}" alt="">
					               </a>
				                </div>
		                    </div>
		                    <div class="item">
		    	                <div class="logo-manu">
					                <a href="http://velatheme.com/demo/elise_multi/vel_elise/en/2_fashion-manufacturer" title="view products">
					                <img class="img-responsive" src="{{media url="wysiwyg/2-Manufacturers.jpg"}}" alt="">
					                </a>
				                </div>
		                    </div>
		                    <div class="item">
		    	                 <div class="logo-manu">
									<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/3_fashion-manufacturer" title="view products">
									<img class="img-responsive" src="{{media url="wysiwyg/3-Manufacturers.jpg"}}" alt=""></a>
								</div>
		                    </div>
		                    <div class="item">
						    	<div class="logo-manu">
									<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/4_fashion-manufacturer" title="view products">
									<img class="img-responsive" src="{{media url="wysiwyg/4-Manufacturers.jpg"}}" alt=""></a>
								</div>
		                    </div>
		                    <div class="item">
						    	<div class="logo-manu">
									<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/5_fashion-manufacturer" title="view products">
									<img class="img-responsive" src="{{media url="wysiwyg/5-Manufacturers.jpg"}}" alt=""></a>
								</div>
		                    </div>
		                    <div class="item">
						    	<div class="logo-manu">
									<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/6_fashion-manufacturer" title="view products">
									<img class="img-responsive" src="{{media url="wysiwyg/6-Manufacturers.jpg"}}" alt=""></a>
								</div>
		                    </div>
		                    <div class="item">
						    	<div class="logo-manu">
									<a href="http://velatheme.com/demo/elise_multi/vel_elise/en/7_fashion-manufacturer" title="view products">
									<img class="img-responsive" src="{{media url="wysiwyg/7-Manufacturers.jpg"}}" alt=""></a>
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
