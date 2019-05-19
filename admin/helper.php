<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();

/**
 * requirement page
 * will call functions to admin page 
 * 
 * 
 * admin page font awesome data with various font awesome version 
 * elements requirement page
 * will called at if import style not works with elements
 */
function oxi_addons_admin_font_awesome_upload($data) {
    $val = '';
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    $ftawversion = $faversion[0];
    $FONTDATA = array(
        'facebook' => array('fa fa-facebook', 'fab fa-facebook-f'),
        'twitter' => array('fa fa-twitter', 'fab fa-twitter'),
        'desktop' => array('fa fa-desktop', 'fas fa-desktop'),
        'tablet' => array('fa fa-tablet', 'fas fa-tablet-alt'),
        'mobile' => array('fa fa-mobile', 'fas fa-mobile-alt'),
        'youtube' => array('fa fa-youtube-play', 'fab fa-youtube'),
        'plus' => array('fa fa-plus-circle', 'fas fa-plus-circle'),
        'adjust' => array('fa fa-adjust', 'fas fa-adjust'),
        'fa-cog ' => array('fa fa-cog', 'fas fa-cog'),
        'fa-cog fa-spin' => array('fa fa-cog fa-spin', 'fas fa-cog fa-spin'),
        'fa-trash' => array('fa fa-trash', 'far fa-trash-alt'),
        'fa-exclamation-triangle' => array('fa fa-exclamation-triangle', 'fas fa-exclamation-triangle'),
        'fa-external-link' => array('fa fa-list-ul', 'fas fa-external-link-alt'),
        'fa-check-circle' => array('fa fa-check-circle', 'fas fa-check-circle'),
        'oxi-accordion' => array('fa fa-list-ul', 'fas fa-list-ul'),
        'oxi-banner' => array('fa fa-image', 'fas fa-image'),
        'oxi-button' => array('fa fa-money', 'fas fa-money-check'),
        'oxi-carousel' => array('', 'fas fa-sliders-h'),
        'oxi-catagory' => array('', 'fas fa-th-list'),
        'oxi-contact_form' => array('fa fa-forumbee', 'fas fa-file-contract'),
        'oxi-content_boxes' => array('fa fa-th-large', 'fas fa-th-large'),
        'oxi-count_down' => array('fa fa-clock', 'fas fa-clock'),
        'oxi-counter' => array('fa fa-calendar-check-o', 'fas fa-calendar-check'),
        'oxi-divider' => array('fa fa-deviantart', 'fab fa-deviantart'),
        'oxi-drop_caps' => array('fa fa-quinscape', 'fab fa-quinscape'),
        'oxi-event_widgets' => array('', 'fas fa-calendar'),
        'oxi-footer' => array('', 'fas fa-address-book'),
        'oxi-heading' => array('', 'fas fa-heading'),
        'oxi-icon' => array('', 'fas fa-location-arrow'),
        'oxi-icon_boxes' => array('', 'far fa-address-book'),
        'oxi-icon_effects' => array('', 'fas fa-baseball-ball'),
        'oxi-image_boxes' => array('', 'fas fa-file-image'),
        'oxi-info_banner' => array('', 'fas fa-archive'),
        'oxi-lightbox' => array('', 'fas fa-life-ring'),
        'oxi-link_effects' => array('', 'fas fa-link'),
        'oxi-product_boxes' => array('', 'fas fa-box-open'),
        'oxi-section_divider' => array('', 'fas fa-puzzle-piece'),
        'oxi-single_image' => array('', 'fas fa-file-image'),
        'oxi-social_icons' => array('', 'fas fa-share-square'),
        'oxi-spacer' => array('', 'fas fa-backspace'),
        'oxi-text_boxes' => array('', 'fas fa-text-width'),
    );
    if (array_key_exists("$data", $FONTDATA)) {
        if ($ftawversion == '4.7.0') {
            $val = $FONTDATA[$data][0];
        } else {
            $val = $FONTDATA[$data][1];
        }
    } else {
        if ($ftawversion == '4.7.0') {
            $val = 'fa fa-th-large';
        } else {
            $val = 'fas fa-th-large';
        }
    }
    return $val;
}

/**
 * font awesome data modify for admin page
 */
function oxi_addons_admin_font_awesome($data) {
    $dt = oxi_addons_admin_font_awesome_upload($data);
    $dt = oxi_addons_font_awesome($dt);
    return $dt;
}

/**
 * responsive browsers data icon
 * calling font awesome data only
 */
function oxi_addons_adm_browser_icon() {
    echo '<div class="oxi-addons-setting-save-dtm-mode">
                <div class="oxi-addons-material-icons active" oxi-dtm="addons-dtm-laptop">
                    ' . oxi_addons_font_awesome_svg('desktop-solid') . '
                </div>
                <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-tab">
                    ' . oxi_addons_font_awesome_svg('tablet-alt-solid') . '
                </div>
                <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-mobile">
                    ' . oxi_addons_font_awesome_svg('mobile-alt-solid') . '
                </div>
            </div>';
}

/**
 * responsive call class
 * will works at viewing data
 */
function OxiAddonsADMHelpItemPerRows($id = null, $styledata = null, $value = null, $control = null, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row <?php echo $controldata; ?>" >
        <label for="<?php echo $id; ?>-laptop" class="col-sm-6 control-label" oxi-addons-tooltip="How many Items you want to Show at Single Row">Item Per Rows</label>
        <div class="col-sm-6 addons-dtm-laptop">
            <select class="form-control" id="<?php echo $id; ?>-laptop" name="<?php echo $id; ?>-laptop">
                <option value="oxi-addons-lg-col-1" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-1') {
                    echo 'selected';
                }
                ?>>Single Item</option>
                <option value="oxi-addons-lg-col-2" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-2') {
                    echo 'selected';
                }
                ?>>2 Items</option>
                <option value="oxi-addons-lg-col-3" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-3') {
                    echo 'selected';
                }
                ?>>3 Items</option>
                <option value="oxi-addons-lg-col-4" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-4') {
                    echo 'selected';
                }
                ?>>4 Items</option>
                <option value="oxi-addons-lg-col-5" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-5') {
                    echo 'selected';
                }
                ?>>5 Items</option>
                <option value="oxi-addons-lg-col-6" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-6') {
                    echo 'selected';
                }
                ?>>6 Items</option>
                <option value="oxi-addons-lg-col-7" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-7') {
                    echo 'selected';
                }
                ?>>7 Items</option>
                <option value="oxi-addons-lg-col-8" <?php
                if ($styledata[$value] == 'oxi-addons-lg-col-8') {
                    echo 'selected';
                }
                ?>>8 Items</option>
            </select>
        </div>
        <div class="col-sm-6 addons-dtm-tab">
            <select class="form-control" id="<?php echo $id; ?>-tab" name="<?php echo $id; ?>-tab">
                <option value="oxi-addons-md-col-1" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-1') {
                    echo 'selected';
                }
                ?>>Single Item</option>
                <option value="oxi-addons-md-col-2" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-2') {
                    echo 'selected';
                }
                ?>>2 Items</option>
                <option value="oxi-addons-md-col-3" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-3') {
                    echo 'selected';
                }
                ?>>3 Items</option>
                <option value="oxi-addons-md-col-4" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-4') {
                    echo 'selected';
                }
                ?>>4 Items</option>
                <option value="oxi-addons-md-col-5" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-5') {
                    echo 'selected';
                }
                ?>>5 Items</option>
                <option value="oxi-addons-md-col-6" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-6') {
                    echo 'selected';
                }
                ?>>6 Items</option>
                <option value="oxi-addons-md-col-7" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-7') {
                    echo 'selected';
                }
                ?>>7 Items</option>
                <option value="oxi-addons-md-col-8" <?php
                if ($styledata[($value + 1)] == 'oxi-addons-md-col-8') {
                    echo 'selected';
                }
                ?>>8 Items</option>
            </select>
        </div>
        <div class="col-sm-6 addons-dtm-mobile">
            <select class="form-control" id="<?php echo $id; ?>-mobile" name="<?php echo $id; ?>-mobile">
                <option value="oxi-addons-xs-col-1" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-1') {
                    echo 'selected';
                }
                ?>>Single Item</option>
                <option value="oxi-addons-xs-col-2" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-2') {
                    echo 'selected';
                }
                ?>>2 Items</option>
                <option value="oxi-addons-xs-col-3" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-3') {
                    echo 'selected';
                }
                ?>>3 Items</option>
                <option value="oxi-addons-xs-col-4" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-4') {
                    echo 'selected';
                }
                ?>>4 Items</option>
                <option value="oxi-addons-xs-col-5" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-5') {
                    echo 'selected';
                }
                ?>>5 Items</option>
                <option value="oxi-addons-xs-col-6" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-6') {
                    echo 'selected';
                }
                ?>>6 Items</option>
                <option value="oxi-addons-xs-col-7" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-7') {
                    echo 'selected';
                }
                ?>>7 Items</option>
                <option value="oxi-addons-xs-col-8" <?php
                if ($styledata[($value + 2)] == 'oxi-addons-xs-col-8') {
                    echo 'selected';
                }
                ?>>8 Items</option>

            </select>
        </div>
    </div>
    <?php
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '-laptop").on("change", function () {
                        var value = jQuery(this).val(); 
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-1");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-2");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-3");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-4");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-5");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-6");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-7");
                        jQuery("' . $export . '").removeClass("oxi-addons-lg-col-8");
                        jQuery("' . $export . '").addClass(value);
                    });
                    jQuery("#' . $id . '-tab").on("change", function () {
                        var value = jQuery(this).val(); 
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-1");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-2");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-3");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-4");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-5");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-6");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-7");
                        jQuery("' . $export . '").removeClass("oxi-addons-md-col-8");
                        jQuery("' . $export . '").addClass(value);
                    });
                    jQuery("#' . $id . '-mobile").on("change", function () {
                        var value = jQuery(this).val(); 
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-1");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-2");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-3");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-4");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-5");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-6");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-7");
                        jQuery("' . $export . '").removeClass("oxi-addons-xs-col-8");
                        jQuery("' . $export . '").addClass(value);
                    });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * date picker function
 * works at layouts page to select date and time
 */
function oxi_addons_adm_help_date_picker($id = null, $value = null, $styledata = null, $control = null, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-date" class="col-sm-6 control-label" oxi-addons-tooltip="Set Your Custom Date" >Date </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input type="date" class="form-control " id="<?php echo $id; ?>-date" name="<?php echo $id; ?>-date" value="<?php echo $styledata[$value]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-time" class="col-sm-6 control-label" oxi-addons-tooltip="Set Your Custom Time">Time </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input type="time" class="form-control " id="<?php echo $id; ?>-time" name="<?php echo $id; ?>-time" value="<?php echo $styledata[($value + 2)]; ?>">
        </div>
    </div>
    <?php
}

/**
 * data serialize function
 * works at layouts page to serialize
 */
function OxiAddonsADMHelpDataSerialize($data) {
    ?>
    <div class="list-group" id="oxi_addons_table_content">
        <?php
        $serialize = explode(',', $data);
        foreach ($serialize as $value) {
            echo '<a href="#" class="list-group-item list-group-item-action" id="' . $value . '">' . oxi_addons_shortcode_name_converter($value) . '</a>';
        }
        ?>
    </div>
    <input type="hidden" name="OxiAddPR-TC-Serial" id="OxiAddPR-TC-Serial" value="<?php echo $data; ?>">
    <?php
}

/**
 * text number selector
 * works at layouts page to adding single number
 */
function oxi_addons_adm_help_number($id = null, $value = null, $step = null, $name = null, $title = null, $control = null, $export = null, $exname = null, $numbertype = 'px', $lowestvalue = - 10000, $highestvalue = 10000) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input type="number" class="form-control " min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>"  step="<?php echo $step; ?>"id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>">
        </div>
    </div>
    <?php
    if (!empty($export) && !empty($exname)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                    jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + jQuery(this).val() + \'' . $numbertype . '; } </style>\').appendTo("#oxi-addons-preview-data");
                });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * double number selector
 * works at layouts page to adding double number
 */
function oxi_addons_adm_help_number_double($id = null, $value = null, $id2 = null, $value2 = null, $step = null, $name = null, $title = null, $control = 'true', $export1st = null, $exname1st = null, $export2nd = null, $exname2nd = null, $numbertype = 'px', $lowestvalue = - 10000, $highestvalue = 10000) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <input type="number" class="form-control" min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>"  step="<?php echo $step; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <input type="number" class="form-control" min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>"  step="<?php echo $step; ?>" id="<?php echo $id2; ?>" name="<?php echo $id2; ?>" value="<?php echo $value2; ?>">
        </div>
    </div>
    <?php
    $jquery = '';
    if (!empty($export1st) && !empty($exname1st)) {
        $jquery .= 'jQuery("#' . $id . '").on("change", function () {
                    jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export1st . '{' . $exname1st . ': \' + jQuery(this).val() + \'' . $numbertype . '; } </style>\').appendTo("#oxi-addons-preview-data");
                });';
    }
    if (!empty($export2nd) && !empty($exname2nd)) {
        $jquery .= 'jQuery("#' . $id2 . '").on("change", function () {
                    jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export2nd . '{' . $exname2nd . ': \' + jQuery(this).val() + \'' . $numbertype . '; } </style>\').appendTo("#oxi-addons-preview-data");
                });';
    }
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

/**
 * single number selector with media query
 * works at layouts page to adding single number with responsive value
 */
function oxi_addons_adm_help_number_dtm($id = null, $laptop = null, $tab = null, $mobile = null, $step = null, $name = null, $title = null, $control = true, $export = null, $exname = null, $numbertype = 'px', $lowestvalue = - 10000, $highestvalue = 10000) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop">
            <input type="number" class="form-control oxiadminnumberdtmparent"  min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>" step="<?php echo $step; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $laptop; ?>">
        </div>
        <div class="col-sm-6 addons-dtm-tab">
            <input type="number" class="form-control"  min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>" step="<?php echo $step; ?>" id="<?php echo $id; ?>-tab" name="<?php echo $id; ?>-tab" value="<?php echo $tab; ?>">
        </div>
        <div class="col-sm-6 addons-dtm-mobile">
            <input type="number" class="form-control" min="<?php echo $lowestvalue; ?>" max="<?php echo $highestvalue; ?>"  step="<?php echo $step; ?>" id="<?php echo $id; ?>-mobile" name="<?php echo $id; ?>-mobile" value="<?php echo $mobile; ?>">
        </div>        
    </div>
    <?php
    if (!empty($export) && !empty($exname)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + jQuery(this).val() + \'' . $numbertype . '; } </style>\').appendTo("#oxi-addons-preview-data");
                     });
                     jQuery("#' . $id . '-tab").on("change", function () {
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + jQuery(this).val() + \'' . $numbertype . '; }} </style>\').appendTo("#oxi-addons-preview-data");
                     });
                     jQuery("#' . $id . '-mobile").on("change", function () {
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + jQuery(this).val() + \'' . $numbertype . '; }} </style>\').appendTo("#oxi-addons-preview-data");
                     });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * double number selector with media query
 * works at layouts page to adding double number with responsive value
 */
function oxi_addons_adm_help_number_double_dtm($id = null, $laptop = null, $tab = null, $mobile = null, $id2 = null, $laptop2 = null, $tab2 = null, $mobile2 = null, $step = null, $name = null, $title = null, $control = 'true', $export = null, $exname = null, $numbertype = 'px') {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-3 addons-dtm-laptop">
            <input type="number" class="form-control oxiadminnumberdtmparent" step="<?php echo $step; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $laptop; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop">
            <input type="number" class="form-control oxiadminnumberdtmparent" step="<?php echo $step; ?>" id="<?php echo $id2; ?>" name="<?php echo $id2; ?>" value="<?php echo $laptop2; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-tab">
            <input type="number" class="form-control" step="<?php echo $step; ?>" id="<?php echo $id; ?>-tab" name="<?php echo $id; ?>-tab" value="<?php echo $tab; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-tab">
            <input type="number" class="form-control" step="<?php echo $step; ?>" id="<?php echo $id2; ?>-tab" name="<?php echo $id2; ?>-tab" value="<?php echo $tab2; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-mobile">
            <input type="number" class="form-control" step="<?php echo $step; ?>" id="<?php echo $id; ?>-mobile" name="<?php echo $id; ?>-mobile" value="<?php echo $mobile; ?>">
        </div>  
        <div class="col-sm-3 addons-dtm-mobile">
            <input type="number" class="form-control"step="<?php echo $step; ?>" id="<?php echo $id2; ?>-mobile" name="<?php echo $id2; ?>-mobile" value="<?php echo $mobile2; ?>">
        </div>  
    </div>
    <?php
    if (!empty($export) && !empty($exname)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                        var value1 = jQuery("#' . $id . '").val();
                        var value2 = jQuery("#' . $id2 . '").val();
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; } </style>\').appendTo("#oxi-addons-preview-data");
                    });
                    jQuery("#' . $id2 . '").on("change", function () {
                        var value1 = jQuery("#' . $id . '").val();
                        var value2 = jQuery("#' . $id2 . '").val();
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; } </style>\').appendTo("#oxi-addons-preview-data");
                    });
                    jQuery("#' . $id . '-tab").on("change", function () {
                        var value1 = jQuery("#' . $id . '-tab").val();
                        var value2 = jQuery("#' . $id2 . '-tab").val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; }} </style>\').appendTo("#oxi-addons-preview-data");
                    });
                    jQuery("#' . $id2 . '-tab").on("change", function () {
                        var value1 = jQuery("#' . $id . '-tab").val();
                        var value2 = jQuery("#' . $id2 . '-tab").val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; }} </style>\').appendTo("#oxi-addons-preview-data");
                    });
                    jQuery("#' . $id . '-mobile").on("change", function () {
                        var value1 = jQuery("#' . $id . '-mobile").val();
                        var value2 = jQuery("#' . $id2 . '-mobile").val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; }} </style>\').appendTo("#oxi-addons-preview-data");
                    });
                    jQuery("#' . $id2 . '-mobile").on("change", function () {
                        var value1 = jQuery("#' . $id . '-mobile").val();
                        var value2 = jQuery("#' . $id2 . '-mobile").val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value1 + \'' . $numbertype . '  \' + value2 + \'' . $numbertype . ';; }} </style>\').appendTo("#oxi-addons-preview-data");
                    });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * padding, margin selector with media query
 * works at layouts page to adding padding, margin with responsive value
 */
function oxi_addons_adm_help_padding_margin($id = null, $fristnumber = null, $styledata = null, $step = null, $name = null, $title = null, $control = 'true', $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary oxiAddonsPadMar" oxiAddonscheck="<?php echo $id; ?>" oxi-mode="">Easy</label>
                </div>
            </div>
            <input type="number" class="form-control addons-dtm-laptop oxiAddonsPadMarJS oxiadminpaddinsparent" step="1" id="<?php echo $id; ?>-laptop" name="<?php echo $id; ?>" value="<?php echo $styledata[($fristnumber)]; ?>">
            <input type="number" class="form-control addons-dtm-tab oxiAddonsPadMarJS" step="1" id="<?php echo $id; ?>-tab" name="<?php echo $id; ?>-tab" value="<?php echo $styledata[($fristnumber + 1)]; ?>">
            <input type="number" class="form-control addons-dtm-mobile oxiAddonsPadMarJS" step="1" id="<?php echo $id; ?>-mobile" name="<?php echo $id; ?>-mobile" value="<?php echo $styledata[($fristnumber + 2)]; ?>">
        </div>
    </div>

    <div class=" form-group row <?php echo $id; ?>-laptop">
        <label for="<?php echo $id; ?>-top" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Top</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-laptop-top" name="<?php echo $id; ?>-laptop-top" value="<?php echo $styledata[($fristnumber)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-laptop">
        <label for="<?php echo $id; ?>-bottom" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Bottom</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-laptop-bottom" name="<?php echo $id; ?>-laptop-bottom" value="<?php echo $styledata[($fristnumber + 4)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-laptop">
        <label for="<?php echo $id; ?>-left" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Left</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-laptop-left" name="<?php echo $id; ?>-laptop-left" value="<?php echo $styledata[($fristnumber + 8)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-laptop">
        <label for="<?php echo $id; ?>-right" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Right</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-laptop-right" name="<?php echo $id; ?>-laptop-right" value="<?php echo $styledata[($fristnumber + 12)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-tab">
        <label for="<?php echo $id; ?>-tab-top" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Top</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-tab-top" name="<?php echo $id; ?>-tab-top" value="<?php echo $styledata[($fristnumber + 1)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-tab">
        <label for="<?php echo $id; ?>-tab-bottom" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Bottom</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-tab-bottom" name="<?php echo $id; ?>-tab-bottom" value="<?php echo $styledata[($fristnumber + 5)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-tab">
        <label for="<?php echo $id; ?>-tab-left" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Left</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-tab-left" name="<?php echo $id; ?>-tab-left" value="<?php echo $styledata[($fristnumber + 9)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-tab">
        <label for="<?php echo $id; ?>-tab-right" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Right</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-tab-right" name="<?php echo $id; ?>-tab-right" value="<?php echo $styledata[($fristnumber + 13)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-mobile">
        <label for="<?php echo $id; ?>-mobile-top" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Top</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-mobile-top" name="<?php echo $id; ?>-mobile-top" value="<?php echo $styledata[($fristnumber + 2)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-mobile">
        <label for="<?php echo $id; ?>-mobile-bottom" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Bottom</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-mobile-bottom" name="<?php echo $id; ?>-mobile-bottom" value="<?php echo $styledata[($fristnumber + 6)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-mobile">
        <label for="<?php echo $id; ?>-mobile-left" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Left</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-mobile-left" name="<?php echo $id; ?>-mobile-left" value="<?php echo $styledata[($fristnumber + 10)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-mobile">
        <label for="<?php echo $id; ?>-mobile-right" class="col-sm-6 control-label" data-toggle-oxi="tooltip" data-placement="top"><?php echo $name; ?> Right</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-mobile-right" name="<?php echo $id; ?>-mobile-right" value="<?php echo $styledata[($fristnumber + 14)]; ?>">
        </div>
    </div>    
    <?php
    $jquery = 'jQuery("#' . $id . '-laptop-top").change(function () {
                    var value = jQuery(this).val();
                    jQuery("#' . $id . '-tab-top").val(value);
                    jQuery("#' . $id . '-mobile-top").val(value);
                });
                jQuery("#' . $id . '-laptop-bottom").change(function () {
                    var value = jQuery(this).val();
                    jQuery("#' . $id . '-tab-bottom").val(value);
                    jQuery("#' . $id . '-mobile-bottom").val(value);
                });
                jQuery("#' . $id . '-laptop-left").change(function () {
                    var value = jQuery(this).val();
                    jQuery("#' . $id . '-tab-left").val(value);
                    jQuery("#' . $id . '-mobile-left").val(value);
                });
                jQuery("#' . $id . '-laptop-right").change(function () {
                    var value = jQuery(this).val();
                    jQuery("#' . $id . '-tab-right").val(value);
                    jQuery("#' . $id . '-mobile-right").val(value);
                });';
    if (!empty($export) && !empty($exname) && strtolower($exname) == 'border-width') {
        $jquery .= 'jQuery("#' . $id . '-laptop").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-top").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-top: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-bottom").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-bottom: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-left").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-left: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-right").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-right: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-top: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-bottom: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-left: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-right: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-top: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-bottom: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-left: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-right: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   ';
    } elseif (!empty($export) && !empty($exname) && strtolower($exname) == 'border-radius') {
        $jquery .= 'jQuery("#' . $id . '-laptop").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-top").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-top-left-radius: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-bottom").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-bottom-right-radius: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-left").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-bottom-left-radius: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-right").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-top-right-radius: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-top-left-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-bottom-right-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-bottom-left-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{border-top-right-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-top-left-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-bottom-right-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-bottom-left-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{border-top-right-radius: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   ';
    } elseif (!empty($export) && !empty($exname)) {
        $jquery .= 'jQuery("#' . $id . '-laptop").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . ': \' + value + \'px  \' + value + \'px \' + value + \'px  \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-top").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . '-top: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-bottom").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . '-bottom: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-left").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . '-left: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-laptop-right").on("change", function () {
                        var value = jQuery(this).val();
                       jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . '-right: \' + value + \'px; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-top: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-bottom: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-left: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-tab-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (min-width : 669px) and (max-width : 993px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-right: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-top").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-top: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-bottom").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-bottom: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-left").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-left: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-mobile-right").on("change", function () {
                        var value = jQuery(this).val();
                        jQuery(\'<style type="text/css">@media only screen and (max-width : 668px){#oxi-addons-preview-data ' . $export . '{' . $exname . '-right: \' + value + \'px; }} </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   ';
    }
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

/**
 * box shadow selector
 * works at layouts page to adding box shadow with responsive value
 */
function OxiAddonsADMhelpBoxShadow($id = null, $fristnumber = null, $styledata = null, $control = 'true', $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    echo '<div class="form-group row">
                <label for="' . $id . '-color" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Box Shadow Color" >Box Shadow</label>
                <div class="col-sm-6 addons-dtm-laptop-lock">
                    <input type="text" data-format="rgb" data-opacity="true" class="form-control oxi-addons-minicolor oxi-addons-CF-data" id="' . $id . '-color" name="' . $id . '-color" value="' . $styledata[$fristnumber] . '">
                </div>
        </div>  
        <div class="form-group row ' . $controldata . '">
          <label for="' . $id . '-horizontal" class="col-sm-6 control-label" oxi-addons-tooltip="Box Shadow Lenth as horizontal and vertical" >Shadow length</label>
                <div class="col-sm-3 addons-dtm-laptop-lock">
                   <input type="number" class="form-control " step="1" id="' . $id . '-horizontal" name="' . $id . '-horizontal" value="' . $styledata[($fristnumber + 1)] . '">
                </div>
                <div class="col-sm-3 addons-dtm-laptop-lock">
                    <input type="number" class="form-control " step="1" id="' . $id . '-vertical" name="' . $id . '-vertical" value="' . $styledata[($fristnumber + 2)] . '">
                </div> 
        </div>
        <div class="form-group row ' . $controldata . '">
                <label for="' . $id . '-blur" class="col-sm-6 control-label" oxi-addons-tooltip="Box Shadow Radius as Blur and Spread" >Blur and Spread</label>
                <div class="col-sm-3 addons-dtm-laptop-lock">
                   <input type="number" class="form-control " step="1" id="' . $id . '-blur" name="' . $id . '-blur" value="' . $styledata[($fristnumber + 3)] . '">
                </div>
              <div class="col-sm-3 addons-dtm-laptop-lock">
                  <input type="number" class="form-control " step="1" id="' . $id . '-spread" name="' . $id . '-spread" value="' . $styledata[($fristnumber + 4)] . '">
              </div>
        </div>';
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '-color").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var horizontal = jQuery("#' . $id . '-horizontal").val();
                     var vertical = jQuery("#' . $id . '-vertical").val();
                     var blur = jQuery("#' . $id . '-blur").val();
                     var spread = jQuery("#' . $id . '-spread").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + horizontal + \'px \' + vertical + \'px  \' + blur + \'px \' + spread + \'px  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-horizontal").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var horizontal = jQuery("#' . $id . '-horizontal").val();
                     var vertical = jQuery("#' . $id . '-vertical").val();
                     var blur = jQuery("#' . $id . '-blur").val();
                     var spread = jQuery("#' . $id . '-spread").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + horizontal + \'px \' + vertical + \'px  \' + blur + \'px \' + spread + \'px  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-vertical").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var horizontal = jQuery("#' . $id . '-horizontal").val();
                     var vertical = jQuery("#' . $id . '-vertical").val();
                     var blur = jQuery("#' . $id . '-blur").val();
                     var spread = jQuery("#' . $id . '-spread").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + horizontal + \'px \' + vertical + \'px  \' + blur + \'px \' + spread + \'px  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-blur").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var horizontal = jQuery("#' . $id . '-horizontal").val();
                     var vertical = jQuery("#' . $id . '-vertical").val();
                     var blur = jQuery("#' . $id . '-blur").val();
                     var spread = jQuery("#' . $id . '-spread").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + horizontal + \'px \' + vertical + \'px  \' + blur + \'px \' + spread + \'px  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-spread").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var horizontal = jQuery("#' . $id . '-horizontal").val();
                     var vertical = jQuery("#' . $id . '-vertical").val();
                     var blur = jQuery("#' . $id . '-blur").val();
                     var spread = jQuery("#' . $id . '-spread").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + horizontal + \'px \' + vertical + \'px  \' + blur + \'px \' + spread + \'px  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * inner box shadow selector
 * works at layouts page to adding box shadow with responsive value
 */
function OxiAddonsADMhelpInnerBoxShadow($id = null, $fristnumber = null, $styledata = null, $control = null, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    echo '<div class="form-group row ' . $controldata . '">
                <label for="' . $id . '-color" class="col-sm-6 control-label" oxi-addons-tooltip="Set Inner Shadow Color and Size" >Inner Shadow</label>
                <div class="col-sm-3 addons-dtm-laptop-lock">
                   <input type="number" class="form-control " step="1" id="' . $id . '-inner" name="' . $id . '-inner" value="' . $styledata[($fristnumber + 2)] . '">
                </div>
                <div class="col-sm-3 addons-dtm-laptop-lock">
                    <input type="text" data-format="rgb" data-opacity="true" class="form-control oxi-addons-minicolor oxi-addons-CF-data " id="' . $id . '-color" name="' . $id . '-color" value="' . $styledata[$fristnumber] . '">
                </div>
        </div>';
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '-color").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var inner = jQuery("#' . $id . '-inner").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + inner + \'px \' + color + \' inset; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-inner").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     var inner = jQuery("#' . $id . '-inner").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{box-shadow:  \' + inner + \'px \' + color + \' inset; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * border selector with color and type
 * works at layouts page to adding border color and type
 */
function OxiAddonsADMhelpBorder($id = null, $fristnumber = null, $styledata = null, $control = 'true', $export = null, $exname = null, $name = 'Border') {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '-color").on("change", function () {
                     var color = jQuery("#' . $id . '-color").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-color:  \' + color + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });
                   jQuery("#' . $id . '-type").on("change", function () {
                     var type = jQuery("#' . $id . '-type").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{border-style:  \' + type + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    echo '<div class="form-group row ' . $controldata . '">
            <label for="' . $id . '-color" class="col-sm-6 control-label" oxi-addons-tooltip="Set Border Color and Border Type" >' . $name . ' Color </label>
            <div class="col-sm-3 addons-dtm-laptop-lock">
                <input type="text"  class="form-control oxi-addons-minicolor oxi-addons-CF-data " id="' . $id . '-color" name="' . $id . '-color" value="' . $styledata[($fristnumber + 1)] . '">
            </div>';
    $type = $styledata[($fristnumber)];
    ?>
    <div class="col-sm-3 addons-dtm-laptop-lock">
        <select class="form-control" id="<?php echo $id; ?>-type" name="<?php echo $id; ?>-type">
            <option value="dotted" <?php
            if ($type == 'dotted') {
                echo 'selected';
            }
            ?>>Dotted</option>
            <option value="dashed" <?php
            if ($type == 'dashed') {
                echo 'selected';
            }
            ?>>Dashed</option>
            <option value="solid" <?php
            if ($type == 'solid') {
                echo 'selected';
            }
            ?>>Solid</option>
            <option value="double" <?php
            if ($type == 'double') {
                echo 'selected';
            }
            ?>>Double</option>
            <option value="groove" <?php
            if ($type == 'groove') {
                echo 'selected';
            }
            ?>>Groove</option>
            <option value="ridge" <?php
            if ($type == 'ridge') {
                echo 'selected';
            }
            ?>>Ridge</option>           
            <option value="inset" <?php
            if ($type == 'inset') {
                echo 'selected';
            }
            ?>>Inset</option>
            <option value="outset" <?php
            if ($type == 'outset') {
                echo 'selected';
            }
            ?>>Outset</option>
            <option value="none" <?php
            if ($type == 'none') {
                echo 'selected';
            }
            ?>>None</option>
            <option value="hidden" <?php
            if ($type == 'hidden') {
                echo 'selected';
            }
            ?>>Hidden</option>
            <option value="none" <?php
            if ($type == 'none') {
                echo 'selected';
            }
            ?>>None</option>
        </select>  
    </div>
    <?php
    echo '</div>';
}

/**
 * color selector with rgba and linear gradient
 * works at layouts page to adding color with linear gradient
 */
function oxi_addons_adm_help_MiniColor($id = null, $value = null, $rgba = null, $name = null, $title = null, $control = null, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if ($rgba == 'rgba') {
        $RGBA = 'data-format="rgb" data-opacity="true"';
    } else {
        $RGBA = '';
    }
    $colortype = get_option('oxi_addons_linear_gradient');
    echo '<div class="form-group row ' . $controldata . '">
            <label for="' . $id . '" class="col-sm-6 control-label"  oxi-addons-tooltip="' . $title . '">' . $name . '</label>
            <div class="col-sm-6 addons-dtm-laptop-lock">';
    if ($colortype == 'yes' && $rgba == 'rgba') {
        echo '<input  class="oxi-addons-CF-data" type=""  id="' . $id . '" name="' . $id . '" value="' . $value . '">';
        $jquery = 'jQuery("#' . $id . '").coloringPick({
                                                        "show_input": true,
                                                        "theme": "dark",
                                                        change: function(val){
                                                            var wordcount = val.split(/\b[\s,\.-:;]*/).length;
                                                            var limitWord = 23;
                                                            if (wordcount < limitWord) {
                                                                jQuery("<style type=\'text/css\'> ' . $export . '{background:" + val + "} </style>").appendTo("#wpwrap");
                                                            }else{
                                                                jQuery("<style type=\'text/css\'> ' . $export . '{" + val + "} </style>").appendTo("#wpwrap");
                                                            }
                                                        }
                                                        });';
        wp_add_inline_script('jquery.coloring-pick', $jquery);
    } else {
        echo '<input type="text" ' . $RGBA . ' oxijsid ="' . $export . '" oxijsname ="' . $exname . '"  class="form-control oxi-addons-minicolor oxi-addons-CF-data" id="' . $id . '" name="' . $id . '" value="' . $value . '">';
    }
    echo '  </div>
        </div>';
}

/**
 * hidden field selector
 * works at layouts page to adding hidden field
 */
function OxiAddonsADMHelpInputHidden($id = null, $value = null, $control = null) {
    echo '<input type="hidden"  name="' . $id . '" value="' . $value . '">';
}

/**
 * background field selector with image and linear gradient
 * works at layouts page to adding background field
 */
function OxiAddonsADMHelpBGImage($id = null, $styledata = null, $firstvalue = null, $control = 'true', $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    oxi_addons_adm_help_MiniColor($id . '-color', $styledata[$firstvalue], 'rgba', 'Background Color', 'Set Your background Color', '', $export, $exname);
    ?>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-image" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Background Color and Image also set Background Opacity if you used Image">Background Image</label>
        <div class="col-sm-3 addons-dtm-laptop-lock" style="padding-right: 0px;">
            <input type="text "class="form-control" style="padding-right: 4px; padding-left: 4px;" id="<?php echo $id; ?>-image" name="<?php echo $id; ?>-image" value="<?php echo OxiAddonsUrlConvert($styledata[($firstvalue + 1)]); ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <button type="button" oxiimage="#<?php echo $id; ?>-image" class="oxi-addons-body-image-button btn btn-default">Upload</button>
        </div>
    </div>
    <?php
}

/**
 * preview color field selector
 * works at layouts page to adding preview color
 */
function oxi_addons_adm_help_preview_color($value) {
    $colortype = get_option('oxi_addons_linear_gradient');
    if ($colortype == 'yes') {
        echo '<input type=""  id="oxi-addons-preview-color" name="oxi-addons-preview-color" value="' . $value . '">';
        $jquery = 'jQuery("#oxi-addons-preview-color").coloringPick({
                                                        "show_input": true,
                                                        "theme": "dark",
                                                        change: function(val){
                                                            var wordcount = val.split(/\b[\s,\.-:;]*/).length;
                                                            var limitWord = 23;
                                                            if (wordcount < limitWord) {
                                                                jQuery("#preview-color").val(val);
                                                                jQuery("<style type=\'text/css\'> #oxi-addons-preview-data{background:" + val + "} </style>").appendTo("#wpwrap");
                                                            }else{
                                                                jQuery("<style type=\'text/css\'> #oxi-addons-preview-data{" + val + "} </style>").appendTo("#wpwrap");
                                                            }
                                                        }
                                                        });';
    } else {
        echo '<input type="text" data-format="rgb" data-opacity="true" oxijsid ="oxi-addons-preview-color" oxijstyle="color" oxijsname ="background"  class="form-control oxi-addons-minicolor oxi-addons-CF-data " id="oxi-addons-preview-color" name="oxi-addons-preview-color" value="' . $value . '">';
        $jquery = 'jQuery("#oxi-addons-preview-color").on("change", function () { jQuery("<style type=\'text/css\'> #oxi-addons-preview-data{background:" + jQuery(this).val() + "} </style>").appendTo("#wpwrap");});';
    }
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

/**
 * true false field selector
 * works at layouts page to adding true false field
 */
function oxi_addons_adm_help_true_false($id = null, $value = null, $fristname = null, $fristvalue = null, $Secondname = null, $Secondvalue = null, $name = null, $title = null, $control = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php
                if ($fristvalue == $value) {
                    echo 'active';
                }
                ?>"> <input class="oxilab-alert-change"  oxilab-alert="<?php echo $name; ?>" type="radio" <?php
                       if ($fristvalue == $value) {
                           echo 'checked';
                       }
                       ?> name="<?php echo $id; ?>" id="<?php echo $id; ?>-yes" autocomplete="off" value="<?php echo $fristvalue; ?>"><?php echo $fristname; ?></label>
                <label class="btn btn-primary <?php
                if ($Secondvalue == $value) {
                    echo 'active';
                }
                ?>"> <input type="radio"  class="oxilab-alert-change"  oxilab-alert="<?php echo $name; ?>" <?php
                       if ($Secondvalue == $value) {
                           echo 'checked';
                       }
                       ?> name="<?php echo $id; ?>" autocomplete="off" id="<?php echo $id; ?>-no" value="<?php echo $Secondvalue; ?>"><?php echo $Secondname; ?> </label>
            </div>
        </div>
    </div>
    <?php
}

/**
 * font family field selector
 * works at layouts page to adding font family field
 */
function oxi_addons_adm_help_Font_Family($id = null, $value = null, $name = null, $title = null, $control = true, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="oxi-addons-family oxi-addons-CF-data" value="<?php echo $value; ?>" oxiexport="<?php echo $export; ?>" type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>">
        </div>
    </div>
    <?php
}

/**
 * font settings field selector
 * works at layouts page to adding font family, font style, font weight, line height, text shadow and text align
 */
function OxiAddonsADMHelpFontSettings($id = null, $firstvalue = null, $data = null, $control = true, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-family" class="col-sm-6 control-label"  oxi-addons-tooltip="Set your Font family for make more accrate also can import font family from Settings">Font Family</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="oxi-addons-family oxi-addons-CF-data " value="<?php echo $data[$firstvalue]; ?>"  oxiexport="<?php echo $export; ?>"  type="text" name="<?php echo $id; ?>-family" id="<?php echo $id; ?>-family">
        </div>
    </div>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-weight" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Weight Property as normal or blod or others">Font Weight</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-font-weight" id="<?php echo $id; ?>-weight" oxiexport="<?php echo $export; ?>"  name="<?php echo $id; ?>-weight">
                <option value="100" <?php
                if ($data[($firstvalue + 1)] == '100') {
                    echo 'selected';
                }
                ?>>100</option>
                <option value="200" <?php
                if ($data[($firstvalue + 1)] == '200') {
                    echo 'selected';
                }
                ?>>200</option>
                <option value="300" <?php
                if ($data[($firstvalue + 1)] == '300') {
                    echo 'selected';
                }
                ?>>300</option>
                <option value="400" <?php
                if ($data[($firstvalue + 1)] == '400') {
                    echo 'selected';
                }
                ?>>400</option>
                <option value="500" <?php
                if ($data[($firstvalue + 1)] == '500') {
                    echo 'selected';
                }
                ?>>500</option>
                <option value="600" <?php
                if ($data[($firstvalue + 1)] == '600') {
                    echo 'selected';
                }
                ?>>600</option>
                <option value="700" <?php
                if ($data[($firstvalue + 1)] == '700') {
                    echo 'selected';
                }
                ?>>700</option>
                <option value="800" <?php
                if ($data[($firstvalue + 1)] == '800') {
                    echo 'selected';
                }
                ?>>800</option>
                <option value="900" <?php
                if ($data[($firstvalue + 1)] == '900') {
                    echo 'selected';
                }
                ?>>900</option>
                <option value="normal" <?php
                if ($data[($firstvalue + 1)] == 'normal') {
                    echo 'selected';
                }
                ?>>Normal</option>
                <option value="bold" <?php
                if ($data[($firstvalue + 1)] == 'bold') {
                    echo 'selected';
                }
                ?>>Bold</option>
                <option value="lighter" <?php
                if ($data[($firstvalue + 1)] == 'lighter') {
                    echo 'selected';
                }
                ?>>Lighter</option>
                <option value="initial" <?php
                if ($data[($firstvalue + 1)] == 'initial') {
                    echo 'selected';
                }
                ?>>Initial</option>
            </select>
        </div>
    </div>
    <?php
    $datacompile = $data[($firstvalue + 3)];
    $clonetrue = strpos($datacompile, ":");
    if ($clonetrue !== FALSE) {
        $datacompile = explode(':', $datacompile);
        $fontstyle = $datacompile[0];
        $lineheight = $datacompile[1];
    } else {
        $fontstyle = $datacompile;
        $lineheight = '1.3';
    }
    ?>

    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-style" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Style as normal, italic or Others">Font Style </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-font-style" id="<?php echo $id; ?>-style"  oxiexport="<?php echo $export; ?>" name="<?php echo $id; ?>-style">
                <option <?php
                if ($fontstyle == 'normal') {
                    echo 'selected';
                }
                ?> value="normal">Normal</option>
                <option <?php
                if ($fontstyle == 'italic') {
                    echo 'selected';
                }
                ?> value="italic">Italic</option>
                <option <?php
                if ($fontstyle == 'oblique') {
                    echo 'selected';
                }
                ?> value="oblique">Oblique</option>
                <option <?php
                if ($fontstyle == 'initial') {
                    echo 'selected';
                }
                ?> value="initial">Initial</option>
                <option <?php
                if ($fontstyle == 'inherit') {
                    echo 'selected';
                }
                ?> value="inherit">Inherit</option>
            </select>
        </div>
    </div>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-line-height" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Line Height Property as normal or blod or others">Line Height</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="form-control"  value="<?php echo $lineheight; ?>" type="number" step="0.05" name="<?php echo $id; ?>-line-height" id="<?php echo $id; ?>-line-height">
        </div>
    </div>
    <?php
    $datacompile = explode(':', $data[($firstvalue + 4)]);
    if (!empty($datacompile[1])) {
        $fontalign = $datacompile[0];
        $textshadow = $datacompile[1];
    } else {
        $fontalign = $datacompile;
        $textshadow = '0()0()0()#fff';
    }
    if (!empty($datacompile[2])) {
        $letterspacing = $datacompile[2];
    } else {
        $letterspacing = 0;
    }
    $textshadow = explode('()', $textshadow);
    ?>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-letter-spacing" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Letter Spacing Property as normal or blod or others">Letter Spacing</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="form-control"  value="<?php echo $letterspacing; ?>" type="number" step="0.01" name="<?php echo $id; ?>-letter-spacing" id="<?php echo $id; ?>-letter-spacing">
        </div>
    </div>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-align" class="col-sm-6 control-label"  oxi-addons-tooltip="Your text Align as Left, Center or Right">Text Align</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-text-align"  id="<?php echo $id; ?>-align"  oxiexport="<?php echo $export; ?>" name="<?php echo $id; ?>-align">
                <option value="left" <?php
                if ($fontalign == 'left') {
                    echo 'selected';
                };
                ?>>Left</option>
                <option value="center" <?php
                if ($fontalign == 'center') {
                    echo 'selected';
                };
                ?>>Center</option>
                <option value="right" <?php
                if ($fontalign == 'right') {
                    echo 'selected';
                };
                ?>>Right</option>
            </select>
        </div>
    </div>

    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-text-shadow" class="col-sm-6 control-label" oxi-addons-tooltip="Set text Shadow with easy and Advanced mode. At easy mode set Blur Radius only">Text Shadow</label>
        <div class="input-group col-sm-6 addons-dtm-laptop-lock">
            <div class="input-group-prepend">
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary oxiAddonsTextShadow" oxiAddonscheck="<?php echo $id; ?>-text-shadow" oxi-mode="">Easy</label>
                </div>
            </div>
            <input type="number" class="form-control oxiAddonsTextShadowparent" step="1" id="<?php echo $id; ?>-text-shadow" value="<?php echo $textshadow[2]; ?>">
        </div>
    </div>

    <div class=" form-group row <?php echo $id; ?>-text-shadow-horizontal">
        <label for="<?php echo $id; ?>-text-shadow-horizontal" class="col-sm-6 control-label" data-toggle-oxi="tooltip" oxi-addons-tooltip="Set Text Shadow Horizontal">Text Shadow Horizontal</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-horizontal" name="<?php echo $id; ?>-text-shadow-horizontal" value="<?php echo $textshadow[0]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-text-shadow-vertical">
        <label for="<?php echo $id; ?>-text-shadow-vertical" class="col-sm-6 control-label" data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Vertical">Text Shadow Vertical</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-vertical" name="<?php echo $id; ?>-text-shadow-vertical" value="<?php echo $textshadow[1]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-text-shadow-blur-radius">
        <label for="<?php echo $id; ?>-text-shadow-blur-radius" class="col-sm-6 control-label" data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Blur Radius">Text Shadow Blur Radius</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-blur-radius" name="<?php echo $id; ?>-text-shadow-blur-radius" value="<?php echo $textshadow[2]; ?>">
        </div>
    </div>
    <div class="form-group row <?php echo $id; ?>-text-shadow-color">
        <label for="<?php echo $id; ?>-text-shadow-color" class="col-sm-6 control-label"  data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Color">Text Shadow Color</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input type="text" data-format="rgb" data-opacity="true"  class="form-control oxi-addons-minicolor" id="<?php echo $id; ?>-text-shadow-color" name="<?php echo $id; ?>-text-shadow-color" value="<?php echo $textshadow[3]; ?>">
        </div>
    </div>
    <?php
}

/**
 * Text Shadow
 * works at layouts page to adding Text Shadow 
 */
function OxiAddonsADMHelpTextShadow($id = null, $firstvalue = null, $data = null, $control = true, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-text-shadow" class="col-sm-6 control-label" oxi-addons-tooltip="Set text Shadow with easy and Advanced mode. At easy mode set Blur Radius only">Text Shadow</label>
        <div class="input-group col-sm-6 addons-dtm-laptop-lock">
            <div class="input-group-prepend">
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary oxiAddonsTextShadow" oxiAddonscheck="<?php echo $id; ?>-text-shadow" oxi-mode="">Easy</label>
                </div>
            </div>
            <input type="number" class="form-control oxiAddonsTextShadowparent" step="1" id="<?php echo $id; ?>-text-shadow" value="<?php echo $data[($firstvalue + 2)]; ?>">
        </div>
    </div>

    <div class=" form-group row <?php echo $id; ?>-text-shadow-horizontal">
        <label for="<?php echo $id; ?>-text-shadow-horizontal" class="col-sm-6 control-label" data-toggle-oxi="tooltip" oxi-addons-tooltip="Set Text Shadow Horizontal">Text Shadow Horizontal</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-horizontal" name="<?php echo $id; ?>-text-shadow-horizontal" value="<?php echo $data[$firstvalue]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-text-shadow-vertical">
        <label for="<?php echo $id; ?>-text-shadow-vertical" class="col-sm-6 control-label" data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Vertical">Text Shadow Vertical</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-vertical" name="<?php echo $id; ?>-text-shadow-vertical" value="<?php echo $data[($firstvalue + 1)]; ?>">
        </div>
    </div>
    <div class=" form-group row <?php echo $id; ?>-text-shadow-blur-radius">
        <label for="<?php echo $id; ?>-text-shadow-blur-radius" class="col-sm-6 control-label" data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Blur Radius">Text Shadow Blur Radius</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" step="1" id="<?php echo $id; ?>-text-shadow-blur-radius" name="<?php echo $id; ?>-text-shadow-blur-radius" value="<?php echo $data[($firstvalue + 2)]; ?>">
        </div>
    </div>
    <div class="form-group row <?php echo $id; ?>-text-shadow-color">
        <label for="<?php echo $id; ?>-text-shadow-color" class="col-sm-6 control-label"  data-toggle-oxi="tooltip"  oxi-addons-tooltip="Set Text Shadow Color">Text Shadow Color</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input type="text" data-format="rgb" data-opacity="true"  class="form-control oxi-addons-minicolor" id="<?php echo $id; ?>-text-shadow-color" name="<?php echo $id; ?>-text-shadow-color" value="<?php echo $data[($firstvalue + 3)]; ?>">
        </div>
    </div>
    <?php
}

/**
 * button font settings field selector
 * works at layouts page to adding font style, font wight, font family 
 */
function OxiAddonsADMHelpButtonFontSettings($id = null, $firstvalue = null, $data = null, $control = true, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-family" class="col-sm-6 control-label"  oxi-addons-tooltip="Set your Font family for make more accrate also can import font family from Settings">Font Family</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="oxi-addons-family oxi-addons-CF-data " value="<?php echo $data[$firstvalue]; ?>" type="text" name="<?php echo $id; ?>-family" id="<?php echo $id; ?>-family">
        </div>
    </div>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-weight" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Weight Property as normal or blod or others">Font Weight</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-font-weight" id="<?php echo $id; ?>-weight" name="<?php echo $id; ?>-weight">
                <option value="100" <?php
                if ($data[($firstvalue + 1)] == '100') {
                    echo 'selected';
                }
                ?>>100</option>
                <option value="200" <?php
                if ($data[($firstvalue + 1)] == '200') {
                    echo 'selected';
                }
                ?>>200</option>
                <option value="300" <?php
                if ($data[($firstvalue + 1)] == '300') {
                    echo 'selected';
                }
                ?>>300</option>
                <option value="400" <?php
                if ($data[($firstvalue + 1)] == '400') {
                    echo 'selected';
                }
                ?>>400</option>
                <option value="500" <?php
                if ($data[($firstvalue + 1)] == '500') {
                    echo 'selected';
                }
                ?>>500</option>
                <option value="600" <?php
                if ($data[($firstvalue + 1)] == '600') {
                    echo 'selected';
                }
                ?>>600</option>
                <option value="700" <?php
                if ($data[($firstvalue + 1)] == '700') {
                    echo 'selected';
                }
                ?>>700</option>
                <option value="800" <?php
                if ($data[($firstvalue + 1)] == '800') {
                    echo 'selected';
                }
                ?>>800</option>
                <option value="900" <?php
                if ($data[($firstvalue + 1)] == '900') {
                    echo 'selected';
                }
                ?>>900</option>
                <option value="normal" <?php
                if ($data[($firstvalue + 1)] == 'normal') {
                    echo 'selected';
                }
                ?>>Normal</option>
                <option value="bold" <?php
                if ($data[($firstvalue + 1)] == 'bold') {
                    echo 'selected';
                }
                ?>>Bold</option>
                <option value="lighter" <?php
                if ($data[($firstvalue + 1)] == 'lighter') {
                    echo 'selected';
                }
                ?>>Lighter</option>
                <option value="initial" <?php
                if ($data[($firstvalue + 1)] == 'initial') {
                    echo 'selected';
                }
                ?>>Initial</option>
            </select>
        </div>
    </div>
    <div class="form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>-style" class="col-sm-6 control-label" oxi-addons-tooltip="Set your Font Style as normal, italic or Others">Font Style </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-font-style" id="<?php echo $id; ?>-style" name="<?php echo $id; ?>-style">
                <option <?php
                if ($data[($firstvalue + 3)] == 'normal') {
                    echo 'selected';
                }
                ?> value="normal">Normal</option>
                <option <?php
                if ($data[($firstvalue + 3)] == 'italic') {
                    echo 'selected';
                }
                ?> value="italic">Italic</option>
                <option <?php
                if ($data[($firstvalue + 3)] == 'oblique') {
                    echo 'selected';
                }
                ?> value="oblique">Oblique</option>
                <option <?php
                if ($data[($firstvalue + 3)] == 'initial') {
                    echo 'selected';
                }
                ?> value="initial">Initial</option>
                <option <?php
                if ($data[($firstvalue + 3)] == 'inherit') {
                    echo 'selected';
                }
                ?> value="inherit">Inherit</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * text align field selector
 * works at layouts page to adding text align
 */
function oxi_addons_adm_help_Text_Align($id = null, $value = null, $name = null, $title = null, $control = true, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                     var value = jQuery("#' . $id . '").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ':  \' + value + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?> ">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="left" <?php
                if ($value == 'left') {
                    echo 'selected';
                };
                ?>>Left</option>
                <option value="center" <?php
                if ($value == 'center') {
                    echo 'selected';
                };
                ?>>Center</option>
                <option value="right" <?php
                if ($value == 'right') {
                    echo 'selected';
                };
                ?>>Right</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * justify align field selector
 * works at layouts page to adding justify align
 */
function oxi_addons_adm_help_Justify_Align($id = null, $value = null, $name = null, $title = null, $control = true, $export = null, $exname = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                     var value = jQuery("#' . $id . '").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{' . $exname . ':  \' + value + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?> ">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="flex-start;" <?php
                if ($value == 'flex-start;') {
                    echo 'selected';
                };
                ?>>Left</option>
                <option value="center" <?php
                if ($value == 'center') {
                    echo 'selected';
                };
                ?>>Center</option>
                <option value="flex-end" <?php
                if ($value == 'flex-end') {
                    echo 'selected';
                };
                ?>>Right</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * font weight field selector
 * works at layouts page to adding font weight field
 */
function oxi_addons_adm_help_Font_Weight($id = null, $value = null, $name = null, $title = null, $control = true, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                     var value = jQuery("#' . $id . '").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{font-weight:  \' + value + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control "  id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="100" <?php
                if ($value == '100') {
                    echo 'selected';
                }
                ?>>100</option>
                <option value="200" <?php
                if ($value == '200') {
                    echo 'selected';
                }
                ?>>200</option>
                <option value="300" <?php
                if ($value == '300') {
                    echo 'selected';
                }
                ?>>300</option>
                <option value="400" <?php
                if ($value == '400') {
                    echo 'selected';
                }
                ?>>400</option>
                <option value="500" <?php
                if ($value == '500') {
                    echo 'selected';
                }
                ?>>500</option>
                <option value="600" <?php
                if ($value == '600') {
                    echo 'selected';
                }
                ?>>600</option>
                <option value="700" <?php
                if ($value == '700') {
                    echo 'selected';
                }
                ?>>700</option>
                <option value="800" <?php
                if ($value == '800') {
                    echo 'selected';
                }
                ?>>800</option>
                <option value="900" <?php
                if ($value == '900') {
                    echo 'selected';
                }
                ?>>900</option>
                <option value="normal" <?php
                if ($value == 'normal') {
                    echo 'selected';
                }
                ?>>Normal</option>
                <option value="bold" <?php
                if ($value == 'bold') {
                    echo 'selected';
                }
                ?>>Bold</option>
                <option value="lighter" <?php
                if ($value == 'lighter') {
                    echo 'selected';
                }
                ?>>Lighter</option>
                <option value="initial" <?php
                if ($value == 'initial') {
                    echo 'selected';
                }
                ?>>Initial</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * font style field selector
 * works at layouts page to adding font style field
 */
function oxi_addons_adm_help_Font_Style($id = null, $value = null, $name = null, $title = null, $control = true, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").on("change", function () {
                     var value = jQuery("#' . $id . '").val();
                     jQuery(\'<style type="text/css">#oxi-addons-preview-data ' . $export . '{font-style:  \' + value + \'; } </style>\').appendTo("#oxi-addons-preview-data");
                   });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control "   id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option <?php
                if ($value == 'normal') {
                    echo 'selected';
                }
                ?> value="normal">Normal</option>
                <option <?php
                if ($value == 'italic') {
                    echo 'selected';
                }
                ?> value="italic">Italic</option>
                <option <?php
                if ($value == 'oblique') {
                    echo 'selected';
                }
                ?> value="oblique">Oblique</option>
                <option <?php
                if ($value == 'initial') {
                    echo 'selected';
                }
                ?> value="initial">Initial</option>
                <option <?php
                if ($value == 'inherit') {
                    echo 'selected';
                }
                ?> value="inherit">Inherit</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * initial open field selector
 * works at layouts page to adding initial open field
 */
function OxiAddonsAdminInitialOpen($id, $data, $name, $title, $control) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row  <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value=":first"     <?php
                if ($data == ':first') {
                    echo 'selected';
                };
                ?>>First</option>
                <option value=":eq(1)"     <?php
                if ($data == ':eq(1)') {
                    echo 'selected';
                };
                ?>>2nd</option>
                <option value=":eq(2)"     <?php
                if ($data == ':eq(2)') {
                    echo 'selected';
                };
                ?>>3rd</option>
                <option value=":eq(3)"     <?php
                if ($data == ':eq(3)') {
                    echo 'selected';
                };
                ?>>4th</option>
                <option value=":eq(4)"     <?php
                if ($data == ':eq(4)') {
                    echo 'selected';
                };
                ?>>5th</option>
                <option value=":eq(5)"     <?php
                if ($data == ':eq(5)') {
                    echo 'selected';
                };
                ?>>6th</option>
                <option value=":eq(6)"     <?php
                if ($data == ':eq(6)') {
                    echo 'selected';
                };
                ?>>7th</option>
                <option value=":eq(7)"     <?php
                if ($data == ':eq(7)') {
                    echo 'selected';
                };
                ?>>8th</option>
                <option value=":eq(8)"     <?php
                if ($data == ':eq(8)') {
                    echo 'selected';
                };
                ?>>9th</option>
                <option value=":eq(9)" <?php
                if ($data == ':eq(9)') {
                    echo 'selected';
                };
                ?>>10th</option>
                <option value="none"    <?php
                if ($data == 'none') {
                    echo 'selected';
                };
                ?>>None</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * heading tag field selector
 * works at layouts page to adding heading tag field
 */
function oxi_addons_adm_help_Heading_Tag($id = null, $value = null, $name = null, $title = null, $control = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxilab-alert-change" id="<?php echo $id; ?>" oxilab-alert="<?php echo $name; ?>" name="<?php echo $id; ?>">
                <option value="h1" <?php
                if ($value == 'h1') {
                    echo 'selected';
                }
                ?>>Heading 1</option>
                <option value="h2" <?php
                if ($value == 'h2') {
                    echo 'selected';
                }
                ?>>Heading 2</option>
                <option value="h3" <?php
                if ($value == 'h3') {
                    echo 'selected';
                }
                ?>>Heading 3</option>
                <option value="h4" <?php
                if ($value == 'h4') {
                    echo 'selected';
                }
                ?>>Heading 4</option>
                <option value="h5" <?php
                if ($value == 'h5') {
                    echo 'selected';
                }
                ?>>Heading 5</option>
                <option value="h6" <?php
                if ($value == 'h6') {
                    echo 'selected';
                }
                ?>>Heading 6</option>              
            </select>
        </div>
    </div>
    <?php
}

/**
 * only animation field selector
 * works at layouts page to adding only animation field
 */
function OxiAddonsADMHelpOnlyAnimation($id = null, $value = null, $name = 'Animation', $title = "Set your Animation as no animation also works", $control = 'true', $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-amimation-data" oxiexport="<?php echo $export; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <optgroup label="No Animation">
                    <option value="" <?php
                    if ($value == '') {
                        echo 'selected';
                    }
                    ?>>No Animation</option>
                </optgroup>
                <optgroup label="Attention Seekers">
                    <option value="bounce"      <?php
                    if ($value == 'bounce') {
                        echo 'selected';
                    }
                    ?>>bounce</option>
                    <option value="flash"       <?php
                    if ($value == 'flash') {
                        echo 'selected';
                    }
                    ?>>flash</option>
                    <option value="pulse"       <?php
                    if ($value == 'pulse') {
                        echo 'selected';
                    }
                    ?>>pulse</option>
                    <option value="rubberBand"  <?php
                    if ($value == 'rubberBand') {
                        echo 'selected';
                    }
                    ?>>rubberBand</option>
                    <option value="shake"       <?php
                    if ($value == 'shake') {
                        echo 'selected';
                    }
                    ?>>shake</option>
                    <option value="swing"       <?php
                    if ($value == 'swing') {
                        echo 'selected';
                    }
                    ?>>swing</option>
                    <option value="tada"        <?php
                    if ($value == 'tada') {
                        echo 'selected';
                    }
                    ?>>tada</option>
                    <option value="wobble"      <?php
                    if ($value == 'wobble') {
                        echo 'selected';
                    }
                    ?>>wobble</option>
                    <option value="jello"       <?php
                    if ($value == 'jello') {
                        echo 'selected';
                    }
                    ?>>jello</option>
                    <option value="heartBeat"   <?php
                    if ($value == 'heartBeat') {
                        echo 'selected';
                    }
                    ?>>heartBeat</option>
                </optgroup>

                <optgroup label="Bouncing Entrances">
                    <option value="bounceIn"      <?php
                    if ($value == 'bounceIn') {
                        echo 'selected';
                    }
                    ?>>bounceIn</option>
                    <option value="bounceInDown"  <?php
                    if ($value == 'bounceInDown') {
                        echo 'selected';
                    }
                    ?>>bounceInDown</option>
                    <option value="bounceInLeft"  <?php
                    if ($value == 'bounceInLeft') {
                        echo 'selected';
                    }
                    ?>>bounceInLeft</option>
                    <option value="bounceInRight" <?php
                    if ($value == 'bounceInRight') {
                        echo 'selected';
                    }
                    ?>>bounceInRight</option>
                    <option value="bounceInUp"    <?php
                    if ($value == 'bounceInUp') {
                        echo 'selected';
                    }
                    ?>>bounceInUp</option>
                </optgroup>

                <optgroup label="Bouncing Exits">
                    <option value="bounceOut"      <?php
                    if ($value == 'bounceOut') {
                        echo 'selected';
                    }
                    ?>>bounceOut</option>
                    <option value="bounceOutDown"  <?php
                    if ($value == 'bounceOutDown') {
                        echo 'selected';
                    }
                    ?>>bounceOutDown</option>
                    <option value="bounceOutLeft"  <?php
                    if ($value == 'bounceOutLeft') {
                        echo 'selected';
                    }
                    ?>>bounceOutLeft</option>
                    <option value="bounceOutRight" <?php
                    if ($value == 'bounceOutRight') {
                        echo 'selected';
                    }
                    ?>>bounceOutRight</option>
                    <option value="bounceOutUp"    <?php
                    if ($value == 'bounceOutUp') {
                        echo 'selected';
                    }
                    ?>>bounceOutUp</option>
                </optgroup>

                <optgroup label="Fading Entrances">
                    <option value="fadeIn"          <?php
                    if ($value == 'fadeIn') {
                        echo 'selected';
                    }
                    ?>>fadeIn</option>
                    <option value="fadeInDown"      <?php
                    if ($value == 'fadeInDown') {
                        echo 'selected';
                    }
                    ?>>fadeInDown</option>
                    <option value="fadeInDownBig"   <?php
                    if ($value == 'fadeInDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeInDownBig</option>
                    <option value="fadeInLeft"      <?php
                    if ($value == 'fadeInLeft') {
                        echo 'selected';
                    }
                    ?>>fadeInLeft</option>
                    <option value="fadeInLeftBig"   <?php
                    if ($value == 'fadeInLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeInLeftBig</option>
                    <option value="fadeInRight"     <?php
                    if ($value == 'fadeInRight') {
                        echo 'selected';
                    }
                    ?>>fadeInRight</option>
                    <option value="fadeInRightBig"  <?php
                    if ($value == 'fadeInRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeInRightBig</option>
                    <option value="fadeInUp"        <?php
                    if ($value == 'fadeInUp') {
                        echo 'selected';
                    }
                    ?>>fadeInUp</option>
                    <option value="fadeInUpBig"     <?php
                    if ($value == 'fadeInUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeInUpBig</option>
                </optgroup>

                <optgroup label="Fading Exits">
                    <option value="fadeOut"         <?php
                    if ($value == 'fadeOut') {
                        echo 'selected';
                    }
                    ?>>fadeOut</option>
                    <option value="fadeOutDown"     <?php
                    if ($value == 'fadeOutDown') {
                        echo 'selected';
                    }
                    ?>>fadeOutDown</option>
                    <option value="fadeOutDownBig"  <?php
                    if ($value == 'fadeOutDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutDownBig</option>
                    <option value="fadeOutLeft"     <?php
                    if ($value == 'fadeOutLeft') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeft</option>
                    <option value="fadeOutLeftBig"  <?php
                    if ($value == 'fadeOutLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeftBig</option>
                    <option value="fadeOutRight"    <?php
                    if ($value == 'fadeOutRight') {
                        echo 'selected';
                    }
                    ?>>fadeOutRight</option>
                    <option value="fadeOutRightBig" <?php
                    if ($value == 'fadeOutRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutRightBig</option>
                    <option value="fadeOutUp"       <?php
                    if ($value == 'fadeOutUp') {
                        echo 'selected';
                    }
                    ?>>fadeOutUp</option>
                    <option value="fadeOutUpBig"    <?php
                    if ($value == 'fadeOutUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutUpBig</option>
                </optgroup>

                <optgroup label="Flippers">
                    <option value="flip"         <?php
                    if ($value == 'flip') {
                        echo 'selected';
                    }
                    ?>>flip</option>
                    <option value="flipInX"      <?php
                    if ($value == 'flipInX') {
                        echo 'selected';
                    }
                    ?>>flipInX</option>
                    <option value="flipInY"      <?php
                    if ($value == 'flipInY') {
                        echo 'selected';
                    }
                    ?>>flipInY</option>
                    <option value="flipOutX"     <?php
                    if ($value == 'flipOutX') {
                        echo 'selected';
                    }
                    ?>>flipOutX</option>
                    <option value="flipOutY"     <?php
                    if ($value == 'flipOutY') {
                        echo 'selected';
                    }
                    ?>>flipOutY</option>
                </optgroup>

                <optgroup label="Lightspeed">
                    <option value="lightSpeedIn"    <?php
                    if ($value == 'lightSpeedIn') {
                        echo 'selected';
                    }
                    ?>>lightSpeedIn</option>
                    <option value="lightSpeedOut"   <?php
                    if ($value == 'lightSpeedOut') {
                        echo 'selected';
                    }
                    ?>>lightSpeedOut</option>
                </optgroup>

                <optgroup label="Rotating Entrances">
                    <option value="rotateIn"            <?php
                    if ($value == 'rotateIn') {
                        echo 'selected';
                    }
                    ?>>rotateIn</option>
                    <option value="rotateInDownLeft"    <?php
                    if ($value == 'rotateInDownLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInDownLeft</option>
                    <option value="rotateInDownRight"   <?php
                    if ($value == 'rotateInDownRight') {
                        echo 'selected';
                    }
                    ?>>rotateInDownRight</option>
                    <option value="rotateInUpLeft"      <?php
                    if ($value == 'rotateInUpLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInUpLeft</option>
                    <option value="rotateInUpRight"     <?php
                    if ($value == 'rotateInUpRight') {
                        echo 'selected';
                    }
                    ?>>rotateInUpRight</option>
                </optgroup>

                <optgroup label="Rotating Exits">
                    <option value="rotateOut"            <?php
                    if ($value == 'rotateOut') {
                        echo 'selected';
                    }
                    ?>>rotateOut</option>
                    <option value="rotateOutDownLeft"    <?php
                    if ($value == 'rotateOutDownLeft') {
                        echo 'selected';
                    }
                    ?>>rotateOutDownLeft</option>
                    <option value="rotateOutDownRight"   <?php
                    if ($value == 'rotateOutDownRight') {
                        echo 'selected';
                    }
                    ?>>rotateOutDownRight</option>
                    <option value="rotateOutUpLeft"      <?php
                    if ($value == 'rotateOutUpLeft') {
                        echo 'selected';
                    }
                    ?>>rotateOutUpLeft</option>
                    <option value="rotateOutUpRight"     <?php
                    if ($value == 'rotateOutUpRight') {
                        echo 'selected';
                    }
                    ?>>rotateOutUpRight</option>
                </optgroup>

                <optgroup label="Sliding Entrances">
                    <option value="slideInUp"       <?php
                    if ($value == 'slideInUp') {
                        echo 'selected';
                    }
                    ?>>slideInUp</option>
                    <option value="slideInDown"     <?php
                    if ($value == 'slideInDown') {
                        echo 'selected';
                    }
                    ?>>slideInDown</option>
                    <option value="slideInLeft"     <?php
                    if ($value == 'slideInLeft') {
                        echo 'selected';
                    }
                    ?>>slideInLeft</option>
                    <option value="slideInRight"    <?php
                    if ($value == 'slideInRight') {
                        echo 'selected';
                    }
                    ?>>slideInRight</option>

                </optgroup>
                <optgroup label="Sliding Exits">
                    <option value="slideOutUp"      <?php
                    if ($value == 'slideOutUp') {
                        echo 'selected';
                    }
                    ?>>slideOutUp</option>
                    <option value="slideOutDown"    <?php
                    if ($value == 'slideOutDown') {
                        echo 'selected';
                    }
                    ?>>slideOutDown</option>
                    <option value="slideOutLeft"    <?php
                    if ($value == 'slideOutLeft') {
                        echo 'selected';
                    }
                    ?>>slideOutLeft</option>
                    <option value="slideOutRight"   <?php
                    if ($value == 'slideOutRight') {
                        echo 'selected';
                    }
                    ?>>slideOutRight</option>

                </optgroup>

                <optgroup label="Zoom Entrances">
                    <option value="zoomIn"      <?php
                    if ($value == 'zoomIn') {
                        echo 'selected';
                    }
                    ?>>zoomIn</option>
                    <option value="zoomInDown"  <?php
                    if ($value == 'zoomInDown') {
                        echo 'selected';
                    }
                    ?>>zoomInDown</option>
                    <option value="zoomInLeft"  <?php
                    if ($value == 'zoomInLeft') {
                        echo 'selected';
                    }
                    ?>>zoomInLeft</option>
                    <option value="zoomInRight" <?php
                    if ($value == 'zoomInRight') {
                        echo 'selected';
                    }
                    ?>>zoomInRight</option>
                    <option value="zoomInUp"    <?php
                    if ($value == 'zoomInUp') {
                        echo 'selected';
                    }
                    ?>>zoomInUp</option>
                </optgroup>

                <optgroup label="Zoom Exits">
                    <option value="zoomOut"         <?php
                    if ($value == 'zoomOut') {
                        echo 'selected';
                    }
                    ?>>zoomOut</option>
                    <option value="zoomOutDown"     <?php
                    if ($value == 'zoomOutDown') {
                        echo 'selected';
                    }
                    ?>>zoomOutDown</option>
                    <option value="zoomOutLeft"     <?php
                    if ($value == 'zoomOutLeft') {
                        echo 'selected';
                    }
                    ?>>zoomOutLeft</option>
                    <option value="zoomOutRight"    <?php
                    if ($value == 'zoomOutRight') {
                        echo 'selected';
                    }
                    ?>>zoomOutRight</option>
                    <option value="zoomOutUp"       <?php
                    if ($value == 'zoomOutUp') {
                        echo 'selected';
                    }
                    ?>>zoomOutUp</option>
                </optgroup>

                <optgroup label="Specials">
                    <option value="hinge"       <?php
                    if ($value == 'hinge') {
                        echo 'selected';
                    }
                    ?>>hinge</option>
                    <option value="jackInTheBox"    <?php
                    if ($value == 'jackInTheBox') {
                        echo 'selected';
                    }
                    ?>>jackInTheBox</option>
                    <option value="rollIn"      <?php
                    if ($value == 'rollIn') {
                        echo 'selected';
                    }
                    ?>>rollIn</option>
                    <option value="rollOut"     <?php
                    if ($value == 'rollOut') {
                        echo 'selected';
                    }
                    ?>>rollOut</option>
                </optgroup>
            </select>
        </div>
    </div>   
    <?php
}

/**
 * animation field selector
 * works at layouts page to adding animation field
 */
function oxi_addons_adm_help_Animation($id = null, $numberid = null, $styledata = null, $control = true, $export = null) {
    $value = $styledata[$numberid];
    $Animation = explode('//', $styledata[($numberid + 2)]);
    $sanimation = explode(":", $styledata[($numberid + 1)]);
    if (count($sanimation) < 2) {
        $sanimation[1] = 'false';
        $sanimation[2] = 'false';
        $sanimation[3] = 500;
        $sanimation[4] = 10;
        $sanimation[5] = 0.2;
    }
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class="form-group row">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="Set your Animation type as No Animation also works">Type </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control oxi-addons-amimation-data" oxiexport="<?php echo $export; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <optgroup label="No Animation">
                    <option value="" <?php
                    if ($value == '') {
                        echo 'selected';
                    }
                    ?>>No Animation</option>
                </optgroup>
                <optgroup label="Attention Seekers">
                    <option value="bounce" <?php
                    if ($value == 'bounce') {
                        echo 'selected';
                    }
                    ?>>bounce</option>
                    <option value="flash" <?php
                    if ($value == 'flash') {
                        echo 'selected';
                    }
                    ?>>flash</option>
                    <option value="pulse" <?php
                    if ($value == 'pulse') {
                        echo 'selected';
                    }
                    ?>>pulse</option>
                    <option value="rubberBand" <?php
                    if ($value == 'rubberBand') {
                        echo 'selected';
                    }
                    ?>>rubberBand</option>
                    <option value="shake" <?php
                    if ($value == 'shake') {
                        echo 'selected';
                    }
                    ?>>shake</option>
                    <option value="swing" <?php
                    if ($value == 'swing') {
                        echo 'selected';
                    }
                    ?>>swing</option>
                    <option value="tada" <?php
                    if ($value == 'tada') {
                        echo 'selected';
                    }
                    ?>>tada</option>
                    <option value="wobble" <?php
                    if ($value == 'wobble') {
                        echo 'selected';
                    }
                    ?>>wobble</option>
                    <option value="jello" <?php
                    if ($value == 'jello') {
                        echo 'selected';
                    }
                    ?>>jello</option>
                </optgroup>
                <optgroup label="Bouncing Entrances">
                    <option value="bounceIn" <?php
                    if ($value == 'bounceIn') {
                        echo 'selected';
                    }
                    ?>>bounceIn</option>
                    <option value="bounceInDown" <?php
                    if ($value == 'bounceInDown') {
                        echo 'selected';
                    }
                    ?>>bounceInDown</option>
                    <option value="bounceInLeft" <?php
                    if ($value == 'bounceInLeft') {
                        echo 'selected';
                    }
                    ?>>bounceInLeft</option>
                    <option value="bounceInRight" <?php
                    if ($value == 'bounceInRight') {
                        echo 'selected';
                    }
                    ?>>bounceInRight</option>
                    <option value="bounceInUp" <?php
                    if ($value == 'bounceInUp') {
                        echo 'selected';
                    }
                    ?>>bounceInUp</option>
                </optgroup>
                <optgroup label="Fading Entrances">
                    <option value="fadeIn" <?php
                    if ($value == 'fadeIn') {
                        echo 'selected';
                    }
                    ?>>fadeIn</option>
                    <option value="fadeInDown" <?php
                    if ($value == 'fadeInDown') {
                        echo 'selected';
                    }
                    ?>>fadeInDown</option>
                    <option value="fadeInDownBig" <?php
                    if ($value == 'fadeInDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeInDownBig</option>
                    <option value="fadeInLeft" <?php
                    if ($value == 'fadeInLeft') {
                        echo 'selected';
                    }
                    ?>>fadeInLeft</option>
                    <option value="fadeInLeftBig" <?php
                    if ($value == 'fadeInLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeInLeftBig</option>
                    <option value="fadeInRight" <?php
                    if ($value == 'fadeInRight') {
                        echo 'selected';
                    }
                    ?>>fadeInRight</option>
                    <option value="fadeInRightBig" <?php
                    if ($value == 'fadeInRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeInRightBig</option>
                    <option value="fadeInUp" <?php
                    if ($value == 'fadeInUp') {
                        echo 'selected';
                    }
                    ?>>fadeInUp</option>
                    <option value="fadeInUpBig" <?php
                    if ($value == 'fadeInUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeInUpBig</option>
                </optgroup>
                <optgroup label="Fading Exits">
                    <option value="fadeOut" <?php
                    if ($value == 'fadeOut') {
                        echo 'selected';
                    }
                    ?>>fadeOut</option>
                    <option value="fadeOutDown" <?php
                    if ($value == 'fadeOutDown') {
                        echo 'selected';
                    }
                    ?>>fadeOutDown</option>
                    <option value="fadeOutDownBig" <?php
                    if ($value == 'fadeOutDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutDownBig</option>
                    <option value="fadeOutLeft" <?php
                    if ($value == 'fadeOutLeft') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeft</option>
                    <option value="fadeOutLeftBig" <?php
                    if ($value == 'fadeOutLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeftBig</option>
                    <option value="fadeOutRight" <?php
                    if ($value == 'fadeOutRight') {
                        echo 'selected';
                    }
                    ?>>fadeOutRight</option>
                    <option value="fadeOutRightBig" <?php
                    if ($value == 'fadeOutRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutRightBig</option>
                    <option value="fadeOutUp" <?php
                    if ($value == 'fadeOutUp') {
                        echo 'selected';
                    }
                    ?>>fadeOutUp</option>
                    <option value="fadeOutUpBig" <?php
                    if ($value == 'fadeOutUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutUpBig</option>
                </optgroup>
                <optgroup label="Flippers">
                    <option value="flip" <?php
                    if ($value == 'flip') {
                        echo 'selected';
                    }
                    ?>>flip</option>
                    <option value="flipInX" <?php
                    if ($value == 'flipInX') {
                        echo 'selected';
                    }
                    ?>>flipInX</option>
                    <option value="flipInY" <?php
                    if ($value == 'flipInY') {
                        echo 'selected';
                    }
                    ?>>flipInY</option>
                    <option value="flipOutX" <?php
                    if ($value == 'flipOutX') {
                        echo 'selected';
                    }
                    ?>>flipOutX</option>
                    <option value="flipOutY" <?php
                    if ($value == 'flipOutY') {
                        echo 'selected';
                    }
                    ?>>flipOutY</option>
                </optgroup>
                <optgroup label="Lightspeed">
                    <option value="lightSpeedIn" <?php
                    if ($value == 'lightSpeedIn') {
                        echo 'selected';
                    }
                    ?>>lightSpeedIn</option>
                    <option value="lightSpeedOut" <?php
                    if ($value == 'lightSpeedOut') {
                        echo 'selected';
                    }
                    ?>>lightSpeedOut</option>
                </optgroup>
                <optgroup label="Rotating Entrances">
                    <option value="rotateIn" <?php
                    if ($value == 'rotateIn') {
                        echo 'selected';
                    }
                    ?>>rotateIn</option>
                    <option value="rotateInDownLeft" <?php
                    if ($value == 'rotateInDownLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInDownLeft</option>
                    <option value="rotateInDownRight" <?php
                    if ($value == 'rotateInDownRight') {
                        echo 'selected';
                    }
                    ?>>rotateInDownRight</option>
                    <option value="rotateInUpLeft" <?php
                    if ($value == 'rotateInUpLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInUpLeft</option>
                    <option value="rotateInUpRight" <?php
                    if ($value == 'rotateInUpRight') {
                        echo 'selected';
                    }
                    ?>>rotateInUpRight</option>
                </optgroup>
                <optgroup label="Sliding Entrances">
                    <option value="slideInUp" <?php
                    if ($value == 'slideInUp') {
                        echo 'selected';
                    }
                    ?>>slideInUp</option>
                    <option value="slideInDown" <?php
                    if ($value == 'slideInDown') {
                        echo 'selected';
                    }
                    ?>>slideInDown</option>
                    <option value="slideInLeft" <?php
                    if ($value == 'slideInLeft') {
                        echo 'selected';
                    }
                    ?>>slideInLeft</option>
                    <option value="slideInRight" <?php
                    if ($value == 'slideInRight') {
                        echo 'selected';
                    }
                    ?>>slideInRight</option>
                </optgroup> 
                <optgroup label="Zoom Entrances">
                    <option value="zoomIn" <?php
                    if ($value == 'zoomIn') {
                        echo 'selected';
                    }
                    ?>>zoomIn</option>
                    <option value="zoomInDown" <?php
                    if ($value == 'zoomInDown') {
                        echo 'selected';
                    }
                    ?>>zoomInDown</option>
                    <option value="zoomInLeft" <?php
                    if ($value == 'zoomInLeft') {
                        echo 'selected';
                    }
                    ?>>zoomInLeft</option>
                    <option value="zoomInRight" <?php
                    if ($value == 'zoomInRight') {
                        echo 'selected';
                    }
                    ?>>zoomInRight</option>
                    <option value="zoomInUp" <?php
                    if ($value == 'zoomInUp') {
                        echo 'selected';
                    }
                    ?>>zoomInUp</option>
                </optgroup>
                <optgroup label="Specials">
                    <option value="hinge" <?php
                    if ($value == 'hinge') {
                        echo 'selected';
                    }
                    ?>>hinge</option>
                    <option value="jackInTheBox" <?php
                    if ($value == 'jackInTheBox') {
                        echo 'selected';
                    }
                    ?>>jackInTheBox</option>
                    <option value="rollIn" <?php
                    if ($value == 'rollIn') {
                        echo 'selected';
                    }
                    ?>>rollIn</option>
                </optgroup>
            </select>
        </div>
    </div>    
    <div class=" form-group row <?php echo $controldata; ?> <?php echo $id; ?>-duration">
        <label for="<?php echo $id; ?>-duration" class="col-sm-6 col-form-label"  oxi-addons-tooltip="Animation Duration works as Second, Set how long you want Animation" >Duration (Second)</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="form-control oxi-addons-amimation-duration" oxiexport="<?php echo $export; ?>" type="number" step="0.1" value="<?php echo $sanimation[0]; ?>" id="<?php echo $id; ?>-duration" name="<?php echo $id; ?>-duration">
        </div>
    </div>
    <div class=" form-group row <?php echo $controldata; ?> <?php echo $id; ?>-delay">
        <label for="<?php echo $id; ?>-delay" class="col-sm-6 col-form-label"  oxi-addons-tooltip="Animation Delay works for Animation deley, How long your property need to wait before show" >Delay (Second)</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="form-control oxi-addons-amimation-delay" oxiexport="<?php echo $export; ?>"  type="number" step="0.1" value="<?php echo $Animation[0]; ?>" id="<?php echo $id; ?>-delay" name="<?php echo $id; ?>-delay">
        </div>
    </div>
    <div class=" form-group row <?php echo $controldata; ?> <?php echo $id; ?>-delay">
        <label class="col-sm-6 control-label"  oxi-addons-tooltip="Do you want automatic looping as animation will continue showing">Animation Looping</label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php
                if ($Animation[1] == 'infinite') {
                    echo 'active';
                }
                ?>"> 
                    <input class="oxilab-alert-change" oxilab-alert="Amimation Looping" type="radio" <?php
                    if ($Animation[1] == 'infinite') {
                        echo 'checked';
                    }
                    ?> name="<?php echo $id; ?>-loop" id="<?php echo $id; ?>-loop-yes" autocomplete="off" value="infinite">Yes</label>

                <label class="btn btn-primary <?php
                if ($Animation[1] == '') {
                    echo 'active';
                }
                ?>"> 
                    <input class="oxilab-alert-change" oxilab-alert="Amimation Looping" type="radio" <?php
                    if ($Animation[1] == '') {
                        echo 'checked';
                    }
                    ?> name="<?php echo $id; ?>-loop" autocomplete="off" id="<?php echo $id; ?>-loop-no" value="">No </label>
            </div>
        </div>
    </div>
    <div class="oxi-3d-animation-body  <?php echo $controldata; ?>">
        <div class="oxi-3d-animation-head">
            3d Effects
        </div>
    </div>
    <?php
    echo oxi_addons_adm_help_true_false($id . '-3d-animation', $sanimation[1], 'Yes', 'true', 'No', 'false', 'Active 3D Animation?', 'Wanna Active 3D Animation?', $control);
    echo oxi_addons_adm_help_true_false($id . '-3d-inverse', $sanimation[2], 'True', 'true', 'False', 'false', 'Animation Inverse?', 'Wanna Active Inverse Animation?', $control);
    echo oxi_addons_adm_help_number($id . '-3d-perspective', $sanimation[3], 5, 'Perspective', 'Set perspective value for your 3D Animation', $control);
    echo oxi_addons_adm_help_number($id . '-3d-maxRotation', $sanimation[4], 0.1, 'Max Rotation', 'Set Max Rotation value for your 3D Animation', $control);
    echo oxi_addons_adm_help_number($id . '-3d-animationDuration', $sanimation[5], 0.1, 'Animation Duration', 'Set Animation Duration value for your 3D Animation', $control);
    ?>
    <?php
    $jquery = 'oxiAddonsAnimation("#' . $id . '", ".' . $id . '-duration", ".' . $id . '-delay");
                jQuery("#' . $id . '").on("change", function () {
                     oxiAddonsAnimation("#' . $id . '", ".' . $id . '-duration", ".' . $id . '-delay");
                })';
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

/**
 * Transform Property field selector
 * works at layouts page to adding Transform Property field
 */
function OxiAddonsTransformProperty($id = null, $value = null, $name = null, $title = null, $control = null, $export = null) {
    ?>
    <div class="form-group row">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label"  oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?> </label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <select class="form-control OxiAddonsTransformPropertyData" oxiexport='<?php echo $export; ?>'   id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="oxi-addons-transform-left-to-right" <?php
                if ($value == 'oxi-addons-transform-left-to-right') {
                    echo 'selected';
                }
                ?>>Left to Right</option>
                <option value="oxi-addons-transform-right-to-left" <?php
                if ($value == 'oxi-addons-transform-right-to-left') {
                    echo 'selected';
                }
                ?>>Right to Left</option>
                <option value="oxi-addons-transform-top-to-bottom" <?php
                if ($value == 'oxi-addons-transform-top-to-bottom') {
                    echo 'selected';
                }
                ?>>Top to Bottom</option>
                <option value="oxi-addons-transform-bottom-to-top" <?php
                if ($value == 'oxi-addons-transform-bottom-to-top') {
                    echo 'selected';
                }
                ?>>Bottom to Top</option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * Border size and type field selector
 * works at layouts page to adding Border size and type field
 */
function oxi_addons_adm_help_border($id = null, $size = null, $type = null, $name = null, $title = null, $control = 'true', $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <input type="number" class="form-control oxi_addons_adm_help_border-size" oxiexport="<?php echo $export; ?>" step="1" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $size; ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <select class="form-control oxi_addons_adm_help_border-type" oxiexport="<?php echo $export; ?>" id="<?php echo $id; ?>-type" name="<?php echo $id; ?>-type">
                <option value="dotted" <?php
                if ($type == 'dotted') {
                    echo 'selected';
                }
                ?>>Dotted</option>
                <option value="dashed" <?php
                if ($type == 'dashed') {
                    echo 'selected';
                }
                ?>>Dashed</option>
                <option value="solid" <?php
                if ($type == 'solid') {
                    echo 'selected';
                }
                ?>>Solid</option>
                <option value="double" <?php
                if ($type == 'double') {
                    echo 'selected';
                }
                ?>>Double</option>
                <option value="groove" <?php
                if ($type == 'groove') {
                    echo 'selected';
                }
                ?>>Groove</option>
                <option value="ridge" <?php
                if ($type == 'ridge') {
                    echo 'selected';
                }
                ?>>Ridge</option>           
                <option value="inset" <?php
                if ($type == 'inset') {
                    echo 'selected';
                }
                ?>>Inset</option>
                <option value="outset" <?php
                if ($type == 'outset') {
                    echo 'selected';
                }
                ?>>Outset</option>
                <option value="none" <?php
                if ($type == 'none') {
                    echo 'selected';
                }
                ?>>None</option>
                <option value="hidden" <?php
                if ($type == 'hidden') {
                    echo 'selected';
                }
                ?>>Hidden</option>
                <option value="none" <?php
                if ($type == 'none') {
                    echo 'selected';
                }
                ?>>None</option>
            </select>  
        </div>
    </div>
    <?php
}

function oxi_addons_adm_help_multiple_selection_style_1($id = null, $value = null, $name = null, $title = null, $control = null) {
    echo oxi_addons_admin_select2();
    ?>
    <div class="form-group">
        <label>Example of multiple select</label>
        <select class="oxi-addons-multiple-select" multiple>
            <?php
            foreach (get_post_types('', 'names') as $post_type) {
                echo '<option>' . $post_type . '</option>';
            }
            ?>
        </select>
    </div>
    <?php
}

/**
 * Textbox field selector
 * works at layouts page to adding Textbox field
 */
function oxi_addons_adm_help_textbox($id = null, $value = null, $name = null, $title = null, $control = null, $export = null) {

    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?> <?php echo $controldata; ?>">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label" oxi-addons-tooltip="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="col-sm-6 addons-dtm-laptop-lock">
            <input class="form-control" type="text" value="<?php echo OxiAddonsUrlConvert($value); ?>" id='<?php echo $id; ?>'  name="<?php echo $id; ?>">
        </div>
    </div>
    <?php
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").keyup(function () {
                      jQuery("' . $export . '").html(jQuery(this).val());
                });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

function oxi_addons_adm_help_modal_textbox($id = null, $value = null, $name = null, $title = null) {
    echo '  <div class="form-group">
                    <label for="' . $id . '">' . $name . '</label>
                    <input type="text " class="form-control" id="' . $id . '" name="' . $id . '" value="' . $value . '">
                    <small class="form-text text-muted">' . $title . '</small>
                </div>';
}

function oxi_addons_adm_help_modal_textarea($id = null, $value = null, $name = null, $title = null) {
    echo '  <div class="form-group">
                    <label for="' . $id . '">' . $name . '</label>
                    <textarea class="form-control" rows="4" id="' . $id . '" name="' . $id . '">' . $value . '</textarea>
                    <small class="form-text text-muted">' . $title . '</small>
                </div>';
}

/**
 * Image Upload field selector
 * works at layouts page to adding Image Upload field
 */
function oxi_addons_adm_help_body_image_upload($id = null, $value = null, $name = null, $title = null, $control = null) {

    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">       
        <div class="col-sm-8 addons-dtm-laptop-lock" style="padding-right: 0px;">
            <input type="text "class="form-control" style="padding-right: 4px; padding-left: 4px;" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo OxiAddonsUrlConvert($value); ?>">
        </div>
        <div class="col-sm-4 addons-dtm-laptop-lock">
            <button type="button" oxiimage="#<?php echo $id; ?>" class="oxi-addons-body-image-button btn btn-default">Upload</button>
        </div>
    </div>
    <?php
}

/**
 * Image Modal form Upload field selector
 * works at layouts page to adding Image Modal form Upload field
 */
function oxi_addons_adm_help_model_image_upload($id = null, $value = null, $name = null, $title = null, $control = null) {

    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">       
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>

        <div class="col-sm-3 addons-dtm-laptop-lock" style="padding-right: 0px;">
            <input type="text "class="form-control" style="padding-right: 4px; padding-left: 4px;" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo OxiAddonsUrlConvert($value); ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop-lock text-center">
            <button type="button" oxiimage="#<?php echo $id; ?>" class="oxi-addons-modal-image-button btn btn-default">Upload</button>
        </div>
    </div>
    <?php
}

function oxi_addons_adm_help_modal_second_image_upload($id = null, $value = null, $name = null, $title = null) {
    echo '  <div class="form-group row">
                    <label class="col-sm-12" for="' . $id . '">' . $name . '</label>
                    <div class="col-sm-8 addons-dtm-laptop-lock" style="padding-right: 0px;">
                        <input type="text "class="form-control" style="padding-right: 4px; padding-left: 4px;" id="' . $id . '" name="' . $id . '" value="' . OxiAddonsUrlConvert($value) . '">
                    </div>
                    <div class="col-sm-4 addons-dtm-laptop-lock text-center">
                        <button type="button" oxiimage="#' . $id . '" class="oxi-addons-modal-image-button btn btn-default">Upload</button>
                    </div>
                    <small class="form-text text-muted col-sm-12">' . $title . '</small>
                </div>';
}

/**
 * Image Body Upload field selector
 * works at layouts page to adding Image Body Upload field
 */
function oxi_addons_adm_help_image_upload($id = null, $value = null, $name = null, $title = null, $control = null) {

    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">       
        <label for="<?php echo $id; ?>" class="col-sm-6 control-label" oxi-addons-tooltip="<?php echo $title; ?>" ><?php echo $name; ?> </label>

        <div class="col-sm-3 addons-dtm-laptop-lock" style="padding-right: 0px;">
            <input type="text "class="form-control" style="padding-right: 4px; padding-left: 4px;" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo OxiAddonsUrlConvert($value); ?>">
        </div>
        <div class="col-sm-3 addons-dtm-laptop-lock">
            <button type="button" oxiimage="#<?php echo $id; ?>" class="oxi-addons-body-image-button btn btn-default">Upload</button>
        </div>
    </div>
    <?php
}

/**
 * Responsive Icon  selector
 * works at layouts page to adding Responsive Icon 
 */
function oxi_addons_adm_help_form_dtm_mode() {
    ?>
    <div class="modal-footer">
        <div class="oxi-addons-setting-save-dtm-mode">
            <div class="oxi-addons-material-icons active" oxi-dtm="addons-dtm-laptop" oxi-mode="laptop" oxi-addons-tooltip="Set Your Property Viewing Property Mode">
                <?php
                echo oxi_addons_admin_font_awesome('desktop');
                ?>
            </div>
            <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-tab" oxi-mode="tab" oxi-addons-tooltip="Set Your Property Viewing Property Mode">
                <?php
                echo oxi_addons_admin_font_awesome('tablet');
                ?>
            </div>
            <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-mobile" oxi-mode="mobile" oxi-addons-tooltip="Set Your Property Viewing Property Mode">
                <?php
                echo oxi_addons_admin_font_awesome('mobile');
                ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Textarea Field  selector
 * works at layouts page to adding Textarea Field 
 */
function oxi_addons_adm_help_textarea($id = null, $value = null, $control = null, $export = null) {

    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    ?>
    <div class=" form-group row <?php echo $controldata; ?>">
        <textarea id="<?php echo $id; ?>" class="addons-dtm-laptop-lock" name="<?php echo $id; ?>"><?php echo OxiAddonsUrlConvert($value); ?></textarea>
    </div>
    <?php
    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").keyup(function () {
                      jQuery("' . $export . '").html(jQuery(this).val());
                });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * Form Textarea Field  selector
 * works at layouts page to adding  Form Textarea Field 
 */
function oxi_addons_adm_help_form_textarea($id = null, $value = null, $name = null, $title = null, $control = null, $export = null) {
    if ($control == 'true') {
        $controldata = 'oxi-addons-admin-lite-version';
    } else {
        $controldata = '';
    }
    echo '<div class="form-group ' . $controldata . '"  oxi-addons-tooltip="' . $title . '" >
               <label for="' . $id . '">' . $name . '</label>
               <textarea class="form-control" id="' . $id . '"  name="' . $id . '" rows="3" style=" min-height: 80px;">' . OxiAddonsUrlConvert($value) . '</textarea>
          </div>';

    if (!empty($export)) {
        $jquery = 'jQuery("#' . $id . '").keyup(function () {
                      jQuery("' . $export . '").html(jQuery(this).val());
                });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
}

/**
 * Wordpress TextArea Field  selector
 * works at layouts page to adding Wordpress TextArea Field 
 */
function oxi_addons_adm_help_model_rich_text_box($id, $files) {
    wp_editor(OxiAddonsTextConvert($files), $id, $settings = array(
        'textarea_name' => $id,
        'wpautop' => false,
        'force_br_newlines' => true,
        'force_p_newlines' => false)
    );
    ?>
    <script type="text/javascript">
        var str = '<script type="text/javascript">';
        str += 'setTimeout(function () {';
        str += ' jQuery(".media-button-insert").on("click", function () {';
        str += ' jQuery("#oxi-addons-list-data-modal").css({"overflow-x": "hidden", "overflow-y": "auto"});jQuery("body").css({ "overflow" : "hidden" });';
        str += ' });';
        str += ' jQuery(".media-modal-close").on("click", function () {';
        str += ' jQuery("#oxi-addons-list-data-modal").css({"overflow-x": "hidden", "overflow-y": "auto"});jQuery("body").css({ "overflow" : "hidden" });';
        str += '});';
        str += '}, 1000);';
        str += '<';
        str += '/script>';
        jQuery('#insert-media-button').on('click', function () {
            jQuery(str).appendTo("#wpwrap");
        });
    </script>
    <?php
}

function oxi_addons_adm_help_support($oxitype) {
    echo '';
}

/**
 * Preview not works jQuery selector
 * works at layouts page to adding Preview not works jQuery
 */
function oxi_addons_adm_help_nonjs_popup($id, $title) {
    wp_add_inline_script('jquery.bootstrap-growl', 'jQuery("#' . $id . '").on("change", function () {
                                                        var data = "<strong>' . $title . '</strong> will works after saved data";
                                                        jQuery.bootstrapGrowl(data, {});                                 
                                                    }); ');
}

/**
 * Shortcode name change Field
 * works at Shortcode Addons page to adding Shortcode name change
 */
function oxi_addons_shortcode_namechange($oxiid, $name) {
    echo '  <div class="oxi-addons-shortcode">
                <div class="oxi-addons-shortcode-heading">
                    Shortcode Name
                </div>
                <div class="oxi-addons-shortcode-body">
                    <form method="post">
                        <div class="input-group mb-3" oxi-addons-tooltip="Set your Future Name for this Shortcode">
                            <input type="hidden" class="form-control" name="addonsstylenameid" value="' . $oxiid . '">
                            <input type="text" class="form-control" name="addonsstylename" value="' . $name . '">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-success" name="addonsstylenamechange" value="Save">
                            </div>
                        </div>
                        ' . wp_nonce_field('oxi-addons-style-name-change') . '
                    </form>
                </div>
            </div>';
}

/**
 * Shortcode selector Body
 * works at layouts page to adding Shortcode Selector Body
 */
function oxi_addons_shortcode_call($oxitype, $oxiid) {
    echo '<div class="oxi-addons-shortcode">
                <div class="oxi-addons-shortcode-heading">
                    Shortcodes
                </div>
                <div class="oxi-addons-shortcode-body">
                    <em>Shortcode for posts/pages/plugins</em>
                    <p>Copy &amp; paste the shortcode directly into any WordPress post, page or Page Builder.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[oxi_addons id=&quot;' . $oxiid . '&quot;]">
                    <span></span>
                    <em>Shortcode for templates/themes</em>
                    <p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[oxi_addons  id=&quot;' . $oxiid . '&quot;]&#039;); ?&gt;">
                    <span></span>                       
                </div>
            </div>';
}

/**
 * Shortcode Add new data button
 * works at layouts page to adding new data
 */
function oxi_addons_list_modal_open($title = 'Add New Items') {

    echo '<div class="oxi-addons-item-form">
            <div class="oxi-addons-item-form-heading">
               ' . $title . '
            </div>
            <div class="oxi-addons-item-form-item" id="oxi-addons-list-data-modal-open">
                <span>
                    ' . oxi_addons_admin_font_awesome('plus') . '
                        ' . $title . '
                </span>
            </div>
        </div>';
}

/**
 * shortcode data rearrange field selector
 * works at layouts page to adding shortcode data rearrange button
 */
function oxi_addons_list_rearrange($title = FALSE, $listdata = FALSE, $listitemid = FALSE, $listitemtype = 'title') {
    echo '<div class="oxi-addons-item-form">
            <div class="oxi-addons-item-form-heading">
                ' . $title . '
            </div>
            <div class="oxi-addons-item-form-item" id="oxi-addons-list-rearrange-modal-open">
                <span>
                    ' . oxi_addons_admin_font_awesome('fa-cog') . '
                </span>
                
            </div>
        </div>';
    ?>
    <div id="oxi-addons-list-rearrange-modal" class="modal fade bd-example-modal-sm" role="dialog">
        <div class="modal-dialog modal-sm">
            <form id="oxi-addons-form-rearrange-submit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo $title; ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="alert text-center" id="oxi-addons-list-rearrange-saving">
                            <?php echo oxi_addons_admin_font_awesome('fa-cog') ?>
                        </div>
                        <?php
                        echo ' <ul class="list-group" id="oxi-addons-list-rearrange">';
                        foreach ($listdata as $value) {
                            $listitemdata = explode('||#||', $value['files']);
                            if ($listitemtype == 'icon') {
                                echo '<li class="list-group-item" id ="' . $value['id'] . '">' . oxi_addons_font_awesome($listitemdata[($listitemid)]) . '</li>';
                            } else if ($listitemtype == 'image') {
                                echo '<li class="list-group-item" id ="' . $value['id'] . '"><img src="' . OxiAddonsUrlConvert($listitemdata[($listitemid)]) . '"></li>';
                            } else {
                                echo '<li class="list-group-item" id ="' . $value['id'] . '">' . ($listitemdata[($listitemid)]) . '</li>';
                            }
                        }
                        echo '</ul>';
                        ?>
                    </div>
                    <div class="modal-footer">    
                        <input type="hidden" name="oxi-addons-admin-ajax-nonce" id="oxi-addons-admin-ajax-nonce" value="<?php echo wp_create_nonce("oxi_addons_admin_ajax_nonce"); ?>"/>
                        <button type="button" id="oxi-addons-list-rearrange-close" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" id="oxi-addons-list-rearrange-submit" class="btn btn-primary" value="submit">
                    </div>
                </div>
            </form>
        </div>
    </div> 
    <?php
}

/**
 * Quick Tutorials button
 * works at layouts page to adding quick tutorials button
 */
function oxi_addons_quick_tutorials($data) {
    if (!empty($data)) {
        echo '<div class="oxi-addons-item-form">
            <div class="oxi-addons-item-form-heading">
                Quick Tutorials
            </div>
            <a class="oxi-addons-item-form-item oxi-addons-tutorials" youtubeid="' . $data . '" oxi-addons-tooltip="View Our toturials for this Elements">
                <span>
                    ' . oxi_addons_admin_font_awesome('youtube') . '
                </span>
            </a>
        </div>';
    }
}

/**
 * Shortcode Addons Menu 
 * works at all page to adding menu
 */
function OxiAddonsAdmAdminMenu($oxitype, $youtube = '', $others = '', $control = '') {
    $status = get_option('oxi_addons_license_status');
    $prolink = '';
    if ($status != 'valid') {
        $prolink = ' <li><a target="_blank" class="oxi-addons-promote" href="https://www.oxilab.org/downloads/short-code-addons/">Upgrade Today ' . oxi_addons_admin_font_awesome('fa-external-link') . '</a></li>';
        $jquery = 'jQuery(".oxi-addons-CF-data").each(function (index, value) {   
                            jQuery(this).closest(".col-sm-6").siblings(".col-sm-6.control-label").append(" <span class=\"oxi-pro-only\">Pro</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery("#oxi-addons-form-submit").submit(function () {
                            jQuery(".oxi-addons-CF-data").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                        });';
        wp_add_inline_script('oxi-addons-vendor', $jquery);
    }
    if ($others == '') {
        echo '<div class="oxi-addons-wrapper">
                <ul class="oxilab-admin-menu">
                    <li><a href="' . oxi_addons_admin_menu_link('') . '">Shortcode Elements</a></li>
                    <li><a href="' . oxi_addons_admin_menu_link($oxitype) . '">' . oxi_addons_shortcode_name_converter($oxitype) . ' Settings</a></li>
                     <li><a href="' . oxi_addons_admin_menu_link('import-data') . '">Import Layouts</a></li>
                    <li><a href="' . oxi_addons_admin_menu_link('settings') . '">Settings</a></li> ';
        if ($youtube != '') {
            echo '<li>
                <a class="oxilab-admin-menu-quick oxi-addons-tutorials" youtubeid="' . $youtube . '" oxi-addons-tooltip="View Our Tutorials for this Elements">
                    <span>
                        ' . oxi_addons_admin_font_awesome('youtube') . '
                    </span>
                </a>
            </li>';
        }
        echo $prolink;
        echo '</ul>
    </div>';
        if ($control == '' && $status != 'valid') {
            $url = admin_url("admin.php?page=oxi-addons-import&oxitype=oxiprofile");
            echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
            exit;
        }
        $jquery = 'setTimeout(function () {
                                        jQuery(".oxi-addons-tutorials").grtyoutube({autoPlay: true, theme: "light"});
                                    }, 500);';
        wp_add_inline_script('YouTubePopUps', $jquery);
    } else {
        $youtube .= 'Ovvqi7iZJ-s';
        echo '<div class="oxi-addons-wrapper">
        <ul class="oxilab-admin-menu">
            <li><a href="' . oxi_addons_admin_menu_link('') . '">Shortcode Elements</a></li>
            <li><a href="' . oxi_addons_admin_menu_link('import') . '">Import Elements</a></li>
            <li><a href="' . oxi_addons_admin_menu_link('import-data') . '">Import Layouts</a></li>
            <li><a href="' . oxi_addons_admin_menu_link('settings') . '">Settings</a></li>';
        if ($youtube != '') {
            echo '<li>
                <a class="oxilab-admin-menu-quick oxi-addons-tutorials" youtubeid="' . $youtube . '" oxi-addons-tooltip="View Our Tutorials for this Elements">
                    <span>
                        ' . oxi_addons_admin_font_awesome('youtube') . '
                    </span>
                </a>
            </li>';
        }
        echo $prolink;
        $jquery = 'setTimeout(function () {
                                        jQuery(".oxi-addons-tutorials").grtyoutube({autoPlay: true, theme: "light"});
                                    }, 500);';

        wp_add_inline_script('YouTubePopUps', $jquery);
        echo '</ul>
    </div>';
    }
}

/**
 * Shortcode table
 * works at Style page to viewing shortcode
 */
function OxiAddonsAdmAdminShortcodeTable($data, $oxitype) {
    oxi_addons_font_familly('Bree+Serif');
    oxi_addons_font_familly('Source+Sans+Pro');
    ?>
    <div class="oxi-addons-wrapper">
        <div class="oxi-addons-row">
            <div class="oxi-addons-wrapper">
                <div class="oxi-addons-import-layouts">
                    <h1>Shortcode Addons ›
                        <?php echo oxi_addons_shortcode_name_converter($oxitype); ?>
                    </h1>
                    <p> View our  <?php echo oxi_addons_shortcode_name_converter($oxitype); ?> from Demo and select Which one You Want</p>
                </div>
            </div>
            <?php
            echo OxiAddonsDemoDataLayouts($data, $oxitype);
            ?>
        </div>
    </div>
    <?php
//    echo '<div class="oxi-addons-wrapper">
//                <div class="oxi-addons-row">
//                    <div class="oxi-addons-view-more-demo">
//                        <div class="oxi-addons-view-more-demo-data" >
//                            <div class="oxi-addons-view-more-demo-icon">
//                                <i class="fas fa-bullhorn oxi-icons"></i>
//                            </div>
//                            <div class="oxi-addons-view-more-demo-text">
//                                <div class="oxi-addons-view-more-demo-heading">
//                                    More Layouts
//                                </div>
//                                <div class="oxi-addons-view-more-demo-content">
//                                    Thank you for using Shortcode Addons. As limitation of viewing Layouts or Design we added some layouts. Kindly check more  <a target="_blank" href="https://www.oxilab.org/shortcode-addons-features/' . str_replace('_', '-', $oxitype) . '" >' . oxi_addons_shortcode_name_converter($oxitype) . '</a> design from Oxilab.org. Copy <strong>export</strong> code and <strong>import</strong> it, get your preferable layouts.
//                                </div>
//                            </div>
//                            <div class="oxi-addons-view-more-demo-button">
//                                <a target="_blank" class="oxi-addons-more-layouts" href="https://www.oxilab.org/shortcode-addons-features/' . str_replace('_', '-', $oxitype) . '" >View layouts</a>
//                            </div>
//                        </div>
//                    </div>
//                </div>
//           </div>';
}

/**
 * home tutorials field
 * works at home page to adding youtube tutorials
 */
function oxi_addons_home_quick_tutorials($data) {
    if (!empty($data)) {
        echo '<div class="oxi-addons-home-item-form">            
                <a class="oxi-addons-home-item-form-item oxi-addons-tutorials" youtubeid="' . $data . '"  oxi-addons-tooltip="View Our toturials for this Elements">
                    <span>
                        ' . oxi_addons_admin_font_awesome('youtube') . '
                    </span>
                    <?php ?>
                </a>
            </div>';
        $jquery = 'setTimeout(function () {
                                        jQuery(".oxi-addons-tutorials").grtyoutube({autoPlay: true, theme: "light"});
                                    }, 500);';
        wp_add_inline_script('YouTubePopUps', $jquery);
    }
}

/**
 * Responsive settings tab button
 * works at all page to adding responsive settings tab
 */
function oxiaddonssettingsavedtmmode() {
    echo '<div class="oxi-addons-setting-save-dtm-mode">
                <div class="oxi-addons-material-icons active" oxi-dtm="addons-dtm-laptop" oxi-mode="laptop">
                    ' . oxi_addons_admin_font_awesome('desktop') . '
                </div>
                <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-tab" oxi-mode="tab">
                    ' . oxi_addons_admin_font_awesome('tablet') . '
                </div>
                <div class="oxi-addons-material-icons" oxi-dtm="addons-dtm-mobile" oxi-mode="mobile">
                    ' . oxi_addons_admin_font_awesome('mobile') . '
                </div>
            </div>';
}

/**
 * Admin Url Converter field
 * works at layouts page to convert url
 */
function OxiAddonsAdminUrlConvert($data) {
    $homeurl = home_url();
    $url = 'OxiAddonsUrl./';
    $data = str_replace($homeurl, $url, $data);
    $data = sanitize_text_field($data);
    return $data;
}

/**
 * Font Awesome sanitize 
 * works at layouts page while data saved
 */
function OxiAddonsAdminFontAwesomeSenitize($data) {
    $doubleclonetrue = strpos($data, '"');
    $doubleclonehtmltrue = strpos($data, '&quot;');
    $singleclonehtmltrue = strpos($data, '&apos;');
    $clonetrue = strpos($data, "'");
    if ($clonetrue !== FALSE) {
        $data = str_replace("\\'", "'", $data);
        $data = str_replace("\'", "'", $data);
        $data = explode("'", $data);
        $data = $data[1];
    } elseif ($doubleclonetrue !== FALSE) {
        $data = str_replace('\\"', '"', $data);
        $data = str_replace('\"', '"', $data);
        $data = explode('"', $data);
        $data = $data[1];
    } elseif ($doubleclonehtmltrue !== FALSE) {
        $data = str_replace('\\&quot;', '"', $data);
        $data = str_replace('\&quot;', '"', $data);
        $data = str_replace('\&quot;', '"', $data);
        $data = explode('"', $data);
        $data = $data[1];
    } elseif ($singleclonehtmltrue !== FALSE) {
        $data = str_replace('\\&apos;', '"', $data);
        $data = str_replace('\&apos;', '"', $data);
        $data = str_replace('\&apos;', '"', $data);
        $data = explode('"', $data);
        $data = $data[1];
    } else {
        $data = $data;
    }
    $data = sanitize_text_field($data);
    return $data;
}

/**
 * font settings sanitize 
 * works at layouts page to adding font Settings sanitize
 */
function OxiAddonsADMHelpTextSenitize($data) {
    $data = str_replace('\\\\"', '&quot;', $data);
    $data = str_replace('\\\"', '&quot;', $data);
    $data = str_replace('\\"', '&quot;', $data);
    $data = str_replace('\"', '&quot;', $data);
    $data = str_replace('"', '&quot;', $data);
    $data = str_replace('\\\\&quot;', '&quot;', $data);
    $data = str_replace('\\\&quot;', '&quot;', $data);
    $data = str_replace('\\&quot;', '&quot;', $data);
    $data = str_replace('\&quot;', '&quot;', $data);
    $data = str_replace("\\\\'", '&apos;', $data);
    $data = str_replace("\\\'", '&apos;', $data);
    $data = str_replace("\\'", '&apos;', $data);
    $data = str_replace("\'", '&apos;', $data);
    $data = str_replace("\\\\&apos;", '&apos;', $data);
    $data = str_replace("\\\&apos;", '&apos;', $data);
    $data = str_replace("\\&apos;", '&apos;', $data);
    $data = str_replace("\&apos;", '&apos;', $data);
    $data = str_replace("'", '&apos;', $data);
    $data = str_replace('<', '&lt;', $data);
    $data = str_replace('>', '&gt;', $data);
    $data = sanitize_text_field($data);
    return $data;
}

/**
 * Border sanitize 
 * works at layouts page to adding Border Settings sanitize
 */
function OxiAddonsADMHelpBorderSanitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST['' . $id . '-type']) . '|' . sanitize_text_field($_POST['' . $id . '-color']) . '|';
    return $data;
}

/**
 * Border size and type settings sanitize 
 * works at layouts page to adding Border size and type Settings sanitize
 */
function OxiAddonsADMHelpBorderSizeType($id) {
    $data = $id . ' |' . sanitize_text_field($_POST['' . $id . '']) . '|' . sanitize_text_field($_POST['' . $id . '-type']) . '||';
    return $data;
}

/**
 * font settings sanitize 
 * works at layouts page to adding font Settings sanitize
 */
function OxiAddonsADMHelpFontSettingsSanitize($id) {
    $data = $id . '-family |' . sanitize_text_field($_POST['' . $id . '-family']) . '|' . sanitize_text_field($_POST['' . $id . '-weight']) . '|';
    $data .= $id . '-style |' . sanitize_text_field($_POST['' . $id . '-style']) . '';
    if (!empty($_POST['' . $id . '-line-height'])) {
        $data .= ':' . sanitize_text_field($_POST['' . $id . '-line-height']) . '';
    }
    $data .= '|';
    if (!empty($_POST['' . $id . '-align'])) {
        $data .= '' . sanitize_text_field($_POST['' . $id . '-align']) . '';
    }
    if (!empty($_POST['' . $id . '-align'])) {
        $data .= ':' . sanitize_text_field($_POST['' . $id . '-text-shadow-horizontal']) . '()' . sanitize_text_field($_POST['' . $id . '-text-shadow-vertical']) . '()' . sanitize_text_field($_POST['' . $id . '-text-shadow-blur-radius']) . '()' . sanitize_text_field($_POST['' . $id . '-text-shadow-color']) . '';
    } else {
        $data .= ':';
    }
    if (!empty($_POST['' . $id . '-letter-spacing'])) {
        $data .= ':' . sanitize_text_field($_POST['' . $id . '-letter-spacing']) . '';
    } else {
        $data .= ':';
    }
    $data .= '|';
    return $data;
}

/**
 * background settings sanitize 
 * works at layouts page to adding background Settings sanitize
 */
function OxiAddonsBGImageSanitize($id) {
    $data = $id . '|' . sanitize_text_field($_POST[$id . '-color']) . '|' . sanitize_text_field(OxiAddonsAdminUrlConvert($_POST[$id . '-image'])) . '||';
    return $data;
}

/**
 * padding margin settings sanitize 
 * works at layouts page to adding padding margin Settings sanitize
 */
function oxi_addons_adm_help_padding_margin_senitize($id) {
    $data = $id . '-top |' . (int) $_POST[$id . '-laptop-top'] . '|' . (int) ($_POST[$id . '-tab-top']) . '|' . (int) ($_POST[$id . '-mobile-top']) . '|';
    $data .= $id . '-bottom |' . (int) $_POST[$id . '-laptop-bottom'] . '|' . (int) ($_POST[$id . '-tab-bottom']) . '|' . (int) ($_POST[$id . '-mobile-bottom']) . '|';
    $data .= $id . '-left |' . (int) $_POST[$id . '-laptop-left'] . '|' . (int) ($_POST[$id . '-tab-left']) . '|' . (int) ($_POST[$id . '-mobile-left']) . '|';
    $data .= $id . '-right |' . (int) $_POST[$id . '-laptop-right'] . '|' . (int) ($_POST[$id . '-tab-right']) . '|' . (int) ($_POST[$id . '-mobile-right']) . '|';
    return $data;
}

/**
 * box shadow settings sanitize 
 * works at layouts page to adding box shadow Settings sanitize
 */
function OxiAddonsADMBoxShadowSanitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST[$id . '-color']) . '|' . sanitize_text_field($_POST[$id . '-horizontal']) . '|' . sanitize_text_field($_POST[$id . '-vertical']) . '|' . sanitize_text_field($_POST[$id . '-blur']) . '|' . sanitize_text_field($_POST[$id . '-spread']) . '|';
    return $data;
}

/**
 * inner box shadow settings sanitize 
 * works at layouts page to adding inner box shadow Settings sanitize
 */
function OxiAddonsADMinnerBoxShadowSanitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST[$id . '-color']) . '|' . $id . '-inner' . '|' . sanitize_text_field($_POST[$id . '-inner']) . '|';
    return $data;
}

/**
 * animation settings sanitize 
 * works at layouts page to adding animation Settings sanitize
 */
function oxi_addons_adm_help_animation_senitize($id) {
    $data = $id . '|' . sanitize_text_field($_POST[$id]) . '|'
            . '' . sanitize_text_field($_POST[$id . '-duration']) . ':'
            . '' . sanitize_text_field($_POST[$id . '-3d-animation']) . ':'
            . '' . sanitize_text_field($_POST[$id . '-3d-inverse']) . ':'
            . '' . sanitize_text_field($_POST[$id . '-3d-perspective']) . ':'
            . '' . sanitize_text_field($_POST[$id . '-3d-maxRotation']) . ':'
            . '' . sanitize_text_field($_POST[$id . '-3d-animationDuration']) . ''
            . '|' . sanitize_text_field($_POST[$id . '-delay']) . '//' . sanitize_text_field($_POST[$id . '-loop']) . '|';
    return $data;
}

/**
 * responsive number settings sanitize 
 * works at layouts page to adding responsive number Settings sanitize
 */
function oxi_addons_adm_help_single_size($id) {
    $data = $id . '|' . (int) $_POST[$id] . '|' . (int) $_POST[$id . '-tab'] . '|' . (int) $_POST[$id . '-mobile'] . '|';
    return $data;
}

/**
 * responsive class settings sanitize 
 * works at layouts page to adding responsive class Settings sanitize
 */
function OxiAddonsADMHelpItemPerRowsSanitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST[$id . '-laptop']) . '|' . sanitize_text_field($_POST[$id . '-tab']) . '|' . sanitize_text_field($_POST[$id . '-mobile']) . '|';
    return $data;
}

/**
 * Text Shadow sanitize 
 * works at layouts page to adding Text Shadow Settings sanitize
 */
function OxiAddonsADMHelpTextShadowSanitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST[$id . '-text-shadow-horizontal']) . '|' . sanitize_text_field($_POST[$id . '-text-shadow-vertical']) . '|' . sanitize_text_field($_POST[$id . '-text-shadow-blur-radius']) . '|' . sanitize_text_field($_POST[$id . '-text-shadow-color']) . '||';
    return $data;
}

/**
 * data settings sanitize 
 * works at layouts page to adding data Settings sanitize
 */
function OxiAddonsADMHelpDataSerializeSanitrize() {
    $data = 'OxiAddPR-TC-Serial|' . sanitize_text_field($_POST['OxiAddPR-TC-Serial']) . '|';
    return $data;
}

/**
 * number settings sanitize 
 * works at layouts page to adding number Settings sanitize
 */
function oxi_addons_adm_help_number_dtm_senitize($id) {
    $data = $id . ' |' . sanitize_text_field($_POST[$id . '']) . '|' . sanitize_text_field($_POST[$id . '-tab']) . '|' . sanitize_text_field($_POST[$id . '-mobile']) . '|';
    return $data;
}

/**
 * alert for no jquery settings
 * works at layouts page to adding alert for no jQuery
 */
function OxiAddonsADMHelpNoJquery($Array = FALSE, $id = FALSE, $title = FALSE) {
    $jquery = '';
    if (is_array($Array)) {
        sort($Array);
        foreach ($Array as $value) {
            $jquery .= 'jQuery("#' . $value[0] . '").on("change", function () {
                    var data = "<strong>' . $value[1] . '</strong> will works after saved data";
                    jQuery.bootstrapGrowl(data, {});
                });';
        }
    } else {
        $jquery .= 'jQuery("#' . $id . '").on("change", function () {
                    var data = "<strong>' . $title . '</strong> will works after saved data";
                    jQuery.bootstrapGrowl(data, {});
                });';
    }
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

$supportdata = '<div class="oxi-addons-support">
                    <div class="oxi-addons-support-btn">
                      ' . oxi_addons_admin_font_awesome('fa-cog fa-spin') . '
                        Need any Support?
                    </div>
                </div>';
$supportdata = preg_replace("/\r\n|\r|\n/", ' ', $supportdata);
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery(window).width() >= 900) {
            jQuery("#wpcontent").append('<?php echo $supportdata; ?>');
        }
        jQuery(".oxi-addons-support").click(function () {
            window.open("https://wordpress.org/support/plugin/shortcode-addons/", '_blank');
        });
        setTimeout(function () {
            jQuery(".oxi-addons-support").fadeIn("slow");
        }, 2500);
    });
</script>
<?php 