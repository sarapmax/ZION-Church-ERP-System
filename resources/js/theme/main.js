// Initiate on click and on hover sub menu activation logic
function os_init_sub_menus(){

    // INIT MENU TO ACTIVATE ON HOVER
    var menu_timer;
    $('.menu-activated-on-hover').on('mouseenter', 'ul.main-menu > li.has-sub-menu', function(){
        var $elem = $(this);
        clearTimeout(menu_timer);
        $elem.closest('ul').addClass('has-active').find('> li').removeClass('active');
        $elem.addClass('active');
    });

    $('.menu-activated-on-hover').on('mouseleave', 'ul.main-menu > li.has-sub-menu', function(){
        var $elem = $(this);
        menu_timer = setTimeout(function(){
            $elem.removeClass('active').closest('ul').removeClass('has-active');
        }, 30);
    });

    // INIT MENU TO ACTIVATE ON CLICK
    $('.menu-activated-on-click').on('click', 'li.has-sub-menu > a', function(event){
        var $elem = $(this).closest('li');
        if($elem.hasClass('active')){
            $elem.removeClass('active');
        }else{
            $elem.closest('ul').find('li.active').removeClass('active');
            $elem.addClass('active');
        }
        return false;
    });

}

$('.mobile-menu-trigger').on('click', function(){
    $('.menu-mobile .menu-and-user').slideToggle(200, 'swing');
    return false;
});

os_init_sub_menus();

$(window).on('resize', function() {
    if ($(window).width() > 768) {
        $('.menu-mobile .menu-and-user').css('display', 'block')
    }
});

