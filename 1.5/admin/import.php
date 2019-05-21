<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();
/**
 * Check Import Elements 
 * Checking Admin Import Elements with Nonce
 */
$oxitype = 'oxi-addons';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}

$status = get_option('oxi_addons_license_status');

/**
 * Elements Checking 
 * Elements checking with Custom Data
 */
$directory = OxiAddonsElements;
$DIRfiles = glob($directory . '*', GLOB_ONLYDIR);


$addonsfile = array();
foreach ($DIRfiles as $value) {
    $file = explode('/OxiAddonsElements/', $value);
    if (!empty($value)) {
        $addonsfile[] = $file[1];
    }
}
/**
 * Elements List
 */
$alldata = array(
    array(
        'Content Elements',
        array('accordion', 'bullet_list', 'button', 'content_boxes', 'count_down', 'drop_caps', 'heading', 'icon', 'icon_boxes', 'image_boxes', 'info_boxes', 'info_image_boxes', 'logo_showcase', 'single_image', 'team', 'testimonial', 'text_blocks')
    ),
    array(
        'Creative Elements',
        array('animated_text', 'banner', 'content_toggle', 'counter', 'dual_button', 'footer_info', 'headers', 'icon_effects', 'image_accordion', 'image_comparison', 'image_scroll', 'info_banner', 'interactive_cards', 'lightbox', 'link_effects', 'offcanvas_content', 'progress_bars', 'tooltip')
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
        array('image_effects')
    //array('image_effects', 'creative_effects', 'square_effects', 'button_effects', 'hover_effects')
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
        array('divider', 'section_divider', 'spacer')
    ),
);

$url = $jquery = '';
/**
 * Free version File
 * Free version text file for Shortcode Addons
 */
if (!empty($_GET['oxitype']) && $_GET['oxitype'] == 'oxiprofile') {
    ?>
    <div class="wrap">    
        <div class="oxilab-admin-wrapper">
            <div class="oxi-addons-promote-header">
                <div class="oxi-addons-promote-header-image">
                    <img src="<?php echo plugins_url(); ?>/shortcode-addons/image/shortcode-addons.png">
                </div>
                <div class="oxi-addons-promote-header-heading">
                    Shortcode Addons (Premium)
                </div>
                <div class="oxi-addons-promote-header-info">
                    Ultimate elements library for WordPress Page Builder, Page or Post. 50+ Premium elements with endless customization options.
                </div>
                <div class="oxi-addons-promote-header-button">
                    <button type="button" class="oxi-btn" oxilink="https://www.oxilab.org/downloads/short-code-addons/">Buy Now</button>
                    <button type="button" class="oxi-btn oxi-btn-2" oxilink="https://www.oxilab.org/shortcode-addons-features/">Elements</button>
                </div>
            </div>
            <div class="oxi-addons-promote-features row m-0">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <?php echo oxi_addons_font_awesome('far fa-window-restore'); ?>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Fully Responsive
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        You can use Shortcode Addons with any WordPress theme as long as you installed and activated on it. We’ve tested it on popular theme like GeneratePress, Astra, Ocean also regular Updated.
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <?php echo oxi_addons_font_awesome('far fa-life-ring'); ?>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Friendly Support
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        Our 5 Stars ratings on WordPress.org platforms mainly because of our customer support quality. We even offer our support for free version users and it has been praised by our amazing plugin users.
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <i class="fas oxi-icons fa-assistive-listening-systems"></i>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Use With Any Theme
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        We’ve tested it on popular theme like GeneratePress, Astra, Ocean and also with our own themes like Wiz & it worked perfectly on all of them. We also update regularly to fixed bugs.  
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <i class="fas oxi-icons fa-bolt"></i>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Light Weight
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        Shortcode Addons is 100% modular, Plugins file will load when you only use thats shortcode. Without any shortcode its not load any CSS or JQUERY file also perform fas oxi-iconster performance.
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <i class="fas oxi-icons fa-wrench"></i>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Updated Regularly
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        Shortcode Addons is regularly updated to be always compatible with the latest WordPress versions. We also add new elements and enhance current elements based on our customers feedback.
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="oxi-addons-promote-features-icon">
                        <i class="fas oxi-icons fa-baseball-ball"></i>
                    </div>
                    <div class="oxi-addons-promote-features-heading">
                        Cross Browsers Compatible
                    </div>
                    <div class="oxi-addons-promote-features-content">
                        Shortcode Addons’ elements are tested on all major web browsers like Google Chrome, Mozilla Firefox, Safari, Opera and Internet Explorer to assure full browser compatibility for all elements.
                    </div>
                </div>
            </div>
            <div class="oxi-addons-promote-accordions row m-0">
                <div class="oxi-addons-promote-accordions-heading">
                    Frequently Asked questions
                </div>

                <div class="col-md-12 col-lg-6">
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading active" oxi-ref="#oxi-addons-promote-accordionstab-content-1">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            Is this a standalone plugin?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-1" style="display: block;">
                            Yes, You can use shortcode into page or post. As you are using any page builder so its also works with page builders. <br><br>Normally we build widgets for popular page builder. If you don't get kindly use shortcode into your page builders.
                        </div>
                    </div>     
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading" oxi-ref="#oxi-addons-promote-accordionstab-content-2">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            Does it work with any WordPress theme?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-2">
                            Yes, it will work with any WordPress theme as long as you are using active Shortcode Addons into your website.
                        </div>
                    </div> 
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading" oxi-ref="#oxi-addons-promote-accordionstab-content-3">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            How often do you update Shortcode Addons?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-3">
                            We update our plugins monthly at least. We always add enhancements to existing elements according to users feedback, add new elements and for sure fix bugs and compatibility issues whenever discovered. <br><br>You can Check our change log Here.
                        </div>
                    </div> 
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading active" oxi-ref="#oxi-addons-promote-accordionstab-content-6">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            Will this plugin slow down my website speed?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-6" style="display: block;">
                            No, As our awesome plugins admin panel, If you can't add any shortcode into your sites. Shortcode Addons will not load any CSS or jQuery into your page. <br> <br>Also its will load CSS as your desire shortcode only not all. So your page will speed up with Shortcode Addons.
                        </div>
                    </div>  
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading" oxi-ref="#oxi-addons-promote-accordionstab-content-4">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            Do I have to buy Shortcode Addons?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-4">
                            No, Its totally depend on You. We don't force any user to buy pro version. There have some Customization limitation only at free version and pro version..<br><br> So if you are happy with free version, Thats awesome. we also offer support for free version.                  
                        </div>
                    </div>  
                    <div class="oxi-addons-promote-accordionstab">
                        <div class="oxi-addons-promote-accordionstab-heading" oxi-ref="#oxi-addons-promote-accordionstab-content-5">
                            <i class="fas oxi-icons fa-caret-right"></i>
                            <i class="fas oxi-icons fa-caret-down"></i>
                            Do I need to have coding skills to use Premium Addons?
                        </div>
                        <div class="oxi-addons-promote-accordionstab-content" id="oxi-addons-promote-accordionstab-content-5">
                            No, using Shortcode Addons for any website doesn’t require any coding skills. Just follow Tutorial and Documentation so you can use Shortcode Addons.
                        </div>
                    </div>  
                </div>            
            </div>
        </div>
    </div>
    <?php
    $jquery = 'jQuery(".oxi-btn").click(function(){
                                                var url = jQuery(this).attr("oxilink"); 
                                                window.open(url, "_blank");
                                        });
                                        function oxiequalHeight(group) {
                                            tallest = 0;
                                            group.each(function() {
                                               thisHeight = jQuery(this).height();
                                               if(thisHeight > tallest) {
                                                  tallest = thisHeight;
                                               }
                                            });
                                            group.height(tallest);
                                         }
                                         jQuery(document).ready(function() {
                                            oxiequalHeight(jQuery(".oxi-addons-promote-features-content"));
                                         });
                                         jQuery(".oxi-addons-promote-accordionstab-heading").click(function () { 
                                           if (jQuery(this).hasClass("active") !== false) {
                                               jQuery(this).removeClass("active"); 
                                               var activeTab = jQuery(this).attr("oxi-ref");
                                               jQuery(activeTab).slideUp();
                                          } else if (jQuery(this).hasClass("active") === false) {
                                                jQuery(this).addClass("active");
                                                var activeTab = jQuery(this).attr("oxi-ref");
                                                jQuery(activeTab).slideDown(); 
                                          } });';
    $css = '.oxi-addons-promote-header{
                width: 100%;
                float: left;
                background-color: white;
                padding: 5% 5%;
            }
            .oxi-addons-promote-header-image{    
                width: 100%;
                float: left;
                text-align: center;
            }
            .oxi-addons-promote-header-image img{
                width: 100%;
                height: auto;
                max-width: 200px;
            }
            .oxi-addons-promote-header-heading{
                width: 100%;
                float: left;
                text-align: center;
                font-size: 50px;
                font-weight: 600;
                padding: 10px 10px;
                font-family: "Open Sans";
            }
            .oxi-addons-promote-header-info{
                width: 100%;
                text-align: center;
                font-size: 24px;
                font-weight: 400;
                padding: 10px 10px;
                font-family: ' . oxi_addons_font_familly('Open+Sans') . ';
                max-width: 80%;
                margin: 0 auto;
                margin-bottom: 50px;
            }
            .oxi-addons-promote-header-button{
                width: 100%;
                float: left;
                text-align: center;
                margin-bottom: 70px;
            }
            .oxi-addons-promote-header-button .oxi-btn,
            .oxi-addons-promote-header-button .oxi-btn-2{
                margin: 10px 10px;
            }
            .oxi-btn,
            .oxi-btn-2{
                border-radius: 50px;
                font-size: 20px;
                padding: 14px 80px;
                cursor: pointer;
                color: #fff;
                background-color: #FF7059;
                font-family: "Open Sans";
                font-weight: 400;
                border: 1px solid #FF7059;
                box-shadow: 2px 2px 5px #AFE9FF;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                -moz-transition-duration: 0.5s;
            }
            .oxi-btn-2{
                color: #fff;
                background-color: #5D6D7E;
                border: 1px solid #5D6D7E;
                box-shadow: 2px 2px 5px #AFE9FF;
            }
            .oxi-btn:hover,
            .oxi-btn:focus{
                color: #fff;
                border: 1px solid #FF7059;
                box-shadow: 2px 2px 20px #AFE9FF;
                border-radius: 50px;
            }

            .oxi-btn-2:hover,
            .oxi-btn-2:focus{
                color: #fff;
                border: 1px solid #5D6D7E;
                box-shadow: 2px 2px 20px #AFE9FF;
                border-radius: 50px;
            }
            button.oxi-btn,
            button.oxi-btn-2{
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            .oxi-addons-promote-features{
                background: #001031;
                padding: 70px 50px 70px 50px;
                width: 100%;
                float: left;
                text-align: left;
            }

            .oxi-addons-promote-features-icon{
                width: 100%;
                float: left;
                padding: 20px 5px 10px 5px;
                color: #fff;
            }
            .oxi-addons-promote-features-icon .oxi-icons{
                font-size: 60px;
                text-align: left;
            }
            .oxi-addons-promote-features-heading{
                width: 100%;
                float: left;
                text-align: left;
                color: #fff;
                font-size: 24px;
                font-weight: 600;
                padding: 0 5px 10px 5px;
                font-family: "Open Sans";
            }
            .oxi-addons-promote-features-content{
                width: 100%;
                float: left;
                text-align: left;
                color: #fff;
                font-size: 16px;
                font-weight: 400;
                padding: 0 5px 30px 5px;
                font-family: "Open Sans";
            }
            .oxi-addons-promote-accordions{
                width: 100%;
                float: left;
                padding: 50px 50px;
            }
            .oxi-addons-promote-accordions-heading{
                width: 100%;
                float: left;
                color: #676767;
                text-align: center;
                font-size: 50px;
                font-weight: 600;
                padding: 10px 20px 60px;
                font-family: "Open Sans";
            }
            .oxi-addons-promote-accordionstab{
                width: calc(100% - 20px);
                float: left;
                text-align: left;
                margin: 0 10px;    
                margin-bottom: 20px;
                border-bottom: 1px solid #1ac57e;
            }
            .oxi-addons-promote-accordionstab-heading{
                width: 100%;
                float: left;
                color: #000000;
                font-size: 20px;
                font-weight: 400;
                padding: 10px 0px;
                cursor: pointer;
                font-family: "Open Sans";
            }
            .oxi-addons-promote-accordionstab-heading .oxi-icons{    
                width: 30px;
                float: left;
                font-size: 24px;
                text-align: left;
                display: inline-block;
            }
            .oxi-addons-promote-accordionstab-heading .fa-caret-down{    
               display: none;
            }
            .oxi-addons-promote-accordionstab-heading.active .fa-caret-down{    
               display: block;
            }
            .oxi-addons-promote-accordionstab-heading.active .fa-caret-right{    
               display: none;
            }
            .oxi-addons-promote-accordionstab-heading.active,
            .oxi-addons-promote-accordionstab-heading:hover{
                color: #8e005c;
            }
            .oxi-addons-promote-accordionstab-content{
                width: 100%;
                float: left;
                display: none;
                color: #000000;
                font-size: 14px;
                font-weight: 300;
                padding: 10px 0px;
                cursor: pointer;
                font-family: "Open Sans";
            }
            ';
    wp_add_inline_style('oxi-addons-admin', $css);
} else {
    oxi_addons_font_familly('Bree+Serif');
    oxi_addons_font_familly('Source+Sans+Pro');
    echo '<input type="hidden" name="oxi-addons-admin-ajax-nonce" id="oxi-addons-admin-ajax-nonce" value="' . wp_create_nonce("oxi_addons_admin_ajax_nonce") . '"/>';
    echo '<input type="hidden" name="oxi-addons-admin-ajax-nonce" id="oxi-addons-admin-ajax-url" value="' . oxi_addons_admin_menu_link() . '"/>';
    ?>
    <div class="wrap">
        <?php echo OxiAddonsAdmAdminMenu($oxitype, '', 'other'); ?>

        <?php
        echo '<div class="oxi-addons-wrapper oxi-addons-elements-install-massage">   
                    <div class="oxi-addons-row">
                        <div class="oxi-addons-import-requirement oxi-addons-import-requirement-successfully">
                            <div class="oxi-addons-import-requirement-data">
                                <div class="oxi-addons-import-requirement-icon">
                                    ' . oxi_addons_admin_font_awesome('fa-check-circle') . '
                                </div>
                                <div class="oxi-addons-import-requirement-text">
                                    <div class="oxi-addons-import-requirement-heading">
                                     
                                    </div>
                                    <div class="oxi-addons-import-requirement-content">
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        if (!empty($_GET['oxirequirment'])) {
            $oxirequirment = explode('oxibr', $_GET['oxirequirment']);
            $oxirequirmentdata = array();
            foreach ($oxirequirment as $value) {
                $true = 1;
                foreach ($addonsfile as $val) {
                    if ($value == $val) {
                        $true = 0;
                    }
                }
                if ($true == 1 && $value != '') {
                    $oxirequirmentdata[$value] = $value;
                }
            }
            sort($oxirequirmentdata);
            $count = count($oxirequirmentdata);
            $data = 'Thank you for using Shortcode Addons. As your style data kindly install first ';
            if ($count == 1) {
                $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[0] . '">' . str_replace('_', ' ', $oxirequirmentdata[0]) . '</a> ';
            } else if ($count == 2) {
                $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[0] . '">' . str_replace('_', ' ', $oxirequirmentdata[0]) . '</a> and ';
                $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[1] . '">' . str_replace('_', ' ', $oxirequirmentdata[1]) . '</a> ';
            } else {
                for ($i = 0; $i < $count; $i++) {
                    if ($i <= ($count - 3)) {
                        $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[$i] . '">' . str_replace('_', ' ', $oxirequirmentdata[$i]) . '</a>, ';
                    } else if ($i == ($count - 2)) {
                        $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[$i] . '">' . str_replace('_', ' ', $oxirequirmentdata[$i]) . '</a> and ';
                    } else {
                        $data .= '<a href="#" oxiattr="' . $oxirequirmentdata[$i] . '">' . str_replace('_', ' ', $oxirequirmentdata[$i]) . '</a>';
                    }
                }
            }
            $data .= '. Without this element, Your data will not works properly and created Error.
                        <br><br>
                        Thank You<br>
                        Oxilab Team';
            if ($count > 0) {
                echo '<div class="oxi-addons-wrapper">   
                <div class="oxi-addons-row">
                    <div class="oxi-addons-import-requirement">
                        <div class="oxi-addons-import-requirement-data">
                            <div class="oxi-addons-import-requirement-icon">
                                ' . oxi_addons_admin_font_awesome('fa-exclamation-triangle') . '
                            </div>
                            <div class="oxi-addons-import-requirement-text">
                                <div class="oxi-addons-import-requirement-heading">
                                 Elements Installation Required
                                </div>
                                <div class="oxi-addons-import-requirement-content">
                                    ' . $data . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
        ?>
        <div class="oxi-addons-wrapper">   
            <input class="form-control" type="text" id='oxi_addons_search' placeholder="Search..">
            <?php
            foreach ($alldata as $value) {
                $elementshtml = '';
                $elementsnumber = 0;
                asort($value[1]);
                foreach ($value[1] as $val) {
                    $valuetrue = '';
                    foreach ($addonsfile as $importelements) {
                        if ($importelements == $val) {
                            $valuetrue = 'true';
                        }
                    }

                    if ($valuetrue != 'true') {
                        $elementsnumber++;
                        $elementshtml .= '<div class="oxi-addons-shortcode-import"  oxi-addons-search="' . $val . '" id ="' . $val . '">
                                                    <a target="_blank" href="https://www.oxilab.org/shortcode-addons-features/' . str_replace('_', '-', $val) . '">
                                                       <div class="oxi-addons-shortcode-import-top">
                                                              ' . oxi_addons_admin_font_awesome('oxi-' . $val . '') . '
                                                       </div>
                                                    </a>
                                                    <div class="oxi-addons-shortcode-import-bottom">
                                                        <span>' . oxi_addons_shortcode_name_converter($val) . '</span>
                                                        <input type="button" class="btn btn-outline-info btn-sm text-right OxiElementsADD" name="OxiElementsADD" OXIAddonsElements="' . $val . '" value="Install">
                                                    </div>
                                                </div>';
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
                                                <div class="oxi-addons-text-blocks-content">Available (' . $elementsnumber . ')</div>
                                            </div>
                                        </div>
                                    </div>';
                    echo $elementshtml;
                }
            }
            ?>
        </div>

    </div>
    <?php
    $jquery = 'function oxiequalHeight(group) {
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
                jQuery(".oxilab-admin-menu li:eq(1) a").addClass("active");
                jQuery(".oxi-addons-shortcode-import-bt .btn").click(function(){
                    var url = jQuery(this).attr("href"); 
                    window.open(url, "_blank");
                });
                jQuery(".oxi-addons-import-requirement a").click(function(){
                    var url = jQuery(this).attr("oxiattr").toLowerCase(); 
                    jQuery("#oxi_addons_search").val(url);
                    jQuery(".oxi-addons-shortcode-import").filter(function() {
                      jQuery(this).toggle(jQuery(this).attr("oxi-addons-search").toLowerCase().indexOf(url) > -1)
                    });
                }); 
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
                });';
}
$css = '.oxi-addons-wrapper ul.oxilab-admin-menu li a:hover,
        .oxi-addons-wrapper ul.oxilab-admin-menu li a.active{ 
            background: #7c00b5;
            position: relative;
            color: #fff;
        };';
echo OxiAddonsInlineCSSData($css, 'oxi-addons-admin');

wp_add_inline_script('oxi-addons-bootstrap-jquery', $jquery);
