  $(document).scroll(function() {
    if($(this).scrollTop() > 60)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.navbar-transparent').addClass('scrolled');
    } else {
        $('.navbar-transparent').removeClass('scrolled');
    }
});