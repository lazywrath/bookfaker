  $(function(){

	// sliding down the main nav
	$('#mainNav > ul > li').hover(
		function () {
			// hide the css default behavir
			$('ul', this).css('display', 'none');
			//show its submenu
			$('ul', this).stop().slideDown(160);
		}, 
		function () {
			//hide its submenu
			$('ul', this).stop().slideUp(160);			
		}
	);

	//Go To Top Button
	$(window).scroll(function(){

		var y = $(window).scrollTop();
		
		if ( y > '50' ) {

			$('#toTop').fadeIn(300);
			

		} else {
			$('#toTop').fadeOut(300);//css('display', 'none');
		}
	});

	//go to  top
	$('a[href=#top]').click(function () {
	    $('html, body').animate({ scrollTop: 0 }, 500);
	    return false;
	});//end

	// placeholder for ie
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
	    input.val('');
	    input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
	    input.addClass('placeholder');
	    input.val(input.attr('placeholder'));
	  }
	}).blur();



	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
	    var input = $(this);
	    if (input.val() == input.attr('placeholder')) {
	      input.val('');
	    }
	  })
	});
	// end placeholder for ie


});