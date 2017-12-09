  $(document).scroll(function() {
    if($(this).scrollTop() > 136)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.navbar-transparent').fadeOut(200);
    } else {
        $('.navbar-transparent').fadeIn(200);
    }
});