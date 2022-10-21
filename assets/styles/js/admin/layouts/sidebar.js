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
let title = ".title";
let arrow = ".arrow";
let item = ".dropdown-item";

$(sidebar).on("mouseover", function () {
    if (
        $(wrapper).hasClass("true-collapse") && $(wrapper).width() > 1439
        || !$(wrapper).hasClass("true-collapse") && $(wrapper).width() < 1439 && $(wrapper).width() > 992
    ) {
        $(sidebar).css("width", "280px");
        $(title).css("display", "inline-block");
        $(arrow).css("opacity", 1);
        $(item).css("display", "block")
    }
})

$(sidebar).on("mouseleave", function () {
    if (
        $(wrapper).hasClass("true-collapse") && $(wrapper).width() > 1439
        || !$(wrapper).hasClass("true-collapse") && $(wrapper).width() < 1439 && $(wrapper).width() > 992
    ) {
        $(sidebar).removeAttr("style");
        $(title).removeAttr("style");
        $(arrow).removeAttr("style");
        $(item).removeAttr("style")
    }
})

// $(sidebar).on("mouseover", function () {
//     if (
//         $(wrapper).hasClass("true-collapse") && $(wrapper).width() > 991
//         || $(wrapper).width() < 1439 && $(wrapper).width() > 992
//     ) {
//         $(sidebar).css("width", "280px");
//         $(title).css("display", "inline-block");
//         $(arrow).css("opacity", 1);
//         if ($(".nav-item").hasClass("active")) {
//             console.log('ok')
//             $(".active").children().next().css("display", "inline-block !important")
//         }
//     }
// })
//
// $(sidebar).on("mouseleave", function () {
//     if (
//         $(wrapper).hasClass("true-collapse") && $(wrapper).width() > 991
//         || $(wrapper).width() < 1439 && $(wrapper).width() > 992
//     ) {
//         $(sidebar).removeAttr("style");
//         $(title).removeAttr("style");
//         $(arrow).removeAttr("style");
//     }
// })
