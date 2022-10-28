$('.nav-trigger').click(function () {
    $(this).toggleClass('active');
    $(".collapse").toggleClass("show");
});

$(window).scroll(function () {
    if ($(document).scrollTop() > 50) {
        $('.nav-scroll').removeClass('navbarDefault');
    } else {
        $('.nav-scroll').addClass('navbarDefault');
    }
});
