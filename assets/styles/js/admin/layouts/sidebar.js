$(document).on("click", ".btn-submenu", function (e) {
    let currentTarget = $(e.currentTarget);

    currentTarget.parent().toggleClass("active")
    currentTarget.next().toggle();

    currentTarget.parent().hasClass("active")
        ? currentTarget.children().next().next().css('transform', 'rotate(90deg)')
        : currentTarget.children().next().next().css('transform', 'rotate(0)')
    ;
});
