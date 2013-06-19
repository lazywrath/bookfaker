function imageHover() {


    // prettyPhoto plug-in for workspace images
    $("#gallery_4_columns a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'pp_default',
        opacity: 0.9,
        allow_resize: true,
        slideshow: 5000,
        social_tools: false,
    });
    // End prettyPhoto plugt-in



    // IMAGE ROLLOVER EFFECT
    $('#gallery_4_columns ul li').hover(

        function() {
            $(this).find('img').stop().animate({
                opacity: 0.3
            }, 300);
        },
        function() {
            $(this).find('img').stop().animate({
                opacity: 1
            }, 300);
        }

    );

    $('#gallery_4_columns ul li').hover(

        function() {
            var elem = $(this).find('div');
            var h = elem.height();
            elem.css({
                top: - h - 20 + 'px',
                //height: 'auto',
                //height: '180px',
                display: 'block'
            }).stop().animate({
                opacity: 1,
                top: '5px'
            }, 500, 'easeOutBounce');
        },
        function() {
            var elem = $(this).find('div');
            var h = elem.height();
            elem.stop().animate({
                opacity: 0
                //height: '180px'
                //height: 'auto'
            }, 200, 'easeInCubic', function() {
                $(this).css({
                    display: 'none'
                });
            });
        }
        
    );
    // End image hover effect


}


$(document).ready(function() {

	// slide toggle the side nav
	$('#sideNav > ul > li:has("ul") > a').click(

			function (e) {
				
				$(this).toggleClass('active');
				$(this).parent('li').children('ul').slideToggle(160);

				e.preventDefault();
	     		return false;
			}

	);

	// rotating the videos section
	$("#videoRotator").jCarouselLite({
        btnNext: "#videos .next",
        btnPrev: "#videos .prev",
        visible: 1
    });

    /* calling the imageHover function after the document is ready(after applying the
    'waitforeimages' plug-in) */
    $('#gallery_4_columns ul').waitForImages(function() {

        imageHover();

    });
	
});