jQuery(function () {
    jQuery("#oxi-addons-form-rearrange-submit").submit(function (e) {
        var list_sortable = jQuery('#oxi-addons-list-rearrange').sortable('toArray').toString();
        var security = jQuery('#oxi-addons-admin-ajax-nonce').val();
        jQuery.post({
            url: OxiAddonsAdminajax.ajaxurl,
            beforeSend: function () {
                jQuery("#oxi-addons-list-rearrange-saving").slideDown();
                jQuery("#oxi-addons-list-rearrange").slideUp();
                jQuery("#oxi-addons-list-rearrange-close").slideUp();
                jQuery('#oxi-addons-list-rearrange-submit').val('Saving...');
            },
            data: {
                action: 'OxiAddonsAdminajaxData',
                list_order: list_sortable,
                security: security
            },
            success: function (data) {
                setTimeout(function () {
                    location.reload();
                }, 500);
            }
        });
        e.preventDefault();
        return false;
    });

    function OxiHomeReload(item) {
        if (item === 'testimonial') {
            setTimeout(function () {
                location.reload();
            }, 1500);
        }
    }

    if (jQuery('#OxiAddonsElementsData').length > 0) {
        var datawidth = 4;
        var security = jQuery('#oxi-addons-admin-ajax-nonce').val();
        var list_sortable = jQuery('#OxiAddonsElementsData').val();
        var addons = 'accordion,banner,button,carousel,content_boxes,count_down,counter,divider,drop_caps,event_widgets,food_menu,footer_info,headers,heading,icon,icon_boxes,icon_effects,image_boxes,info_banner,info_boxes,info_image_boxes,link_effects,logo_showcase,price_table,single_image,social_icons,spacer,team,text_blocks,testimonial';
        var addonsdata = addons.split(',');
        addonsdata.forEach(function (item, index) {
            setTimeout(function () {
                jQuery.post({
                    url: OxiAddonsAdminajax.ajaxurl,
                    data: {
                        action: 'OxiAddonsAdminajaxData',
                        list_order: list_sortable,
                        list_items: item,
                        security: security
                    },
                    beforeSend: function () {
                        jQuery('.oxi-addons-loading-wrap-content').html(item.replace("_", " ").replace("_", " ") + ' Downloading');
                    },
                    success: function (data) {
                        datawidth = datawidth + 3.30;
                        jQuery(".oxi-addons-pei-chart-wrap").css({width: datawidth + "%"}, 1500);
                        if (datawidth < 100) {
                            jQuery('.oxi-addons-loading-wrap-heading').html(Math.floor(datawidth) + "% Completed");
                        } else {
                            jQuery('.oxi-addons-loading-wrap-heading').html("Redirecting ...");
                        }
                        jQuery('.oxi-addons-loading-wrap-content').html(item.replace("_", " ").replace("_", " ") + ' Installing');
                        OxiHomeReload(data);
                    },
                    error: function (data) {
                        jQuery.post({
                            url: OxiAddonsAdminajax.ajaxurl,
                            data: {
                                action: 'OxiAddonsAdminajaxData',
                                list_order: list_sortable,
                                list_items: data,
                                security: security
                            },
                            beforeSend: function () {
                                jQuery('.oxi-addons-loading-wrap-content').html(data.replace("_", " ").replace("_", " ") + ' Downloading');
                            },
                            success: function (data) {
                                datawidth = datawidth + 3.30;
                                jQuery(".oxi-addons-pei-chart-wrap").css({width: datawidth + "%"}, 1500);
                                if (datawidth < 100) {
                                    jQuery('.oxi-addons-loading-wrap-heading').html(Math.floor(datawidth) + "% Completed");
                                } else {
                                    jQuery('.oxi-addons-loading-wrap-heading').html("Redirecting ...");
                                }
                                jQuery('.oxi-addons-loading-wrap-content').html(item.replace("_", " ").replace("_", " ") + ' Installing');
                                OxiHomeReload(data);
                            },
                        });
                    }

                });
            }, 5000 * (index + 1));
        });
        return true;
    }
    jQuery(".oxi-addons-shortcode-import-bottom .btn-outline-info.OxiElementsADD").on("click", function (e) {
        jQuery("html, body").animate({scrollTop: 0}, "slow");
        jQuery(this).parent().parent().addClass("delete-kormo-class-ta")
        var security = jQuery('#oxi-addons-admin-ajax-nonce').val();
        var list_sortable = "Installing Data";
        var dat = jQuery(this).attr("oxiaddonselements");
        var url = jQuery('#oxi-addons-admin-ajax-url').val();
        jQuery.post({
            url: OxiAddonsAdminajax.ajaxurl,
            beforeSend: function () {
                jQuery('<div class="oxi-addons-loading-wrap"> <div class="oxi-addons-pei-data"><div class="oxi-addons-loading-wrap-heading">Please Wait ..</div> <div class="oxi-addons-loading-wrap-content">' + dat.replace("_", " ").toLowerCase().replace(/\b[a-z]/g, function (letter) {
                    return letter.toUpperCase();
                }) + ' Installing</div> </div></div>').appendTo("#wpwrap");
            },
            data: {
                action: 'OxiAddonsAdminajaxData',
                list_order: list_sortable,
                security: security,
                list_items: dat,
            },
            success: function (data) {
                console.log(data);
                if (data === 'Problem 1') {
                    var status = confirm("Internet connection problem kindly try again?");
                    if (status == false) {
                        return false;
                    } else {
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }

                } else if (data === 'Problem 2') {
                    var status = confirm("Data Can't Store Kindly Contact to Author");
                    if (status == false) {
                        return false;
                    } else {
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }

                } else {
                    setTimeout(function () {
                        jQuery(".delete-kormo-class-ta").remove();
                        jQuery(".oxi-addons-loading-wrap").remove();
                        jQuery(".oxi-addons-elements-install-massage .oxi-addons-import-requirement-heading").html(data.replace("_", " ").toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        }) + " Install Successfully");
                        jQuery(".oxi-addons-elements-install-massage .oxi-addons-import-requirement-content").html('Thank you for using our Shortcode Addons. <a href="' + url + '&oxitype=' + data + '" >' + data.replace("_", " ").toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        }) + '</a> installed successfully, Now you can create  <a href="' + url + '&oxitype=' + data + '" >' + data.replace("_", " ").toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        }) + '</a> shortcode. You can Install others elements also.');
                        jQuery(".oxi-addons-elements-install-massage").slideDown();
                    }, 500);
                }
            }
        });
        e.preventDefault();
        return false;
    });
    jQuery(".oxi-addons-shortcode-import-bottom .btn-info.OxiElementsADD").on("click", function (e) {
        var security = jQuery('#oxi-addons-admin-ajax-nonce').val();
        var list_sortable = "Installing Data";
        var dat = jQuery(this).attr("oxiaddonselements");
        var url = jQuery('#oxi-addons-admin-ajax-url').val();
        jQuery.post({
            url: OxiAddonsAdminajax.ajaxurl,
            beforeSend: function () {
                jQuery('<div class="oxi-addons-loading-wrap"> <div class="oxi-addons-pei-data"><div class="oxi-addons-loading-wrap-heading">Please Wait ..</div> <div class="oxi-addons-loading-wrap-content">' + dat.replace("_", " ").toLowerCase().replace(/\b[a-z]/g, function (letter) {
                    return letter.toUpperCase();
                }) + ' Installing</div> </div></div>').appendTo("#wpwrap");
            },
            data: {
                action: 'OxiAddonsAdminajaxData',
                list_order: list_sortable,
                security: security,
                list_items: dat
            },
            success: function (data) {
                console.log(data);
                if (data === 'Problem 1') {
                    var status = confirm("Internet connection problem kindly try again?");
                    if (status == false) {
                        return false;
                    } else {
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }

                } else if (data === 'Problem 2') {
                    var status = confirm("Data Can't Store Kindly Contact to Author");
                    if (status == false) {
                        return false;
                    } else {
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }

                } else {
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }
            }
        });
        e.preventDefault();
        return false;
    });
});