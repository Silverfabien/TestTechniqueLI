$(document).on("click", ".btn-submenu", function (e) {
    let currentTarget = $(e.currentTarget);

    currentTarget.parent().toggleClass("active")
    currentTarget.next().toggle();

    currentTarget.parent().hasClass("active")
        ? currentTarget.children().next().next().css('transform', 'rotate(90deg)')
        : currentTarget.children().next().next().css('transform', 'rotate(0)')
    ;
});

let sidebar = ".sidebar";
let wrapper = ".wrapper";

$(sidebar).on("mouseover", function () {
    if ($(wrapper).hasClass("true-collapse")) {
        $(wrapper).removeClass("is-collapsed");
    }
})

$(sidebar).on("mouseleave", function () {
    if ($(wrapper).hasClass("true-collapse")) {
        $(wrapper).addClass("is-collapsed");
    }
})
