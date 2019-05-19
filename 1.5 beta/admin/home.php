<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();

/**
 * Home Page
 * Shortcode Addons home page
 */
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
$oxitype = 'oxi-addons';
$directory = OxiAddonsElements;
if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if (!empty($_POST['OxiElementsDLT']) && $_POST['OxiElementsDLT'] == 'Delete') {
    if (!wp_verify_nonce($nonce, 'Oxi-Addons-Delete-Elements-Nonce')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $folder = sanitize_text_field($_POST['OXIAddonsElements']);
        if ($folder != 'user_control') {
            $target_folder = OxiAddonsElements . $folder . '/';
            WP_Filesystem();
            global $wp_filesystem;
            $wp_filesystem->rmdir($target_folder, true);
        }
    }
}

/**
 * Adding more elements with custom slug
 */
$DIRfiles = glob($directory . '*', GLOB_ONLYDIR);
$importdata = Array();
foreach ($DIRfiles as $value) {
    $file = explode('/OxiAddonsElements/', $value);
    if (!empty($value)) {
        $importdata[$file[1]] = array(
            'type' => 'oxi-addons',
            'name' => $file[1],
            'homepage' => $file[1],
            'slug' => 'oxi-addons');
    }
}

$alldata = array(
    array(
        'Content Elements',
        array('accordion', 'bullet_list', 'button', 'content_boxes', 'count_down', 'drop_caps', 'heading', 'icon', 'icon_boxes', 'image_boxes', 'info_boxes', 'info_image_boxes', 'logo_showcase', 'single_image', 'tabs', 'team', 'testimonial', 'text_blocks')
    ),
    array(
        'Creative Elements',
        array('animated_text', 'banner', 'content_toggle', 'counter', 'dual_button', 'flip_box', 'footer_info', 'headers', 'icon_effects', 'image_accordion', 'image_comparison', 'image_hover', 'image_scroll', 'info_banner', 'interactive_cards', 'lightbox', 'link_effects', 'offcanvas_content', 'progress_bars', 'tooltip')
    ),
    array(
        'Dynamic Contents',
        array('audio_players', 'audio_playlist', 'carousel', 'category', 'data_table')
    ),
    array(
        'Marketing Elements',
        array('alert_box', 'google_chart', 'call_to_action', 'event_widgets', 'food_menu', 'opening_hours', 'product_boxes', 'price_table')
    ),
    array(
        'Image Effects',
        array('image_effects', 'creative_effects', 'square_effects', 'button_effects', 'hover_effects')
    ),
    array(
        'Social Elements',
        array('social_icons', 'social_share')
    ),
    array(
        'Form Contents',
        array('contact_form')
    ),
    array(
        'Extensions',
        array('divider', 'section_divider', 'smooth_scrolling', 'spacer')
    ),
);
if (get_option('oxiaddonsinitialinstallelements') != 'valids' || count($DIRfiles) < 1) {

    echo '<form method="post" id="OxiAddonsElementsDataForm">
                <input type="hidden" id="OxiAddonsElementsData" name="OxiAddonsElementsData" value="Installing Data">
                 <input type="hidden" name="oxi-addons-admin-ajax-nonce" id="oxi-addons-admin-ajax-nonce" value="' . wp_create_nonce("oxi_addons_admin_ajax_nonce") . '"/>
          </form>';
    $css = '.oxi-addons-loading-wrap{
               position:absolute;
               width:100%;
               height:100%;
               left:0;
               top:0;
               background:#171d56;
               
             }
             .oxi-addons-pei-data{
               display: flex;
               width:100%;
               height:100%;
               flex-direction: column;
               justify-content: center;
               align-items: center;
               z-index: 1;
             }
               .oxi-addons-loading-wrap-content{
                    max-width: 700px;
                    padding: 10px 20px;
                    font-size: 20px;
                    color: #fff;
                    text-transform:capitalize;
                    z-index: 1;
                }
               
                .oxi-addons-loading-wrap-heading{
                    max-width: 700px;
                    padding: 10px 20px;
                    color: #fff;
                    font-size: 60px;
                    font-weight: 600;
                    line-height: 1;
                    -webkit-animation: bounce 2s infinite 0s;
                    -moz-animation: bounce 2s infinite 0s;
                    -o-animation: bounce 2s infinite 0s;
                    animation: bounce 2s infinite 0s;
                    -webkit-transition: opacity 2s ease-in-out 0s;
                    -moz-transition: opacity 2s ease-in-out 0s;
                    transition: opacity 2s ease-in-out 0s;
                }
                @-webkit-keyframes bounce {
                    from,
                    20%,
                    53%,
                    80%,
                    to {
                      -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                      animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                      -webkit-transform: translate3d(0, 0, 0);
                      transform: translate3d(0, 0, 0);
                    }

                    40%,
                    43% {
                      -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      -webkit-transform: translate3d(0, -30px, 0);
                      transform: translate3d(0, -30px, 0);
                    }

                    70% {
                      -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      -webkit-transform: translate3d(0, -15px, 0);
                      transform: translate3d(0, -15px, 0);
                    }

                    90% {
                      -webkit-transform: translate3d(0, -4px, 0);
                      transform: translate3d(0, -4px, 0);
                    }
                  }

                  @keyframes bounce {
                    from,
                    20%,
                    53%,
                    80%,
                    to {
                      -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                      animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                      -webkit-transform: translate3d(0, 0, 0);
                      transform: translate3d(0, 0, 0);
                    }

                    40%,
                    43% {
                      -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      -webkit-transform: translate3d(0, -30px, 0);
                      transform: translate3d(0, -30px, 0);
                    }

                    70% {
                      -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                      -webkit-transform: translate3d(0, -15px, 0);
                      transform: translate3d(0, -15px, 0);
                    }

                    90% {
                      -webkit-transform: translate3d(0, -4px, 0);
                      transform: translate3d(0, -4px, 0);
                    }
                  }

                  .bounce {
                    -webkit-animation-name: bounce;
                    animation-name: bounce;
                    -webkit-transform-origin: center bottom;
                    transform-origin: center bottom;
                  }
                  .oxi-addons-pei-chart{
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    left: 50%;
                    top: 50%;
                    transform:translate(-50%, -50%);
                    z-index:0;
                  }
                  .oxi-addons-pei-chart-wrap{
                    width: 0%; 
                    height: 100%;
                    position: absolute;
                    background: #F15540;
                    transition: width 6s;
                  }
                  ';
    wp_add_inline_style('oxi-addons-admin', $css);
    $modaldata = '<div class="oxi-addons-loading-wrap">
                      <div class="oxi-addons-pei-chart">
                            <div class="oxi-addons-pei-chart-wrap"></div>
                      </div>
                      <div class="oxi-addons-pei-data">
                            <div class="oxi-addons-loading-wrap-heading">Please Wait ..</div>
                            <div class="oxi-addons-loading-wrap-content">Elements Downloading</div>
                      </div>
                  </div>
                  ';


    $modaldata = preg_replace("/\r\n|\r|\n/", ' ', $modaldata);
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#wpwrap").append('<?php echo $modaldata; ?>');
        });
    </script>
    <?php
} else {
    ksort($importdata);
    ksort($alldata);
    $nodata = 0;
    oxi_addons_font_familly('Bree+Serif');
    oxi_addons_font_familly('Source+Sans+Pro');
    ?>
    <div class="wrap">   
        <!--- Admin Menu--->
        <?php
        echo OxiAddonsAdmAdminMenu($oxitype, '', 'other');
        echo '<input type="hidden" name="oxi-addons-admin-ajax-nonce" id="oxi-addons-admin-ajax-nonce" value="' . wp_create_nonce("oxi_addons_admin_ajax_nonce") . '"/>';
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-wrapper">
                <input class="form-control" type="text" id='oxi_addons_search' placeholder="Search..">
                <?php
                foreach ($alldata as $value) {
                    $elementshtml = '';
                    $elementsnumber = 0;
                    asort($value[1]);
                    foreach ($value[1] as $val) {
                        $valuetrue = '';
                        foreach ($importdata as $importelements) {
                            if ($val == $importelements['name']) {
                                $version = '';
                                if (file_exists(OxiAddonsElements . $importelements['name'] . '/version.php')) {
                                    $version = include_once OxiAddonsElements . $importelements['name'] . '/version.php';
                                }
                                if ($version == '1.5') {
                                    $versiondata = '<form method="post" class="OXIAddonsElementsDeleteSubmit">
                                                        <input type="hidden" id="OXIAddonsElements" name="OXIAddonsElements" value="' . $importelements['name'] . '">
                                                        <input type="submit" class="btn btn-outline-warning btn-sm text-right oxi-addons-addons-element-btn-warning " name="OxiElementsDLT" value="Delete">
                                                        ' . wp_nonce_field('Oxi-Addons-Delete-Elements-Nonce') . '
                                                    </form>';
                                } else {
                                    $versiondata = '<form method="post">
                                                      <input type="button" class="btn btn-info btn-sm text-right OxiElementsADD oxi-addons-home-button-bounce" name="OxiElementsADD" OXIAddonsElements="' . $importelements['name'] . '" value="Update">
                                                    </form>';
                                }





                                if ($importelements['slug'] != 'oxi-addons') {
                                    $oxilink = 'admin.php?page=' . $importelements['homepage'];
                                } else {
                                    $oxilink = 'admin.php?page=oxi-addons&oxitype=' . $importelements['homepage'];
                                }
                                $elementsnumber++;

                                $elementshtml .= '<div class="oxi-addons-shortcode-import" id="' . $val . '" oxi-addons-search="' . $importelements['homepage'] . '">
                                    <a href="' . admin_url($oxilink) . '">
                                        <div class="oxi-addons-shortcode-import-top">
                                            ' . oxi_addons_admin_font_awesome('oxi-' . $importelements['homepage'] . '') . '
                                        </div>
                                    </a>
                                    <div class="oxi-addons-shortcode-import-bottom">
                                        <span>' . oxi_addons_shortcode_name_converter($importelements['name']) . '</span>
                                        ' . $versiondata . '
                                    </div>
                                </div>';
                            }
                        }
                    }
                    if ($elementsnumber > 0) {
                        echo '  <div class="oxi-addons-text-blocks-body-wrapper">
                                    <div class="oxi-addons-text-blocks-body">
                                        <div class="oxi-addons-text-blocks">
                                            <div class="oxi-addons-text-blocks-heading">' . $value[0] . '</div>
                                            <div class="oxi-addons-text-blocks-border">
                                                <div class="oxi-addons-text-block-border"></div>
                                            </div>
                                            <div class="oxi-addons-text-blocks-content">Installed (' . $elementsnumber . ')</div>
                                        </div>
                                    </div>
                                </div>';
                        echo $elementshtml;
                    }
                }
                $elements = array();
                foreach ($alldata as $value) {
                    foreach ($value[1] as $valu) {
                        $elements[$valu] = $valu;
                    }
                }
                $notinclude = '';
                $notelementsnumber = 0;
                foreach ($importdata as $val) {
                    if ($val['slug'] == 'oxi-addons') {
                        if (in_array($val['name'], $elements)) {
                            
                        } else {
                            $notelementsnumber++;
                            $oxilink = 'admin.php?page=oxi-addons&oxitype=' . $val['name'];
                            $notinclude .= '<div class="oxi-addons-shortcode-import" id="' . $val['name'] . '" oxi-addons-search="' . $val['name'] . '">
                                    <a href="' . admin_url($oxilink) . '">
                                        <div class="oxi-addons-shortcode-import-top">
                                            ' . oxi_addons_admin_font_awesome('oxi-' . $val['name'] . '') . '
                                        </div>
                                    </a>
                                    <div class="oxi-addons-shortcode-import-bottom">
                                        <span>' . oxi_addons_shortcode_name_converter($val['name']) . '</span>
                                        <form method="post" class="OXIAddonsElementsDeleteSubmit">
                                            <input type="hidden" id="OXIAddonsElements" name="OXIAddonsElements" value="' . $val['name'] . '">
                                            <input type="submit" class="btn btn-outline-warning btn-sm text-right oxi-addons-addons-element-btn-warning" name="OxiElementsDLT" value="Delete">
                                            ' . wp_nonce_field('Oxi-Addons-Delete-Elements-Nonce') . '
                                        </form>
                                    </div>
                                </div>';
                        }
                    }
                }
                if (!empty($notinclude)) {
                    echo '  <div class="oxi-addons-text-blocks-body-wrapper">
                                    <div class="oxi-addons-text-blocks-body">
                                        <div class="oxi-addons-text-blocks">
                                            <div class="oxi-addons-text-blocks-heading">Custom Elements</div>
                                            <div class="oxi-addons-text-blocks-border">
                                                <div class="oxi-addons-text-block-border"></div>
                                            </div>
                                            <div class="oxi-addons-text-blocks-content">Installed (' . $notelementsnumber . ')</div>
                                        </div>
                                    </div>
                                </div>';
                    echo $notinclude;
                }

                wp_add_inline_script('oxi-addons-bootstrap-jquery', 'function oxiequalHeight(group) {
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
                                oxiequalHeight(jQuery(".oxi-addons-shortcode-import-bottom"));
                                }, 500);
                                jQuery("#oxi_addons_search").on("keyup", function() {
                                var value = jQuery(this).val().toLowerCase();
                                jQuery(".oxi-addons-shortcode-import").filter(function() {
                                jQuery(this).toggle(jQuery(this).attr("oxi-addons-search").toLowerCase().indexOf(value) > -1);
                                });
                                if (jQuery.trim(jQuery(this).val()).length) {
                                jQuery(".oxi-addons-text-blocks-body-wrapper").not(":first").fadeOut("slow")
                                } else {
                                jQuery(".oxi-addons-text-blocks-body-wrapper").fadeIn("slow")
                                }
                                });');
                $jquery = 'jQuery(".oxilab-admin-menu li:eq(0) a").addClass("active");';
                wp_add_inline_script('oxi-addons-bootstrap-jquery', $jquery);
                ?>
            </div>
        </div>
    </div>
    <?php
}

$css = '.oxi-addons-wrapper ul.oxilab-admin-menu li a:hover,
        .oxi-addons-wrapper ul.oxilab-admin-menu li a.active{ 
            background: #7c00b5;
            position: relative;
            color: #fff;
        };';
echo OxiAddonsInlineCSSData($css, 'oxi-addons-admin');
