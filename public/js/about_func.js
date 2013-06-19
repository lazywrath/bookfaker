$(document).ready(function() {

    // pulling the latest tweets with "twitter seaofclouds" plug-in
    $(".twitterFeed").tweet({
        join_text: "auto",
        username: "envato",
        avatar_size: 0,
        count: 4,
        loading_text: "loading tweets..."
    });


});