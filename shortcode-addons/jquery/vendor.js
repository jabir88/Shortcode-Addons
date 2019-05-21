jQuery(".oxi-addons-tabs-ul li:first").addClass("active");
jQuery(".oxi-addons-tabs-content-tabs:first").addClass("active");
jQuery(".oxi-addons-tabs-ul li").click(function () {
    jQuery(".oxi-addons-tabs-ul li").removeClass("active");
    jQuery(this).toggleClass("active");
    jQuery(".oxi-addons-tabs-content-tabs").removeClass("active");
    var activeTab = jQuery(this).attr("ref");
    jQuery(activeTab).addClass("active");
});
jQuery("#oxi-addons-setting-reload").click(function () {
    location.reload();
});
jQuery("#oxi-addons-style-1-create-new-item").on("click", function () {
    jQuery("#oxi-addons-style-1-create-modal").modal("show");
});
jQuery("#oxi-addons-list-data-modal-open").on("click", function () {
    jQuery("#oxi-addons-list-data-modal").modal("show");
});
jQuery(".oxi-addons-addons-style-create").on("click", function () {
    var data = jQuery(this).attr("addons-data");
    jQuery("#oxi-addons-data").val(jQuery("#" + data).val());
    jQuery("#oxistyleid").val("");
    jQuery("#oxi-addons-style-create-modal").modal("show");
});
jQuery(".OXIAddonsElementsDeleteSubmit").submit(function () {
    var status = confirm("Do you Want to Delete rhis Elements?");
    if (status == false) {
        return false;
    } else {
        return true;
    }
});
jQuery(".oxi-addons-addons-style-btn-warning").on("click", function () {
    var status = confirm("Do you Want to Deactive This Style?");
    if (status == false) {
        return false;
    } else {
        return true;
    }
});


jQuery('.oxi-addons-minicolor').each(function () {
    jQuery(this).minicolors({
        control: jQuery(this).attr('data-control') || 'hue',
        defaultValue: jQuery(this).attr('data-defaultValue') || '',
        format: jQuery(this).attr('data-format') || 'hex',
        keywords: jQuery(this).attr('data-keywords') || 'transparent' || 'initial' || 'inherit',
        inline: jQuery(this).attr('data-inline') === 'true',
        letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
        opacity: jQuery(this).attr('data-opacity'),
        position: jQuery(this).attr('data-position') || 'bottom left',
        swatches: jQuery(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
        change: function (value, opacity) {
            if (!value)
                return;
            if (opacity)
                value += ', ' + opacity;
            if (typeof console === 'object') {
                console.log(value);
            }
        },
        theme: 'bootstrap'
    });
});
function oxiequalHeight(group) {
    tallest = 0;
    group.each(function () {
        thisHeight = jQuery(this).height();
        if (thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}
setTimeout(function () {
    oxiequalHeight(jQuery(".oxiequalHeight"));
}, 500);
jQuery(".oxi-addons-style-clone").on("click", function () {
    var dataid = jQuery(this).attr('oxiaddonsdataid');
    jQuery('#oxistyleid').val(dataid);
    jQuery("#oxi-addons-style-create-modal").modal("show");
});
jQuery(".oxilab-alert-change").on("change", function () {
    var data = "<strong>" + jQuery(this).attr('oxilab-alert') + " </strong> will works after saved data";
    jQuery.bootstrapGrowl(data, {});
});
jQuery(".oxi-addons-minicolor").on("change", function () {
    var oxijsid = jQuery(this).attr('oxijsid');
    var oxijsname = jQuery(this).attr('oxijsname');
    if (jQuery(this).val() === '') {
        jQuery(this).val('transparent');
    }
    jQuery("<style type='text/css'>#oxi-addons-preview-data " + oxijsid + "{" + oxijsname + ": " + jQuery(this).val() + "; } </style>").appendTo("#oxi-addons-preview-data");
});

setTimeout(function () {
    jQuery("<style type='text/css'>#oxi-addons-preview-data{background: " + jQuery("#oxi-addons-preview-color").val() + "; } </style>").appendTo("#oxi-addons-preview-data");
}, 500);
oxiequalHeight(jQuery(".oxiaddonsoxiequalHeight"));

function oxiAddonsDTM(data, activemode) {
    if (data !== '') {
        jQuery('.addons-dtm-laptop').slideUp();
        jQuery('.addons-dtm-tab').slideUp();
        jQuery('.addons-dtm-mobile').slideUp();
        jQuery('.' + data).slideDown();
        jQuery(".oxiAddonsPadMar").each(function (index, value) {
            jQuery(this).attr('oxi-mode', activemode);
            var dataid = jQuery(this).attr("oxiAddonscheck");
            jQuery(this).removeClass("active").text('Easy');
            jQuery("." + dataid + "-laptop").slideUp();
            jQuery("." + dataid + "-tab").slideUp();
            jQuery("." + dataid + "-mobile").slideUp();
        });
        jQuery(".oxiAddonsTextShadow").each(function (index, value) {
            var dataid = jQuery(this).attr("oxiAddonscheck");
            jQuery("#" + dataid + "").removeAttr('disabled');
            jQuery(this).removeClass("active").text('Easy');
            jQuery("." + dataid + "-horizontal").slideUp();
            jQuery("." + dataid + "-vertical").slideUp();
            jQuery("." + dataid + "-blur-radius").slideUp();
            jQuery("." + dataid + "-color").slideUp();
        });
        if (data !== 'addons-dtm-laptop') {
            jQuery(".addons-dtm-laptop-lock *").css('pointer-events', 'none');
            jQuery(".addons-dtm-laptop-lock *").css('opacity', '0.7');
            jQuery(".addons-dtm-laptop-lock *").attr('disabled', 'disabled');
        } else {
            jQuery(".addons-dtm-laptop-lock *").css('pointer-events', 'auto');
            jQuery(".addons-dtm-laptop-lock *").css('opacity', '1');
            jQuery(".addons-dtm-laptop-lock *").removeAttr('disabled');
        }

    } else {
        jQuery(".oxilab-setting-save-dtm-mode:first").addClass("active");
        jQuery('.addons-dtm-laptop').slideDown();
        jQuery('.addons-dtm-tab').slideUp();
        jQuery('.addons-dtm-mobile').slideUp();
        jQuery(".oxiAddonsPadMar").each(function (index, value) {
            jQuery(this).attr('oxi-mode', 'laptop');
            var dataid = jQuery(this).attr("oxiAddonscheck");
            jQuery(this).removeClass("active").text('Easy');
            jQuery("." + dataid + "-laptop").slideUp();
            jQuery("." + dataid + "-tab").slideUp();
            jQuery("." + dataid + "-mobile").slideUp();
        });
        jQuery(".oxiAddonsTextShadow").each(function (index, value) {
            var dataid = jQuery(this).attr("oxiAddonscheck");
            jQuery(this).removeClass("active").text('Easy');
            jQuery("." + dataid + "-horizontal").slideUp();
            jQuery("." + dataid + "-vertical").slideUp();
            jQuery("." + dataid + "-blur-radius").slideUp();
            jQuery("." + dataid + "-color").slideUp();
        });
    }
}
oxiAddonsDTM('', '');
jQuery(".oxi-addons-material-icons").click(function () {
    if (jQuery(this).hasClass('active')) {
        return false;
    } else {
        jQuery(".oxi-addons-material-icons").removeClass("active");
        jQuery(this).toggleClass("active");
        var activeT = jQuery(this).attr("oxi-dtm");
        var activemode = jQuery(this).attr("oxi-mode");
        oxiAddonsDTM(activeT, activemode);
    }
});

jQuery('.oxiAddonsPadMar').click(function () {
    var datamode = jQuery(this).attr('oxi-mode');
    var dataid = jQuery(this).attr("oxiAddonscheck");
    if (jQuery(this).hasClass('active')) {
        jQuery(this).text('Easy');
        jQuery("#" + dataid + "-" + datamode).removeAttr('disabled');
        jQuery("." + dataid + "-" + datamode + "").slideUp();
    } else {
        jQuery(this).text('Advanced');
        jQuery("#" + dataid + "-" + datamode).attr('disabled', 'disabled');
        jQuery("." + dataid + "-" + datamode + "").slideDown();
    }
});


jQuery(".oxiAddonsPadMarJS").on("change", function () {
    var dataid = "#" + jQuery(this).attr('id');
    var value = jQuery(this).val();
    jQuery(dataid + "-top").val(value);
    jQuery(dataid + "-bottom").val(value);
    jQuery(dataid + "-left").val(value);
    jQuery(dataid + "-right").val(value);
});

jQuery('.oxiAddonsTextShadow').click(function () {
    var dataid = jQuery(this).attr("oxiAddonscheck");
    if (jQuery(this).hasClass('active')) {
        jQuery(this).text('Easy');
        jQuery("#" + dataid + "").removeAttr('disabled');
        jQuery("." + dataid + "-horizontal").slideUp();
        jQuery("." + dataid + "-vertical").slideUp();
        jQuery("." + dataid + "-blur-radius").slideUp();
        jQuery("." + dataid + "-color").slideUp();
    } else {
        jQuery(this).text('Advanced');
        jQuery("#" + dataid + "").attr('disabled', 'disabled');
        jQuery("." + dataid + "-horizontal").slideDown();
        jQuery("." + dataid + "-vertical").slideDown();
        jQuery("." + dataid + "-blur-radius").slideDown();
        jQuery("." + dataid + "-color").slideDown();
    }
});
jQuery(".oxiAddonsTextShadowparent").on("change", function () {
    var dataid = "#" + jQuery(this).attr('id');
    var value = jQuery(this).val();
    jQuery(dataid + "-blur-radius").val(value);
});
jQuery("#oxi-addons-form-submit").submit(function () {
    jQuery(".addons-dtm-laptop-lock *").css('pointer-events', 'auto');
    jQuery(".addons-dtm-laptop-lock *").css('opacity', '1');
    jQuery(".addons-dtm-laptop-lock *").removeAttr('disabled');
    jQuery("#oxi-addons-preview-BG").val(jQuery("#oxi-addons-preview-color").val());
    return true;
});

jQuery("[oxi-addons-tooltip]").hover(function () {
    jQuery('.oxi-addons-tooltip').remove();
    jQuery(this).css('position', 'relative');
    var $toolTiptext = jQuery(this).attr("oxi-addons-tooltip");
    jQuery(this).append("<div class='oxi-addons-tooltip'>" + $toolTiptext + "</div>");
}, function () {
    jQuery(this).css('position', '');
    jQuery('.oxi-addons-tooltip').remove();
});

jQuery('#oxi-addons-list-rearrange-modal-open').on('click', function () {
    jQuery("#oxi-addons-list-rearrange-modal").modal("show");
    jQuery("#oxi-addons-list-rearrange-saving").slideUp();
    jQuery("#oxi-addons-list-rearrange").slideDown();
    jQuery("#oxi-addons-list-rearrange-close").slideDown();
    jQuery('#oxi-addons-list-rearrange-submit').val('Submit');

});
setTimeout(function () {
    if (jQuery('#oxi-addons-list-rearrange').hasClass('list-group')) {
        jQuery('#oxi-addons-list-rearrange').sortable({
            axis: 'y',
            opacity: 0.7
        });
    }
}, 1000);
setTimeout(function () {
    if (jQuery("#oxi_addons_table_content").hasClass("list-group")) {
        jQuery('#oxi_addons_table_content').sortable({
            axis: 'y',
            opacity: 0.7,
            update: function (event, ui) {
                var list_sortable = jQuery(this).sortable('toArray').toString();
                jQuery("#OxiAddPR-TC-Serial").val(list_sortable);
            }
        });
    }
}, 1000);


function oxiAddonsAnimation(id, duration, delay) {
    if (jQuery(id).val() === "") {
        jQuery(duration).slideUp();
        jQuery(delay).slideUp();
    } else {
        jQuery(duration).slideDown();
        jQuery(delay).slideDown();
    }
}
jQuery('.oxiadminnumberdtmparent').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("id");
    jQuery('#' + id + '-tab').val(value);
    jQuery('#' + id + '-mobile').val(value);
});
jQuery('.oxiadminpaddinsparent').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("name");
    jQuery('#' + id + '-tab').val(value);
    jQuery('#' + id + '-mobile').val(value);
    jQuery('#' + id + '-laptop-top').val(value);
    jQuery('#' + id + '-laptop-bottom').val(value);
    jQuery('#' + id + '-laptop-left').val(value);
    jQuery('#' + id + '-laptop-right').val(value);
    jQuery('#' + id + '-tab-top').val(value);
    jQuery('#' + id + '-tab-bottom').val(value);
    jQuery('#' + id + '-tab-left').val(value);
    jQuery('#' + id + '-tab-right').val(value);
    jQuery('#' + id + '-mobile-top').val(value);
    jQuery('#' + id + '-mobile-bottom').val(value);
    jQuery('#' + id + '-mobile-left').val(value);
    jQuery('#' + id + '-mobile-right').val(value);
});
jQuery('.oxi-addons-content-div').each(function () {
    var minNumber = 1;
    var maxNumber = 10000000;
    var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber);
    var number = randomnumber;
    var version = "";
    jQuery(this).find('.form-group.row').each(function () {
        if (jQuery(this).hasClass("oxi-addons-admin-lite-version")) {
            version = 'yes';
        }
    });
    if (version === "yes") {
        jQuery("<div class='form-group form-check'> <input type='checkbox' class='form-check-input OxiAddonsADMLiteCheckbox' id='OxiAddonsADMLiteCheckbox-" + number + "'> <label class='form-check-label' for='OxiAddonsADMLiteCheckbox-" + number + "'>Lite</label></div>").appendTo(jQuery(this).find('.oxi-head'));
    }
});
jQuery('.OxiAddonsADMLiteCheckbox').change(function () {
    if (jQuery(this).prop('checked')) {
        jQuery(this).parent().parent().next().children('.oxi-addons-admin-lite-version').slideUp();
    } else {
        jQuery(this).parent().parent().next().children('.oxi-addons-admin-lite-version').slideDown();
    }
});
jQuery('.oxi-addons-family').change(function () {
    var font = jQuery(this).val().replace(/\+/g, ' ');
    font = font.split(':');
    var id = jQuery(this).attr("oxiexport");
    jQuery("<style type='text/css'>#oxi-addons-preview-data " + id + "{font-family: " + font[0] + "; } </style>").appendTo("#oxi-addons-preview-data");
});
jQuery('.oxi-addons-font-weight').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery("<style type='text/css'>#oxi-addons-preview-data " + id + "{font-weight: " + value + "; } </style>").appendTo("#oxi-addons-preview-data");
});
jQuery('.oxi-addons-font-style').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery("<style type='text/css'>#oxi-addons-preview-data " + id + "{font-style: " + value + "; } </style>").appendTo("#oxi-addons-preview-data");
});
jQuery('.oxi-addons-text-align').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery("<style type='text/css'>#oxi-addons-preview-data " + id + "{text-align: " + value + "; } </style>").appendTo("#oxi-addons-preview-data");
});
jQuery('.oxi-addons-amimation-data').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery(id).removeClass("bounce");
    jQuery(id).removeClass("flash");
    jQuery(id).removeClass("pulse");
    jQuery(id).removeClass("rubberBand");
    jQuery(id).removeClass("shake");
    jQuery(id).removeClass("swing");
    jQuery(id).removeClass("tada");
    jQuery(id).removeClass("wobble");
    jQuery(id).removeClass("jello");
    jQuery(id).removeClass("bounceIn");
    jQuery(id).removeClass("bounceInDown");
    jQuery(id).removeClass("bounceInLeft");
    jQuery(id).removeClass("bounceInRight");
    jQuery(id).removeClass("bounceInUp");
    jQuery(id).removeClass("fadeIn");
    jQuery(id).removeClass("fadeInDown");
    jQuery(id).removeClass("fadeInDownBig");
    jQuery(id).removeClass("fadeInLeft");
    jQuery(id).removeClass("fadeInLeftBig");
    jQuery(id).removeClass("fadeInRight");
    jQuery(id).removeClass("fadeInRightBig");
    jQuery(id).removeClass("fadeInUp");
    jQuery(id).removeClass("fadeInUpBig");
    jQuery(id).removeClass("fadeOut");
    jQuery(id).removeClass("fadeOutDown");
    jQuery(id).removeClass("fadeOutDownBig");
    jQuery(id).removeClass("fadeOutLeft");
    jQuery(id).removeClass("fadeOutLeftBig");
    jQuery(id).removeClass("fadeOutRight");
    jQuery(id).removeClass("fadeOutRightBig");
    jQuery(id).removeClass("fadeOutUp");
    jQuery(id).removeClass("fadeOutUpBig");
    jQuery(id).removeClass("flip");
    jQuery(id).removeClass("flipInX");
    jQuery(id).removeClass("flipInY");
    jQuery(id).removeClass("flipOutX");
    jQuery(id).removeClass("flipOutY");
    jQuery(id).removeClass("lightSpeedIn");
    jQuery(id).removeClass("lightSpeedOut");
    jQuery(id).removeClass("rotateIn");
    jQuery(id).removeClass("rotateInDownLeft");
    jQuery(id).removeClass("rotateInDownRight");
    jQuery(id).removeClass("rotateInUpLeft");
    jQuery(id).removeClass("rotateInUpRight");
    jQuery(id).removeClass("slideInUp");
    jQuery(id).removeClass("slideInDown");
    jQuery(id).removeClass("slideInLeft");
    jQuery(id).removeClass("slideInRight");
    jQuery(id).removeClass("zoomIn");
    jQuery(id).removeClass("zoomInDown");
    jQuery(id).removeClass("zoomInLeft");
    jQuery(id).removeClass("zoomInRight");
    jQuery(id).removeClass("zoomInUp");
    jQuery(id).removeClass("hinge");
    jQuery(id).removeClass("jackInTheBox");
    jQuery(id).removeClass("rollIn");
    jQuery(id).removeClass("oxi-addons-visible");
    jQuery(id).attr('oxi-addons-animation', value);
    jQuery('.oxi-addons-animation').oxiAddonsAniView();
});
jQuery('.oxi-addons-amimation-duration').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery(id).attr('oxi-addons-duration', value);
    jQuery(id).css("animation-duration:", "");
    jQuery(id).css("transition:", "");
    jQuery(id).removeClass("bounce");
    jQuery(id).removeClass("flash");
    jQuery(id).removeClass("pulse");
    jQuery(id).removeClass("rubberBand");
    jQuery(id).removeClass("shake");
    jQuery(id).removeClass("swing");
    jQuery(id).removeClass("tada");
    jQuery(id).removeClass("wobble");
    jQuery(id).removeClass("jello");
    jQuery(id).removeClass("bounceIn");
    jQuery(id).removeClass("bounceInDown");
    jQuery(id).removeClass("bounceInLeft");
    jQuery(id).removeClass("bounceInRight");
    jQuery(id).removeClass("bounceInUp");
    jQuery(id).removeClass("fadeIn");
    jQuery(id).removeClass("fadeInDown");
    jQuery(id).removeClass("fadeInDownBig");
    jQuery(id).removeClass("fadeInLeft");
    jQuery(id).removeClass("fadeInLeftBig");
    jQuery(id).removeClass("fadeInRight");
    jQuery(id).removeClass("fadeInRightBig");
    jQuery(id).removeClass("fadeInUp");
    jQuery(id).removeClass("fadeInUpBig");
    jQuery(id).removeClass("fadeOut");
    jQuery(id).removeClass("fadeOutDown");
    jQuery(id).removeClass("fadeOutDownBig");
    jQuery(id).removeClass("fadeOutLeft");
    jQuery(id).removeClass("fadeOutLeftBig");
    jQuery(id).removeClass("fadeOutRight");
    jQuery(id).removeClass("fadeOutRightBig");
    jQuery(id).removeClass("fadeOutUp");
    jQuery(id).removeClass("fadeOutUpBig");
    jQuery(id).removeClass("flip");
    jQuery(id).removeClass("flipInX");
    jQuery(id).removeClass("flipInY");
    jQuery(id).removeClass("flipOutX");
    jQuery(id).removeClass("flipOutY");
    jQuery(id).removeClass("lightSpeedIn");
    jQuery(id).removeClass("lightSpeedOut");
    jQuery(id).removeClass("rotateIn");
    jQuery(id).removeClass("rotateInDownLeft");
    jQuery(id).removeClass("rotateInDownRight");
    jQuery(id).removeClass("rotateInUpLeft");
    jQuery(id).removeClass("rotateInUpRight");
    jQuery(id).removeClass("slideInUp");
    jQuery(id).removeClass("slideInDown");
    jQuery(id).removeClass("slideInLeft");
    jQuery(id).removeClass("slideInRight");
    jQuery(id).removeClass("zoomIn");
    jQuery(id).removeClass("zoomInDown");
    jQuery(id).removeClass("zoomInLeft");
    jQuery(id).removeClass("zoomInRight");
    jQuery(id).removeClass("zoomInUp");
    jQuery(id).removeClass("hinge");
    jQuery(id).removeClass("jackInTheBox");
    jQuery(id).removeClass("rollIn");
    jQuery(id).removeClass("oxi-addons-visible");
    jQuery('.oxi-addons-animation').oxiAddonsAniView();

});
jQuery('.oxi-addons-amimation-delay').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery(id).attr('oxi-addons-delay', value);
    jQuery(id).css("animation-duration:", "");
    jQuery(id).css("transition:", "");
    jQuery(id).removeClass("bounce");
    jQuery(id).removeClass("flash");
    jQuery(id).removeClass("pulse");
    jQuery(id).removeClass("rubberBand");
    jQuery(id).removeClass("shake");
    jQuery(id).removeClass("swing");
    jQuery(id).removeClass("tada");
    jQuery(id).removeClass("wobble");
    jQuery(id).removeClass("jello");
    jQuery(id).removeClass("bounceIn");
    jQuery(id).removeClass("bounceInDown");
    jQuery(id).removeClass("bounceInLeft");
    jQuery(id).removeClass("bounceInRight");
    jQuery(id).removeClass("bounceInUp");
    jQuery(id).removeClass("fadeIn");
    jQuery(id).removeClass("fadeInDown");
    jQuery(id).removeClass("fadeInDownBig");
    jQuery(id).removeClass("fadeInLeft");
    jQuery(id).removeClass("fadeInLeftBig");
    jQuery(id).removeClass("fadeInRight");
    jQuery(id).removeClass("fadeInRightBig");
    jQuery(id).removeClass("fadeInUp");
    jQuery(id).removeClass("fadeInUpBig");
    jQuery(id).removeClass("fadeOut");
    jQuery(id).removeClass("fadeOutDown");
    jQuery(id).removeClass("fadeOutDownBig");
    jQuery(id).removeClass("fadeOutLeft");
    jQuery(id).removeClass("fadeOutLeftBig");
    jQuery(id).removeClass("fadeOutRight");
    jQuery(id).removeClass("fadeOutRightBig");
    jQuery(id).removeClass("fadeOutUp");
    jQuery(id).removeClass("fadeOutUpBig");
    jQuery(id).removeClass("flip");
    jQuery(id).removeClass("flipInX");
    jQuery(id).removeClass("flipInY");
    jQuery(id).removeClass("flipOutX");
    jQuery(id).removeClass("flipOutY");
    jQuery(id).removeClass("lightSpeedIn");
    jQuery(id).removeClass("lightSpeedOut");
    jQuery(id).removeClass("rotateIn");
    jQuery(id).removeClass("rotateInDownLeft");
    jQuery(id).removeClass("rotateInDownRight");
    jQuery(id).removeClass("rotateInUpLeft");
    jQuery(id).removeClass("rotateInUpRight");
    jQuery(id).removeClass("slideInUp");
    jQuery(id).removeClass("slideInDown");
    jQuery(id).removeClass("slideInLeft");
    jQuery(id).removeClass("slideInRight");
    jQuery(id).removeClass("zoomIn");
    jQuery(id).removeClass("zoomInDown");
    jQuery(id).removeClass("zoomInLeft");
    jQuery(id).removeClass("zoomInRight");
    jQuery(id).removeClass("zoomInUp");
    jQuery(id).removeClass("hinge");
    jQuery(id).removeClass("jackInTheBox");
    jQuery(id).removeClass("rollIn");
    jQuery(id).removeClass("oxi-addons-visible");
    jQuery('.oxi-addons-animation').oxiAddonsAniView();
});
jQuery('.OxiAddonsTransformPropertyData').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery(id).removeClass("oxi-addons-transform-left-to-right");
    jQuery(id).removeClass("oxi-addons-transform-right-to-left");
    jQuery(id).removeClass("oxi-addons-transform-top-to-bottom");
    jQuery(id).removeClass("oxi-addons-transform-bottom-to-top");
    jQuery(id).addClass(value);
});
jQuery('.oxi_addons_adm_help_border-size').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery('<style type="text/css">#oxi-addons-preview-data ' + id + ' {border-width:  ' + value + 'px;} </style>').appendTo("#oxi-addons-preview-data");
});
jQuery('.oxi_addons_adm_help_border-type').change(function () {
    var value = jQuery(this).val();
    var id = jQuery(this).attr("oxiexport");
    jQuery('<style type="text/css">#oxi-addons-preview-data ' + id + ' {border-type:  ' + value + '; } </style>').appendTo("#oxi-addons-preview-data");
});


jQuery('.oxi-addons-event-widgets-right-info').on('click', function () {
    if (jQuery(this).hasClass('oxi-active')) {
        jQuery(this).next('.oxi-addons-event-widgets-right-content').slideUp();
        jQuery(this).removeClass('oxi-active');
    } else {
        jQuery(this).next('.oxi-addons-event-widgets-right-content').slideDown();
        jQuery(this).addClass('oxi-active');
    }
});
if (jQuery(".table").hasClass("oxi_addons_table_data")) {
    setTimeout(function () {
        jQuery(".oxi_addons_table_data").DataTable({
             "aLengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]],
            "initComplete": function (settings, json) {
                jQuery(".oxi-addons-wrapper.table-responsive").css("opacity", "1").animate({height: jQuery(".oxi-addons-wrapper.table-responsive").get(0).scrollHeight}, 1000 );;
            }
        });
    }, 1500);
}
