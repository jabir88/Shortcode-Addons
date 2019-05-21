<?php

if (!defined('ABSPATH'))
    exit;

/**
 * shortcode addons page works at views shortcode
 * this is the main page for view elements into sites
 */
function oxi_addons_menu_custom_post_type_icon() {
    ?>
    <style type='text/css' media='screen'>
        #adminmenu #toplevel_page_oxi-addons  div.wp-menu-image:before {
            content: "\f486";
        }
    </style>
    <?php

}

/**
 * The code that runs during view font familly.
 */
function oxi_addons_font_familly($data) {
    $load = get_option('oxi_addons_google_font');
    if ($load == '' && $data != '') {
        wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
    }
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}

/**
 * The code that runs during explode text align data from text shadow.
 */
function OxiAddonsTextAlignFixed($data) {
    $file = explode(":", $data);
    return $file[0];
}

/**
 * The code that runs during export text data.
 * this also works with shortocde also
 */
function oxi_addons_html_decode($data) {
    $data = html_entity_decode($data);
    $data = do_shortcode($data, $ignore_html = false);
    return $data;
}

/**
 * The code that runs during export font familly.
 * this also works with font family link also
 */
function oxi_addons_font_awesome($data) {
    $icon = explode(' ', $data);
    $fadata = get_option('oxi_addons_font_awesome');
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    if ($fadata == 'yes') {
        wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    }
    $files = '<i class="' . $data . ' oxi-icons"></i>';
    return $files;
}

/**
 * The code that runs during export text data.
 */
function OxiAddonsTextConvert($data) {
    $data = html_entity_decode($data);
    $data = do_shortcode($data, $ignore_html = false);
    return $data;
}

/**
 * The code that runs during background color image viewing.
 * also works with linear gradient also
 */
function OxiAddonsBGImage($styledata, $number) {
    if ($styledata[($number + 1)] == '') {
        $value = 'background: ' . $styledata[$number] . ';';
    } else {
        if (strlen($styledata[$number]) < 27) {
            $value = 'background: linear-gradient(' . $styledata[$number] . ', ' . $styledata[$number] . '), url("' . OxiAddonsUrlConvert($styledata[($number + 1)]) . '") no-repeat center center;
                       -webkit-background-size: cover;
                       -moz-background-size: cover;
                       -o-background-size: cover;
                       background-size: cover;';
        } else {
            $value = 'background: ' . $styledata[$number] . ', url("' . OxiAddonsUrlConvert($styledata[($number + 1)]) . '") no-repeat center center;
                       -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;';
        }
    }
    return $value;
}

/**
 * The code that runs during box shadow viewing.
 */
function OxiAddonsBoxShadowSanitize($styledata, $number) {
    $value = 'box-shadow:' . $styledata[($number + 1)] . 'px ' . $styledata[($number + 2)] . 'px ' . $styledata[($number + 3)] . 'px ' . $styledata[($number + 4)] . 'px ' . $styledata[$number] . ';';
    return $value;
}

/**
 * The code that runs during editing data.
 * its only pass html class to view edit panel
 */
function OxiAddonsAdminDefine($user) {
    $value = '';
    if ($user == 'admin') {
        $value = 'oxi-addons-admin-edit-list';
    }
    return $value;
}

/**
 * The code that runs during border, border radius, padding, margin.
 */
function OxiAddonsPaddingMarginSanitize($styledata, $number) {
    $value = '' . $styledata[$number] . 'px ' . $styledata[($number + 12)] . 'px ' . $styledata[($number + 4)] . 'px ' . $styledata[($number + 8)] . 'px';
    return $value;
}

/**
 * The code that runs during animation viewing.
 * works with full animation data
 */
function OxiAddonsAnimation($styledata, $firstvalue) {
    $data = '';
    $number = rand();
    $number2 = rand();
    $danimation = explode(':', $styledata[($firstvalue + 1)]);
    if (count($danimation) > 3) {
        if ($danimation[1] == 'true') {
            $jquery = 'jQuery(".oxi-d-animation-' . $number . '-' . $number2 . '").Oxiplate({
                                                inverse: ' . $danimation[2] . ',
                                                perspective: ' . $danimation[3] . ',
                                                maxRotation: ' . $danimation[4] . ',
                                                animationDuration: ' . ($danimation[5] * 1000) . '
                                              });';
            wp_add_inline_script('oxi-addons-animation', $jquery);
            $data .= ' oxi-addons-d-animation="oxi-d-animation-' . $number . '-' . $number2 . '" ';
        }
    }
    if (!empty($styledata[($firstvalue)])) {
        $css = '';
        $animation = explode('//', $styledata[($firstvalue + 2)]);
        $data .= 'oxi-addons-animation="oxi-animation-' . $number . '-' . $number2 . ' ' . $styledata[$firstvalue] . '"';
        $loop = $animation[1] == 'infinite' ? ' infinite ' : ' 1 ';
        $css .= ' .oxi-addons-animation.oxi-animation-' . $number . '-' . $number2 . '{ 
                             -webkit-animation: ' . $styledata[$firstvalue] . ' ' . $danimation[0] . 's ' . $loop . ' ' . $animation[0] . 's; 
                             -moz-animation:    ' . $styledata[$firstvalue] . ' ' . $danimation[0] . 's ' . $loop . ' ' . $animation[0] . 's;
                             -o-animation:      ' . $styledata[$firstvalue] . ' ' . $danimation[0] . 's ' . $loop . ' ' . $animation[0] . 's;
                             animation:         ' . $styledata[$firstvalue] . ' ' . $danimation[0] . 's ' . $loop . ' ' . $animation[0] . 's;
                            -webkit-transition: opacity  ' . $danimation[0] . 's ease-in-out ' . $animation[0] . 's;
                            -moz-transition: opacity  ' . $danimation[0] . 's ease-in-out ' . $animation[0] . 's;
                            transition: opacity  ' . $danimation[0] . 's ease-in-out ' . $animation[0] . 's'
                . '         }';
        wp_add_inline_style('oxi-addons', $css);
    } else {
        $data .= '';
    }
    return $data;
}

/**
 * The code that runs during font settings.
 * capable to output font family,font style, line height font style, text shadow, text align 
 */
function OxiAddonsFontSettings($styledata, $firstvalue) {
    $data = 'font-family:' . oxi_addons_font_familly($styledata[$firstvalue]) . '; font-weight:' . $styledata[($firstvalue + 1)] . ';';
    $clonetrue = strpos($styledata[($firstvalue + 3)], ":");
    if ($clonetrue !== FALSE) {
        $datacompile = explode(":", $styledata[($firstvalue + 3)]);
        $data .= ' font-style:' . $datacompile[0] . ';';
        $data .= ' line-height:' . $datacompile[1] . ';';
    } else {
        $data .= ' font-style:' . $styledata[($firstvalue + 3)] . ';';
    }
    $clonetrue = strpos($styledata[($firstvalue + 4)], ":");
    if ($clonetrue !== FALSE) {
        $datacompile = explode(":", $styledata[($firstvalue + 4)]);
        if (!empty($datacompile[0])) {
            $data .= ' text-align:' . $datacompile[0] . ';';
        }
        $shadowcheck = strpos($datacompile[1], '0()0()0');
        if ($shadowcheck === FALSE && !empty($datacompile[1])) {
            $texts = explode('()', $datacompile[1]);
            $data .= ' text-shadow:' . $texts[0] . 'px ' . $texts[1] . 'px ' . $texts[2] . 'px  ' . $texts[3] . ';';
        }
        if (!empty($datacompile[2])) {
            if ($datacompile[2] != 0) {
                $data .= 'letter-spacing:' . $datacompile[2] . 'px;';
            }
        }
    } else {
        $data .= ' text-align:' . $styledata[($firstvalue + 4)] . ';';
    }
    return $data;
}

/**
 * The code that runs during Text Shadow.
 * capable to output Text Shadow
 */
function OxiAddonsTextShadowSettings($styledata, $firstvalue) {
    $shadow = $styledata[$firstvalue] . '|' . $styledata[($firstvalue + 1)] . '|' . $styledata[($firstvalue + 2)];
    $shadowcheck = strpos($shadow, '0|0|0');
    if ($shadowcheck === FALSE) {
        $data = ' text-shadow:' . $styledata[$firstvalue] . 'px ' . $styledata[($firstvalue + 1)] . 'px ' . $styledata[($firstvalue + 2)] . 'px  ' . $styledata[($firstvalue + 3)] . ';';
        return $data;
    }
}

/**
 * The code that runs during output responsive class.
 */
function OxiAddonsItemRows($styledata, $firstvalue) {
    $data = ' ' . $styledata[$firstvalue] . ' ' . $styledata[($firstvalue + 1)] . ' ' . $styledata[($firstvalue + 2)] . ' ';
    return $data;
}

/**
 * The code that runs during url or link output.
 */
function OxiAddonsUrlConvert($data) {
    $homeurl = home_url();
    $url = 'OxiAddonsUrl./';
    $data = str_replace($url, $homeurl, $data);
    return $data;
}

/**
 * adding custom js or css if needed
 */
function oxi_addons_elements_stylejs($data, $oxitype = '', $type = 'css', $classperamiter = '') {
    if ($classperamiter == '') {
        $classperamiter = $data;
    }
    $elementor = '';
    if (is_admin()) {
        if (!function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if (is_plugin_active('elementor/elementor.php')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                $elementor = 'elementor';
            }
        }
    }
    if ($type == 'css' && $elementor == 'elementor') {
        echo '<style>';
        echo file_get_contents(content_url('uploads/OxiAddonsElements/' . $oxitype . '/file/' . $data . '.css', __FILE__));
        echo '</style>';
    } elseif ($type == 'css' && $elementor != 'elementor') {
        wp_enqueue_style('oxi-addons-' . $classperamiter, content_url('uploads/OxiAddonsElements/' . $oxitype . '/file/' . $data . '.css', __FILE__));
    } elseif ($type == 'js' && $elementor == 'elementor') {
        echo '<script>';
        echo file_get_contents(content_url('uploads/OxiAddonsElements/' . $oxitype . '/file/' . $data . '.js', __FILE__));
        echo '</script>';
    } elseif ($type == 'js' && $elementor != 'elementor') {
        wp_enqueue_script('oxi-addons-' . $classperamiter, content_url('uploads/OxiAddonsElements/' . $oxitype . '/file/' . $data . '.js', __FILE__));
    } elseif ($type == 'php') {
        include_once OxiAddonsElements . $oxitype . '/file/' . $data . '.php';
    }
}

/**
 * The code that runs during each shortcode viewing. 
 * media query, col class animation css, animation js
 */
function oxi_addons_public_style() {
    if (is_admin()) {
        if (!function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if (is_plugin_active('elementor/elementor.php')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<style>';
                echo file_get_contents(plugins_url('css/style.css', __FILE__));
                echo file_get_contents(plugins_url('css/animation.css', __FILE__));
                echo '</style>';
                echo '<script>';
                echo file_get_contents(plugins_url('jquery/animation.js', __FILE__));
                echo '</script>';
            }
        }
    }
    wp_enqueue_script("jquery");
    wp_enqueue_style('oxi-addons', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('oxi-addons-animation', plugins_url('css/animation.css', __FILE__));
    wp_enqueue_script('oxi-addons-animation', plugins_url('jquery/animation.js', __FILE__));
}

/**
 * The code that runs during viewport animated .
 */
function oxi_addons_public_waypoints() {
    if (get_option('oxi_addons_waypoints') == 'yes') {
        if (is_admin()) {
            if (!function_exists('is_plugin_active')) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            }
            if (is_plugin_active('elementor/elementor.php')) {
                if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                    echo '<script>';
                    echo file_get_contents(plugins_url('jquery/waypoints.min.js', __FILE__));
                    echo '</script>';
                }
            }
        }
        wp_enqueue_script('jquery.waypoints.min', plugins_url('jquery/waypoints.min.js', __FILE__));
    }
}

function oxi_addons_public_isotope() {
    if (is_admin()) {
        if (!function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if (is_plugin_active('elementor/elementor.php')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<style>';
                echo file_get_contents(plugins_url('jquery/imagesloaded.pkgd.min.js', __FILE__));
                echo '</style>';
                echo '<script>';
                echo file_get_contents(plugins_url('jquery/jquery.isotope.v3.0.2.js', __FILE__));
                echo '</script>';
            }
        }
    }
    wp_enqueue_script('oxi-addons-imagesloaded.pkgd.min', plugins_url('jquery/imagesloaded.pkgd.min.js', __FILE__));
    wp_enqueue_script('oxi-addons-jquery.isotope.v3.0.2', plugins_url('jquery/jquery.isotope.v3.0.2.js', __FILE__));
}

/**
 * The code that runs during MagnificPopup js loading.
 */
function oxi_addons_MagnificPopup() {
    if (is_admin()) {
        if (!function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if (is_plugin_active('elementor/elementor.php')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<style>';
                echo file_get_contents(plugins_url('css/MagnificPopup.css', __FILE__));
                echo '</style>';
                echo '<script>';
                echo file_get_contents(plugins_url('jquery/MagnificPopup.js', __FILE__));
                echo '</script>';
            }
        }
    }
    wp_enqueue_style('oxi-addons-MagnificPopup', plugins_url('css/MagnificPopup.css', __FILE__));
    wp_enqueue_script('oxi-addons-MagnificPopup', plugins_url('jquery/MagnificPopup.js', __FILE__));
}

/**
 * The code that runs during Each shortcode name changing at admin page.
 */
add_shortcode('OXI_ADDONS_Style_Change', 'OXI_ADDONS_Style_Change_SHORTCODE');

function OXI_ADDONS_Style_Change_SHORTCODE($atts) {
    $more = $layouts = $style = '';
    extract(shortcode_atts(
                    array(
        'more' => '',
                    ), $atts));
    $more = sanitize_text_field($atts['more']);
    ob_start();
    if ($more != '') {
        echo '<div class="oxi-addons-button-flex-box" ' . $style2 . '>';
        echo '<a href="' . $more . '" class="oxi-addons-button-admin-style-more" style="display:block">More layouts</a>';
        echo '</div>';
        echo oxi_addons_public_style();
    }
    return ob_get_clean();
}

add_shortcode('OXI_ADDONS_EXPORT_DATA', 'OXI_ADDONS_EXPORT_DATA_SHORTCODE');

/**
 * export data at admin page
 */
function OXI_ADDONS_EXPORT_DATA_SHORTCODE($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = (int) $atts['id'];
    ob_start();
    global $wpdb;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $exportvalue = '';
    $jQuery = '';
    if ((int) $styleid) {
        $exportdata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
        $exportfile = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid = '$styleid'  ORDER by id ASC", ARRAY_A);
        $preexport = $exportdata['name'] . 'OXIIMPORT' . $exportdata['type'] . 'OXIIMPORT' . $exportdata['style_name'] . 'OXIIMPORT' . $exportdata['css'];
        if (count($exportfile) > 0) {
            $preexport .= '##OXISTYLE##';
            foreach ($exportfile as $value) {
                $preexport .= $value['files'] . '##OXIDATA##';
            }
        }
        $shortcodeount = substr_count($preexport, '[oxi_addons');
        if ($shortcodeount > 0) {
            $comdata = explode("[oxi_addons", $preexport);
            for ($i = 0; $i <= (count($comdata) - 1); $i++) {
                if ($i == 0) {
                    $exportvalue .= $comdata[$i];
                } else {
                    $firstdevider = explode("]", $comdata[$i]);
                    for ($j = 0; $j <= (count($firstdevider) - 1); $j++) {
                        if ($j == 0) {
                            $findnumber = explode("id", strtolower($firstdevider[$j]));
                            preg_match('/\d+/', $findnumber[1], $number);
                            //echo $number[0];
                            $finddatastyle = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $number[0]), ARRAY_A);

                            $finddatafiles = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid = '$number[0]'  ORDER by id ASC", ARRAY_A);
                            $findexport = $exportdata['name'] . 'OXIIMPORT' . $finddatastyle['type'] . 'OXIIMPORT' . $finddatastyle['style_name'] . 'OXIIMPORT' . $finddatastyle['css'];
                            if (count($finddatafiles) > 0) {
                                $findexport .= '##OXISTYLE##';
                                foreach ($finddatafiles as $value) {
                                    $findexport .= $value['files'] . '##OXIDATA##';
                                }
                            }
                            $exportvalue .= '|||{VULEO EDIT ER CINTA KORBEN NA}|||';
                            $exportvalue .= $findexport;
                            $exportvalue .= '|||{SHORTCODE DATA VULA JABE NA}|||';
                            $exportvalue .= '|||{VULEO EDIT ER CINTA KORBEN NA}|||';
                        } else {
                            if ($j > 1) {
                                $exportvalue .= ']';
                            }
                            $exportvalue .= $firstdevider[$j];
                        }
                    }
                }
            }
        } else {
            $exportvalue .= $preexport;
        }
        echo '<div class="oxi-addons-container">'
        . '<div class="oxi-addons-row oxi-addons-center">'
        . '<a class="oxi-button oxi-addons-export-button" href="#oxi-addons-export-data-body-' . $styleid . '">Export</a>
              </div>
              </div>
              <div class="white-popup-block Oximfp-hide" id="oxi-addons-export-data-body-' . $styleid . '">
                 <textarea id="oxi-addons-export-data-' . $styleid . '" class="oxi-addons-export-data-code">' . OxiAddonsUrlConvert($exportvalue) . '</textarea>
                <button class="oxi-button oxi-addons-export-button oxi-addons-export-button-copy" id="oxi-addons-export-data-' . $styleid . '">Copy</button>
                </div>';
        echo oxi_addons_MagnificPopup();
        wp_enqueue_script('onlineexportdata', plugins_url('jquery/onlineexportdata.js', __FILE__));
    }
    return ob_get_clean();
}

/**
 * convert function to viewing short code
 */
function OxiAddons_Shortcode_Style_ID($type, $layouts) {
    $layouts = str_replace("-", "_", $layouts);
    return 'oxi_' . $type . '_' . $layouts . '_shortcode';
}

add_shortcode('oxi_addons', 'oxi_addons_shortcode');

/**
 * call all shortcode addons data form here
 * this is the shortocde converted to data
 */
function oxi_addons_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = (int) $atts['id'];
    ob_start();
    global $wpdb;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    $listdata = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid= '$styleid'  ORDER by id ASC", ARRAY_A);
    $shortcode = '';
    if (is_array($styledata)) {
        wp_enqueue_script("jquery");
        oxi_addons_public_style();
        $file = OxiAddonsElements . $styledata['type'] . '/view/' . $styledata['style_name'] . '.php';
        if (file_exists($file)) {
            $shortcode .= '<div class="oxi-addons-container ' . get_option('oxi_addons_conflict_class') . '">';
            include_once OxiAddonsElements . $styledata['type'] . '/view/' . $styledata['style_name'] . '.php';
            $function = OxiAddons_Shortcode_Style_ID($styledata['type'], $styledata['style_name']);
            $shortcode .= $function($styledata, $listdata, 'user');
            $shortcode .= '</div>';
        } else {
            $shortcode .= '<div class="oxi-addons-container">
                      <div class="oxi-addons-error">
                          **There have an error into Shortcode Addons > <strong>' . oxi_addons_shortcode_name_converter($styledata['type']) . '</strong>. Kindly Install or Reinstall <strong>' . oxi_addons_shortcode_name_converter($styledata['type']) . '</strong> first to view your data.** 
                      </div>
                  </div>';
        }
    } else {
        $shortcode .= $styleid;
        $shortcode .= '<div class="oxi-addons-container">
                        <div class="oxi-addons-error">
                            **<strong>Empty</strong> data found. Kindly check shortcode and put right shortcode with id from Shortcode Addons Elements** 
                        </div>
                  </div>';
    }
    return ob_get_clean();
}

/**
 * The code that runs during shortcode using.
 */
function oxi_addons_shortcode_extension($styleid) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    $listdata = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid= '$styleid'  ORDER by id ASC", ARRAY_A);
    if (is_array($styledata)) {
        wp_enqueue_script("jquery");
        oxi_addons_public_style();
        $file = OxiAddonsElements . $styledata['type'] . '/view/' . $styledata['style_name'] . '.php';
        if (file_exists($file)) {
            include_once OxiAddonsElements . $styledata['type'] . '/view/' . $styledata['style_name'] . '.php';
            $function = OxiAddons_Shortcode_Style_ID($styledata['type'], $styledata['style_name']);
            $function($styledata, $listdata, 'user');
        } else {
            echo '<div class="oxi-addons-container">
                      <div class="oxi-addons-error">
                          **There have an error into Shortcode Addons > <strong>' . oxi_addons_shortcode_name_converter($styledata['type']) . '</strong>. Kindly Install or Reinstall <strong>' . oxi_addons_shortcode_name_converter($styledata['type']) . '</strong> first to view your data.** 
                      </div>
                  </div>';
        }
    } else {
        echo '<div class="oxi-addons-container">
                    <div class="oxi-addons-error">
                        **<strong>Empty</strong> data found. Kindly check shortcode and put right shortcode with id from Shortcode Addons Elements** 
                    </div>
              </div>';
    }
    return ob_get_clean();
}

/**
 * create unique class from text
 */
function OxiStringToClassReplacce($string, $number = '000') {
    $entities = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', "t");
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", " ");
    return 'oxi-STCR-' . str_replace($replacements, $entities, urlencode($string)) . $number;
}

/**
 * The code that runs during rating.
 */
function OxiAddonsPublicRate($value = '', $style = 'style1') {
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    $ftawversion = $faversion[0];
    if ($style == 'style1') {
        if ($ftawversion == '4.7.0') {
            $ratefull = 'fa fa-star';
            $ratehalf = 'fa fa-star-half-o';
            $rateO = 'fa fa-star-o';
        } else {
            $ratefull = 'fas fa-star';
            $ratehalf = 'fas fa-star-half-alt';
            $rateO = 'far fa-star';
        }
    }
    if ($value > 4.75) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull);
    } elseif ($value <= 4.75 && $value > 4.25) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratehalf);
    } elseif ($value <= 4.25 && $value > 3.75) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 3.75 && $value > 3.25) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratehalf) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 3.25 && $value > 2.75) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 2.75 && $value > 2.25) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratehalf) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 2.25 && $value > 1.75) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 1.75 && $value > 1.25) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($ratehalf) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO);
    } elseif ($value <= 1.25) {
        return oxi_addons_font_awesome($ratefull) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO) . oxi_addons_font_awesome($rateO);
    }
}

/**
 * The code that runs during visual composer Addons.
 */
add_shortcode('Oxi_Addons_VC', 'Oxi_Addons_VC_shortcode');

function Oxi_Addons_VC_shortcode($atts) {
    extract(shortcode_atts(array(
        'id' => ''
                    ), $atts));
    $styleid = $atts['id'];
    ob_start();
    oxi_addons_shortcode_extension($styleid);
    return ob_get_clean();
}

function OxiAddonsInlineCSSData($data = '', $jscss = 'css', $path = 'oxi-addons') {
    $data = preg_replace('/\/\*((?!\*\/).)*\*\//', ' ', $data);
    $data = preg_replace('/\s{2,}/', ' ', $data);
    $data = preg_replace('/\s*([:;{}])\s*/', '$1', $data);
    $data = preg_replace('/;}/', ' }', $data);
    $elementor = '';
    if (is_admin()) {
        if (!function_exists('is_plugin_active')) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if (is_plugin_active('elementor/elementor.php')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                $elementor = 'elementor';
            }
        }
    }
    if ($jscss == 'js') {
        if (!empty($elementor)) {
            echo '<script>setTimeout(function () {';
            echo $data;
            echo '}, 1000);</script>';
        } else {
            wp_add_inline_script('' . (($path == 'oxi-addons') ? 'oxi-addons-animation' : $path) . '', $data);
        }
    } else {
        if (!empty($elementor)) {
            echo '<style>';
            echo $data;
            echo '</style>';
        } else {
            wp_add_inline_style($path, $data);
        }
    }
}

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
    if (is_array($oxitype)) {
        
    } else {
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
}
