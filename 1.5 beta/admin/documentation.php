<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();
echo oxi_addons_public_isotope();
$jquery = 'jQuery(window).load(function(){
                            jQuery(".oxi-addons-category-data").isotope({
                                filter: "*",
                                animationOptions: {
                                    duration: 750,
                                    easing: "linear",
                                    queue: false
                                },
                                layoutMode: "masonry",
                            });
                    });';

wp_add_inline_script('oxi-isotope-min', $jquery);
echo OxiAddonsAdmAdminMenu('', '', 'other');
?>
<div class="about-wrap">
    <h1>Welcome to Shortcode Addons</h1>
    <div class="about-text">
        Thank you for choosing Shortcode Addons, The most friendly WordPress addons or all in one Package Plugin. Here's how to get started.
    </div>
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab nav-tab-active">
            Getting Started		
        </a>
    </h2>
    <div class="feature-section">
        <p>Shortcode Addons is easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on your Designs. Follow the four Steps to create Shortcode. If get any troubles watch learning Videos or Documentation</p>
        <p>&nbsp; &nbsp; <strong>Step 1 :-</strong>&nbsp; Select Elements form Shortcode Elements Page.</p>
        <p>&nbsp; &nbsp; <strong>Step 2 :-</strong>&nbsp; Confirm your Layouts.</p>
        <p>&nbsp; &nbsp; <strong>Step 3 :-</strong>&nbsp; Add or Customize layout data.</p>
        <p>&nbsp; &nbsp; <strong>Step 4 :-</strong>&nbsp; Paste Shortcode into your Post, Page or Page Builders.</p>
    </div>
    <div class="feature-section">
        <div class="about-container">
            <div class="about-addons-videos"><iframe src="//www.youtube.com/embed/Ovvqi7iZJ-s" frameborder="0" allowfullscreen class="about-video"></iframe></div>
        </div>
    </div>
    <div class="feature-section">
        <h3>Have any Bugs or Suggestion</h3>
        <p>Your suggestions will make this plugin even better, Even if you get any bugs on Shortcode Addons so let us to know, We will try to solved within few hours</p>
        <p>
            <a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Contact Us</a>
            <a href="https://wordpress.org/plugins/shortcode-addons/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a>
        </p>

    </div>
</div>
<div class="wrap">    
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <div class="oxi-addons-doc-heading">
                Shortcode Addons Documentation
            </div>
            <div class="oxilab-admin-wrapper about-wrap ">
                <div class="oxi-addons-category-data">
                    <?php
                    $documentation = array(
                        array('Getting Started', array(
                                array('Install Addons', 'https://www.oxilab.org/docs/shortcode-addons/install-addons/'),
                                array('Configuring Elements', 'https://www.oxilab.org/docs/shortcode-addons/elements/'),
                                array('Using Elements', 'https://www.oxilab.org/docs/shortcode-addons/using-elements/'),
                                array('Import Layouts', 'https://www.oxilab.org/docs/shortcode-addons/import-layouts/'),
                                array('Upgrade Pro Version', 'https://www.oxilab.org/docs/shortcode-addons/upgrade-pro-version/'),
                            ),
                        ),
                        array('Addons FAQ', array(
                                array('Shortcode into Post', 'https://www.oxilab.org/docs/addons-faq/shortcode-into-post/'),
                                array('Shortcode into Page', 'https://www.oxilab.org/docs/addons-faq/shortcode-into-page/'),
                                array('Addons Settings', 'https://www.oxilab.org/?p=27177'),
                                array('Custom Font Familly', 'https://www.oxilab.org/?p=27175'),
                                array('Data not Found?', 'https://www.oxilab.org/docs/addons-faq/data-not-found/'),
                                array('Update Addons Elements', 'https://www.oxilab.org/docs/addons-faq/update-addons-elements/'),
                            ),
                        ),
                        array('Works with Page Builders', array(
                                array('Divi Builder', 'https://www.oxilab.org/?p=27054'),
                                array('Beaver Builders', 'https://www.oxilab.org/?p=27055'),
                                array('Elementor Addons', 'https://www.oxilab.org/?p=27056'),
                                array('Visual Composer', 'https://www.oxilab.org/?p=27057'),
                                array('SiteOrigin', 'https://www.oxilab.org/?p=27060'),
                                array('Themify Builder', 'https://www.oxilab.org/?p=27058'),
                                array('Thrive Architect', 'https://www.oxilab.org/?p=27059'),
                            ),
                        ),
                        array('Content Elements', array(
                                array('Accordion', 'https://www.oxilab.org/?p=27075'),
                                array('Bullet List', 'https://www.oxilab.org/?p=27076'),
                                array('Button', 'https://www.oxilab.org/?p=27077'),
                                array('Content Boxes', 'https://www.oxilab.org/?p=27078'),
                                array('Count Down', 'https://www.oxilab.org/?p=27079'),
                                array('Drop Caps', 'https://www.oxilab.org/?p=27080'),
                                array('Heading', 'https://www.oxilab.org/?p=27081'),
                                array('Icon', 'https://www.oxilab.org/?p=27082'),
                                array('Icon Boxes', 'https://www.oxilab.org/?p=27083'),
                                array('Image Boxes', 'https://www.oxilab.org/?p=27084'),
                                array('Info Boxes', 'https://www.oxilab.org/?p=27085'),
                                array('Info Image Boxes', 'https://www.oxilab.org/?p=27086'),
                                array('Logo Showcase', 'https://www.oxilab.org/?p=27087'),
                                array('Single Image', 'https://www.oxilab.org/?p=27088'),
                                array('Team', 'https://www.oxilab.org/?p=27089'),
                                array('Testimonial', 'https://www.oxilab.org/?p=27090'),
                                array('Text Blocks', 'https://www.oxilab.org/?p=27091'),
                            ),
                        ),
                        array('Creative Elements', array(
                                array('Animated Text', 'https://www.oxilab.org/?p=27093'),
                                array('Banner', 'https://www.oxilab.org/?p=27094'),
                                array('Content Toggle', 'https://www.oxilab.org/?p=27095'),
                                array('Counter', 'https://www.oxilab.org/?p=27096'),
                                array('Footer Into', 'https://www.oxilab.org/?p=27097'),
                                array('Headers', 'https://www.oxilab.org/?p=27098'),
                                array('Image Accordion', 'https://www.oxilab.org/?p=27099'),
                                array('Image Comparison', 'https://www.oxilab.org/?p=27100'),
                                array('Icon Effects', 'https://www.oxilab.org/?p=27101'),
                                array('Image Scroll', 'https://www.oxilab.org/?p=27102'),
                                array('Info Banner', 'https://www.oxilab.org/?p=27103'),
                                array('Lightbox', 'https://www.oxilab.org/?p=27104'),
                                array('Link Effects', 'https://www.oxilab.org/?p=27105'),
                                array('Offcanvas Content', 'https://www.oxilab.org/?p=27106'),
                                array('Progress Bars', 'https://www.oxilab.org/?p=27107'),
                                array('Tooltip', 'https://www.oxilab.org/?p=27108'),
                            ),
                        ),
                        array('Dynamic Contents', array(
                                array('Audio Players', 'https://www.oxilab.org/?p=27110'),
                                array('Audio Playlist', 'https://www.oxilab.org/?p=27111'),
                                array('Carousel', 'https://www.oxilab.org/?p=27112'),
                                array('Category', 'https://www.oxilab.org/?p=27113'),
                                array('Data Table', 'https://www.oxilab.org/?p=27114'),
                            ),
                        ),
                        array('Marketing Elements', array(
                                array('Alert Box', 'https://www.oxilab.org/?p=27116'),
                                array('Call to Action', 'https://www.oxilab.org/?p=27117'),
                                array('Event Widgets', 'https://www.oxilab.org/?p=27119'),
                                array('Food Menu', 'https://www.oxilab.org/?p=27120'),
                                array('Opening Hours', 'https://www.oxilab.org/?p=27121'),
                                array('Product Boxes', 'https://www.oxilab.org/?p=27122'),
                                array('Price Table', 'https://www.oxilab.org/?p=27123'),
                            ),
                        ),
                        array('Social Elements', array(
                                array('Social Icons', 'https://www.oxilab.org/?p=27125'),
                            ),
                        ),
                        array('Form Contents', array(
                                array('Contact Form', 'https://www.oxilab.org/?p=27127'),
                            ),
                        ),
                        array('Extensions', array(
                                array('Divider', 'https://www.oxilab.org/?p=27129'),
                                array('Section Divider', 'https://www.oxilab.org/?p=27130'),
                                array('Smooth Scrolling', 'https://www.oxilab.org/?p=27131'),
                                array('Spacer', 'https://www.oxilab.org/?p=27132'),
                            ),
                        ),
                    );
                    foreach ($documentation as $value) {
                        echo '  <div class="oxi-addons-docs">';
                        echo '      <h3><span class="dashicons dashicons-portfolio"></span> ' . $value[0] . '</h3>';
                        echo '      <div class="oxi-inside">
                                         <ul class="oxi-inside-sections">';
                        foreach ($value[1] as $val) {
                            echo ' <li><a target="_blank" href="' . $val[1] . '"><span class="dashicons dashicons-media-default"></span> ' . $val[0] . '</a></li>';
                        }
                        echo '          </ul>
                                    </div>';

                        echo '  </div>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
