var tab, lasttab;
var defaultTab = '#profile-tab';
var direction = "rtl"; // Right To Left

//$('.tab').hide();
/*
function showTab(id) {
    id = id.replace("-tab", "");
    //window.location.hash = id;

    if (tab) {
        direction = (tab.attr('data-index') < $(id + "-tab").attr('data-index')) ? "rtl" : "ltr";
        lasttab = tab;
        lasttab.animate({
            'margin-left': (direction == "rtl") ? -0 - $(window).width() : -0 + $(window).width(),
            opacity: 1
        }, 1000, "easeInOutExpo", function () {
            $(this).hide();
        });

        if (tab.attr('id') == "team-tab") {
            $('#members-tab').animate({
                'margin-left': $(window).width(),
                opacity: 1
            }, 1000, "easeInOutExpo", function () {
                $(this).hide();
                $(this).unbind('click');
            });
        }
    }


    $('.nav').find('.current').removeClass('current');
    $('a[href="' + id + '"]').parent().addClass('current').prev().css('');

    tab = $(id + "-tab");
    tab.css({
        'margin-left': (direction == "rtl") ? -0 + $(window).width() : -0 - $(window).width(),
        opacity: 1
    }).show().animate({
        'margin-left': 0,
        opacity: 1
    }, 1000, "easeInOutExpo");

    if (id == "#team") {
        $('#members-tab').css({
            'margin-left': $(window).width()
        }).show().animate({
            'margin-left': 0
        }, 1000, "easeInOutExpo").find('.tab').show();

    }

    setFooterY();
}
*/
function setFooterY(h) {
    if(h == undefined || isNaN(h * 1)) {
        var tab = $('.tab');
        var h = tab.height() + 150 + 0;
    }
    /*if (tab.attr('id') == "team-tab") {
        $('#members-tab').height($('#members-tab').find('.page').height() + 0);
        h += $('#members-tab').height() - 0;
    }*/

    $('#content').height(h);
    //$('#vignettage').height(0 + h);
}

if ($('.nav').length > 0 && $('#news-page').length == 0) {
   /* $('.nav').on('click', 'a', function (e) {
        e.preventDefault();
        var clickedAnchor = $(e.target);
        if (!clickedAnchor.parent().hasClass('current')) {
            showTab(clickedAnchor.attr('href'));
        }

    });*/
    /*
    if (window.location.hash != "") {
        showTab(window.location.hash);
    } else {
        showTab(defaultTab);
    }
    */

    $(document).ready(function () {
        setTimeout(setFooterY, 500);
    });
}