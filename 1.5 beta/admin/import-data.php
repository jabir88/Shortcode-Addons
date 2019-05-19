<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();
/**
 * Import Data
 * Shortcode Addons Import Data Page
 */
$oxitype = 'oxi-addons';
global $wpdb;
$table_name = $wpdb->prefix . 'oxi_div_style';
$table_list = $wpdb->prefix . 'oxi_div_list';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}

/**
 * Check Import Data 
 * Checking Admin Import Data with Nonce
 */
$status = get_option('oxi_addons_license_status');
if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'OxiAddImportData-nonce')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $directory = OxiAddonsElements;
        $DIRfiles = glob($directory . '*', GLOB_ONLYDIR);
        $importcheck = array();
        foreach ($DIRfiles as $value) {
            $file = explode('/OxiAddonsElements/', $value);
            if (!empty($value)) {
                $importcheck[] = $file[1];
            }
        }
        $requirment = '';
        $ImportData = OxiAddonsADMHelpTextSenitize($_POST['OxiAddImportData-content']);
        $addonscheck = strpos($ImportData, 'OxiAddonsImportAddons');
        if ($addonscheck !== FALSE) {
            if (strpos($ImportData, 'image-hover-ultimate-new') !== FALSE) {
                $addons_table_name = $wpdb->prefix . 'image_hover_ultimate_style';
                $addons_table_files = $wpdb->prefix . 'image_hover_ultimate_list';
                $addonsdata = explode('OxiAddonsImportAddons', $ImportData);
                $slug = $addonsdata[0];
                $addonsstyle = explode('|||OxiAddonsImport|||', $addonsdata[1]);
                $addonsfiles = explode('|||OxiAddonsImportFiles|||', $addonsdata[2]);
                $wpdb->query($wpdb->prepare("INSERT INTO {$addons_table_name} (name, style_name, css) VALUES ( %s, %s, %s )", array($addonsstyle[0], $addonsstyle[1], $addonsstyle[2])));
                $redirect_id = $wpdb->insert_id;
                if ($redirect_id > 0) {
                    foreach ($addonsfiles as $value) {
                        if (strpos($value, '|||OxiAddonsImport|||') !== FALSE) {
                            $addonsdatafiles = explode('|||OxiAddonsImport|||', $value);
                            $wpdb->query($wpdb->prepare("INSERT INTO $addons_table_files (styleid, title, files, buttom_text, link, image, hoverimage, data1, data1link, data2, data2link) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", array($redirect_id, $addonsdatafiles[0], $addonsdatafiles[1], $addonsdatafiles[2], $addonsdatafiles[3], $addonsdatafiles[4], $addonsdatafiles[5], $addonsdatafiles[6], $addonsdatafiles[7], $addonsdatafiles[8], $addonsdatafiles[9])));
                        }
                    }
                    $url = admin_url("admin.php?page=$slug&styleid=$redirect_id");
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                }
            } else if (strpos($ImportData, 'content-tabs-ultimate-new') !== FALSE) {
                $addons_table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
                $addons_table_files = $wpdb->prefix . 'content_tabs_ultimate_list';
                $addonsdata = explode('OxiAddonsImportAddons', $ImportData);
                $slug = $addonsdata[0];
                $addonsstyle = explode('|||OxiAddonsImport|||', $addonsdata[1]);
                $addonsfiles = explode('|||OxiAddonsImportFiles|||', $addonsdata[2]);
                $wpdb->query($wpdb->prepare("INSERT INTO {$addons_table_name} (name, style_name, css) VALUES ( %s, %s, %s )", array($addonsstyle[0], $addonsstyle[1], $addonsstyle[2])));
                $redirect_id = $wpdb->insert_id;
                if ($redirect_id > 0) {
                    foreach ($addonsfiles as $value) {
                        // echo $value;
                        if (strpos($value, '|||OxiAddonsImport|||') !== FALSE) {
                            $addonsdatafiles = explode('|||OxiAddonsImport|||', $value);
                            $wpdb->query($wpdb->prepare("INSERT INTO $addons_table_files (styleid, title, files, css) VALUES (%d, %s, %s, %s)", array($redirect_id, $addonsdatafiles[0], $addonsdatafiles[1], $addonsdatafiles[2])));
                        }
                    }
                    $url = admin_url("admin.php?page=$slug&styleid=$redirect_id");
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                }
            } else if (strpos($ImportData, 'oxilab-flip-box-admin') !== FALSE) {
                $addons_table_name = $wpdb->prefix . 'oxi_div_style';
                $addons_table_files = $wpdb->prefix . 'oxi_div_list';
                $addonsdata = explode('OxiAddonsImportAddons', $ImportData);
                $slug = $addonsdata[0];
                $addonsstyle = explode('|||OxiAddonsImport|||', $addonsdata[1]);
                $addonsfiles = explode('|||OxiAddonsImportFiles|||', $addonsdata[2]);
                $wpdb->query($wpdb->prepare("INSERT INTO {$addons_table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($addonsstyle[0], $addonsstyle[1], $addonsstyle[2], $addonsstyle[3])));
                $redirect_id = $wpdb->insert_id;
                if ($redirect_id > 0) {
                    foreach ($addonsfiles as $value) {
                        if (strpos($value, '|||OxiAddonsImport|||') !== FALSE) {
                            $addonsdatafiles = explode('|||OxiAddonsImport|||', $value);
                            $wpdb->query($wpdb->prepare("INSERT INTO $addons_table_files (styleid, type, files, css) VALUES (%d, %s, %s, %s)", array($redirect_id, $addonsdatafiles[0], $addonsdatafiles[1], $addonsdatafiles[2])));
                        }
                    }
                    $url = admin_url("admin.php?page=$slug&styleid=$redirect_id");
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                }
            }
        } else {
            if ($status != 'valid') {
                  $url = admin_url("admin.php?page=oxi-addons-import&oxitype=oxiprofile");
            } else {
                $finaldata = explode('|||{VULEO EDIT ER CINTA KORBEN NA}|||', $ImportData);
                $fixedcontent = '';
                for ($is = 0; $is < count($finaldata); $is++) {
                    $datatue = strpos($finaldata[$is], '|||{SHORTCODE DATA VULA JABE NA}|||');
                    if ($datatue !== FALSE) {
                        $FXDATA = str_replace('|||{SHORTCODE DATA VULA JABE NA}|||', '', $finaldata[$is]);
                        $datatrue = strpos($FXDATA, '##OXISTYLE##');
                        if ($datatrue !== FALSE) {
                            $oxidata = explode('##OXISTYLE##', $FXDATA);
                            $IMdata = explode('OXIIMPORT', $oxidata[0]);
                            $IMFILE = explode('##OXIDATA##', $oxidata[1]);
                            if (count($IMdata) == 4) {
                                $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($IMdata[0], $IMdata[1], $IMdata[2], $IMdata[3])));
                                $redirect_id = $wpdb->insert_id;

                                if ($redirect_id == 0) {
                                    $url = admin_url("admin.php?page=oxi_addons_import_data");
                                }
                                if ($redirect_id != 0) {
                                    foreach ($IMFILE as $value) {
                                        if (!empty($value)) {
                                            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, type, files) VALUES (%d, %s, %s )", array($redirect_id, 'oxi-addons', $value)));
                                        }
                                    }
                                    if (in_array($IMdata[1], $importcheck)) {
                                        $requirment .= '';
                                    } else {
                                        $requirment .= '' . $IMdata[1] . 'oxibr';
                                    }
                                }
                            }
                        } else {
                            $IMdata = explode('OXIIMPORT', $FXDATA);
                            if (count($IMdata) == 4) {
                                $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($IMdata[0], $IMdata[1], $IMdata[2], $IMdata[3])));
                                $redirect_id = $wpdb->insert_id;
                                if (in_array($IMdata[1], $importcheck)) {
                                    $requirment .= '';
                                } else {
                                    $requirment .= '' . $IMdata[1] . 'oxibr';
                                }
                            }
                        }
                        $fixedcontent .= OxiAddonsADMHelpTextSenitize('[oxi_addons id="' . $redirect_id . '"]');
                    } else {
                        $fixedcontent .= $finaldata[$is];
                    }
                }
                $datatrue = strpos($fixedcontent, '##OXISTYLE##');
                if ($datatrue !== FALSE) {
                    $oxidata = explode('##OXISTYLE##', $fixedcontent);
                    $IMdata = explode('OXIIMPORT', $oxidata[0]);
                    $IMFILE = explode('##OXIDATA##', $oxidata[1]);
                    if (count($IMdata) == 4) {
                        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($IMdata[0], $IMdata[1], $IMdata[2], $IMdata[3])));
                        $redirect_id = $wpdb->insert_id;
                        if ($redirect_id == 0) {
                            $url = admin_url("admin.php?page=oxi_addons_import_data");
                        }
                        if ($redirect_id != 0) {
                            foreach ($IMFILE as $value) {
                                if (!empty($value)) {
                                    $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, type, files) VALUES (%d, %s, %s )", array($redirect_id, 'oxi-addons', $value)));
                                }
                            }
                            $url = admin_url("admin.php?page=oxi-addons&oxitype=$IMdata[1]&styleid=$redirect_id");
                            if (in_array($IMdata[1], $importcheck)) {
                                $requirment .= '';
                            } else {
                                $requirment .= '' . $IMdata[1] . 'oxibr';
                            }
                        }
                    }
                } else {
                    $IMdata = explode('OXIIMPORT', $fixedcontent);
                    if (count($IMdata) == 4) {
                        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($IMdata[0], $IMdata[1], $IMdata[2], $IMdata[3])));
                        $redirect_id = $wpdb->insert_id;
                        if ($redirect_id == 0) {
                            $url = admin_url("admin.php?page=oxi_addons_import_data");
                        }
                        if ($redirect_id != 0) {
                            $url = admin_url("admin.php?page=oxi-addons&oxitype=$IMdata[1]&styleid=$redirect_id");
                        }
                        if (in_array($IMdata[1], $importcheck)) {
                            $requirment .= '';
                        } else {
                            $requirment .= '' . $IMdata[1] . 'oxibr';
                        }
                    }
                }
                if ($requirment != '') {
                    $url = admin_url("admin.php?page=oxi-addons-import&oxirequirment=$requirment");
                }
            }
            echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
            exit;
        }
    }
}
oxi_addons_font_familly('Bree+Serif');
oxi_addons_font_familly('Source+Sans+Pro');
?>
<div class="wrap"> 
    <?php echo OxiAddonsAdmAdminMenu($oxitype, '', 'other'); ?>

    <div class="oxi-addons-wrapper">   
        <div class="oxi-addons-import-layouts">

            <h1>Import Shortcodes Data</h1>
            <p> The Import tool allows you to easily manage your Shortcode content. Its too easy as copy templete files from our online style list or local files and paste it into our import box. Once Imported your data will shown automatically with new shortcode.</p>
            <!----- Import Form ---->

            <?php
            if ($status != 'valid') {
                echo '<div class="oxi-addons-updated">
                        <p>Hey, Thank you very much, to using <strong>Shortcode Addons- with Visual Composer, Divi, Beaver Builder and Elementor Extension </strong>! Import style or layouts will works only at Pro or Premium version. Our Premium version comes with lots of features and 16/6 Dedicated Support.</p>
                  </div>';
            }
            ?>
            <form method="post" id="oxi-addons-import-data-form">
                <div class="oxi-addons-import-data">
                    <div class="oxi-headig">
                        Style Data Textbox
                    </div>
                    <div class="oxi-content">
                        <textarea placeholder="Paste your style files..." name="OxiAddImportData-content" ></textarea>
                    </div>
                    <div class="oxi-buttom">
                        <a href="" class="btn btn-danger"> Reset </a>
                        <input type="submit" class="btn btn-success" name="submit" value="Save">
                        <?php wp_nonce_field("OxiAddImportData-nonce") ?>
                    </div>
                </div>
            </form>
            <div class="feature-section">
                <h3>Get Trouble to Import Style?</h3>
                <p>Your suggestions will make this plugin even better, Even if you get any bugs on Shortcode Addons so let us to know, We will try to solved within few hours</p>
                <p class="oxi-feature-button">
                    <a href="https://www.oxilab.org/docs/shortcode-addons/import-layouts/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Documentation</a>
                    <a href="https://wordpress.org/plugins/shortcode-addons/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
$jquery = 'jQuery(".oxilab-admin-menu li:eq(2) a").addClass("active");';
wp_add_inline_script('oxi-addons-bootstrap-jquery', $jquery);
