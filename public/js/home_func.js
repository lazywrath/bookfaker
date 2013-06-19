$(document).ready(function() {

	// rotating the top stories section
	$('#stories').waitForImages(function() {

		$("#stories").jCarouselLite({
	        btnNext: "#topStories .next",
	        btnPrev: "#topStories .prev",
	        visible: 4
	    });

	});

	// pulling the latest tweets with "twitter seaofclouds" plug-in
	$(".twitterFeed").tweet({
		join_text: "auto",
		username: "envato",
		avatar_size: 0,
		count: 4,
		loading_text: "loading tweets..."
	});

	// rotating the sponsers section
	$('.sponsers').waitForImages(function() {

		$(".sponsers").jCarouselLite({
	        btnNext: "#ourSponsers .next",
	        btnPrev: "#ourSponsers .prev",
	        visible: 4
	    });

	});
	
});