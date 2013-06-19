function imageHover() {


    // prettyPhoto plug-in for workspace images
    $("#gallery_1 div a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'pp_default',
        opacity: 0.9,
        allow_resize: true,
        slideshow: 5000,
        social_tools: false,
    });
    // End prettyPhoto plugt-in



    // IMAGE ROLLOVER EFFECT
    $('#gallery_1 ul li').hover(

        function() {
            var elem = $(this).find('div.image-hover');
            var h = elem.height();
            elem.css({
                top: - h - 20 + 'px',
                //height: 'auto',
                //height: '180px',
                display: 'block'
            }).stop().animate({
                opacity: 1,
                top: '42%'
            }, 500, 'easeOutBounce');
        },
        function() {
            var elem = $(this).find('div.image-hover');
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

    /* calling the imageHover function after the document is ready(after applying the
    'waitforeimages' plug-in) */
    $('#gallery_1 ul').waitForImages(function() {

        imageHover();

    });



    /* ===== Filtring the Portfolio images with QuickSand plug-in ======
    ====================================================================*/

    // get the action filter option item on page load
    var $filterType = $('#categoriesLinks li.selected a').attr('class');

    // get and assign the ourHolder element to the
    // $holder varible for use later
    var $holder = $('ul.designs');

    // clone all items within the pre-assigned $holder element
    var $data = $holder.clone();

    // attempt to call Quicksand when a filter option
    // item is clicked
    $('#categoriesLinks li a').click(function(e) {

        // reset the active class on all the buttons
        $('#categoriesLinks li').removeClass('selected');

        // assign the class of the clicked filter option
        // element to our $filterType variable
        var $filterType = $(this).attr('class');
        $(this).parent().addClass('selected');
        if ($filterType == 'all') {
            // assign all li items to the $filteredData var when
            // the 'All' filter option is clicked
            var $filteredData = $data.find('li.item');
        }
        else {
            // find all li elements that have our required $filterType
            // values for the data-type element
            var $filteredData = $data.find('li[data-type=' + $filterType + ']');
        }

        /* call quicksand and assign transition parameters (after applying the
        'waitforeimages' plug-in) */
        // 'useSclaing' require to include bothe 'jquery-css-transform.js' and
        // 'jquery-animate-css-rotate-scale.js' plug-ins in order to work.
        $('ul.designs').waitForImages(function() {

            $holder.quicksand($filteredData, {
                useScaling: true,
                duration: 500,
                easing: 'easeInOutQuad'
            }, function() {

                /* calling the imageHover function so that the image hover effect and the 
                prettyPhoto plug-in can work after we filter the images */
                imageHover();

            });

        });

        return false;

    });
    

});