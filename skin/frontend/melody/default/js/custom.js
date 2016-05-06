$j(window).load(function(){
    $j('#vel_slider').nivoSlider({
        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 500, // Slide transition speed
        pauseTime:  10000, // How long each slide will show
        startSlide:  0, // Set starting Slide (0 index)
        directionNav: 1, // Next & Prev navigation
        controlNav: 1, // 1,2,3... navigation
        controlNavThumbs: 0, // Use thumbnails for Control Nav
        pauseOnHover: 0, // Stop animation while hovering
        manualAdvance: 0, // Force manual transitions
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        randomStart: 1, // Start on a random slide
        afterLoad: function(){
            $j(".vel_preload").hide();
        } // Triggers when slider has loaded
    });

    $j('.product_quantity_up').click(function (event) {
        event.preventDefault();
        $j('#qty').val(+$j('#qty').val() + 1);
    });
    $j('.product_quantity_down').click(function (event) {
        event.preventDefault();
        if ($j('#qty').val() > 0) $j('#qty').val(+$j('#qty').val() - 1);
    });

    if($j('#selectProductSort').length){
        $j('#selectProductSort').uniform();
    }
});

