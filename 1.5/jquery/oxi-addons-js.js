
function OxiAddonsAjaxDataProcess(styleid, func, file, phpfile, sentdata, callback) {
    var security = jQuery("#oxi_addons_ajax_nonce").val();
    jQuery.post({
        url: OxiAddonsAjaxRequest.ajaxurl,
        beforeSend: function () {
            sentdata;
        },
        data: {
            action: 'OxiAddonsAjaxRequestData',
            styleid: styleid,
            func: func,
            security: security,
            file: file,
            phpfile: phpfile
        },
        success: function (data) {
            callback(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}