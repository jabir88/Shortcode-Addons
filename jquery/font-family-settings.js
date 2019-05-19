jQuery(document).ready(function () {
    jQuery('.oxi-font-family-delete').bind('click', function(e) {  
        e.preventDefault();
        var data = jQuery(this).attr('oxidatafont');
        jQuery("#oxi_addons_google_font").val(data);
        jQuery("#oxi-font-family-status").val('delete');
        jQuery('#oxi-addons-form-submit').submit();
    });
    jQuery('.oxi-font-family-saved').bind('click', function(e) {  
        e.preventDefault();
        jQuery('#oxi-addons-form-submit').submit();
    });
});