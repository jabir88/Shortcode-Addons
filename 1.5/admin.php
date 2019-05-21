<?php
if (!defined('ABSPATH'))
    exit;
oxi_addons_user_capabilities();
/**
 * Admin page
 * working to control each elements page
 * style page, layouts page
 */
if (empty($_GET['styleid'])) {
    $oxiid = '';
} else {
    $oxiid = (int) $_GET['styleid'];
}
if (empty($_GET['oxitype'])) {
    $oxitype = '';
} else {
    $oxitype = sanitize_text_field($_GET['oxitype']);
}

/**
 * The code that runs during change style name.
 */
function OxiDataAdminStyleNameChange() {
    if (!empty($_REQUEST['_wpnonce'])) {
        $nonce = $_REQUEST['_wpnonce'];
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    if (!empty($_POST['addonsstylenamechange']) && $_POST['addonsstylenamechange'] == 'Save') {
        if (!wp_verify_nonce($nonce, 'oxi-addons-style-name-change')) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $Addonsname = sanitize_text_field($_POST['addonsstylename']);
            $AddonsID = (int) $_POST['addonsstylenameid'];
            if ($AddonsID > 0) {
                $wpdb->query($wpdb->prepare("UPDATE $table_name SET name = %s WHERE id = %d", $Addonsname, $AddonsID));
            }
        }
    }
}

/**
 * The code that runs during clone data.
 */
function OxiDataAdminImport($oxitype) {
    $oxilink = '';
    if (!empty($_GET['oxilink'])) {
        $oxilink = sanitize_text_field($_GET['oxilink']);
    }
    if ($oxilink != '') {
        $js = '     setTimeout(function () {
                        jQuery("html, body").animate({ 
                            scrollTop: jQuery("#' . $oxilink . '").offset().top 
                        }, "slow");
                    }, 800);';
        wp_add_inline_script('oxi-addons-vendor', $js);
    }

    if (!empty($_REQUEST['_wpnonce'])) {
        $nonce = $_REQUEST['_wpnonce'];
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $table_import = $wpdb->prefix . 'oxi_div_import';
    $addonsnonce = 'oxi-addons-' . $oxitype . '-create-nonce';
    if (!empty($_POST['addonsdatasubmit']) && $_POST['addonsdatasubmit'] == 'Save') {
        if (!wp_verify_nonce($nonce, $addonsnonce)) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $AddonsData = OxiAddonsADMHelpTextSenitize($_POST['oxi-addons-data']);
            $Addonsname = sanitize_text_field($_POST['addons-style-name']);
            $AddonsID = (int) $_POST['oxistyleid'];
            $datatrue = strpos($AddonsData, '##OXISTYLE##');
            if ($datatrue !== FALSE) {
                $oxidata = explode('##OXISTYLE##', $AddonsData);
                $IMdata = explode('OXIIMPORT', $oxidata[0]);
                $IMFILE = explode('##OXIDATA##', $oxidata[1]);
                if (count($IMdata) == 4) {
                    $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($Addonsname, $oxitype, $IMdata[2], $IMdata[3])));
                    $redirect_id = $wpdb->insert_id;
                    if ($redirect_id == 0) {
                        $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype");
                    }
                    if ($redirect_id != 0) {
                        foreach ($IMFILE as $value) {
                            if (!empty($value)) {
                                $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, type, files) VALUES (%d, %s, %s )", array($redirect_id, 'oxi-addons', $value)));
                            }
                        }
                        $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype&styleid=$redirect_id");
                    }
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                }
            } else {
                $AddonsData = explode('OXIIMPORT', $AddonsData);
                if ($AddonsID > 0) {
                    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $AddonsID), ARRAY_A);
                    $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($Addonsname, $styledata['type'], $styledata['style_name'], $styledata['css'])));
                    $redirect_id = $wpdb->insert_id;
                    if ($redirect_id == 0) {
                        $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype");
                    }
                    if ($redirect_id != 0) {
                        $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype&styleid=$redirect_id");
                    }
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                } else {
                    if (count($AddonsData) == 4) {
                        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, type, style_name, css) VALUES ( %s, %s, %s, %s )", array($Addonsname, $AddonsData[1], $AddonsData[2], $AddonsData[3])));
                        $redirect_id = $wpdb->insert_id;
                        if ($redirect_id == 0) {
                            $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype");
                        }
                        if ($redirect_id != 0) {
                            $url = admin_url("admin.php?page=oxi-addons&oxitype=$oxitype&styleid=$redirect_id");
                        }
                        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                        exit;
                    }
                }
            }
        }
    }
    $addonsdelnonce = "oxi-addons-$oxitype-del-nonce";
    if (!empty($_POST['addonsdatadelete']) && $_POST['addonsdatadelete'] == 'delete') {
        if (!wp_verify_nonce($nonce, $addonsdelnonce)) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $id = (int) $_POST['oxideleteid'];
            $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
            $wpdb->query($wpdb->prepare("DELETE FROM $table_list WHERE styleid = %d", $id));
        }
    }
    $addonsdelnonce = "oxi-addons-$oxitype-style-del-nonce";
    if (!empty($_POST['addonsstyledelete']) && $_POST['addonsstyledelete'] == 'Deactive') {
        if (!wp_verify_nonce($nonce, $addonsdelnonce)) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $AddonsData = sanitize_text_field($_POST['oxideletestyle']);
            $wpdb->query($wpdb->prepare("DELETE FROM $table_import WHERE type = %s and name = %s", $oxitype, $AddonsData));
        }
    }
    $addonsaddnonce = "oxi-addons-$oxitype-style-active-nonce";
    if (!empty($_POST['addonsstyleactive']) && $_POST['addonsstyleactive'] == 'Active') {
        if (!wp_verify_nonce($nonce, $addonsaddnonce)) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $AddonsData = sanitize_text_field($_POST['oxiactivestyle']);
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_import} (type, name) VALUES ( %s, %s)", array($oxitype, $AddonsData)));
            $js = 'document.location.href = "' . (admin_url("admin.php?page=oxi-addons&oxitype=$oxitype&oxilink=$AddonsData")) . '";';
            wp_add_inline_script('oxi-addons-vendor', $js);
        }
    }
}

/**
 * The code that runs during view import data to shortcode.
 */
function OxiDataAdminShortcode($oxitype, $STYLEDATA) {
    $number = rand();
    $datatrue = strpos($STYLEDATA, '##OXISTYLE##');
    if ($datatrue !== FALSE) {
        $oxidata = explode('##OXISTYLE##', $STYLEDATA);
        $IMdata = explode('OXIIMPORT', $oxidata[0]);
        $IMFILE = explode('##OXIDATA##', $oxidata[1]);
        if (count($IMdata) == 4) {
            include_once OxiAddonsElements . $oxitype . '/view/' . $IMdata[2] . '.php';
            $layouts = str_replace("-", "_", $IMdata[2]);
            $SF = 'oxi_' . $oxitype . '_' . $layouts . '_shortcode';
            $DATA = array(
                'id' => $number,
                'name' => $IMdata[0],
                'type' => $IMdata[1],
                'style_name' => $IMdata[2],
                'css' => $IMdata[3],
            );
            $file = array();
            foreach ($IMFILE as $value) {
                $listnumber = rand();
                if (!empty($value)) {
                    $file[] = array(
                        'id' => $listnumber,
                        'styleid' => $number,
                        'type' => 'oxi-addons',
                        'files' => $value);
                }
            }
        }
        $SF($DATA, $file, 'user');
    } else {
        $STYLEDATA = explode('OXIIMPORT', $STYLEDATA);
        if (count($STYLEDATA) == 4) {
            $layouts = str_replace("-", "_", $STYLEDATA[2]);
            include_once OxiAddonsElements . $oxitype . '/view/' . $STYLEDATA[2] . '.php';
            $SF = 'oxi_' . $oxitype . '_' . $layouts . '_shortcode';
            $DATA = array(
                'id' => $number,
                'name' => $STYLEDATA[0],
                'type' => $STYLEDATA[1],
                'style_name' => $STYLEDATA[2],
                'css' => $STYLEDATA[3],
            );
            $SF($DATA);
        }
    }
}

/**
 * The code that runs during admin shortcode name change.
 */
function OxiDataAdminShortcodeName($STYLEDATA) {
    $datatrue = strpos($STYLEDATA, '##OXISTYLE##');
    if ($datatrue !== FALSE) {
        $oxidata = explode('##OXISTYLE##', $STYLEDATA);
        $STYLEDATA = explode('OXIIMPORT', $oxidata[0]);
        echo oxi_addons_shortcode_name_converter($STYLEDATA[0]);
    } else {
        $STYLEDATA = explode('OXIIMPORT', $STYLEDATA);
        echo oxi_addons_shortcode_name_converter($STYLEDATA[0]);
    }
}

/**
 * The code that runs during controlling shortcode data.
 */
function OxiDataAdminShortcodeControl($number = '', $value = '', $data = array()) {
    $findlayoutstyle = explode('OXIIMPORT', $value);
    $datatrue = strpos($value, '##OXISTYLE##');
    if ($datatrue !== FALSE) {
        $oxidata = explode('##OXISTYLE##', $value);
        $IMdata = explode('OXIIMPORT', $oxidata[0]);
        $IMFILE = explode('##OXIDATA##', $oxidata[1]);
        $layouts = $IMdata[2];
    } else {
        $STYLEDATA = explode('OXIIMPORT', $value);
        $layouts = $STYLEDATA[2];
    }
    $status = get_option('oxi_addons_license_status');

    if ($status != 'valid') {
        if (in_array($layouts, $data)) {
            echo ' <div class="oxi-addons-style-preview-bottom-right">
                       <form method="post" style=" display: inline-block; ">
                        ' . wp_nonce_field("oxi-addons-$findlayoutstyle[1]-style-del-nonce") . '
                        <input type="hidden" name="oxideletestyle" value="' . $findlayoutstyle[2] . '">
                        <button class="btn btn-warning oxi-addons-addons-style-btn-warning" title="Delete"  type="submit" value="Deactive" name="addonsstyledelete">Deactive</button>  
                    </form>
                        <input type="hidden" id="oxistyle' . $number . 'data"  value="' . OxiAddonsADMHelpTextSenitize($value) . '">
                        <button type="button" class="btn btn-success oxi-addons-addons-style-create" data-toggle="modal" addons-data="oxistyle' . $number . 'data">Create Style</button>
                    </div>';
        } else {
            echo ' <div class="oxi-addons-style-preview-bottom-right">
                        <form method="post" style=" display: inline-block; ">
                            ' . wp_nonce_field("oxi-addons-$findlayoutstyle[1]-style-del-nonce") . '
                            <input type="hidden" name="oxideletestyle" value="' . $findlayoutstyle[2] . '">
                            <button class="btn btn-warning oxi-addons-addons-style-btn-warning" title="Delete"  type="submit" value="Deactive" name="addonsstyledelete">Deactive</button>  
                        </form>
                        <button type="button" class="btn btn-danger" >Pro Only</button>
                    </div>';
        }
    } else {
        echo ' <div class="oxi-addons-style-preview-bottom-right">
                    <form method="post" style=" display: inline-block; ">
                        ' . wp_nonce_field("oxi-addons-$findlayoutstyle[1]-style-del-nonce") . '
                        <input type="hidden" name="oxideletestyle" value="' . $findlayoutstyle[2] . '">
                        <button class="btn btn-warning oxi-addons-addons-style-btn-warning" title="Delete"  type="submit" value="Deactive" name="addonsstyledelete">Deactive</button>  
                    </form>
                    <input type="hidden" id="oxistyle' . $number . 'data"  value="' . OxiAddonsADMHelpTextSenitize($value) . '">
                    <button type="button" class="btn btn-success oxi-addons-addons-style-create" data-toggle="modal" addons-data="oxistyle' . $number . 'data">Create Style</button>
                </div>';
    }
}

/**
 * opening modal for shortcode style page.
 */
function OxiDataAdminShortcodeModal($oxitype) {
    $oxiname = oxi_addons_shortcode_name_converter($oxitype);
    $addonsnonce = 'oxi-addons-' . $oxitype . '-create-nonce';
    ?>
    <div class="modal fade" id="oxi-addons-style-create-modal" >
        <form method="post" id="oxi-addons-style-create-modal-form">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">                    
                        <h4 class="modal-title"><?php echo $oxiname; ?> Settings</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo oxi_addons_adm_help_textbox('addons-style-name', '', 'Name', 'Give Your ' . $oxiname . ' Name');
                        ?>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="oxistyleid" name="oxistyleid" value="">
                        <input type="hidden" id="oxistyledelete" name="oxistyledelete" value="">
                        <input type="hidden" id="oxi-addons-data" name="oxi-addons-data" value="">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                        <?php wp_nonce_field($addonsnonce) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
}

/**
 * The code that runs during font family call.
 */
function OxiAddonsAdminFontFamily() {
    global $wpdb;
    $table_import = $wpdb->prefix . 'oxi_div_import';
    $FontFamily = $wpdb->get_results("SELECT * FROM $table_import WHERE font = 'fontfamily' ORDER by type  ASC", ARRAY_A);
    $fontdata = '';
    foreach ($FontFamily as $value) {
        $fontdata .= '"';
        $fontdata .= $value['type'];
        $fontdata .= '",';
    }
    if (empty($fontdata)) {
        $fontdata .= '"Initial", "Inherit", "ABeeZee", "Abel", "Abhaya+Libre", "Abril+Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent+Pro", "Aguafina+Script", "Akronim", "Aladin", "Aldrich", "Alef", "Alegreya", "Alegreya+SC", "Alegreya+Sans", "Alegreya+Sans+SC", "Alex+Brush", "Alfa+Slab+One", "Alice", "Alike", "Alike+Angular", "Allan", "Allerta", "Allerta+Stencil", "Allura", "Almendra", "Almendra+Display", "Almendra+SC", "Amarante", "Amaranth", "Amatic+SC", "Amethysta", "Amiko", "Amiri", "Amita", "Anaheim", "Andada", "Andika", "Angkor", "Annie+Use+Your+Telescope", "Anonymous+Pro", "Antic", "Antic+Didone", "Antic+Slab", "Anton", "Arapey", "Arbutus", "Arbutus+Slab", "Architects+Daughter", "Archivo", "Archivo+Black", "Archivo+Narrow", "Aref+Ruqaa", "Arima+Madurai", "Arimo", "Arizonia", "Armata", "Arsenal", "Artifika", "Arvo", "Arya", "Asap", "Asap+Condensed", "Asar", "Asset", "Assistant", "Astloch", "Asul", "Athiti", "Atma", "Atomic+Age", "Aubrey", "Audiowide", "Autour+One", "Average", "Average+Sans", "Averia+Gruesa+Libre", "Averia+Libre", "Averia+Sans+Libre", "Averia+Serif+Libre", "Bad+Script", "Bahiana", "Baloo", "Baloo+Bhai", "Baloo+Bhaijaan", "Baloo+Bhaina", "Baloo+Chettan", "Baloo+Da", "Baloo+Paaji", "Baloo+Tamma", "Baloo+Tammudu", "Baloo+Thambi", "Balthazar", "Bangers", "Barlow", "Barlow+Condensed", "Barlow+Semi+Condensed", "Barrio", "Basic", "Battambang", "Baumans", "Bayon", "Belgrano", "Bellefair", "Belleza", "BenchNine", "Bentham", "Berkshire+Swash", "Bevan", "Bigelow+Rules", "Bigshot+One", "Bilbo", "Bilbo+Swash+Caps", "BioRhyme", "BioRhyme+Expanded", "Biryani", "Bitter", "Black+And+White+Picture", "Black+Han+Sans", "Black+Ops+One", "Bokor", "Bonbon", "Boogaloo", "Bowlby+One", "Bowlby+One+SC", "Brawler", "Bree+Serif", "Bubblegum+Sans", "Bubbler+One", "Buda:300", "Buenard", "Bungee", "Bungee+Hairline", "Bungee+Inline", "Bungee+Outline", "Bungee+Shade", "Butcherman", "Butterfly+Kids", "Cabin", "Cabin+Condensed", "Cabin+Sketch", "Caesar+Dressing", "Cagliostro", "Cairo", "Calligraffitti", "Cambay", "Cambo", "Candal", "Cantarell", "Cantata+One", "Cantora+One", "Capriola", "Cardo", "Carme", "Carrois+Gothic", "Carrois+Gothic+SC", "Carter+One", "Catamaran", "Caudex", "Caveat", "Caveat+Brush", "Cedarville+Cursive", "Ceviche+One", "Changa", "Changa+One", "Chango", "Chathura", "Chau+Philomene+One", "Chela+One", "Chelsea+Market", "Chenla", "Cherry+Cream+Soda", "Cherry+Swash", "Chewy", "Chicle", "Chivo", "Chonburi", "Cinzel", "Cinzel+Decorative", "Clicker+Script", "Coda", "Coda+Caption:800", "Codystar", "Coiny", "Combo", "Comfortaa", "Coming+Soon", "Concert+One", "Condiment", "Content", "Contrail+One", "Convergence", "Cookie", "Copse", "Corben", "Cormorant", "Cormorant+Garamond", "Cormorant+Infant", "Cormorant+SC", "Cormorant+Unicase", "Cormorant+Upright", "Courgette", "Cousine", "Coustard", "Covered+By+Your+Grace", "Crafty+Girls", "Creepster", "Crete+Round", "Crimson+Text", "Croissant+One", "Crushed", "Cuprum", "Cute+Font", "Cutive", "Cutive+Mono", "Damion", "Dancing+Script", "Dangrek", "David+Libre", "Dawning+of+a+New+Day", "Days+One", "Dekko", "Delius", "Delius+Swash+Caps", "Delius+Unicase", "Della+Respira", "Denk+One", "Devonshire", "Dhurjati", "Didact+Gothic", "Diplomata", "Diplomata+SC", "Do+Hyeon", "Dokdo", "Domine", "Donegal+One", "Doppio+One", "Dorsa", "Dosis", "Dr+Sugiyama", "Duru+Sans", "Dynalight", "EB+Garamond", "Eagle+Lake", "East+Sea+Dokdo", "Eater", "Economica", "Eczar", "El+Messiri", "Electrolize", "Elsie", "Elsie+Swash+Caps", "Emblema+One", "Emilys+Candy", "Encode+Sans", "Encode+Sans+Condensed", "Encode+Sans+Expanded", "Encode+Sans+Semi+Condensed", "Encode+Sans+Semi+Expanded", "Engagement", "Englebert", "Enriqueta", "Erica+One", "Esteban", "Euphoria+Script", "Ewert", "Exo", "Exo+2", "Expletus+Sans", "Fanwood+Text", "Farsan", "Fascinate", "Fascinate+Inline", "Faster+One", "Fasthand", "Fauna+One", "Faustina", "Federant", "Federo", "Felipa", "Fenix", "Finger+Paint", "Fira+Mono", "Fira+Sans", "Fira+Sans+Condensed", "Fira+Sans+Extra+Condensed", "Fjalla+One", "Fjord+One", "Flamenco", "Flavors", "Fondamento", "Fontdiner+Swanky", "Forum", "Francois+One", "Frank+Ruhl+Libre", "Freckle+Face", "Fredericka+the+Great", "Fredoka+One", "Freehand", "Fresca", "Frijole", "Fruktur", "Fugaz+One", "GFS+Didot", "GFS+Neohellenic", "Gabriela", "Gaegu", "Gafata", "Galada", "Galdeano", "Galindo", "Gamja+Flower", "Gentium+Basic", "Gentium+Book+Basic", "Geo", "Geostar", "Geostar+Fill", "Germania+One", "Gidugu", "Gilda+Display", "Give+You+Glory", "Glass+Antiqua", "Glegoo", "Gloria+Hallelujah", "Goblin+One", "Gochi+Hand", "Gorditas", "Gothic+A1", "Goudy+Bookletter+1911", "Graduate", "Grand+Hotel", "Gravitas+One", "Great+Vibes", "Griffy", "Gruppo", "Gudea", "Gugi", "Gurajada", "Habibi", "Halant", "Hammersmith+One", "Hanalei", "Hanalei+Fill", "Handlee", "Hanuman", "Happy+Monkey", "Harmattan", "Headland+One", "Heebo", "Henny+Penny", "Herr+Von+Muellerhoff", "Hi+Melody", "Hind", "Hind+Guntur", "Hind+Madurai", "Hind+Siliguri", "Hind+Vadodara", "Holtwood+One+SC", "Homemade+Apple", "Homenaje", "IBM+Plex+Mono", "IBM+Plex+Sans", "IBM+Plex+Sans+Condensed", "IBM+Plex+Serif", "IM+Fell+DW+Pica", "IM+Fell+DW+Pica+SC", "IM+Fell+Double+Pica", "IM+Fell+Double+Pica+SC", "IM+Fell+English", "IM+Fell+English+SC", "IM+Fell+French+Canon", "IM+Fell+French+Canon+SC", "IM+Fell+Great+Primer", "IM+Fell+Great+Primer+SC", "Iceberg", "Iceland", "Imprima", "Inconsolata", "Inder", "Indie+Flower", "Inika", "Inknut+Antiqua", "Irish+Grover", "Istok+Web", "Italiana", "Italianno", "Itim", "Jacques+Francois", "Jacques+Francois+Shadow", "Jaldi", "Jim+Nightshade", "Jockey+One", "Jolly+Lodger", "Jomhuria", "Josefin+Sans", "Josefin+Slab", "Joti+One", "Jua", "Judson", "Julee", "Julius+Sans+One", "Junge", "Jura", "Just+Another+Hand", "Just+Me+Again+Down+Here", "Kadwa", "Kalam", "Kameron", "Kanit", "Kantumruy", "Karla", "Karma","Katibeh", "Kaushan+Script", "Kavivanar", "Kavoon", "Kdam+Thmor", "Keania+One", "Kelly+Slab", "Kenia", "Khand", "Khmer", "Khula", "Kirang+Haerang", "Kite+One", "Knewave", "Kotta+One", "Koulen", "Kranky", "Kreon", "Kristi", "Krona+One", "Kumar+One", "Kumar+One+Outline", "Kurale", "La+Belle+Aurore", "Laila", "Lakki+Reddy", "Lalezar", "Lancelot", "Lateef", "Lato", "League+Script", "Leckerli+One", "Ledger", "Lekton", "Lemon", "Lemonada", "Libre+Barcode+128", "Libre+Barcode+128+Text", "Libre+Barcode+39", "Libre+Barcode+39+Extended", "Libre+Barcode+39+Extended+Text", "Libre+Barcode+39+Text", "Libre+Baskerville", "Libre+Franklin", "Life+Savers", "Lily+Script+One", "Limelight", "Linden+Hill", "Lobster", "Lobster+Two", "Londrina+Outline", "Londrina+Shadow", "Londrina+Sketch", "Londrina+Solid", "Lora", "Love+Ya+Like+A+Sister", "Loved+by+the+King", "Lovers+Quarrel", "Luckiest+Guy", "Lusitana", "Macondo", "Macondo+Swash+Caps", "Mada", "Magra", "Maiden+Orange", "Maitree", "Mako", "Mallanna", "Mandali", "Manuale", "Marcellus", "Marcellus+SC", "Marck+Script", "Margarine", "Marko+One", "Marmelad", "Martel", "Martel+Sans", "Marvel", "Mate", "Mate+SC", "Maven+Pro", "McLaren", "Meddon", "MedievalSharp", "Medula+One", "Meera+Inimai", "Megrim", "Meie+Script", "Merienda", "Merienda+One", "Merriweather", "Merriweather+Sans", "Metal", "Metal+Mania", "Metamorphous", "Metrophobic", "Michroma", "Milonga", "Miltonian", "Miltonian+Tattoo", "Mina", "Miniver", "Miriam+Libre", "Mirza", "Miss+Fajardose", "Mitr", "Modak", "Modern+Antiqua", "Mogra", "Molengo", "Molle:400i", "Monda", "Monofett", "Monoton", "Monsieur+La+Doulaise", "Montaga", "Montez", "Montserrat", "Montserrat+Alternates", "Montserrat+Subrayada", "Moul", "Moulpali", "Mountains+of+Christmas", "Mouse+Memoirs", "Mr+Bedfort", "Mr+Dafoe", "Mr+De+Haviland", "Mrs+Saint+Delafield", "Mrs+Sheppards", "Mukta", "Mukta+Mahee", "Mukta+Malar", "Mukta+Vaani", "Muli", "Mystery+Quest", "NTR", "Nanum+Brush+Script", "Nanum+Gothic", "Nanum+Gothic+Coding", "Nanum+Myeongjo", "Nanum+Pen+Script", "Neucha", "Neuton", "New+Rocker", "News+Cycle", "Niconne", "Nixie+One", "Nobile", "Nokora", "Norican", "Nosifer", "Nothing+You+Could+Do", "Noticia+Text", "Noto+Sans", "Noto+Serif", "Nova+Cut", "Nova+Flat", "Nova+Mono", "Nova+Oval", "Nova+Round", "Nova+Script", "Nova+Slim", "Nova+Square", "Numans", "Nunito", "Nunito+Sans", "Odor+Mean+Chey", "Offside", "Old+Standard+TT", "Oldenburg", "Oleo+Script", "Oleo+Script+Swash+Caps", "Open+Sans", "Open+Sans+Condensed:300", "Oranienbaum", "Orbitron", "Oregano", "Orienta", "Original+Surfer", "Oswald", "Over+the+Rainbow", "Overlock", "Overlock+SC", "Overpass", "Overpass+Mono", "Ovo", "Oxygen", "Oxygen+Mono", "PT+Mono", "PT+Sans", "PT+Sans+Caption", "PT+Sans+Narrow", "PT+Serif", "PT+Serif+Caption", "Pacifico", "Padauk", "Palanquin", "Palanquin+Dark", "Pangolin", "Paprika", "Parisienne", "Passero+One", "Passion+One", "Pathway+Gothic+One", "Patrick+Hand", "Patrick+Hand+SC", "Pattaya", "Patua+One", "Pavanam", "Paytone+One", "Peddana", "Peralta", "Permanent+Marker", "Petit+Formal+Script", "Petrona", "Philosopher", "Piedra", "Pinyon+Script", "Pirata+One", "Plaster", "Play", "Playball", "Playfair+Display", "Playfair+Display+SC", "Podkova", "Poiret+One", "Poller+One", "Poly", "Pompiere", "Pontano+Sans", "Poor+Story", "Poppins", "Port+Lligat+Sans", "Port+Lligat+Slab", "Pragati+Narrow", "Prata", "Preahvihear", "Press+Start+2P", "Pridi", "Princess+Sofia", "Prociono", "Prompt", "Prosto+One", "Proza+Libre", "Puritan", "Purple+Purse", "Quando", "Quantico", "Quattrocento", "Quattrocento+Sans", "Questrial", "Quicksand", "Quintessential", "Qwigley", "Racing+Sans+One", "Radley", "Rajdhani", "Rakkas", "Raleway", "Raleway+Dots", "Ramabhadra", "Ramaraja", "Rambla", "Rammetto+One", "Ranchers", "Rancho", "Ranga", "Rasa", "Rationale", "Ravi+Prakash", "Redressed", "Reem+Kufi", "Reenie+Beanie", "Revalia", "Rhodium+Libre", "Ribeye", "Ribeye+Marrow", "Righteous", "Risque", "Roboto", "Roboto+Condensed", "Roboto+Mono", "Roboto+Slab", "Rochester", "Rock+Salt", "Rokkitt", "Romanesco", "Ropa+Sans", "Rosario", "Rosarivo", "Rouge+Script", "Rozha+One", "Rubik", "Rubik+Mono+One", "Ruda", "Rufina", "Ruge+Boogie", "Ruluko", "Rum+Raisin", "Ruslan+Display", "Russo+One", "Ruthie", "Rye", "Sacramento", "Sahitya", "Sail", "Saira", "Saira+Condensed", "Saira+Extra+Condensed", "Saira+Semi+Condensed", "Salsa", "Sanchez", "Sancreek", "Sansita", "Sarala", "Sarina", "Sarpanch", "Satisfy", "Scada", "Scheherazade", "Schoolbell", "Scope+One", "Seaweed+Script", "Secular+One", "Sedgwick+Ave", "Sedgwick+Ave+Display", "Sevillana", "Seymour+One", "Shadows+Into+Light", "Shadows+Into+Light+Two", "Shanti", "Share", "Share+Tech", "Share+Tech+Mono", "Shojumaru", "Short+Stack", "Shrikhand", "Siemreap", "Sigmar+One", "Signika", "Signika+Negative", "Simonetta", "Sintony", "Sirin+Stencil", "Six+Caps", "Skranji", "Slabo+13px", "Slabo+27px", "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Snowburst+One", "Sofadi+One", "Sofia", "Song+Myung", "Sonsie+One", "Sorts+Mill+Goudy", "Source+Code+Pro", "Source+Sans+Pro", "Source+Serif+Pro", "Space+Mono", "Special+Elite", "Spectral", "Spectral+SC", "Spicy+Rice", "Spinnaker", "Spirax", "Squada+One", "Sree+Krushnadevaraya", "Sriracha", "Stalemate", "Stalinist+One", "Stardos+Stencil", "Stint+Ultra+Condensed", "Stint+Ultra+Expanded", "Stoke", "Strait", "Stylish", "Sue+Ellen+Francisco", "Suez+One", "Sumana", "Sunflower:300", "Sunshiney", "Supermercado+One", "Sura", "Suranna", "Suravaram", "Suwannaphum", "Swanky+and+Moo+Moo", "Syncopate", "Tajawal", "Tangerine", "Taprom", "Tauri", "Taviraj", "Teko", "Telex", "Tenali+Ramakrishna", "Tenor+Sans", "Text+Me+One", "The+Girl+Next+Door", "Tienne", "Tillana", "Timmana", "Tinos", "Titan+One", "Titillium+Web", "Trade+Winds", "Trirong", "Trocchi", "Trochut", "Trykker", "Tulpen+One", "Ubuntu", "Ubuntu+Condensed", "Ubuntu+Mono", "Ultra", "Uncial+Antiqua", "Underdog", "Unica+One", "UnifrakturCook:700", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Vampiro+One", "Varela", "Varela+Round", "Vast+Shadow", "Vesper+Libre", "Vibur", "Vidaloka", "Viga", "Voces", "Volkhov", "Vollkorn", "Vollkorn+SC", "Voltaire", "Waiting+for+the+Sunrise", "Wallpoet", "Walter+Turncoat", "Warnes", "Wellfleet", "Wendy+One", "Wire+One", "Work+Sans", "Yanone+Kaffeesatz", "Yantramanav", "Yatra+One", "Yellowtail", "Yeon+Sung", "Yeseva+One", "Yesteryear", "Yrsa", "Zeyada", "Zilla+Slab", "Zilla+Slab+Highlight"';
    }
    $data = '(function (a) {
                            a.fn.fontselect = function (b) {
                                var c = function (a, b) {
                                    return function () {
                                        return a.apply(b, arguments)
                                    }
                                },
                                        d = [' . $fontdata . '], e = {style: "font-select", placeholder: "Select a font", lookahead: 2, api: "//fonts.googleapis.com/css?family="}, f = function () {
                                    function b(b, c) {
                                        this.$original = a(b);
                                        this.options = c;
                                        this.active = !1;
                                        this.setupHtml();
                                        this.getVisibleFonts();
                                        this.bindEvents();
                                        var d = this.$original.val();
                                        if (d) {
                                            this.updateSelected();
                                            this.addFontLink(d)
                                        }
                                    }
                                    b.prototype.bindEvents = function () {
                                        a("li", this.$results).click(c(this.selectFont, this)).mouseenter(c(this.activateFont, this)).mouseleave(c(this.deactivateFont, this));
                                        a("span", this.$select).click(c(this.toggleDrop, this));
                                        this.$arrow.click(c(this.toggleDrop, this))
                                    };
                                    b.prototype.toggleDrop = function (a) {
                                        if (this.active) {
                                            this.$element.removeClass("font-select-active");
                                            this.$drop.hide();
                                            clearInterval(this.visibleInterval)
                                        } else {
                                            this.$element.addClass("font-select-active");
                                            this.$drop.show();
                                            this.moveToSelected();
                                            this.visibleInterval = setInterval(c(this.getVisibleFonts, this), 500)
                                        }
                                        this.active = !this.active
                                    };
                                    b.prototype.selectFont = function () {
                                        var b = a("li.active", this.$results).data("value");
                                        this.$original.val(b).change();
                                        this.updateSelected();
                                        this.toggleDrop()
                                    };
                                    b.prototype.moveToSelected = function () {
                                        var b, c = this.$original.val();
                                        c ? b = a("li[data-value=\'" + c + "\']", this.$results) : b = a("li", this.$results).first();
                                        this.$results.scrollTop(b.addClass("active").position().top)
                                    };
                                    b.prototype.activateFont = function (b) {
                                        a("li.active", this.$results).removeClass("active");
                                        a(b.currentTarget).addClass("active")
                                    };
                                    b.prototype.deactivateFont = function (b) {
                                        a(b.currentTarget).removeClass("active")
                                    };
                                    b.prototype.updateSelected = function () {
                                        var b = this.$original.val();
                                        a("span", this.$element).text(this.toReadable(b)).css(this.toStyle(b))
                                    };
                                    b.prototype.setupHtml = function () {
                                        this.$original.empty().hide();
                                        this.$element = a("<div>", {"class": this.options.style});
                                        this.$arrow = a("<div><b></b></div>");
                                        this.$select = a("<a><span>" + this.options.placeholder + "</span></a>");
                                        this.$drop = a("<div>", {"class": "fs-drop"});
                                        this.$results = a("<ul>", {"class": "fs-results"});
                                        this.$original.after(this.$element.append(this.$select.append(this.$arrow)).append(this.$drop));
                                        this.$drop.append(this.$results.append(this.fontsAsHtml())).hide()
                                    };
                                    b.prototype.fontsAsHtml = function () {
                                        var a = d.length, b, c, e = "";
                                        for (var f = 0; f < a; f++) {
                                            b = this.toReadable(d[f]);
                                            c = this.toStyle(d[f]);
                                            e += \'<li data-value="\' + d[f] + \'" style="font-family: \' + c["font-family"] + "; font-weight: " + c["font-weight"] + \'">\' + b + "</li>"
                                        }
                                        return e
                                    };
                                    b.prototype.toReadable = function (a) {
                                        return a.replace(/[\+|:]/g, " ")
                                    };
                                    b.prototype.toStyle = function (a) {
                                        var b = a.split(":");
                                        return{"font-family": this.toReadable(b[0]), "font-weight": b[1] || 400}
                                    };
                                    b.prototype.getVisibleFonts = function () {
                                        if (this.$results.is(":hidden"))
                                            return;
                                        var b = this, c = this.$results.scrollTop(), d = c + this.$results.height();
                                        if (this.options.lookahead) {
                                            var e = a("li", this.$results).first().height();
                                            d += e * this.options.lookahead
                                        }
                                        a("li", this.$results).each(function () {
                                            var e = a(this).position().top + c, f = e + a(this).height();
                                            if (f >= c && e <= d) {
                                                var g = a(this).data("value");
                                                b.addFontLink(g)
                                            }
                                        })
                                    };
                                    b.prototype.addFontLink = function (b) {
                                        var c = this.options.api + b;
                                        a("link[href*=\'" + b + "\']").length === 0 && a("link:last").after(\'<link href="\' + c + \'" rel="stylesheet" type="text/css">\')
                                    };
                                    return b
                                }();
                                return this.each(function (b) {
                                    b && a.extend(e, b);
                                    return new f(this, e)
                                })
                            }
                        })(jQuery);
                        jQuery(\'.oxi-addons-family\').fontselect();';
    wp_add_inline_script('oxi-addons-bootstrap-jquery', $data);
}

/**
 * The code that runs during style page css jquery calling.
 */
function oxi_addons_home_script() {
    wp_enqueue_script("jquery");
    wp_enqueue_script('YouTubePopUps', plugins_url('jquery/YouTubePopUps.js', __FILE__));
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_script('oxi-addons-bootstrap-jquery', plugins_url('jquery/bootstrap.min.js', __FILE__));
    wp_enqueue_style('oxi-addons-bootstrap-jquery', plugins_url('css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxi-addons-admin', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script('oxi-addons-vendor', plugins_url('jquery/vendor.js', __FILE__));
    OxiAddonsAdminajax();
    add_action('wp_print_scripts', 'OxiAddonsAdminajax');
}

/**
 * The code that runs during style layouts page css jquery calling.
 */
function oxi_addons_style_script() {
    wp_enqueue_script("jquery");
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('jquery-ui-mouse');
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('jquery-ui-draggable');
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_script('oxi-addons-popper-jquery', plugins_url('jquery/popper.min.js', __FILE__));
    wp_enqueue_script('oxi-addons-bootstrap-jquery', plugins_url('jquery/bootstrap.min.js', __FILE__));
    OxiAddonsAdminFontFamily();
    wp_enqueue_script('oxi-addons-jquery.dataTables.min', plugins_url('jquery/jquery.dataTables.min.js', __FILE__));
    wp_enqueue_script('oxi-addons-dataTables.bootstrap.min', plugins_url('jquery/dataTables.bootstrap.min.js', __FILE__));
    wp_enqueue_style('oxi-addons-bootstrap-jquery', plugins_url('css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('jquery.coloring-pick', plugins_url('css/jquery.coloring-pick.min.js.css', __FILE__));
    wp_enqueue_script('jquery.coloring-pick', plugins_url('jquery/jquery.coloring-pick.min.js', __FILE__));
    wp_enqueue_style('oxi-addons-admin', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script('oxi-addons-color', plugins_url('jquery/minicolors.js', __FILE__));
    wp_enqueue_style('oxi-addons-color', plugins_url('css/minicolors.css', __FILE__));
    wp_enqueue_script('YouTubePopUps', plugins_url('jquery/YouTubePopUps.js', __FILE__));
    wp_enqueue_script('jquery.bootstrap-growl', plugins_url('jquery/jquery.bootstrap-growl.js', __FILE__));
    wp_enqueue_script('oxi-addons-vendor', plugins_url('jquery/vendor.js', __FILE__));
}

/**
 * add media uploader at style page.
 */
function oxi_addons_media_scripts() {
    wp_enqueue_media();
    wp_register_script('oxi_addons_media_scripts', plugins_url('jquery/media-uploader.js', __FILE__));
    wp_enqueue_script('oxi_addons_media_scripts');
}

function oxi_addons_admin_select2() {
    wp_enqueue_style('oxi_addons_admin_select2', plugins_url('css/select2.min.css', __FILE__));
    wp_enqueue_script('oxi_addons_admin_select2', plugins_url('jquery/select2.min.js', __FILE__));
    $js = "jQuery(function () {
                jQuery('.oxi-addons-multiple-select').each(function () {
                  jQuery(this).select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: jQuery(this).attr('placeholder'),
                    allowClear: Boolean(jQuery(this).data('allow-clear')),
                  });
                });
              });";
    wp_add_inline_script('oxi_addons_admin_select2', $js);
}

/**
 * core page of style or layouts page.
 * defirne page with each style
 */
if (empty($oxiid) && empty($oxitype)) {
    oxi_addons_home_script();
    include_once oxi_addons_url . 'admin/home.php';
} elseif (!empty($oxitype)) {
    global $wpdb;
    $jquery = '';
    wp_enqueue_script("jquery");
    oxi_addons_style_script();
    oxi_addons_public_style();
    if ($oxitype == 'spacer' || $oxitype == 'smooth_scrolling') {
        include OxiAddonsElements . $oxitype . '/' . $oxitype . '.php';
    } else {
        if (!empty($oxiid)) {
            $table_name = $wpdb->prefix . 'oxi_div_style';
            $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $oxiid), ARRAY_A);
            if (is_array($styledata)) {
                if ($styledata['type'] != $oxitype) {
                    $url = admin_url('admin.php?page=oxi-addons&oxitype=' . $styledata['type'] . '&styleid=' . $styledata['id']);
                    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
                    exit;
                }
                if (file_exists(OxiAddonsElements . $styledata['type'] . '/admin/' . $styledata['style_name'] . '.php')) {
                    oxi_addons_media_scripts();
                    OxiAddonsAdminajax();
                    add_action('wp_print_scripts', 'OxiAddonsAdminajax');
                    include_once OxiAddonsElements . $styledata['type'] . '/view/' . $styledata['style_name'] . '.php';
                    include_once OxiAddonsElements . $styledata['type'] . '/admin/' . $styledata['style_name'] . '.php';
                } else {
                    echo OxiAddonsInstallRequirment($styledata['type']);
                }
            }
        } else {
            include_once OxiAddonsElements . $oxitype . '/' . $oxitype . '.php';
        }
    }
    $controltype = get_option('oxi_addons_admin_version');
    if ($controltype == 'yes') {
        $jquery .= 'jQuery(".oxi-addons-admin-lite-version").each(function (index, value) {
                        jQuery(this).slideUp();
                    });
                    jQuery( ".OxiAddonsADMLiteCheckbox" ).prop( "checked", true );
                    ';
    }
    $jquery .= 'jQuery(".oxilab-admin-menu li:eq(1) a").addClass("active");';
    wp_add_inline_script('oxi-addons-vendor', $jquery);
}

/**
 * The code that runs during style layouts page css jquery call.
 */
function oxi_addons_single_style_scripts($type = 'style', $name, $linking = '') {
    if ($linking == '') {
        if ($type == 'scripts' && $name != '') {
            wp_enqueue_script('oxi-addons-' . $name . '', plugins_url('jquery/' . $name . '.js', __FILE__));
        }
    } else {
        if ($type == 'scripts' && $name != '') {
            wp_enqueue_script('oxi-addons-' . $name . '', $name);
        }
    }
}

/**
 * elements requirement page
 * will called at if import style not works with elements
 */
function OxiAddonsInstallRequirment($oxitype) {
    $url = admin_url("admin.php?page=oxi-addons#$oxitype");
    $import = admin_url("admin.php?page=oxi-addons-import#$oxitype");
    echo '<div class="oxi-addons-wrapper">   
                <div class="oxi-addons-row">
                    <div class="oxi-addons-import-requirement" style="padding-top: 100px;">
                        <div class="oxi-addons-import-requirement-data">
                            <div class="oxi-addons-import-requirement-icon">
                                ' . oxi_addons_admin_font_awesome('fa-exclamation-triangle') . '
                            </div>
                            <div class="oxi-addons-import-requirement-text">
                                <div class="oxi-addons-import-requirement-heading">
                                  ' . str_replace('_', ' ', $oxitype) . ' Update Required
                                </div>
                                <div class="oxi-addons-import-requirement-content">
                                    Thank you for using Shortcode Addons. As your Style data kindly Update <a target="_blank" href="' . $url . '">' . str_replace('_', ' ', $oxitype) . '</a>. Without Update this elements your data will not works properly and create Error.<br>
                                    Update is too easy as Delete from <a target="_blank" href="' . $url . '">Shortcode Elements</a> and Install again from <a target="_blank" href="' . $url . '">Import Elements</a>. Don\'t worry your data not delete during Update.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
}

/**
 * Demo data 
 * will called at if import style not works with elements
 */
function OxiAddonsDemoDataLayouts($data, $oxitype) {
    if (count($data) > 0) {
        if (!empty($_REQUEST['_wpnonce'])) {
            $nonce = $_REQUEST['_wpnonce'];
        }
        global $wpdb;
        $exportvalue = '';
        $oxitype = sanitize_text_field($_GET['oxitype']);
        $table_name = $wpdb->prefix . 'oxi_div_style';
        $table_list = $wpdb->prefix . 'oxi_div_list';
        if (!empty($_POST['export']) && $_POST['export'] == 'export') {
            if (wp_verify_nonce($nonce, 'oxi-addons-' . $oxitype . '-export-nonce')) {
                $oxistyleid = (int) $_POST['oxiexportid'];
                if ((int) $oxistyleid) {
                    $exportdata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $oxistyleid), ARRAY_A);
                    $exportfile = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid = '$oxistyleid'  ORDER by id ASC", ARRAY_A);
                    $exportvalue .= $exportdata['name'] . 'OXIIMPORT' . $exportdata['type'] . 'OXIIMPORT' . $exportdata['style_name'] . 'OXIIMPORT' . $exportdata['css'];
                    if (count($exportfile) > 0) {
                        $exportvalue .= '##OXISTYLE##';
                        foreach ($exportfile as $value) {
                            $exportvalue .= $value['files'] . '##OXIDATA##';
                        }
                    }
                    $jQuery = 'jQuery("#oxi-addons-style-export-data").modal("show"); 
                                    jQuery(".OxiAddImportDatacontent").on("click", function () {
                                    jQuery("#OxiAddImportDatacontent").select();
                                    document.execCommand("copy"); 
                                    alert("Your Style Data Copied")
                                    })';
                    wp_add_inline_script('oxi-addons-vendor', $jQuery);
                    echo '<div class="modal fade" id="oxi-addons-style-export-data" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">Export Data</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                     <textarea id="OxiAddImportDatacontent" class="oxi-addons-export-data-code">' . OxiAddonsADMHelpTextSenitize($exportvalue) . '</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-info OxiAddImportDatacontent")">Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }
        }
        ?>
        <div class="oxi-addons-wrapper table-responsive abop" style="margin-bottom: 20px; opacity: 0; height: 0px">
            <table class="table table-hover widefat oxi_addons_table_data" style="background-color: #fff; border: 1px solid #ccc">
                <thead>
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 15%">Name</th>
                        <th style="width: 15%">Templates</th>
                        <th style="width: 30%">Shortcode</th>
                        <th style="width: 30%">Edit Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $value) {
                        $id = $value['id'];
                        echo '<tr>';
                        echo '<td>' . $id . '</td>';
                        echo '<td>' . oxi_addons_shortcode_name_converter($value['name']) . '</td>';
                        echo '<td>' . oxi_addons_shortcode_name_converter($value['style_name']) . '</td>';
                        echo '<td><span>Shortcode &nbsp;&nbsp;<input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[oxi_addons id=&quot;' . $id . '&quot;]"></span> <br>'
                        . '<span>Php Code &nbsp;&nbsp; <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[oxi_addons  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                        echo '<td> 
                                     <button type="button" class="btn btn-success oxi-addons-style-clone"  style="float:left" oxiaddonsdataid="' . $id . '">Clone</button>
                                     <a href="' . admin_url("admin.php?page=oxi-addons&oxitype=$oxitype&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                                    <form method="post" class="oxi-addons-style-delete">
                                            ' . wp_nonce_field("oxi-addons-$oxitype-del-nonce") . '
                                            <input type="hidden" name="oxideleteid" value="' . $id . '">
                                            <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="addonsdatadelete">Delete</button>  
                                    </form>
                                    <form method="post">
                                            ' . wp_nonce_field("oxi-addons-$oxitype-export-nonce") . '
                                            <input type="hidden" name="oxiexportid" value="' . $id . '">
                                            <button class="btn btn-info" style="float:left; margin-left: 5px;"  title="Export"  type="submit" value="export" name="export">Export</button>  
                                    </form>
                             </td>';
                        echo ' </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <?php
    }
}
