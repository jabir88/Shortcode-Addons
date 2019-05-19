
jQuery(document).ready(function ($) {
    var custom_uploader;
    jQuery('.oxi-addons-body-image-button').click(function (e) {
        var linkdata = jQuery(this).attr("oxiimage");
        jQuery('#oxi-addons-preview-data').prepend('<input type="hidden" id="oxi-addons-body-image-upload-hidden" value="' + linkdata + '" />');
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        custom_uploader.on('select', function () {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var lnkdata = jQuery("#oxi-addons-body-image-upload-hidden").val();
            jQuery(lnkdata).val(attachment.url);
        });
        custom_uploader.open();
    });
});
jQuery(document).ready(function ($) {
    var custom_uploader;
    jQuery('.oxi-addons-modal-image-button').click(function (e) {
        var linkdata = jQuery(this).attr("oxiimage");
        jQuery('#oxi-addons-preview-data').prepend('<input type="hidden" id="oxi-addons-body-image-upload-hidden" value="' + linkdata + '" />');
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        custom_uploader.on('select', function () {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var lnkdata = jQuery("#oxi-addons-body-image-upload-hidden").val();
            jQuery(lnkdata).val(attachment.url);
            jQuery("#oxi-addons-list-data-modal").css({
                "overflow-x": "hidden",
                "overflow-y": "auto"

            });
            jQuery("body").css({
                "overflow": "hidden"
            });
        });
        custom_uploader.open();
    });
});
jQuery('#oxi-addons-list-data-modal').on('hidden.bs.modal', function (e) {
    jQuery("body").css({
        "overflow": "auto"
    });
})