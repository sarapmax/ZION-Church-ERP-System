$('.mobile-menu-trigger').on('click', function(){
    $('.menu-mobile .menu-and-user').slideToggle(200, 'swing');
    return false;
});

$(window).on('resize', function() {
    if ($(window).width() > 768) {
        $('.menu-mobile .menu-and-user').css('display', 'block')
    }
});
