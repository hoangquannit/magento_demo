<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/*@var blocks are defined by array([title],[identifier],[content])  */

$blocks = array(
    array(
        'Home page nov slideshow',
        'home_page_nov_slideshow',
        '<div class="slideshow-container clearfix">
    <div class="vel_preload" style="display: none;"></div>
    <div id="vel_slider">
        <img src="{{media url="wysiwyg/sample-1.jpg"}}" alt="Wing man - hit the runway in stylish separates and casuals - Click to Shop Man" title="#htmlcaption_1"/>
        <img src="{{media url="wysiwyg/sample-2.jpg"}}" alt="Wing man - hit the runway in stylish separates and casuals - Click to Shop Man" title="#htmlcaption_2"/>
        <img src="{{media url="wysiwyg/sample-3.jpg"}}" alt="Wing man - hit the runway in stylish separates and casuals - Click to Shop Man" title="#htmlcaption_3"/>

    </div>
    <div id="htmlcaption_1" class="nivo-html-caption">
        <div class="vela-slider-ct">
            <div class="vel-center slider-center">
                   <div class="vel-title effect-7">
                        It was popularise
                    </div>
                        <div class="vel-description effect-11">
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum</p>
                    </div>
                         <div class="vel-html effect-12">
                        <p><a class="btn btn-default" href="#"><em>Shop now !</em></a></p>
                    </div>
            </div>
         </div>
    </div>
    <div id="htmlcaption_2" class="nivo-html-caption">
        <div class="vela-slider-ct">
            <div class="vel-center slider-center">
                <div class="vel-title effect-1">
                        T-shirts
                    </div>
                        <div class="vel-description effect-5">
                        <p>MEGA SALE OFF 30%</p>
                    </div>
                        <div class="vel-html effect-12">
                        <p><a class="btn btn-default" href="http://www.prestashop.com/"><em>Shop now !</em></a></p>
                    </div>
                </div>
        </div>
    </div>
    <div id="htmlcaption_3" class="nivo-html-caption">
        <div class="vela-slider-ct">
            <div class="vel-center slider-left">
                <div class="vel-title effect-12">
                        SALE OFF 35%
                    </div>
                        <div class="vel-description effect-1">
                        <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima</p>
                    </div>
                        <div class="vel-html effect-5">
                        <p><a class="btn btn-default" href="#"><em>Shop now !</em></a></p>
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
