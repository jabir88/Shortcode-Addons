<?php
/*
  Plugin Name: Shortcode Addons- with Visual Composer, Divi, Beaver Builder and Elementor Extension
  Plugin URI: https://www.oxilab.org
  Description: Shortcode Addons is an amazing set of beautiful and useful elements with Visual Composer, Divi, Beaver Builder and Elementor Extension.
  Author: biplob018
  Version: 1.5
 */
if (!defined('ABSPATH'))
    exit;
$oxi_div_database = '5.3';
define('oxi_addons_url', plugin_dir_path(__FILE__));
include oxi_addons_url . 'shortcode.php';
include oxi_addons_url . 'widgets/widget.php';
define('oxi_addons', 'addons');
$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
define('OxiAddonsElements', $upload_dir . '/OxiAddonsElements/');

/**
 * The code that runs during plugin using as who can use Shortcode Addons.
 */
function oxi_addons_user_capabilities() {
    $user_role = get_option('oxi_addons_user_permission');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    if (!current_user_can($first_key)) {
        wp_die(__('You do not have sufficient permissions to access this page. Kindly contact with your site admin to give you access'));
    }
}

/**
 * Shortcode Addons Menu 
 * works at all page to adding menu
 */
add_action('admin_head', 'oxi_addons_menu_custom_post_type_icon');

/**
 * The core function of plugin that is used to define menu,
 * admin-specific hooks with user capabilities.
 */
add_action('admin_menu', 'oxi_addons_menu');

function oxi_addons_menu() {
    $user_role = get_option('oxi_addons_user_permission');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    add_menu_page('Shortcode Addons', 'Shortcode Addons', $first_key, 'oxi-addons', 'oxi_addons_home');
    add_submenu_page('oxi-addons', 'Available Shortcodes', 'Available Shortcodes', $first_key, 'oxi-addons', 'oxi_addons_home');
    add_submenu_page('oxi-addons', 'Import Layouts', 'Import Layouts', $first_key, 'oxi-addons-import-data', 'oxi_addons_import_data');
    add_submenu_page('oxi-addons', 'Import Elements', 'Import Elements', $first_key, 'oxi-addons-import', 'oxi_addons_import');
    add_submenu_page('oxi-addons', 'Settings', 'Settings', $first_key, 'oxi-addons-settings', 'oxi_addons_settings');
    add_submenu_page('oxi-addons', 'Documentation', 'Documentation', $first_key, 'oxi-addons-documentation', 'oxi_addons_documentation');
}

/**
 * call home page of shortcode addons
 */
function oxi_addons_home() {
    include oxi_addons_url . 'admin/helper.php';
    include oxi_addons_url . 'admin.php';
}

/**
 * call home page CSS Jquery of shortcode addons
 */
function oxi_addons_import_css_js() {
    wp_enqueue_script("jquery");
    wp_enqueue_script('YouTubePopUps', plugins_url('jquery/YouTubePopUps.js', __FILE__));
    wp_enqueue_script('oxi-addons-bootstrap-jquery', plugins_url('jquery/bootstrap.min.js', __FILE__));
    wp_enqueue_script('jquery.bootstrap-growl', plugins_url('jquery/jquery.bootstrap-growl.js', __FILE__));
    wp_enqueue_script('oxi-addons-vendor', plugins_url('jquery/vendor.js', __FILE__));
    wp_enqueue_style('oxi-addons-bootstrap', plugins_url('css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxi-addons-admin', plugins_url('css/admin.css', __FILE__));
}

/**
 * call import page of shortcode addons
 */
function oxi_addons_import() {
    oxi_addons_import_css_js();
    OxiAddonsAdminajax();
    include oxi_addons_url . 'admin/helper.php';
    include oxi_addons_url . 'admin/import.php';
}

/**
 * call import style of shortcode addons
 */
function oxi_addons_import_data() {
    oxi_addons_import_css_js();
    include oxi_addons_url . 'admin/helper.php';
    include oxi_addons_url . 'admin/import-data.php';
}

include oxi_addons_url . 'Oxilab_Updater.php';

function oxi_addons_documentation() {
    wp_enqueue_script("jquery");
    wp_enqueue_style('oxi-addons-admin', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    wp_enqueue_style('oxilab-addons-welcome', plugins_url('css/admin-welcome.css', __FILE__));
    include oxi_addons_url . 'admin/helper.php';
    include oxi_addons_url . 'admin/documentation.php';
}

/**
 * using to convert name of shortcode addons elements
 */
function oxi_addons_shortcode_name_converter($data) {
    $data = str_replace('_', ' ', $data);
    $data = str_replace('-', ' ', $data);
    $data = str_replace('+', ' ', $data);
    return ucwords($data);
}

/**
 * using to create quick link at each menu 
 */
function oxi_addons_admin_menu_link($data = '') {
    if (empty($data)) {
        return admin_url('admin.php?page=oxi-addons');
    } elseif ($data == 'import') {
        return admin_url('admin.php?page=oxi-addons-import');
    } elseif ($data == 'import-data') {
        return admin_url('admin.php?page=oxi-addons-import-data');
    } elseif ($data == 'settings') {
        return admin_url('admin.php?page=oxi-addons-settings');
    } else {
        return admin_url('admin.php?page=oxi-addons&oxitype=' . $data);
    }
}

/**
 * The code that runs during plugin activation.
 */
register_activation_hook(__FILE__, 'oxi_addons_install');

function oxi_addons_install() {
    global $wpdb;
    global $oxi_div_database;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $table_import = $wpdb->prefix . 'oxi_div_import';
    $charset_collate = $wpdb->get_charset_collate();
    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                type varchar(50) NOT NULL,
                style_name varchar(40),
                css text,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
                type varchar(50) NOT NULL,
                files text,
                css text,
		PRIMARY KEY  (id)
	) $charset_collate;";
    $sql3 = "CREATE TABLE $table_import (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                type varchar(50) NOT NULL,
                name varchar(100) NOT NULL,
                font varchar(100) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    add_option('oxi_addons_install', $oxi_div_database);
    update_option("oxi_div_database", $oxi_div_database);
    $ln = '' . '5.6.0||' . 'ht' . 'tp' . 's:' . '/' . '/' . 'use.f' . 'onta' . 'wesome' . '.' . 'com/release' . 's/v5' . '.6.3' . '/c' . 'ss/al' . 'l' . '.' . 'css';
    $yes = 'yes';
    add_option('oxi_addons_admin_version', $yes);
    add_option('oxi_addons_font_awesome', $yes);
    add_option('oxi_addons_font_awesome_version', $ln);
    add_option('oxi_addons_bootstrap', $yes);
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/OxiAddonsElements';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777);
    }
    set_transient('_Oxilab_shortcode_welcome_activation_redirect', true, 30);
}

add_action('admin_init', '_Oxilab_shortcode_welcome_activation_redirect');

function _Oxilab_shortcode_welcome_activation_redirect() {
    if (!get_transient('_Oxilab_shortcode_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Oxilab_shortcode_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'oxi-addons-documentation'), admin_url('admin.php')));
}

/**
 * Call admin ajax for rearrange each elements
 * update each addons data via ajax
 */
function OxiAddonsAdminajax() {
    wp_enqueue_script('oxi-addons-admin-ajax', plugins_url('jquery/oxi-addons-admin-ajax.js', __FILE__));
    wp_localize_script('oxi-addons-admin-ajax', 'OxiAddonsAdminajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function OxiAddonsAdminajaxData() {
    check_ajax_referer('oxi_addons_admin_ajax_nonce', 'security');
    $list_order = sanitize_text_field($_POST['list_order']);
    $valids = 'valids';
    if ($list_order == 'Installing Data') {
        $list_items = sanitize_text_field($_POST['list_items']);
        $tmpfile = download_url('http://www.oxilab.org/ShortcodeElements/' . $list_items . '.zip', $timeout = 500);
        if (is_string($tmpfile)) {
            $permfile = 'oxilab.zip';
            $zip = new ZipArchive();
            if ($zip->open($tmpfile) !== TRUE) {
                echo 'Problem 2';
            }
            $zip->extractTo(OxiAddonsElements);
            $zip->close();
            echo $list_items;
            add_option('oxiaddonsinitialinstallelements', $valids);
            die();
        } else {
            echo 'Problem 1';
            die();
        }
    } else {
        $list = explode(',', $list_order);
        global $wpdb;
        $table_list = $wpdb->prefix . 'oxi_div_list';
        foreach ($list as $value) {
            echo $value;
            $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $value), ARRAY_A);
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, type, files) VALUES (%d, %s, %s )", array($data['styleid'], 'oxi-addons', $data['files'])));
            $redirect_id = $wpdb->insert_id;
            if ($redirect_id == 0) {
                die();
            }
            if ($redirect_id != 0) {
                $wpdb->query($wpdb->prepare("DELETE FROM $table_list WHERE id = %d", $value));
            }
        }
        die();
    }
}

add_action('wp_ajax_OxiAddonsAdminajaxData', 'OxiAddonsAdminajaxData');

function OxiAddonsAjaxRequest() {
    wp_enqueue_script('oxi-addons-ajax', plugins_url('jquery/oxi-addons-js.js', __FILE__));
    wp_localize_script('oxi-addons-ajax', 'OxiAddonsAjaxRequest', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_nopriv_OxiAddonsAjaxRequestData', 'OxiAddonsAjaxRequestData');
add_action('wp_ajax_OxiAddonsAjaxRequestData', 'OxiAddonsAjaxRequestData');

function OxiAddonsAjaxRequestData() {
    check_ajax_referer('oxi_addons_ajax_nonce', 'security');
    ob_start();
    $styleid = (int) $_POST['styleid'];
    $func = sanitize_text_field($_POST['func']);
    $file = sanitize_text_field($_POST['file']);
    $phpfile = sanitize_text_field($_POST['phpfile']);
    $phpfile = explode('||', $phpfile);
    include OxiAddonsElements . $phpfile[0] . '/view/' . $phpfile[1] . '.php';
    $func($styleid, $file);
    die();
}

define('OXILAB_OXI_ADDONS_HOME', 'https://www.oxilab.org'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
define('OXILAB_OXI_ADDONS', 'Short code Addons'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of the settings page for the license input to be displayed
define('OXILAB_OXI_ADDONS_LICENSE_PAGE', 'oxi-addons-settings');

function oxi_addons_plugin_updater() {
    $license_key = trim(get_option('oxi_addons_license_key'));
    // retrieve our license key from the DB
    // setup the updater
    $oxi_addons_updater = new OXILAB_OXI_ADDONS_OXILAB_Updater(OXILAB_OXI_ADDONS_HOME, __FILE__, array(
        'version' => '1.5', // current version number
        'license' => $license_key, // license key (used get_option above to retrieve from DB)
        'item_name' => OXILAB_OXI_ADDONS, // name of this plugin
        'author' => 'Biplob Adhikari', // author of this plugin
        'beta' => false
            )
    );
}

$status = get_option('oxi_addons_license_status');
$license_key = trim(get_option('oxi_addons_license_key'));

if (!empty($license_key)) {
    add_action('admin_init', 'oxi_addons_plugin_updater', 0);
}

/**
 * The code that runs during plugin settings page.
 */
function oxi_addons_settings() {
    $oxitype = '';
    include oxi_addons_url . 'admin/helper.php';
    wp_enqueue_style('oxi-addons-admin', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script("jquery");
    oxi_addons_import_css_js();
    wp_enqueue_script('YouTubePopUps', plugins_url('jquery/YouTubePopUps.js', __FILE__));
    wp_enqueue_script('font-family-settings', plugins_url('jquery/font-family-settings.js', __FILE__));
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $saved_role = get_option('oxi_addons_user_permission');
    $fontawvr = get_option('oxi_addons_font_awesome_version');
    $license = get_option('oxi_addons_license_key');
    $status = get_option('oxi_addons_license_status');
    $fontawesomevr = array(
        array('name' => '5.7.2', 'url' => '5.7.2||https://use.fontawesome.com/releases/v5.7.2/css/all.css'),
        array('name' => '5.7.1', 'url' => '5.7.1||https://use.fontawesome.com/releases/v5.7.1/css/all.css'),
        array('name' => '5.7.0', 'url' => '5.7.0||https://use.fontawesome.com/releases/v5.7.0/css/all.css'),
        array('name' => '5.6.3', 'url' => '5.6.3||https://use.fontawesome.com/releases/v5.6.3/css/all.css'),
        array('name' => '5.6.0', 'url' => '5.6.0||https://use.fontawesome.com/releases/v5.6.0/css/all.css'),
        array('name' => '5.5.0', 'url' => '5.5.0||https://use.fontawesome.com/releases/v5.5.0/css/all.css'),
        array('name' => '5.4.2', 'url' => '5.4.2||https://use.fontawesome.com/releases/v5.4.2/css/all.css'),
        array('name' => '5.4.1', 'url' => '5.4.1||https://use.fontawesome.com/releases/v5.4.1/css/all.css'),
        array('name' => '5.3.1', 'url' => '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css'),
        array('name' => '5.2.0', 'url' => '5.2.0||https://use.fontawesome.com/releases/v5.2.0/css/all.css'),
        array('name' => '5.1.1', 'url' => '5.1.1||https://use.fontawesome.com/releases/v5.1.1/css/all.css'),
        array('name' => '5.1.0', 'url' => '5.1.0||https://use.fontawesome.com/releases/v5.1.0/css/all.css'),
        array('name' => '5.0.13', 'url' => '5.0.13||https://use.fontawesome.com/releases/v5.0.13/css/all.css'),
        array('name' => '5.0.12', 'url' => '5.0.12||https://use.fontawesome.com/releases/v5.0.12/css/all.css'),
        array('name' => '5.0.10', 'url' => '5.0.10||https://use.fontawesome.com/releases/v5.0.10/css/all.css'),
        array('name' => '5.0.9', 'url' => '5.0.9||https://use.fontawesome.com/releases/v5.0.9/css/all.css'),
        array('name' => '5.0.8', 'url' => '5.0.8||https://use.fontawesome.com/releases/v5.0.8/css/all.css'),
        array('name' => '5.0.6', 'url' => '5.0.6||https://use.fontawesome.com/releases/v5.0.6/css/all.css'),
        array('name' => '5.0.4', 'url' => '5.0.4||https://use.fontawesome.com/releases/v5.0.4/css/all.css'),
        array('name' => '4.7.0', 'url' => '4.7.0||https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'),
    );
    global $wpdb;
    $table_import = $wpdb->prefix . 'oxi_div_import';
    $FontFamily = $wpdb->get_results("SELECT * FROM $table_import WHERE font = 'fontfamily' ORDER by font  ASC", ARRAY_A);
    ?>
    <div class="wrap">    
        <?php echo OxiAddonsAdmAdminMenu($oxitype, '', 'other'); ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-row">
                <!--- settings tabs start now---->
                <h1><?php _e('Shortcode Addons Settings'); ?></h1>
                <p>Set Shortcode Addons With Your Theme and Development.</p>

                <?php
                if (!current_user_can('manage_options')) {
                    echo '<p style="color:red">**Note: You can only add or midify Google Font Family. For admin access You can\'t modify others. If you want so kindly contact with your admin.</p>';
                }
                ?>
                <div  class="nav-tab-wrapper oxi-addons-settings-tab-wrapper">
                    <div class="nav-tab" oxi-data="#oxi-tab-general">General Settings</div>
                    <div  class="nav-tab" oxi-data="#oxi-tab-font-family">Font Family</div>
                    <div  class="nav-tab" oxi-data="#oxi-tab-license-key">License Key</div>
                </div>
                <div class="oxi-addons-settings-tab" id="oxi-tab-general">
                    <!--- first tab of settings page---->
                    <form method="post" action="options.php" id="oxigeneraldatauser">
                        <?php settings_fields('oxi-addons-settings-group'); ?>
                        <?php do_settings_sections('oxi-addons-settings-group'); ?>
                        <table class="form-table">

                            <?php
                            if (!current_user_can('manage_options')) {
                                $jquery = 'jQuery("#oxigeneraldatauser  *").prop("disabled", true);';
                                wp_add_inline_script('oxi-addons-vendor', $jquery);
                            }
                            ?>
                            <tr valign="top">
                                <td scope="row">Who Can Edit?</td>
                                <td>
                                    <select name="oxi_addons_user_permission">
                                        <?php foreach ($roles as $key => $role) { ?>
                                            <option value="<?php echo $key; ?>" <?php selected($saved_role, $key); ?>><?php echo $role; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_user_permission"><?php _e('Select the Role who can manage This Plugins.'); ?> <a target="_blank" href="https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table">Help</a></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Admin Version</td>
                                <td>
                                    <input type="radio" name="oxi_addons_admin_version" value="yes" <?php checked('yes', get_option('oxi_addons_admin_version'), true); ?>>Lite
                                    <input type="radio" name="oxi_addons_admin_version" value="" <?php checked('', get_option('oxi_addons_admin_version'), true); ?>>Full Version
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_admin_version"><?php _e('Set Oxi Addons Admin Page Version where Data Will show as Lite or Full version'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Google Font Support</td>
                                <td>
                                    <input type="radio" name="oxi_addons_google_font" value="" <?php checked('', get_option('oxi_addons_google_font'), true); ?>>YES
                                    <input type="radio" name="oxi_addons_google_font" value="no" <?php checked('no', get_option('oxi_addons_google_font'), true); ?>>No
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_google_font"><?php _e('Load Google Font CSS at shortcode loading, If your theme already loaded select No for faster loading'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Font Awesome Support</td>
                                <td>
                                    <input type="radio" name="oxi_addons_font_awesome" value="yes" <?php checked('yes', get_option('oxi_addons_font_awesome'), true); ?>>YES
                                    <input type="radio" name="oxi_addons_font_awesome" value="" <?php checked('', get_option('oxi_addons_font_awesome'), true); ?>>No
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_font_awesome"><?php _e('Load Font Awesome CSS at shortcode loading, If your theme already loaded select No for faster loading'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Font Awesome Version?</td>
                                <td>
                                    <select name="oxi_addons_font_awesome_version">
                                        <?php foreach ($fontawesomevr as $value) { ?>
                                            <option value="<?php echo $value['url']; ?>" <?php selected($fontawvr, $value['url']); ?>><?php echo $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_font_awesome_version"><?php _e('Select Your Font Awesome version, Which are using into your sites so Its will not conflict your Icons'); ?></label>
                                </td>
                            </tr>  
                            <tr valign="top">
                                <td scope="row">Bootstrap 4 Support</td>
                                <td>
                                    <input type="radio" name="oxi_addons_bootstrap" value="yes" <?php checked('yes', get_option('oxi_addons_bootstrap'), true); ?>>YES
                                    <input type="radio" name="oxi_addons_bootstrap" value="" <?php checked('', get_option('oxi_addons_bootstrap'), true); ?>>No
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_bootstrap"><?php _e('Add Bootstrap Style and JQuery with Shortcode Using, Its Bootstrap 4 Version'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Linear Gradient Support</td>
                                <td>
                                    <input type="radio" name="oxi_addons_linear_gradient" value="yes" <?php checked('yes', get_option('oxi_addons_linear_gradient'), true); ?>>YES
                                    <input type="radio" name="oxi_addons_linear_gradient" value="" <?php checked('', get_option('oxi_addons_linear_gradient'), true); ?>>No
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_linear_gradient"><?php _e('Use Linear Gradient at Background Selector, You can also use RGBA'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Waypoints Support</td>
                                <td>
                                    <input type="radio" name="oxi_addons_waypoints" value="yes" <?php checked('yes', get_option('oxi_addons_waypoints'), true); ?>>YES
                                    <input type="radio" name="oxi_addons_waypoints" value="" <?php checked('', get_option('oxi_addons_waypoints'), true); ?>>No
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_waypoints"><?php _e('Do you want to load Waypoints. If your theme already loaded set it No.'); ?></label>
                                </td>
                            </tr> 
                            <tr valign="top">
                                <td scope="row">Conflict Class Support</td>
                                <td>
                                    <input type="text" name="oxi_addons_conflict_class" value="<?php echo get_option('oxi_addons_conflict_class'); ?>">
                                </td>
                                <td>
                                    <label class="description" for="oxi_addons_conflict_class"><?php _e('Add Class for avoid Conflict.'); ?></label>
                                </td>
                            </tr> 
                        </table>
                        <?php
                        submit_button();
                        ?>


                    </form>
                </div>

                <div class="oxi-addons-settings-tab" id="oxi-tab-font-family">
                    <!--- font familly of settings page---->
                    <h1><?php _e('Font Family Settings'); ?></h1>
                    <p> <?php _e(' You can also use your Personal Font . Make sure at personal font that you load font library properly.'); ?></p>
                    <form method="post" id="oxi-addons-form-submit">
                        <table class="form-table" style="max-width: 350px;">
                            <tr valign="top">
                                <td>
                                    <input type="text" id="oxi_addons_google_font" name="oxi_addons_google_font" value="">
                                </td>
                                <td>
                                    <input name="font-data-submit" class="button oxi-font-family-saved" value="Save" type="button">
                                    <input name="oxi-font-family-status" id="oxi-font-family-status" value="" type="hidden">
                                </td>
                            </tr> 
                            <?php
                            $css = '';
                            foreach ($FontFamily as $value) {
                                echo '<tr valign="top">
                                        <td class="oxi-font-family-' . $value['id'] . '">
                                        ' . oxi_addons_shortcode_name_converter($value['type']) . '
                                        </td>
                                        <td>
                                            <input oxidatafont="' . $value['type'] . '" class="button delete oxi-font-family-delete" value="Delete" type="button">
                                        </td>
                                    </tr> ';
                                $css .= '.oxi-font-family-' . $value['id'] . '{font-family: ' . oxi_addons_font_familly($value['type']) . ' !important;}';
                            }
                            wp_add_inline_style('oxi-addons-admin', $css);
                            ?>
                        </table>
                        <?php wp_nonce_field("oxi-addons-font-family-nonce") ?>
                    </form>
                </div>
                <div class="oxi-addons-settings-tab" id="oxi-tab-license-key">
                    <!--- Product License of settings page---->
                    <h1><?php _e('Product License Activation'); ?></h1>
                    <p>Activate your copy to get direct plugin updates and official support.</p>
                    <form method="post" action="options.php" id="oxilicensepageuser">

                        <?php settings_fields('oxi_addons_license'); ?>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row" valign="top">
                                        <?php _e('License Key'); ?>
                                    </th>
                                    <td>
                                        <?php
                                        if (current_user_can('manage_options')) {
                                            echo '<input id="oxi_addons_license_key" name="oxi_addons_license_key" type="text" class="regular-text" value="' . $license . '" />';
                                        } else {
                                            $jquery = 'jQuery("#oxilicensepageuser  *").prop("disabled", true);';
                                            wp_add_inline_script('oxi-addons-vendor', $jquery);
                                            echo '<input id="oxi_addons_license_key" name="oxi_addons_license_key" type="text" class="regular-text" value="##############################" />';
                                        }
                                        ?>
                                        <label class="description" for="oxi_addons_license_key"><?php _e('Enter your license key'); ?></label>
                                    </td>
                                </tr>
                                <?php if (!empty($license)) { ?>
                                    <tr valign="top">
                                        <th scope="row" valign="top">
                                            <?php _e('Activate License'); ?>
                                        </th>
                                        <td>
                                            <?php if ($status !== false && $status == 'valid') { ?>
                                                <span style="color:green;"><?php _e('active'); ?></span>
                                                <?php wp_nonce_field('oxi_addons_nonce', 'oxi_addons_nonce'); ?>
                                                <input type="submit" class="button-secondary" name="oxi_addons_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                                <?php
                                            } else {
                                                wp_nonce_field('oxi_addons_nonce', 'oxi_addons_nonce');
                                                ?>
                                                <input type="submit" class="button-secondary" name="oxi_addons_license_activate" value="<?php _e('Activate License'); ?>"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php submit_button(); ?>
                    </form>
                </div>
            </div>
        </div> 
    </div>
    <!--- tabbing jquery at settings page---->
    <?php
    $preview = get_transient('oxi-addons-preview-page');
    if (empty($preview)) {
        $previewclass = ':first';
    } else if ($preview == 'font') {
        $previewclass = ':eq(1)';
    } else {
        $previewclass = ':eq(2)';
    }
    $jquery = ' jQuery(".oxi-addons-settings-tab-wrapper .nav-tab' . $previewclass . '").addClass("nav-tab-active");
                jQuery(".oxi-addons-settings-tab' . $previewclass . '").fadeIn();
                jQuery(".oxi-addons-settings-tab-wrapper .nav-tab").click(function () {
                    var activeTab = jQuery(this).attr("oxi-data");
                    if(jQuery(this).hasClass("nav-tab-active")){
                        return false
                    }else{
                        jQuery(".oxi-addons-settings-tab-wrapper .nav-tab").removeClass("nav-tab-active");
                        jQuery(this).toggleClass("nav-tab-active");
                        jQuery(".oxi-addons-settings-tab").fadeOut();
                        jQuery(activeTab).fadeIn();
                    }
                    
                });
                jQuery(".oxilab-admin-menu li:eq(3) a").addClass("active");';
    wp_add_inline_script('font-family-settings', $jquery);
}

function oxi_addons_plugin_settings() {
    //register our settings
    register_setting('oxi-addons-settings-group', 'oxi_addons_user_permission');
    register_setting('oxi-addons-settings-group', 'oxi_addons_google_font');
    register_setting('oxi-addons-settings-group', 'oxi_addons_font_awesome');
    register_setting('oxi-addons-settings-group', 'oxi_addons_font_awesome_version');
    register_setting('oxi-addons-settings-group', 'oxi_addons_bootstrap');
    register_setting('oxi-addons-settings-group', 'oxi_addons_admin_version');
    register_setting('oxi-addons-settings-group', 'oxi_addons_linear_gradient');
    register_setting('oxi-addons-settings-group', 'oxi_addons_waypoints');
    register_setting('oxi-addons-settings-group', 'oxi_addons_conflict_class');
}

add_action('admin_init', 'oxi_addons_plugin_settings');

/**
 * The code that runs during font family saved.
 * Font family works at settings page
 */
function OxiAddonsAdminFontFamilySave() {
    if (!empty($_REQUEST['_wpnonce'])) {
        $nonce = $_REQUEST['_wpnonce'];
    }
    global $wpdb;
    $table_import = $wpdb->prefix . 'oxi_div_import';
    if (!empty($_POST['oxi_addons_google_font'])) {
        if (!wp_verify_nonce($nonce, 'oxi-addons-font-family-nonce')) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            set_transient('oxi-addons-preview-page', 'font', 30);
            $type = 'fontfamily';
            $fontfamily = sanitize_text_field($_POST['oxi_addons_google_font']);
            $status = sanitize_text_field($_POST['oxi-font-family-status']);
            if ($status == 'delete') {
                $wpdb->query($wpdb->prepare("DELETE FROM $table_import WHERE type = %s", $fontfamily));
            } else {
                $wpdb->query($wpdb->prepare("INSERT INTO {$table_import} (font, type) VALUES ( %s, %s)", array($type, $fontfamily)));
            }
        }
    }
}

add_action('admin_init', 'OxiAddonsAdminFontFamilySave');

function oxi_addons_register_option() {
    // creates our settings in the options table
    register_setting('oxi_addons_license', 'oxi_addons_license_key', 'oxi_addons_sanitize_license');
}

add_action('admin_init', 'oxi_addons_register_option');

function oxi_addons_sanitize_license($new) {
    $old = get_option('oxi_addons_license_key');
    set_transient('oxi-addons-preview-page', 'license', 30);
    if ($old && $old != $new) {
        delete_option('oxi_addons_license_status'); // new license has been entered, so must reactivate
    }
    return $new;
}

/* * **********************************
 * this illustrates how to activate
 * a license key
 * *********************************** */

function oxi_addons_activate_license() {

    // listen for our activate button to be clicked
    if (isset($_POST['oxi_addons_license_activate'])) {
        set_transient('oxi-addons-preview-page', 'license', 30);
        // run a quick security check
        if (!check_admin_referer('oxi_addons_nonce', 'oxi_addons_nonce'))
            return; // get out if we didn't click the Activate button
// retrieve the license from the database
        $license = trim(get_option('oxi_addons_license_key'));
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license' => $license,
            'item_name' => urlencode(OXILAB_OXI_ADDONS), // the name of our product in EDD
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(OXILAB_OXI_ADDONS_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        // make sure the response came back okay
        if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

            if (is_wp_error($response)) {
                $message = $response->get_error_message();
            } else {
                $message = __('An error occurred, please try again.');
            }
        } else {

            $license_data = json_decode(wp_remote_retrieve_body($response));

            if (false === $license_data->success) {

                switch ($license_data->error) {

                    case 'expired' :

                        $message = sprintf(
                                __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                        );
                        break;

                    case 'revoked' :

                        $message = __('Your license key has been disabled.');
                        break;

                    case 'missing' :

                        $message = __('Invalid license.');
                        break;

                    case 'invalid' :
                    case 'site_inactive' :

                        $message = __('Your license is not active for this URL.');
                        break;

                    case 'item_name_mismatch' :

                        $message = sprintf(__('This appears to be an invalid license key for %s.'), OXILAB_OXI_ADDONS);
                        break;

                    case 'no_activations_left':

                        $message = __('Your license key has reached its activation limit.');
                        break;

                    default :

                        $message = __('An error occurred, please try again.');
                        break;
                }
            }
        }

        // Check if anything passed on a message constituting a failure
        if (!empty($message)) {
            $base_url = admin_url('admin.php?page=' . OXILAB_OXI_ADDONS_LICENSE_PAGE);
            $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

            wp_redirect($redirect);
            exit();
        }

        // $license_data->license will be either "valid" or "invalid"

        update_option('oxi_addons_license_status', $license_data->license);
        if ($license_data->license == 'valid') {
            add_option('image_hover_ultimate_license_status', $license_data->license);
            add_option('oxilab_flip_box_license_status', $license_data->license);
            add_option('responsive_tabs_with_accordions_license_status', $license_data->license);
        }
        wp_redirect(admin_url('admin.php?page=' . OXILAB_OXI_ADDONS_LICENSE_PAGE));
        exit();
    }
}

add_action('admin_init', 'oxi_addons_activate_license');
/* * *********************************************
 * Illustrates how to deactivate a license key.
 * This will decrease the site count
 * ********************************************* */

function oxi_addons_deactivate_license() {

    // listen for our activate button to be clicked
    if (isset($_POST['oxi_addons_license_deactivate'])) {
        set_transient('oxi-addons-preview-page', 'license', 30);
        // run a quick security check
        if (!check_admin_referer('oxi_addons_nonce', 'oxi_addons_nonce'))
            return; // get out if we didn't click the Activate button 
// retrieve the license from the database
        $license = trim(get_option('oxi_addons_license_key'));
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license' => $license,
            'item_name' => urlencode(OXILAB_OXI_ADDONS), // the name of our product in EDD
            'url' => home_url()
        );
        // Call the custom API.
        $response = wp_remote_post(OXILAB_OXI_ADDONS_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
        // make sure the response came back okay
        if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
            if (is_wp_error($response)) {
                $message = $response->get_error_message();
            } else {
                $message = __('An error occurred, please try again.');
            }
            $base_url = admin_url('admin.php?page=' . OXILAB_OXI_ADDONS_LICENSE_PAGE);
            $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

            wp_redirect($redirect);
            exit();
        }
        // decode the license data
        $license_data = json_decode(wp_remote_retrieve_body($response));
        // $license_data->license will be either "deactivated" or "failed"
        if ($license_data->license == 'deactivated') {
            delete_option('oxi_addons_license_status');
        }
        wp_redirect(admin_url('admin.php?page=' . OXILAB_OXI_ADDONS_LICENSE_PAGE));
        exit();
    }
}

add_action('admin_init', 'oxi_addons_deactivate_license');
/* * **********************************
 * this illustrates how to check if
 * a license key is still valid
 * the updater does this for you,
 * so this is only needed if you
 * want to do something custom
 * *********************************** */

function oxi_addons_check_license() {
    global $wp_version;
    $license = trim(get_option('oxi_addons_license_key'));
    $api_params = array(
        'edd_action' => 'check_license',
        'license' => $license,
        'item_name' => urlencode(OXILAB_OXI_ADDONS),
        'url' => home_url()
    );

    // Call the custom API.
    $response = wp_remote_post(OXILAB_OXI_ADDONS_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

    if (is_wp_error($response))
        return false;

    $license_data = json_decode(wp_remote_retrieve_body($response));

    if ($license_data->license == 'valid') {
        echo 'valid';
        exit;
        // this license is still valid
    } else {
        echo 'invalid';
        exit;
        // this license is no longer valid
    }
}

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function oxi_addons_admin_notices() {
    if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

        switch ($_GET['sl_activation']) {

            case 'false':
                $message = urldecode($_GET['message']);
                ?>
                <div class="error">
                    <p><?php echo $message; ?></p>
                </div>
                <?php
                break;

            case 'true':
            default:
                break;
        }
    }
}

add_action('admin_notices', 'oxi_addons_admin_notices');

function oxi_addons_shortcode_reviews_call() {
    $reviews = "";
    if (isset($_GET['oxi_addons_shortcode_reviews'])) {
        $reviews = esc_attr($_GET['oxi_addons_shortcode_reviews']);
    }
    if ('already' == $reviews) {
        add_option('oxi_addons_shortcode_reviews', $reviews);
    } elseif ('later' == $reviews) {
        $now = strtotime("now");
        update_option('oxi_addons_shortcode_activation_date', $now);
    }
}

add_action('admin_init', 'oxi_addons_shortcode_reviews_call');

function oxi_addons_shortcode_reviews_check_installation_date() {
    $reviews = "";
    $reviews = get_option('oxi_addons_shortcode_reviews');
    $past_date = strtotime('-7 days');
    if ($reviews != 'already') {
        $install_date = get_option('oxi_addons_shortcode_activation_date');
        if (empty($install_date)) {
            $now = strtotime("now");
            add_option('oxi_addons_shortcode_activation_date', $now);
        } elseif ($past_date >= $install_date) {
            add_action('admin_notices', 'oxi_addons_shortcode_reviews_admin_notice');
        }
    }
}

add_action('admin_init', 'oxi_addons_shortcode_reviews_check_installation_date');

function oxi_addons_shortcode_reviews_admin_notice() {

    // Review URL - Change to the URL of your plugin on WordPress.org
    $reviewurl = 'https://wordpress.org/plugins/shortcode-addons/';

    $reviewsurl = get_admin_url() . '?oxi_addons_shortcode_reviews=later';
    $reviewsurl2 = get_admin_url() . '?oxi_addons_shortcode_reviews=already';

    echo '<div class="updated">';
    echo '<p></p>';

    printf(__('<p>Hey, You’ve using <strong>Shortcode Addons- with Visual Composer, Divi, Beaver Builder and Elementor Extension </strong> more than 1 week – that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.!
                     </p>
                    <p><a href=%s target="_blank"><strong>Ok, you deserve it</strong></a></p>
                    <p><a href=%s><strong>Nope, maybe later</strong></a> </p>
                    <p><a href=%s><strong>I already did</strong></a> </p>'), $reviewurl, $reviewsurl, $reviewsurl2);
    echo '<p></p>';
    echo "</div>";
}
