<?php

/**

 * Astra Child Theme functions and definitions

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package Astra Child

 * @since 1.0.0

 */



/**

 * Define Constants

 */

// define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.'.time() );



/**

 * Enqueue stylesa

 */

function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style( 'myorigene-fonts', 'https://gistcdn.githack.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    

    wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '4.6.2', 'all' );

    // wp_enqueue_style( 'bootstrap-v5-css', get_stylesheet_directory_uri() . '/css/bootstrap-v5.min.css', array(), '5.3.3', 'all' );

	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', array(), CHILD_THEME_ASTRA_CHILD_VERSION );

	wp_enqueue_style( 'Swiper', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', array(), '11', 'all' );

	wp_enqueue_style( 'AOS', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '11', 'all' );

    wp_enqueue_style( 'media-query', get_stylesheet_directory_uri() . '/css/media.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    

	wp_enqueue_script( 'jQuery', get_stylesheet_directory_uri() . '/js/jquery-3.7.1.min.js', array(), CHILD_THEME_ASTRA_CHILD_VERSION, true );

    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array('jQuery'), '4.6.2', true);

    // wp_enqueue_script( 'bootstrap-v5-js', get_stylesheet_directory_uri() . '/js/bootstrap-v5.bundle.min.js', array('jQuery'), '5.3.3', true);

	wp_enqueue_script( 'Swiper', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array('jQuery'), '11', true );

    wp_enqueue_script( 'AOS', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array('jQuery'), '1.0.0', true );

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

    wp_localize_script( 'scripts', 'myog', array(

        'ajaxurl'   => admin_url('admin-ajax.php'),

        'nonce'    => wp_create_nonce('myog_nonce'),

        'home_url' => home_url(),

        'add_to_cart'   => wp_create_nonce('myog_add_to_cart'),

        'popup_error' => '<div class="modal fade add-to-cart-popup" id="add-to-cart-popup" tabindex="-1" role="dialog" aria-labelledby="add-to-cart-popup" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-body position-relative"><button type="button" class="modal-close position-absolute" id="modal-close"><span class="d-none">Close</span></button><div class="modal-inner" id="modal-inner"><img src="/wp-content/uploads/2024/11/myog-icon-status-failed.svg" class="modal-icon"/><p class="mb-0">Something went wrong! Please try again later.</p></div></div></div></div></div>',

    ));



    if( !is_user_logged_in() ){

        wp_enqueue_script( 'login-scripts', get_stylesheet_directory_uri() . '/js/login-scripts.js', array('jQuery'), '1.0.0', true );

        wp_localize_script( 'login-scripts', 'myog_login', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_login_nonce'),

            'myaccount_url' => home_url().'/my-account/',

        ));

    }



    if( is_account_page() && is_wc_endpoint_url('edit-account') ) {

        wp_enqueue_script('myaccount-edit-profile', get_stylesheet_directory_uri() . '/js/my-account-edit-profile.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);

        wp_localize_script('myaccount-edit-profile', 'myog_myaccount_edit_profile', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_myaccount_edit_profile'),

        ));

    }

    

    if( has_shortcode(get_post_field('post_content', get_the_ID() ), 'myog_test_kit_package')) {

        wp_enqueue_script( 'product-filter-scripts', get_stylesheet_directory_uri() . '/js/product-filter-scripts.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);

        wp_localize_script( 'product-filter-scripts', 'myog_test_kit', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_testkit_filter'),

        ));

        wp_enqueue_script( 'product-add-cart-scripts', get_stylesheet_directory_uri() . '/js/add-cart-scripts.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);

        wp_localize_script( 'product-add-cart-scripts', 'myog_add_cart', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_add_to_cart'),

            'art_page'  => wc_get_cart_url(),

        ));

    }



    if( has_shortcode(get_post_field('post_content', get_the_ID() ), 'myog_dna_test_kit_insights')) {

        wp_enqueue_script( 'myog-insights', get_stylesheet_directory_uri() . '/js/myog-insights.js', array('jquery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);

        wp_localize_script( 'myog-insights', 'myog_insights', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_dna_testkit_insights'),

        ));

    }

    

    if ( function_exists( 'is_checkout' ) && is_checkout() || function_exists( 'is_account_page' ) && is_account_page() || is_page('register') || is_page('change-password') || is_page('change-contact-number') || is_page('change-email') || is_page('verification') ) {

        wp_enqueue_style( 'myog_myaccount', get_stylesheet_directory_uri() . '/css/myog-myaccount.css', array(), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

        wp_enqueue_script( 'my-account', get_stylesheet_directory_uri() . '/js/my-account.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'my-account', 'myog_acc', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce_edit_profile'    => wp_create_nonce('myog_edit_profile'),

            'nonce_change_password'    => wp_create_nonce('myog_change_password')

        ));

    }



    if( is_page('change-password') || is_page('register') ) { 

        wp_enqueue_script( 'change-password', get_stylesheet_directory_uri() . '/js/change-password.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'change-password', 'myog_change_password', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'home_url' => home_url(),

            'nonce'    => wp_create_nonce('myog_change_password_nonce'),

            'logout_link' => wp_logout_url(),

        ));

    }

    

    if( is_page('register') ) {

        wp_enqueue_script( 'registration', get_stylesheet_directory_uri() . '/js/registration.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'registration', 'myog_registration', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_registration_nonce'),

            'verification_url' => wc_get_account_endpoint_url('verification'),

        ));

    }



    if( is_page('verification') || is_page('change-email') || is_page('change-contact-number') ) {

        wp_enqueue_style( 'verification', get_stylesheet_directory_uri() . '/css/verification.css', array(), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    }

    if( is_page('verification') ) {

        wp_enqueue_script( 'verification', get_stylesheet_directory_uri() . '/js/verification.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'verification', 'myog_verification', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_verification_nonce'),

            'myacccount_url' => home_url().'/my-account',

        ));

    }



    if( is_page('lost-password') ) {

        wp_enqueue_script( 'lost-password', get_stylesheet_directory_uri() . '/js/lost-password.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'lost-password', 'myog_lost_password', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_lost_password_nonce'),

        ));

    }



    if( is_page('change-email') ) {

        wp_enqueue_script( 'change-email', get_stylesheet_directory_uri() . '/js/change-email.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'change-email', 'myog_change_email', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_change_account_email'),

            'myacccount_url' => home_url().'/my-account',

            'logout_link' => wp_logout_url(),

        ));

    }



    if( is_page('change-contact-number') ) {

        wp_enqueue_script( 'change-contact-number', get_stylesheet_directory_uri() . '/js/change-contact-number.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );

        wp_localize_script( 'change-contact-number', 'myog_change_contact_number', array(

            'ajaxurl'   => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_change_account_mobile'),

            'myacccount_url' => home_url().'/my-account',

            'logout_link' => wp_logout_url(),

        ));

    }



    if( is_product() ) {

        global $product;

        // $product_id = $product->get_id();

        $product_id = 2434;

        $product_name = get_the_title($product_id);

        // $product_name = $product ? $product->get_name() : '';

        $product_unique_id = null;



        switch ($product_name) {

            case 'Premium Package':

                $product_unique_id = 1;

                break;

            case 'For Adults':

                $product_unique_id = 2;

                break;

            case 'For Anti-Aging':

                $product_unique_id = 3;

                break;

            case 'For Children':

                $product_unique_id = 4;

                break;

            default:

                $product_unique_id = null;

        }



        wp_enqueue_script('single-product', get_stylesheet_directory_uri() . '/js/single-product.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);

        wp_localize_script('single-product', 'singleProductData', array(

            'ajax_url' => admin_url('admin-ajax.php'),

            'nonce'    => wp_create_nonce('myog_single_product_insight'),

            'product_unique_id' => $product_unique_id,

            'api_url' => 'https://stagingapi.myorigene.com/api/v1.0.0/get-modules/',

            'p_name' => $product_name,

        ));

    }

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



add_action('admin_init', function () {

    // Redirect any user trying to access comments page

    global $pagenow;

    

    if ($pagenow === 'edit-comments.php') {

       wp_safe_redirect(admin_url());

        exit;

    }



    // Remove comments metabox from dashboard

    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');



    // Disable support for comments and trackbacks in post types

    foreach (get_post_types() as $post_type) {

        if (post_type_supports($post_type, 'comments')) {

            remove_post_type_support($post_type, 'comments');

            remove_post_type_support($post_type, 'trackbacks');

        }

    }

});



// Close comments on the front-end

add_filter('comments_open', '__return_false', 20, 2);

add_filter('pings_open', '__return_false', 20, 2);



// Hide existing comments

add_filter('comments_array', '__return_empty_array', 10, 2);



// Remove comments page in menu

add_action('admin_menu', function () {

    remove_menu_page('edit-comments.php');

});



function myog_init() {

    global $countries;



    if (is_admin_bar_showing()) {

        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);

    }



    $countries=array(array('country'=>'Afghanistan','code'=>'af','mobile_code'=>'+93'),array('country'=>'Albania','code'=>'al','mobile_code'=>'+355'),array('country'=>'Algeria','code'=>'dz','mobile_code'=>'+213'),array('country'=>'American Samoa','code'=>'as','mobile_code'=>'+1684'),array('country'=>'Andorra','code'=>'ad','mobile_code'=>'+376'),array('country'=>'Angola','code'=>'ao','mobile_code'=>'+244'),array('country'=>'Anguilla','code'=>'ai','mobile_code'=>'+1264'),array('country'=>'Antarctica','code'=>'aq','mobile_code'=>'+672'),array('country'=>'Antigua and Barbuda','code'=>'ag','mobile_code'=>'+1268'),array('country'=>'Argentina','code'=>'ar','mobile_code'=>'+54'),array('country'=>'Armenia','code'=>'am','mobile_code'=>'+374'),array('country'=>'Aruba','code'=>'aw','mobile_code'=>'+297'),array('country'=>'Australia','code'=>'au','mobile_code'=>'+61'),array('country'=>'Austria','code'=>'at','mobile_code'=>'+43'),array('country'=>'Azerbaijan','code'=>'az','mobile_code'=>'+994'),array('country'=>'Bahamas','code'=>'bs','mobile_code'=>'+1242'),array('country'=>'Bahrain','code'=>'bh','mobile_code'=>'+973'),array('country'=>'Bangladesh','code'=>'bd','mobile_code'=>'+880'),array('country'=>'Barbados','code'=>'bb','mobile_code'=>'+1246'),array('country'=>'Belarus','code'=>'by','mobile_code'=>'+375'),array('country'=>'Belgium','code'=>'be','mobile_code'=>'+32'),array('country'=>'Belize','code'=>'bz','mobile_code'=>'+501'),array('country'=>'Benin','code'=>'bj','mobile_code'=>'+229'),array('country'=>'Bermuda','code'=>'bm','mobile_code'=>'+1441'),array('country'=>'Bhutan','code'=>'bt','mobile_code'=>'+975'),array('country'=>'Bolivia','code'=>'bo','mobile_code'=>'+591'),array('country'=>'Bosnia','code'=>'ba','mobile_code'=>'+387'),array('country'=>'Botswana','code'=>'bw','mobile_code'=>'+267'),array('country'=>'Brazil','code'=>'br','mobile_code'=>'+55'),array('country'=>'Brunei','code'=>'bn','mobile_code'=>'+673'),array('country'=>'Bulgaria','code'=>'bg','mobile_code'=>'+359'),array('country'=>'Burkina Faso','code'=>'bf','mobile_code'=>'+226'),array('country'=>'Burundi','code'=>'bi','mobile_code'=>'+257'),array('country'=>'Cambodia','code'=>'kh','mobile_code'=>'+855'),array('country'=>'Cameroon','code'=>'cm','mobile_code'=>'+237'),array('country'=>'Canada','code'=>'ca','mobile_code'=>'+1'),array('country'=>'Cape Verde','code'=>'cv','mobile_code'=>'+238'),array('country'=>'Cayman Islands','code'=>'ky','mobile_code'=>'+1345'),array('country'=>'Central African Republic','code'=>'cf','mobile_code'=>'+236'),array('country'=>'Chad','code'=>'td','mobile_code'=>'+235'),array('country'=>'Chile','code'=>'cl','mobile_code'=>'+56'),array('country'=>'China','code'=>'cn','mobile_code'=>'+86'),array('country'=>'Christmas Island','code'=>'cx','mobile_code'=>'+53'),array('country'=>'Cocos Islands','code'=>'cc','mobile_code'=>'+61'),array('country'=>'Colombia','code'=>'co','mobile_code'=>'+57'),array('country'=>'Comoros','code'=>'km','mobile_code'=>'+269'),array('country'=>'Congo','code'=>'cd','mobile_code'=>'+243'),array('country'=>'Congo','code'=>'cg','mobile_code'=>'+242'),array('country'=>'Cook Islands','code'=>'ck','mobile_code'=>'+682'),array('country'=>'Costa Rica','code'=>'cr','mobile_code'=>'+506'),array('country'=>'Cote D\'Ivoire','code'=>'ci','mobile_code'=>'+225'),array('country'=>'Croatia','code'=>'hr','mobile_code'=>'+385'),array('country'=>'Cuba','code'=>'cu','mobile_code'=>'+53'),array('country'=>'Cyprus','code'=>'cy','mobile_code'=>'+357'),array('country'=>'Czech Republic','code'=>'cz','mobile_code'=>'+420'),array('country'=>'Denmark','code'=>'dk','mobile_code'=>'+45'),array('country'=>'Djibouti','code'=>'dj','mobile_code'=>'+253'),array('country'=>'Dominica','code'=>'dm','mobile_code'=>'+1767'),array('country'=>'East Timor','code'=>'tp','mobile_code'=>'+670'),array('country'=>'Ecuador','code'=>'ec','mobile_code'=>'+593'),array('country'=>'Egypt','code'=>'eg','mobile_code'=>'+20'),array('country'=>'El Salvador','code'=>'sv','mobile_code'=>'+503'),array('country'=>'Equatorial Guinea','code'=>'gq','mobile_code'=>'+240'),array('country'=>'Eritrea','code'=>'er','mobile_code'=>'+291'),array('country'=>'Estonia','code'=>'ee','mobile_code'=>'+372'),array('country'=>'Ethiopia','code'=>'et','mobile_code'=>'+251'),array('country'=>'Falkland Islands','code'=>'fk','mobile_code'=>'+500'),array('country'=>'Faroe Islands','code'=>'fo','mobile_code'=>'+298'),array('country'=>'Fiji','code'=>'fj','mobile_code'=>'+679'),array('country'=>'Finland','code'=>'fi','mobile_code'=>'+358'),array('country'=>'France','code'=>'fr','mobile_code'=>'+33'),array('country'=>'French Guiana','code'=>'gf','mobile_code'=>'+594'),array('country'=>'French Polynesia','code'=>'pf','mobile_code'=>'+689'),array('country'=>'Gabon','code'=>'ga','mobile_code'=>'+241'),array('country'=>'Gambia','code'=>'gm','mobile_code'=>'+220'),array('country'=>'Georgia','code'=>'ge','mobile_code'=>'+995'),array('country'=>'Germany','code'=>'de','mobile_code'=>'+49'),array('country'=>'Ghana','code'=>'gh','mobile_code'=>'+233'),array('country'=>'Gibraltar','code'=>'gi','mobile_code'=>'+350'),array('country'=>'Greece','code'=>'gr','mobile_code'=>'+30'),array('country'=>'Greenland','code'=>'gl','mobile_code'=>'+299'),array('country'=>'Grenada','code'=>'gd','mobile_code'=>'+1473'),array('country'=>'Guadeloupe','code'=>'gp','mobile_code'=>'+590'),array('country'=>'Guam','code'=>'gu','mobile_code'=>'+1671'),array('country'=>'Guatemala','code'=>'gt','mobile_code'=>'+502'),array('country'=>'Guinea','code'=>'gn','mobile_code'=>'+224'),array('country'=>'Guinea-Bissau','code'=>'gw','mobile_code'=>'+245'),array('country'=>'Guyana','code'=>'gy','mobile_code'=>'+592'),array('country'=>'Haiti','code'=>'ht','mobile_code'=>'+509'),array('country'=>'Honduras','code'=>'hn','mobile_code'=>'+504'),array('country'=>'Hong Kong','code'=>'hk','mobile_code'=>'+852'),array('country'=>'Hungary','code'=>'hu','mobile_code'=>'+36'),array('country'=>'Iceland','code'=>'is','mobile_code'=>'+354'),array('country'=>'India','code'=>'in','mobile_code'=>'+91'),array('country'=>'Indonesia','code'=>'id','mobile_code'=>'+62'),array('country'=>'Iran','code'=>'ir','mobile_code'=>'+98'),array('country'=>'Iraq','code'=>'iq','mobile_code'=>'+964'),array('country'=>'Ireland','code'=>'ie','mobile_code'=>'+353'),array('country'=>'Israel','code'=>'il','mobile_code'=>'+972'),array('country'=>'Italy','code'=>'it','mobile_code'=>'+39'),array('country'=>'Jamaica','code'=>'jm','mobile_code'=>'+1876'),array('country'=>'Japan','code'=>'jp','mobile_code'=>'+81'),array('country'=>'Jordan','code'=>'jo','mobile_code'=>'+962'),array('country'=>'Kazakstan','code'=>'kz','mobile_code'=>'+7'),array('country'=>'Kenya','code'=>'ke','mobile_code'=>'+254'),array('country'=>'Kiribati','code'=>'ki','mobile_code'=>'+686'),array('country'=>'North Korea','code'=>'kp','mobile_code'=>'+850'),array('country'=>'Korea','code'=>'kr','mobile_code'=>'+82'),array('country'=>'Kuwait','code'=>'kw','mobile_code'=>'+965'),array('country'=>'Kyrgyzstan','code'=>'kg','mobile_code'=>'+996'),array('country'=>'Laos','code'=>'la','mobile_code'=>'+856'),array('country'=>'Latvia','code'=>'lv','mobile_code'=>'+371'),array('country'=>'Lebanon','code'=>'lb','mobile_code'=>'+961'),array('country'=>'Lesotho','code'=>'ls','mobile_code'=>'+266'),array('country'=>'Liberia','code'=>'lr','mobile_code'=>'+231'),array('country'=>'Libya','code'=>'ly','mobile_code'=>'+218'),array('country'=>'Liechtenstein','code'=>'li','mobile_code'=>'+423'),array('country'=>'Lithuania','code'=>'lt','mobile_code'=>'+370'),array('country'=>'Luxembourg','code'=>'lu','mobile_code'=>'+352'),array('country'=>'Macau','code'=>'mo','mobile_code'=>'+853'),array('country'=>'Macedonia','code'=>'mk','mobile_code'=>'+389'),array('country'=>'Madagascar','code'=>'mg','mobile_code'=>'+261'),array('country'=>'Malawi','code'=>'mw','mobile_code'=>'+265'),array('country'=>'Malaysia','code'=>'my','mobile_code'=>'+60'),array('country'=>'Maldives','code'=>'mv','mobile_code'=>'+960'),array('country'=>'Mali','code'=>'ml','mobile_code'=>'+223'),array('country'=>'Malta','code'=>'mt','mobile_code'=>'+356'),array('country'=>'Marshall Islands','code'=>'mh','mobile_code'=>'+692'),array('country'=>'Martinique','code'=>'mq','mobile_code'=>'+596'),array('country'=>'Mauritania','code'=>'mr','mobile_code'=>'+222'),array('country'=>'Mauritius','code'=>'mu','mobile_code'=>'+230'),array('country'=>'Mayotte','code'=>'yt','mobile_code'=>'+269'),array('country'=>'Mexico','code'=>'mx','mobile_code'=>'+52'),array('country'=>'Micronesia','code'=>'fm','mobile_code'=>'+691'),array('country'=>'Moldova','code'=>'md','mobile_code'=>'+373'),array('country'=>'Monaco','code'=>'mc','mobile_code'=>'+377'),array('country'=>'Mongolia','code'=>'mn','mobile_code'=>'+976'),array('country'=>'Montserrat','code'=>'ms','mobile_code'=>'+1664'),array('country'=>'Morocco','code'=>'ma','mobile_code'=>'+212'),array('country'=>'Mozambique','code'=>'mz','mobile_code'=>'+258'),array('country'=>'Myanmar','code'=>'mm','mobile_code'=>'+95'),array('country'=>'Namibia','code'=>'na','mobile_code'=>'+264'),array('country'=>'Nauru','code'=>'nr','mobile_code'=>'+674'),array('country'=>'Nepal','code'=>'np','mobile_code'=>'+977'),array('country'=>'Netherlands','code'=>'nl','mobile_code'=>'+31'),array('country'=>'Netherlands Antilles','code'=>'an','mobile_code'=>'+599'),array('country'=>'New Caledonia','code'=>'nc','mobile_code'=>'+687'),array('country'=>'New Zealand','code'=>'nz','mobile_code'=>'+64'),array('country'=>'Nicaragua','code'=>'ni','mobile_code'=>'+505'),array('country'=>'Niger','code'=>'ne','mobile_code'=>'+227'),array('country'=>'Nigeria','code'=>'ng','mobile_code'=>'+234'),array('country'=>'Niue','code'=>'nu','mobile_code'=>'+683'),array('country'=>'Norfolk Island','code'=>'nf','mobile_code'=>'+672'),array('country'=>'Northern Mariana Islands','code'=>'mp','mobile_code'=>'+1670'),array('country'=>'Norway','code'=>'no','mobile_code'=>'+47'),array('country'=>'Oman','code'=>'om','mobile_code'=>'+968'),array('country'=>'Pakistan','code'=>'pk','mobile_code'=>'+92'),array('country'=>'Palau','code'=>'pw','mobile_code'=>'+680'),array('country'=>'Palestinian','code'=>'ps','mobile_code'=>'+970'),array('country'=>'Panama','code'=>'pa','mobile_code'=>'+507'),array('country'=>'Papua New Guinea','code'=>'pg','mobile_code'=>'+675'),array('country'=>'Paraguay','code'=>'py','mobile_code'=>'+595'),array('country'=>'Peru','code'=>'pe','mobile_code'=>'+51'),array('country'=>'Philippines','code'=>'ph','mobile_code'=>'+63'),array('country'=>'Poland','code'=>'pl','mobile_code'=>'+48'),array('country'=>'Portugal','code'=>'pt','mobile_code'=>'+351'),array('country'=>'Qatar','code'=>'qa','mobile_code'=>'+974'),array('country'=>'Reunion','code'=>'re','mobile_code'=>'+262'),array('country'=>'Romania','code'=>'ro','mobile_code'=>'+40'),array('country'=>'Russia','code'=>'ru','mobile_code'=>'+7'),array('country'=>'Rwanda','code'=>'rw','mobile_code'=>'+250'),array('country'=>'Saint Helena','code'=>'sh','mobile_code'=>'+290'),array('country'=>'Saint Kitts and Nevis','code'=>'kn','mobile_code'=>'+1869'),array('country'=>'Saint Lucia','code'=>'lc','mobile_code'=>'+1758'),array('country'=>'Saint Pierre and Miquelon','code'=>'pm','mobile_code'=>'+508'),array('country'=>'Saint Vincent and the Grenadines','code'=>'vc','mobile_code'=>'+1784'),array('country'=>'Samoa','code'=>'ws','mobile_code'=>'+685'),array('country'=>'San Marino','code'=>'sm','mobile_code'=>'+378'),array('country'=>'Sao Tome and Principe','code'=>'st','mobile_code'=>'+239'),array('country'=>'Saudi Arabia','code'=>'sa','mobile_code'=>'+966'),array('country'=>'Senegal','code'=>'sn','mobile_code'=>'+221'),array('country'=>'Seychelles','code'=>'sc','mobile_code'=>'+248'),array('country'=>'Sierra Leone','code'=>'sl','mobile_code'=>'+232'),array('country'=>'Singapore','code'=>'sg','mobile_code'=>'+65'),array('country'=>'Slovakia','code'=>'sk','mobile_code'=>'+421'),array('country'=>'Slovenia','code'=>'si','mobile_code'=>'+386'),array('country'=>'Solomon Islands','code'=>'sb','mobile_code'=>'+677'),array('country'=>'Somalia','code'=>'so','mobile_code'=>'+252'),array('country'=>'South Africa','code'=>'za','mobile_code'=>'+27'),array('country'=>'Spain','code'=>'es','mobile_code'=>'+34'),array('country'=>'Sri Lanka','code'=>'lk','mobile_code'=>'+94'),array('country'=>'Sudan','code'=>'sd','mobile_code'=>'+249'),array('country'=>'Suriname','code'=>'sr','mobile_code'=>'+597'),array('country'=>'Swaziland','code'=>'sz','mobile_code'=>'+268'),array('country'=>'Sweden','code'=>'se','mobile_code'=>'+46'),array('country'=>'Switzerland','code'=>'ch','mobile_code'=>'+41'),array('country'=>'Syria','code'=>'sy','mobile_code'=>'+963'),array('country'=>'Taiwan','code'=>'tw','mobile_code'=>'+886'),array('country'=>'Tajikistan','code'=>'tj','mobile_code'=>'+992'),array('country'=>'Tanzania','code'=>'tz','mobile_code'=>'+255'),array('country'=>'Thailand','code'=>'th','mobile_code'=>'+66'),array('country'=>'Tokelau','code'=>'tk','mobile_code'=>'+690'),array('country'=>'Tonga','code'=>'to','mobile_code'=>'+676'),array('country'=>'Trinidad and Tobago','code'=>'tt','mobile_code'=>'+1868'),array('country'=>'Tunisia','code'=>'tn','mobile_code'=>'+216'),array('country'=>'Turkey','code'=>'tr','mobile_code'=>'+90'),array('country'=>'Turkmenistan','code'=>'tm','mobile_code'=>'+993'),array('country'=>'Turks and Caicos Islands','code'=>'tc','mobile_code'=>'+1649'),array('country'=>'Tuvalu','code'=>'tv','mobile_code'=>'+688'),array('country'=>'Uganda','code'=>'ug','mobile_code'=>'+256'),array('country'=>'Ukraine','code'=>'ua','mobile_code'=>'+380'),array('country'=>'United Arab Emirates','code'=>'ae','mobile_code'=>'+971'),array('country'=>'United Kingdom','code'=>'gb','mobile_code'=>'+44'),array('country'=>'United States','code'=>'us','mobile_code'=>'+1'),array('country'=>'Uruguay','code'=>'uy','mobile_code'=>'+598'),array('country'=>'Uzbekistan','code'=>'uz','mobile_code'=>'+998'),array('country'=>'Vanuatu','code'=>'vu','mobile_code'=>'+678'),array('country'=>'Vatican City State','code'=>'va','mobile_code'=>'+418'),array('country'=>'Venezuela','code'=>'ve','mobile_code'=>'+58'),array('country'=>'Vietnam','code'=>'vn','mobile_code'=>'+84'),array('country'=>'Virgin Islands, British','code'=>'vi','mobile_code'=>'+1284'),array('country'=>'Virgin Islands, United States','code'=>'vq','mobile_code'=>'+1340'),array('country'=>'Wallis and Futuna Islands','code'=>'wf','mobile_code'=>'+681'),array('country'=>'Yemen','code'=>'ye','mobile_code'=>'+967'),array('country'=>'Zambia','code'=>'zm','mobile_code'=>'+260'),array('country'=>'Zimbabwe','code'=>'zw','mobile_code'=>'+263'));

}

add_action('init', 'myog_init');



add_filter( 'upload_mimes', function ( $upload_mimes ) {

		if ( ! current_user_can( 'administrator' ) ) {

			return $upload_mimes;

		}

		$upload_mimes['svg']  = 'image/svg+xml';

		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;

	}

);



add_filter( 'wp_check_filetype_and_ext', function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {

			$check_filetype  = wp_check_filetype( $filename, $mimes );

			$ext             = $check_filetype['ext'];

			$type            = $check_filetype['type'];

			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {

				$ext  = false;

				$type = false;

			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );

		}

		return $wp_check_filetype_and_ext;

}, 10, 5 );



add_filter('woocommerce_billing_fields', 'custom_billing_fullname_field', 10, 1);

function custom_billing_fullname_field($fields) {

    $user_id = get_current_user_id();

    $nickname = ($user_id) ? get_userdata($user_id)->display_name : '';

    // Remove the default first and last name fields

    unset($fields['billing_first_name']);

    unset($fields['billing_last_name']);

    

    // Add the custom full name field

    $fields['billing_first_name'] = array(

        'type'        => 'text',

        'label'       => __('Full Name', 'woocommerce'),

        'placeholder' => _x('Full Name', 'placeholder', 'woocommerce'),

        'required'    => true,

        'class'       => array('form-row-wide'),

        'default'     => $nickname,

        'priority'    => 20,

    );

    

    return $fields;

}



add_filter('woocommerce_shipping_fields', 'custom_shipping_fullname_field', 10, 1);

function custom_shipping_fullname_field($fields) {

    $user_id = get_current_user_id();

    $nickname = ($user_id) ? get_userdata($user_id)->display_name : '';

    // Remove the default first and last name fields

    unset($fields['shipping_first_name']);

    unset($fields['shipping_last_name']);

    

    // Add the custom full name field

    $fields['shipping_first_name'] = array(

        'type'        => 'text',

        'label'       => __('Full Name', 'woocommerce'),

        'placeholder' => _x('Full Name', 'placeholder', 'woocommerce'),

        'required'    => true,

        'class'       => array('form-row-wide'),

        'default'     => $nickname,

        'priority'    => 20,

    );

    

    return $fields;

}

add_action('rest_api_init', function () {
    register_rest_route('myog/v1', '/create-user/', array(
        'methods'  => 'POST',
        'callback' => 'myog_web_api_create_user',
    ));
    register_rest_route('myog/v1', '/get-user/', array(
        'methods' => 'GET',
        'callback' => 'get_customer_users',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('myog/v1', '/get-userdata/', array(
        'methods' => 'GET',
        'callback' => 'get_customers_userdata',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('myog/v1', '/mobile-login/', array(
        'methods' => 'POST',
        'callback' => 'myog_mobile_login',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('myog/v1', '/mobile-reset-password/', array(
        'methods' => 'POST',
        'callback' => 'myog_mobile_reset_password',
        'permission_callback' => '__return_true'
    ));
});

function get_customers_userdata() {
    $args = array(
        'role'    => 'customer',
        'fields'  => array('ID', 'user_login', 'user_email', 'user_registered'),
        'orderby'    => 'user_registered',
        'order'      => 'DESC',
        'number' => 20,
    );

    $user_query = new WP_User_Query($args);
    $users = $user_query->get_results();

    $result = array();

    if (!empty($users)) {
        foreach ($users as $user) {
            $user_id = $user->ID;
            $userdata = get_userdata($user_id);
            $first_name = get_user_meta($user_id, 'first_name', true);

            $result[] = array(
                'ID'           => $user_id,
                'roles' => $userdata->roles,
                'userdata'   => $userdata->data,
            );
        }
        return new WP_REST_Response(array(
            'status' => 1000,
            'message' => 'Get customer list successfully!',
            'data'   => $result
        ), 200);
    }
    else {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'No users found'
        ), 200);
    }
}

function get_customer_users() {
    $args = array(
        'role'    => 'customer',
        'fields'  => array('ID', 'user_login', 'user_email', 'user_registered'),
        'orderby'    => 'user_registered',
        'order'      => 'DESC',
        'number' => 20,
    );

    $user_query = new WP_User_Query($args);
    $users = $user_query->get_results();

    $result = array();

    if (!empty($users)) {
        foreach ($users as $user) {
            $user_id = $user->ID;
            $first_name = get_user_meta($user_id, 'first_name', true);

            $result[] = array(
                'ID'           => $user_id,
                'user_login'   => $user->user_login,
                'first_name'   => $first_name,
                'email'        => $user->user_email,
                'create_date'  => $user->user_registered
            );
        }
        return new WP_REST_Response(array(
            'status' => 1000,
            'message' => 'Get customer list successfully!',
            'data'   => $result
        ), 200);
    }
    else {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'No users found'
        ), 200);
    }
}

function myog_mobile_login(WP_REST_Request $request) {
    $access = sanitize_text_field($request->get_param('username'));
    $password = sanitize_text_field($request->get_param('password'));
    
    $user = get_user_by('login', $access);
    $method = 'username';
    if( !$user ) {
        $user_email = sanitize_email($request->get_param('username'));
        $user = get_user_by('email', $user_email);
        $method = 'email';
    }
    
    if ($user) {
        if( wp_check_password($password, $user->user_pass, $user->ID) ) {
            return new WP_REST_Response(array(
                'status' => 1000,
                'message' => 'Successful!',
                'user_id' => $user->ID,
            ), 200);
        }
        else {
            return new WP_REST_Response(array(
                'status' => 2000,
                'message' => 'Username or Password is invalid!',
            ), 200);
        }
    }
    else {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'Username or Password is invalid!',
        ), 200);
    }
}

function myog_mobile_reset_password(WP_REST_Request $request) {
    $username = sanitize_text_field($request->get_param('username'));
    $current_password = sanitize_text_field($request->get_param('current_password'));
    $new_password = sanitize_text_field($request->get_param('new_password'));
    $type = sanitize_text_field($request->get_param('type'));
    if( empty($new_password) ) {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'The new password is required!',
        ), 200);
    }
    
    $user = get_user_by('login', $username);
    if(!$user) {
        $email = sanitize_email($request->get_param('username'));
        $user = get_user_by('email', $email);
    }
    if ($user) {
        if( $type == '1' ) { // Reset password with current password
            if( empty($current_password) ) {
                return new WP_REST_Response(array(
                    'status' => 2000,
                    'message' => 'The current password is required!',
                ), 200);
            }
            
            if( wp_check_password($current_password, $user->user_pass, $user->ID) ) {
                wp_set_password($new_password, $user->ID);

                return new WP_REST_Response(array(
                    'status' => 1000,
                    'message' => 'Successful!',
                    'note' => 'Normal reset',
                ), 200);
            }
            else {
                return new WP_REST_Response(array(
                    'status' => 2000,
                    'message' => 'This current password is not match!',
                    'note' => 'Normal reset',
                ), 200);
            }
        }
        else if( $type == '2' ) { // Force reset password
            if (wp_check_password($new_password, $user->user_pass, $user->ID)) {
                return new WP_REST_Response(array(
                    'status' => 2000,
                    'message' => 'This new password is the same as the current password!',
                    'note' => 'Force reset',
                ), 200);
            }
            else {
                wp_set_password($new_password, $user->ID);

                // Double-check if the password was updated
                $user_after = get_user_by('ID', $user->ID);
                if (wp_check_password($new_password, $user_after->user_pass, $user_after->ID)) {
                    return new WP_REST_Response(array(
                        'status' => 1000, 
                        'message' => 'Password reset successfully.',
                        'note' => 'Force reset',
                    ), 200);
                } else {
                    return new WP_REST_Response(array(
                        'status' => 2000,
                        'message' => 'Failed to update the password!',
                        'note' => 'Force reset',
                    ), 200);
                }
            }
        }
        else { // Illegal 
            return new WP_REST_Response(array(
                'status' => 2000,
                'message' => 'Invalid request type!',
                'error' => 'Missing reset type!'
            ), 200);
        }

    }
    else {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'This email address is not exists!',
        ), 200);
    }
}

function myog_web_api_create_user(WP_REST_Request $request) {
    $email = sanitize_email($request->get_param('email'));
    $dial_code = sanitize_text_field($request->get_param('dial_code'));
    $contact_number = sanitize_text_field($request->get_param('contact_number'));
    $password = sanitize_text_field($request->get_param('password'));
    $fullname = sanitize_text_field($request->get_param('fullname'));
    $nationality = sanitize_text_field($request->get_param('nationality'));
    $nric_passport = sanitize_text_field($request->get_param('nric_passport'));
    $dob = sanitize_text_field($request->get_param('dob'));
    $gender = sanitize_text_field($request->get_param('gender'));
    $billing_name = sanitize_text_field($request->get_param('billing_name'));
    $billing_dial_code = sanitize_text_field($request->get_param('billing_dial_code'));
    $billing_contact_number = sanitize_text_field($request->get_param('billing_contact_number'));
    $billing_country = sanitize_text_field($request->get_param('billing_country'));
    $billing_state = sanitize_text_field($request->get_param('billing_state'));
    $billing_city = sanitize_text_field($request->get_param('billing_city'));
    $billing_postcode = sanitize_text_field($request->get_param('billing_postcode'));
    $billing_address_1 = sanitize_text_field($request->get_param('billing_address_1'));

    if( empty($email) ) {
        return new WP_REST_Response(array(
            'status' => 2000,
            'message' => 'Email address is required!',
            'error' => array(
                'email' => 'Email address is required!',
            )
        ), 200);
    }
    else {
        if( email_exists($email) ) {
            return new WP_REST_Response(array(
                'status' => 2000,
                'message' => 'This email address is already in use!',
                'error' => array(
                    'email' => 'This email address is already in use!',
                )
            ), 200);
        }
        else {
            if( empty($dial_code) ) {
                return new WP_REST_Response(array(
                    'status' => 2000,
                    'message' => 'Dial code is required!',
                    'error' => array(
                        'code' => 'Dial code is required!',
                    )
                ), 200);
            }
            else {
                if( empty($contact_number) ) {
                    return new WP_REST_Response(array(
                        'status' => 2000,
                        'message' => 'Contact number is required!',
                        'error' => array(
                            'contact_number' => 'Contact number is required!',
                        )
                    ), 200);
                }
                else {
                    $args = array(
                        'meta_key'   => 'user_additional_information_contact_number',
                        'meta_value' => $contact_number,
                        'number'     => 1,
                        'fields'     => 'ID',
                    );
                    $existing_number = get_users($args);
                    if( username_exists($contact_number) || !empty( $existing_number ) ) {
                        return new WP_REST_Response(array(
                            'status' => 2000,
                            'message' => 'Contact number is already exists!',
                            'error' => array(
                                'contact_number' => 'This contact number is already exists!',
                            )
                        ), 200);
                    }
                    else {
                        if( empty($password) ) {
                            return new WP_REST_Response(array(
                                'status' => 2000,
                                'message' => 'Password is required!',
                                'error' => array(
                                    'password' => 'Password is required!',
                                )
                            ), 200);
                        }
                        else {
                            if( empty($fullname) ) {
                                return new WP_REST_Response(array(
                                    'status' => 2000,
                                    'message' => 'Full name is required!',
                                    'error' => array(
                                        'fullname' => 'Full name is required!',
                                    )
                                ), 200);
                            }
                            else {
                                if( empty($nationality) ) {
                                    return new WP_REST_Response(array(
                                        'status' => 2000,
                                        'message' => 'Nationality is required!',
                                        'error' => array(
                                            'nationality' => 'Nationality is required!',
                                        )
                                    ), 200);
                                }
                                else {
                                    if( empty($nric_passport) ) {
                                        return new WP_REST_Response(array(
                                            'status' => 2000,
                                            'message' => 'NRIC / Passport is required!',
                                            'error' => array(
                                                'nric_passport' => 'NRIC / Passport is required!',
                                            )
                                        ), 200);
                                    }
                                    else {
                                        $nationality_field = 'user_additional_information_nationality';
                                        $nric_passport_field = 'user_additional_information_nric_passport';
                                        $check_nric_passport = get_users(array(
                                            'meta_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                    'key'   => $nationality_field,
                                                    'value' => $nationality,
                                                ),
                                                array(
                                                    'key'   => $nric_passport_field,
                                                    'value' => $nric_passport,
                                                ),
                                            ),
                                            'fields' => 'ID',
                                        ));
    
                                        if(!empty($check_nric_passport)) {
                                            return new WP_REST_Response(array(
                                                'status' => 2000,
                                                'message' => 'This NRIC / Passport already existed!',
                                                'error' => array(
                                                    'nric_passport' => 'This NRIC / Passport already existed!',
                                                )
                                            ), 200);
                                        }
                                        else {
                                            if(empty($dob)) {
                                                return new WP_REST_Response(array(
                                                    'status' => 2000,
                                                    'message' => 'The DOB is required!',
                                                    'error' => array(
                                                        'dob' => 'The DOB is required!',
                                                    )
                                                ), 200);
                                            }
                                            else {
                                                if(empty($gender)) {
                                                    return new WP_REST_Response(array(
                                                        'status' => 2000,
                                                        'message' => 'The Gender is required!',
                                                        'error' => array(
                                                            'gender' => 'The Gender is required!',
                                                        )
                                                    ), 200);
                                                }
                                                else {
                                                    $gender = strtolower($gender);
                                                    if( $gender === 'male' || $gender === 'female' ) {
                                                        if( empty($billing_name) ) {
                                                            return new WP_REST_Response(array(
                                                                'status' => 2000,
                                                                'message' => 'The billing name is required!',
                                                                'error' => array(
                                                                    'billing_name' => 'The billing name is required!',
                                                                )
                                                            ), 200);
                                                        }
                                                        else {
                                                            if( empty($billing_contact_number) ) {
                                                                return new WP_REST_Response(array(
                                                                    'status' => 2000,
                                                                    'message' => 'The billing contact number is required!',
                                                                    'error' => array(
                                                                        'billing_contact_number' => 'The billing contact number is required!',
                                                                    )
                                                                ), 200);
                                                            }
                                                            else {
                                                                if( empty($billing_state) ) {
                                                                    return new WP_REST_Response(array(
                                                                        'status' => 2000,
                                                                        'message' => 'The billing state is required!',
                                                                        'error' => array(
                                                                            'billing_state' => 'The billing state is required!',
                                                                        )
                                                                    ), 200);
                                                                }
                                                                else {
                                                                    if( empty($billing_city) ) {
                                                                        return new WP_REST_Response(array(
                                                                            'status' => 2000,
                                                                            'message' => 'The billing city is required!',
                                                                            'error' => array(
                                                                                'billing_city' => 'The billing city is required!',
                                                                            )
                                                                        ), 200);
                                                                    }
                                                                    else {
                                                                        if( empty($billing_postcode) ) {
                                                                            return new WP_REST_Response(array(
                                                                                'status' => 2000,
                                                                                'message' => 'The billing postcode is required!',
                                                                                'error' => array(
                                                                                    'billing_postcode' => 'The billing postcode is required!',
                                                                                )
                                                                            ), 200);
                                                                        }
                                                                        else {
                                                                            if( empty($billing_address_1) ) {
                                                                                return new WP_REST_Response(array(
                                                                                    'status' => 2000,
                                                                                    'message' => 'The billing_address is required!',
                                                                                    'error' => array(
                                                                                        'billing_address' => 'The billing_address is required!',
                                                                                    )
                                                                                ), 200);
                                                                            }
                                                                            else {
                                                                                $user_id = wp_create_user($contact_number, $password, $email);
                                                                                if (is_wp_error($user_id)) {
                                                                                    return new WP_REST_Response(array(
                                                                                        'status' => 2000,
                                                                                        'message' => $user_id->get_error_message(),
                                                                                        'error' => array(
                                                                                            'user' => $user_id->get_error_message(),
                                                                                        )
                                                                                    ), 200);
                                                                                }
                                                                                else {
                                                                                    $user_update = wp_update_user(array(
                                                                                        'ID' => $user_id,
                                                                                        'first_name' => $fullname,
                                                                                        'user_nicename' => $fullname,
                                                                                        'role' => 'customer',
                                                                                    ));
                                                                                    
                                                                                    if (is_wp_error($user_update)) {
                                                                                        return new WP_REST_Response(array(
                                                                                            'status' => 2000,
                                                                                            'message' => $user_update->get_error_message(),
                                                                                            'error' => array(
                                                                                                'user' => $user_update->get_error_message(),
                                                                                            )
                                                                                        ), 500);
                                                                                    }
                                                                                    else {
                                                                                        $display_name = $fullname;
                                                                                        update_user_meta( $user_id, 'nickname', $display_name );
                                                                                        wp_update_user( array( 'ID' => $user_id, 'display_name' => $fullname, 'role' => 'customer' ) );
                                                                                        update_user_meta($user_id, 'billing_first_name', $billing_name);
                                                                                        update_user_meta($user_id, 'billing_phone', $billing_contact_number);
                                                                                        update_user_meta($user_id, 'billing_email', $email);
                                                                                        update_user_meta($user_id, 'billing_country', $billing_country);
                                                                                        update_user_meta($user_id, 'billing_state', $billing_state);
                                                                                        update_user_meta($user_id, 'billing_city', $billing_city);
                                                                                        update_user_meta($user_id, 'billing_postcode', $billing_postcode);
                                                                                        update_user_meta($user_id, 'billing_address_1', $billing_address_1);
                                                                                    
                                                                                        update_field('user_additional_information', array(
                                                                                            'gender' => $gender,
                                                                                            'date_of_birth' => $dob,
                                                                                            'dial_code' => $dial_code,
                                                                                            'contact_number' => $contact_number,
                                                                                            'nric_passport' => $nric_passport,
                                                                                            'nationality' => $nationality,
                                                                                        ), 'user_'.$user_id);
                        
                                                                                        update_field('verification', array(
                                                                                            'verification_status' => 'Verified',
                                                                                            'otp_status' => 'Verified',
                                                                                        ), 'user_'.$user_id);
                                                                                    
                                                                                        return new WP_REST_Response(array(
                                                                                            'status' => 1000,
                                                                                            'message' => 'User created successfully',
                                                                                            'user' => array(
                                                                                                'user_id' => $user_id,
                                                                                                'fullname' => $fullname,
                                                                                            )
                                                                                        ), 200);
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    else {
                                                        return new WP_REST_Response(array(
                                                            'status' => 2000,
                                                            'message' => 'The Gender is invalid!',
                                                            'error' => array(
                                                                'gender' => 'The Gender is invalid!',
                                                            )
                                                        ), 200);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function remove_my_account_menu_items($items) {
    // $items = array(
    //     'dashboard'       => __('Dashboard', 'astra-child'),
    //     'orders'          => __('Orders', 'astra-child'),
    //     'edit-profile'     => __('Edit Profile', 'astra-child'),
    //     'edit-address'    => __('Addresses', 'astra-child'),
    //     'account-details' => __('Account Details', 'astra-child'),
    //     'customer-logout' => __('Logout', 'astra-child'),
    // );
    $items = array(
        'edit-account'     => __('Edit Profile', 'astra-child'),
        'change-password' => __('Change Password', 'astra-child'),
        'change-email' => __('Change Email', 'astra-child'),
        'change-contact-number' => __('Change Contact', 'astra-child'),
    );
    
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_my_account_menu_items');

function myog_header_account_cart(){
    ob_start();

    $profile = '<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#icon-profile)"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.6156 10.6667C19.079 10.6667 17.5849 11.1725 16.3629 12.1063C15.1409 13.0401 14.2585 14.3502 13.851 15.8353C13.4436 17.3204 13.5335 18.8986 14.1071 20.3275C14.5986 21.5521 15.4221 22.6091 16.4785 23.3824C14.1203 24.3101 12.1105 26.0303 10.7704 28.3527C10.6973 28.4733 10.6488 28.6072 10.6277 28.7466C10.6063 28.8876 10.6133 29.0314 10.6483 29.1695C10.6832 29.3077 10.7455 29.4375 10.8313 29.5513C10.9171 29.6651 11.0249 29.7605 11.1482 29.832C11.2716 29.9034 11.4079 29.9494 11.5493 29.9671C11.6907 29.9849 11.8343 29.974 11.9714 29.9353C12.1086 29.8965 12.2365 29.8306 12.3477 29.7415C12.4577 29.6534 12.5492 29.5443 12.6168 29.4207C14.3124 26.4848 17.302 24.7381 20.6156 24.7381C23.9292 24.7381 26.9188 26.4848 28.6144 29.4207C28.682 29.5443 28.7735 29.6534 28.8835 29.7415C28.9947 29.8306 29.1226 29.8965 29.2598 29.9353C29.3969 29.974 29.5405 29.9849 29.6819 29.9671C29.8233 29.9494 29.9597 29.9034 30.083 29.832C30.2063 29.7605 30.3141 29.6651 30.3999 29.5513C30.4858 29.4375 30.548 29.3077 30.5829 29.1695C30.6179 29.0314 30.6249 28.8876 30.6035 28.7466C30.5824 28.6072 30.5339 28.4733 30.4608 28.3527C29.1206 26.031 27.1107 24.3109 24.7525 23.3826C25.809 22.6092 26.6325 21.5521 27.1241 20.3275C27.6977 18.8986 27.7876 17.3204 27.3802 15.8353C26.9727 14.3502 26.0903 13.0401 24.8683 12.1063C23.6463 11.1725 22.1522 10.6667 20.6156 10.6667ZM18.7471 13.1786C19.6393 12.808 20.621 12.711 21.5681 12.9C22.5152 13.0889 23.3853 13.5552 24.0683 14.2401C24.7513 14.925 25.2166 15.7977 25.4051 16.748C25.5935 17.6982 25.4968 18.6832 25.1271 19.5782C24.7574 20.4733 24.1313 21.2381 23.3283 21.7762C22.5253 22.3142 21.5815 22.6013 20.6159 22.6014C19.3214 22.6 18.0802 22.0837 17.1645 21.1655C16.2489 20.2473 15.7337 19.0022 15.7323 17.7033C15.7324 16.7345 16.0189 15.7876 16.5555 14.9822C17.0922 14.1768 17.8549 13.5492 18.7471 13.1786Z" fill="#358C9A"/></g><defs><clipPath id="icon-profile"><rect width="20" height="20" fill="white" transform="translate(10.6156 10)"/></clipPath></defs></svg>';

    $cart = '<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#icon-cart)"><path d="M16.6156 30C16.0656 30 15.5949 29.8043 15.2036 29.413C14.8116 29.021 14.6156 28.55 14.6156 28C14.6156 27.45 14.8116 26.979 15.2036 26.587C15.5949 26.1957 16.0656 26 16.6156 26C17.1656 26 17.6363 26.1957 18.0276 26.587C18.4196 26.979 18.6156 27.45 18.6156 28C18.6156 28.55 18.4196 29.021 18.0276 29.413C17.6363 29.8043 17.1656 30 16.6156 30ZM26.6156 30C26.0656 30 25.5949 29.8043 25.2036 29.413C24.8116 29.021 24.6156 28.55 24.6156 28C24.6156 27.45 24.8116 26.979 25.2036 26.587C25.5949 26.1957 26.0656 26 26.6156 26C27.1656 26 27.6366 26.1957 28.0286 26.587C28.4199 26.979 28.6156 27.45 28.6156 28C28.6156 28.55 28.4199 29.021 28.0286 29.413C27.6366 29.8043 27.1656 30 26.6156 30ZM15.7656 14L18.1656 19H25.1656L27.9156 14H15.7656ZM14.8156 12H29.5656C29.9489 12 30.2406 12.1707 30.4406 12.512C30.6406 12.854 30.6489 13.2 30.4656 13.55L26.9156 19.95C26.7323 20.2833 26.4863 20.5417 26.1776 20.725C25.8696 20.9083 25.5323 21 25.1656 21H17.7156L16.6156 23H28.6156V25H16.6156C15.8656 25 15.2989 24.6707 14.9156 24.012C14.5323 23.354 14.5156 22.7 14.8656 22.05L16.2156 19.6L12.6156 12H10.6156V9.99998H13.8656L14.8156 12Z" fill="#358C9A"/></g><defs><clipPath id="icon-cart"><rect width="20" height="20" fill="white" transform="translate(10.6156 10)"/></clipPath></defs></svg>';
    $account_url = esc_url(wc_get_account_endpoint_url('dashboard'));
    $cart_url = "window.location.href='".home_url()."/cart'";

    echo '<div class="myog-header-account-menu"><ul class="navbar-nav flex-row ml-0">';
    if (!is_user_logged_in()) { 
        echo '<li class="nav-item"><button type="button" class="btn btn-account-login" id="btn-login" data-toggle="modal" data-target="#myog-login-popup"><span class="d-none">Login</span>'.$profile.'</button></li>';
    }
    else{
        $user = wp_get_current_user();
        $name = $user->display_name;
        $firstLetter = mb_substr($name, 0, 1);
        echo '<li class="nav-item position-relative"><button type="button" class="btn btn-account-profile" id="btn-account"><span class="d-none">Profile</span><h6 class="profile-letter mb-0">'.$firstLetter.'</h6></button><ul class="myaccount-submenu position-absolute"><li class="menu-item "><a href="'.$account_url.'" class="menu-link">Profile</a></li><li class="menu-item"><a href="'.esc_url(wc_get_account_endpoint_url("edit-address")).'">Addresses</a></li><li class="menu-item "><a href="'.wp_logout_url(home_url()).'" class="menu-link">Logout</a></li></ul>
        </li>';
    }
    $cart_items_count = WC()->cart->get_cart_contents_count();
    echo '<li class="nav-item"><button type="button" class="btn btn-cart position-relative" id="btn-cart" onclick="'.$cart_url.'"><span class="d-none">Cart</span>'.$cart.'<span class="cart-counter position-absolute" id="cart-counter">'.$cart_items_count.'</span></button></li>';
            
    echo '</ul></div>';
    return ob_get_clean();
}
add_shortcode('myog_header_account_cart','myog_header_account_cart');

function myog_home_banner(){
    ob_start();
    $args = array(
        'post_type'         => 'home-banner',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'order_by'          => 'menu_order',
    );
    $banners = new WP_Query($args);
    if( $banners->have_posts() ){
?>
    <div class="home-banner-wrapper position-relative" id="home-banner-wrapper">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="position-absolute banner-background w-100 h-100 d-flex align-items-center">
                    <video class="banner-bg-video" id="banner-bg-video" autoplay muted loop>Your browser does not support the video tag.</video>
                </div>
                <div class="col-12 col-md-10 home-banner-container">
                    <div class="home-banner swiper" id="home-banner">
                        <div class="swiper-wrapper">
                        <?php
                        while( $banners->have_posts() ){
                            $banners->the_post();
                            $title = get_the_title();
                            $id = get_the_ID();
                            $img = get_field('banner_image');
                            $banner_caption = get_field('banner_caption');
                            $switch = get_field('call_to_action_button');
                            $cta_button = get_field('cta_button');
                        ?>
                            <div class="swiper-slide" id="home-slider-<?php echo $id;?>">
                                <div class="d-flex flex-column flex-md-row flex-md-row-reverse align-items-end justify-content-start">
                                    <div class="col-11 col-md-7 banner-caption-wrapper">
                                        <div class="banner-caption mb-3">
                                            <?php echo $banner_caption;?>
                                        </div>
                                        <div class="banner-cta">
                                            <a href="<?php echo $cta_button['url'];?>" target="<?php echo $cta_button['target'];?>" class="elementor-button uppercase"><?php echo $cta_button['title'];?></a>
                                        </div>
                                    </div>
                                    <div class="col-11 col-md-5 banner-image">
                                        <img src="<?php echo $img['url'];?>" class="img-fluid w-100 h-100"/>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                        wp_reset_postdata();?>
                        </div>
                        <div class="swiper-pagination home-banner-pagination"></div>
                        <div class="swiper-navigation-prev home-banner-navigation-prev"></div>
                        <div class="swiper-navigation-next home-banner-navigation-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }

    return ob_get_clean();
}
add_shortcode('myog_home_banner','myog_home_banner');

function myog_login_popup_form(){
    if( !is_user_logged_in() ){ ?>
    <div class="myog-login-popup myog-popup modal fade" id="myog-login-popup"aria-hidden="true" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog bg-white">
            <div class="modal-content position-relative p-4">
                <div class="loading"><span class="loader"></span></div>
                <div class="modal-header position-relative justify-content-center px-1 py-0 mb-4 text-center">
                    <button type="button" class="close position-absolute circle-close m-0 p-0" data-dismiss="modal" aria-label="Close"><span class="d-none" aria-hidden="true">Close</span></button>
                    <h3><strong>Sign Up</strong></h3>
                </div>
                <div class="modal-body position-relative px-1 py-0 mb-0">
                    <div class="myog-login-form">
                        <form class="form form-container myog-login-form" method="post" action="" id="myog-login-form">
                            <div class="form-row form-fields">
                                <div class="form-group full field-username">
                                    <label for="login-username">Email or Contact Number</label>
                                    <input type="text" name="login_username" class="form-input" id="login-username" placeholder="Type Your Email or Contact Number"/>
                                    <div class="error error-username" id="error-login-username"></div>
                                </div>
                                <div class="form-group full field-password">
                                    <label for="login-password">Password</label>
                                    <div class="password-wrapper position-relative d-block w-100">
                                        <input type="password" name="login_password" class="form-input" id="login-password" placeholder="Type Your Password" autocomplete="off"/>
                                        <span class="show-password position-absolute" id="show-password"><i class="fa fa-eye-slash"></i></span>
                                    </div>
                                    <div class="error error-password" id="error-login-password"></div>
                                </div>
                                <div class="form-group full field-remember-me">
                                    <input type="checkbox" name="remember_me" class="form-checkbox" id="remember-me"/>
                                    <label for="remember-me">Keep me Logged In</label>
                                </div>
                                <div class="form-group full field-globe-message">
                                    <div class="error error-globe-message" id="error-globe-message"></div>
                                </div>
                            </div>
                            <div class="form-row form-submit-actions">
                                <div class="form-group full field-buttons text-center mt-4">
                                    <button type="submit" name="form-submit" class="btn btn-myog" id="btn-submit"><span>Log In</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer position-relative p-0">
                    <div class="d-block w-100 text-center">
                        <p class="forgot-password mb-0"><a href="<?php echo wp_lostpassword_url();?>">Forgot password?</a></p>
                        <p class="create-new-account mb-0">Don't have an account? Click <a href="/register">here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
    
    if( has_shortcode(get_post_field('post_content', get_the_ID() ), 'myog_test_kit_package')) {
        echo '<div class="myog-add-cart-popup modal fade" id="addCartModal" tabindex="-1" aria-labelledby="addCartModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><button type="button" class="close position-absolute" data-toggle="close"></button><div class="ajax-response"></div></div></div></div></div>';
    }
}
add_action('wp_footer', 'myog_login_popup_form');

function testing(){

    

    $response = array(

        'status' => 'success',

        'message' => 'ok no problem!'

    );

    

    wp_send_json($response);

    die();

}

add_action('wp_ajax_testing', 'testing', 10);

add_action('wp_ajax_nopriv_testing', 'testing', 10);



function myog_login_validation(){

    if( isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'myog_login_nonce' ) ){

        $message = $_POST['login_username'].' - '.$_POST['login_password'].' - '.$_POST['remember_me'].' - '.$_POST['nonce'];



        if (isset($_POST['login_username']) && isset($_POST['login_password'])) {

            $username = sanitize_user($_POST['login_username']);

            $password = $_POST['login_password'];

            if($_POST['remember_me'] == 'on') {

                $remember_me = true;

            }

            else {

                $remember_me = false;

            }

            

            if( empty($username) && empty($password) ) {

                $response = array(

                    'status' => 'failed',

                    'message' => 'Login failed!',

                    'error' => array(

                        'username' => 'Username is required!',

                        'password' => 'Password is required!'

                    )

                );

            }

            else if( !empty($username) && empty($password) ){

                $response = array(

                    'status' => 'failed',

                    'message' => 'Login failed!',

                    'error' => array(

                        'password' => 'Password is required!'

                    )

                );

            }

            else if( empty($username) && !empty($password) ){

                $response = array(

                    'status' => 'failed',

                    'message' => 'Login failed!',

                    'error' => array(

                        'username' => 'Username is required!'

                    )

                );

            }

            else {

                $user = get_user_by('login', $username);

                if( !$user ) {

                    $user = get_user_by('email', $username);

                    if ( !$user ) {

                        $args = array(

                            'meta_key'   => 'user_additional_information_contact_number', // Replace with the correct meta key path

                            'meta_value' => $username,

                            'number'     => 1,

                            'count_total' => false,

                            'fields'     => 'all',

                        );

                        $user_query = new WP_User_Query( $args );

                        $users = $user_query->get_results();

            

                        if ( !empty($users) ) {

                            $user = $users[0]; // Get the first result

                        }

                        else {

                            $response = array(

                                'status' => 'failed',

                                'message' => 'Login failed!',

                                'error' => array(

                                    'username' => 'Username is incorrect!',

                                )

                            );

                        }

                    }

                }

                

                if ( !$user ) {

                    $response = array(

                        'status' => 'failed',

                        'message' => 'Login failed!',

                        'error' => array(

                            'username' => 'This Username is not exist! '

                        )

                    );

                }

                else {

                    if( wp_check_password($password, $user->data->user_pass, $user->ID) ) {

                        // Log in the user

                        $creds = array(

                            // 'user_login'    => $username,

                            'user_login'    => $user->user_login,

                            'user_password' => $password,

                            'remember'      => $remember_me

                        );

    

                        $login = wp_signon($creds, false);

    

                        if (is_wp_error($login)) {

                            $response = array(

                                'status' => 'failed',

                                'message' => $login->get_error_message()

                            );

                        }

                        else{

                            $response = array(

                                'status' => 'success',

                                'message' => 'Login successful!',

                            );

                        }

                    }

                    else{

                        $response = array(

                            'status' => 'failed',

                            'message' => 'Login failed!',

                            'error' => array(

                                'password' => 'This Password is incorrect!'

                            )

                        );

                    }

                }

            }

        }

        else{

            $response = array(

                'status' => 'failed',

                'message' => 'Login failed!',

                'error' => array(

                    'username' => 'Username is required!',

                    'password' => 'Password is required!'

                )

            );

        }

    }

    else{

        $response = array(

            'status' => 'failed',

            'message' => 'This submission was submitted through non-authorized pathway!'

        );

    }

    wp_send_json($response);

    die();

}

add_action('wp_ajax_myog_login_validation', 'myog_login_validation', 10);

add_action('wp_ajax_nopriv_myog_login_validation', 'myog_login_validation', 10);



function myog_blog_grid($atts){

    $atts = shortcode_atts(

        array(

            'title' => 'GeneStory'

        ),

        $atts, 'myog_blog_grid');



    $main_title = $atts['title'];

    $blog_page = home_url().'/blog/';

?>

    <div class="myog-blog-wrapper">

        <div class="myog-blog-header d-flex justify-content-start align-items-start mb-5">

            <div class="d-block d-inline-block mr-0 mr-md-3"><h3 class="mb-0"><strong><?php echo $main_title;?></strong></h3></div>

            <div class="myog-blog-navigation">

                <ul class="navbar-nav my-0 d-flex flex-row flex-wrap outline-buttons">

                    <li class="nav-item"><a href="<?php echo $blog_page;?>" class="nav-link btn btn-outline tiny active" data-target="all" data-toggle="blog">All</a></li>

                <?php

                $cats = array(

                    'taxonomy'      => 'blog-category',

                    'hide_empty'    => true,

                );

                $categories = get_terms($cats);

                if (!empty($categories)) {

                    foreach ($categories as $category) {

                        $term_link = get_term_link($category);

                ?>

                    <li class="nav-item"><a href="<?php echo $term_link;?>" class="nav-link btn btn-outline tiny" data-target="<?php echo $category->slug;?>" data-toggle="blog"><?php echo $category->name;?></a></li>

                <?php

                    }

                }

                ?>

                </ul>

            </div>

        </div>

        <div class="myog-blog-body position-relative">

            <div class="loading"><div class="loader"></div></div>

            <div class="myog-blog-grid grid-list" id="myog-blog-grid">

            <?php 

            $args = array(

                'post_type'         => 'blog',

                'post_status'       => 'publish',

            );

            $blog = new WP_Query($args);

            if( $blog->have_posts() ){

                while( $blog->have_posts() ){ 

                    $blog->the_post();

                    $post_id = get_the_id();

                    $post_title = get_the_title();

                    $permalink = get_permalink();

                    $post_date = get_field('blog_date');

                    $post_description = get_post_field('post_content', get_the_ID());

                    $categories = get_the_terms($post_id, 'blog-category');

                    $first_category = $categories[0]->slug;

            ?>

                <div class="myog-blog-grid-item grid-item" id="blog-id-<?php echo $post_id;?>">

                    <div class="myog-grid-thumbnail">

                    <?php if ( has_post_thumbnail() ){ ?>

                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full');?>" class="img-fluid w-100 h-100"/>

                    <?php } ?>

                    <?php if( !empty($categories) ){ ?>

                        <div class="position-absolute sticky-category"><span class="btn btn-outline tiny"><?php echo $first_category;?></span></div>

                    <?php } ?>

                    </div>

                    <div class="myog-grid-content">

                        <div class="myog-grid-title mb-1">

                            <h4 class="mb-0"><strong><?php echo $post_title;?></strong></h4>

                        </div>

                        <div class="myog-grid-date mb-3">

                            <p class="mb-0"><?php echo $post_date;?></p>

                        </div>

                        <div class="myog-grid-excerpt mb-3">

                        <?php if( has_excerpt() ) { $excerpt = get_the_excerpt(); }

                        else{

                            if( !empty($post_description) ){ $excerpt = $post_description; }

                            else{  $excerpt = ''; }

                        }

                            ?>

                            <p class="mb-0"><?php echo $excerpt;?></p>

                        </div>

                        <div class="myog-grid-cta">

                            <a href="<?php echo $permalink;?>" class="btn btn-outline">READ MORE</a>

                        </div>

                    </div>

                </div>

            <?php }  

                wp_reset_postdata(); 

            } else{ ?>

                <div class="myog-blog-grid-item grid-item full text-center p-4 grid-item-error">

                    <p><strong>Sorry, there was/were no Blog(s) found!</strong></p>

                </div>

            <?php } ?>

            </div>

        </div>

    </div>

<?php

}

add_shortcode('myog_blog_grid', 'myog_blog_grid');



function custom_post_type_archive_title($title) {

    if (is_post_type_archive('blog')) {

        // Modify the title as needed

        $title = 'GeneStory';

    }

    return $title;

}



add_filter('get_the_archive_title', 'custom_post_type_archive_title');



function myog_test_kit_package(){

    ob_start();

    $page_permalink = get_permalink();

    $post_type = 'product';

    $taxonomy = 'product_cat';

    $category_param = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

    $cat_list = array(

        'all'   => 'All'

    );

    $product_categories = get_terms(array(

        'taxonomy'      => $taxonomy,

        'hide_empty'    => false,

    ));

    if( !empty($product_categories) ){

        foreach( $product_categories as $item ){

            $cat_list[$item->slug] = $item->name;

        }

    }



    echo '<div class="myog-tkp-wrapper">';

    echo '<div class="myog-tkp-header d-flex justify-content-start align-items-center mb-5"><h3 class="mb-4 mb-md-0 mr-0 mr-md-3"><strong>Test Kit Package</strong></h3>';

    // if( !empty($product_categories) ){

    // echo '<ul class="navbar-nav px-0 my-0 d-flex flex-row flex-wrap outline-buttons">';

    //     foreach( $cat_list as $slug => $name ){

    //         $class = ($category_param == $slug || empty($category_param) && $slug == 'all' ) ? ' active' : '';

    //         echo '<li class="nav-item"><a href="'.$page_permalink.'?category='.$slug.'" type="button" class="nav-link btn btn-outline tiny'.$class.'" data-target="'.$slug.'" data-toggle="test-kit">'.$name.'</a></li>';

    //     }

    // echo '</ul>';

    // }

    echo '</div>';

    

    echo '<div class="myog-tkp-body position-relative"><div class="loading"><div class="loader"></div></div><div class="myog-tkp-packages grid-list">';

    $args = array(

        'post_type'     => $post_type,

        'post_status'   => 'publish',

        'posts_per_page'    => -1,

        'orderby' => 'menu_order',

        'order' => 'asc',

    );



    if (!empty($category_param) && $category_param != 'all') {

        $args['tax_query'] = array(

            array(

                'taxonomy' => 'product_cat',

                'field' => 'slug',

                'terms' => $category_param,

            ),

        );

    }

    $packages = new WP_Query($args);

    if( $packages->have_posts() ){

        while( $packages->have_posts() ){ 

            $packages->the_post();

            $title = get_the_title();

            $id = get_the_ID();

            $desc_title = get_field('features_title');

            $categories = get_the_terms($id, 'product_cat');

            ?>

            <div class="myog-prod-item grid-item" id="product-id-<?php echo $id;?>">

                <div class="myog-grid-upper">

                    <div class="myog-grid-thumbnail mb-3">

                    <?php if( has_post_thumbnail() ){ 

                        echo '<img src="'.get_the_post_thumbnail_url().'" class="img-fluid w-100 h-100"/>';

                    } ?>

                    </div>

                    <div class="myog-grid-content text-center">

                    <?php if( !empty($categories) ){ $first_category = array_shift($categories); ?>

                        <div class="myog-prod-cat mb-2"><button type="button" target="_blank" type="button" class="nav-link btn btn-outline tiny disabled" data-target="<?php echo $first_category->slug;?>"><?php echo $first_category->name;?></a></div>

                    <?php } ?>

                        <div class="myog-grid-title mb-0"><h4 class="mb-0"><?php echo $title;?><strong></strong></h4></div>

                        <div class="myog-grid-desc pb-3">

                            <p class="text-gray mb-2"><?php echo $desc_title;?></p>

                            <p class="myog-features text-gray mb-0">

                            <?php 

                            if( have_rows('features') ){

                                while( have_rows('features') ){ 

                                    the_row();

                                    $item = get_sub_field('title');

                                    echo '<span class="feature">'.$item.'</span>';

                                }

                            }

                            ?>

                            </p>

                        </div>

                    </div>

                </div>

                <div class="myog-grid-lower">

                    <div class="myog-prod-stars d-flex justify-content-center align-items-center mb-3">

                        <i class="fa fa-star" aria-hidden="true"></i>

                        <i class="fa fa-star" aria-hidden="true"></i>

                        <i class="fa fa-star" aria-hidden="true"></i>

                        <i class="fa fa-star" aria-hidden="true"></i>

                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>

                    <div class="myog-prod-buttons d-flex gap-10 justify-content-center align-items-center">

                        <a href="<?php echo get_permalink();?>" class="btn btn-outline uppercase">More Info</a>

                        <button type="button" class="btn btn-myog position-relative btn-tkp-add-cart btn-add-to-cart disabled" id="add-to-cart" data-product-id="<?php echo $id;?>"><div class="loading"><div class="loader"></div></div><span class="d-none" aria-hidden="true">Add to Cart</span><svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#icon-cart)"><path d="M16.6156 30C16.0656 30 15.5949 29.8043 15.2036 29.413C14.8116 29.021 14.6156 28.55 14.6156 28C14.6156 27.45 14.8116 26.979 15.2036 26.587C15.5949 26.1957 16.0656 26 16.6156 26C17.1656 26 17.6363 26.1957 18.0276 26.587C18.4196 26.979 18.6156 27.45 18.6156 28C18.6156 28.55 18.4196 29.021 18.0276 29.413C17.6363 29.8043 17.1656 30 16.6156 30ZM26.6156 30C26.0656 30 25.5949 29.8043 25.2036 29.413C24.8116 29.021 24.6156 28.55 24.6156 28C24.6156 27.45 24.8116 26.979 25.2036 26.587C25.5949 26.1957 26.0656 26 26.6156 26C27.1656 26 27.6366 26.1957 28.0286 26.587C28.4199 26.979 28.6156 27.45 28.6156 28C28.6156 28.55 28.4199 29.021 28.0286 29.413C27.6366 29.8043 27.1656 30 26.6156 30ZM15.7656 14L18.1656 19H25.1656L27.9156 14H15.7656ZM14.8156 12H29.5656C29.9489 12 30.2406 12.1707 30.4406 12.512C30.6406 12.854 30.6489 13.2 30.4656 13.55L26.9156 19.95C26.7323 20.2833 26.4863 20.5417 26.1776 20.725C25.8696 20.9083 25.5323 21 25.1656 21H17.7156L16.6156 23H28.6156V25H16.6156C15.8656 25 15.2989 24.6707 14.9156 24.012C14.5323 23.354 14.5156 22.7 14.8656 22.05L16.2156 19.6L12.6156 12H10.6156V9.99998H13.8656L14.8156 12Z" fill="#358C9A"></path></g><defs><clipPath id="icon-cart"><rect width="20" height="20" fill="white" transform="translate(10.6156 10)"></rect></clipPath></defs></svg></button>

                    </div>

                </div>

            </div>

            <?php

        }

        wp_reset_postdata();

    }

    else{ ?>

        <div class="myog-blog-grid-item grid-item full text-center p-4 grid-item-error">

            <p><strong>Sorry, there is no Product found!</strong></p>

        </div>

    <?php 

    }

    echo '</div></div>';

    

    echo '</div>';

    return ob_get_clean();

}

add_shortcode('myog_test_kit_package', 'myog_test_kit_package');



function myog_test_kit_filter(){

    if( isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'myog_testkit_filter' ) ){

        $post_type = 'product';

        $taxonomy = 'product_cat';

        $target = $_POST['target'];

        $args = array(

            'post_type' => $post_type,

            'posts_per_page' => -1,

        );

        if( isset($target) && $target !== 'all' ){

            $args['tax_query'] = array(

                array(

                    'taxonomy' => $taxonomy,

                    'field'    => 'slug',

                    'terms'    => sanitize_text_field($target),

                ),

            );

        }



        $products = new WP_Query($args);

        if($products->have_posts()){

            while($products->have_posts()){

                $products->the_post();

                $title = get_the_title();

                $id = get_the_ID();

                $categories = get_the_terms($product_id, $taxonomy);

                if(!empty($categories)){

                    $first_category = $categories[0];

                    $cat_button = '<button type="button" target="_blank" class="nav-link btn btn-outline tiny disabled" data-target="'.$first_category->slug.'">'.$first_category->name.'</button>';

                }

                $permalink = get_permalink();

                if(has_post_thumbnail()){

                    $thumbnail_url = get_the_post_thumbnail_url();

                    $thumbnail = '<img decoding="async" src="'.$thumbnail_url.'" class="img-fluid w-100 h-100">';

                } else{ $thumbnail = ''; }



                $html = '<div class="myog-prod-item grid-item" id="product-id-'.$id.'">

                    <div class="myog-grid-upper">

                        <div class="myog-grid-thumbnail mb-3">'.$thumbnail.'</div>

                        <div class="myog-grid-content text-center">

                            <div class="myog-prod-cat">'.$cat_button.'</div>

                            <div class="myog-grid-title mt-2 mb-0"><h4 class="mb-0"><strong>'.$title.'</strong></h4></div>

                            <div class="myog-grid-desc pb-3">

                                <p class="text-gray mb-2">Young Adult / Beauty Fanatic</p>

                                <p class="myog-features text-gray mb-0">

                                    <span class="feature">Bone Health</span><span class="feature">Diet</span><span class="feature">Mental Wellness</span><span class="feature">Cardiovascular Wellness</span><span class="feature">Sleep DNA Wellness</span><span class="feature">Immune System</span><span class="feature">Allergy</span><span class="feature">Cancer Screening</span><span class="feature">Rare Cancer Screening</span><span class="feature">Rare Disease Screening</span>

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="myog-grid-lower">

                        <div class="myog-prod-stars d-flex justify-content-center align-items-center mb-3">

                            <i class="fa fa-star" aria-hidden="true"></i>

                            <i class="fa fa-star" aria-hidden="true"></i>

                            <i class="fa fa-star" aria-hidden="true"></i>

                            <i class="fa fa-star" aria-hidden="true"></i>

                            <i class="fa fa-star" aria-hidden="true"></i>

                        </div>

                        <div class="myog-prod-buttons d-flex gap-10 justify-content-center align-items-center">

                            <a href="'.$permalink.'" class="btn btn-outline uppercase">More Info</a>

                            <button type="button" class="btn btn-myog position-relative btn-tkp-add-cart btn-add-to-cart" id="add-to-cart" data-product-id="'.$id.'"><div class="loading"><div class="loader"></div></div><span class="d-none" aria-hidden="true">Add to Cart</span><svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#icon-cart)"><path d="M16.6156 30C16.0656 30 15.5949 29.8043 15.2036 29.413C14.8116 29.021 14.6156 28.55 14.6156 28C14.6156 27.45 14.8116 26.979 15.2036 26.587C15.5949 26.1957 16.0656 26 16.6156 26C17.1656 26 17.6363 26.1957 18.0276 26.587C18.4196 26.979 18.6156 27.45 18.6156 28C18.6156 28.55 18.4196 29.021 18.0276 29.413C17.6363 29.8043 17.1656 30 16.6156 30ZM26.6156 30C26.0656 30 25.5949 29.8043 25.2036 29.413C24.8116 29.021 24.6156 28.55 24.6156 28C24.6156 27.45 24.8116 26.979 25.2036 26.587C25.5949 26.1957 26.0656 26 26.6156 26C27.1656 26 27.6366 26.1957 28.0286 26.587C28.4199 26.979 28.6156 27.45 28.6156 28C28.6156 28.55 28.4199 29.021 28.0286 29.413C27.6366 29.8043 27.1656 30 26.6156 30ZM15.7656 14L18.1656 19H25.1656L27.9156 14H15.7656ZM14.8156 12H29.5656C29.9489 12 30.2406 12.1707 30.4406 12.512C30.6406 12.854 30.6489 13.2 30.4656 13.55L26.9156 19.95C26.7323 20.2833 26.4863 20.5417 26.1776 20.725C25.8696 20.9083 25.5323 21 25.1656 21H17.7156L16.6156 23H28.6156V25H16.6156C15.8656 25 15.2989 24.6707 14.9156 24.012C14.5323 23.354 14.5156 22.7 14.8656 22.05L16.2156 19.6L12.6156 12H10.6156V9.99998H13.8656L14.8156 12Z" fill="#358C9A"></path></g><defs><clipPath id="icon-cart"><rect width="20" height="20" fill="white" transform="translate(10.6156 10)"></rect></clipPath></defs></svg></button>

                        </div>

                    </div>

                </div>';

            }

            wp_reset_postdata();

        }

        else{

            $html = '<div class="myog-blog-grid-item grid-item full text-center p-4 grid-item-error"><p><strong>Sorry, there is no Product found!</strong></p></div>';

        }



        $response = array(

            'status' => 'success',

            'message' => 'ok no problem!',

            'html'  => $html

        );

    }

    else{

        $response = array(

            'status' => 'failed',

            'message' => 'The nonce validation failed!'

        );

    }

        

    wp_send_json($response);

    die();

}

add_action('wp_ajax_myog_test_kit_filter', 'myog_test_kit_filter');

add_action('wp_ajax_nopriv_myog_test_kit_filter', 'myog_test_kit_filter');



function add_to_cart_ajax_handler() {

    if( isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'myog_add_to_cart' ) ){

        $product_id = $_POST['product_id'];

        $result = WC()->cart->add_to_cart($product_id);



        if ($result) {

            $cart_amount = WC()->cart->get_cart_contents_count();

            $response = array(

                'status' => 'success',

                'message' => 'Product added to cart successfully.',

                'cart' => $cart_amount,

            );

        }

        else {

            $response = array(

                'status' => 'failed',

                'message' => 'Failed to add product to cart.',

            );

        }

    }

    else{

        $response = array(

            'status' => 'failed',

            'message' => 'Unable to proceed due to unauthorise submission!',

        );

    }



    wp_send_json($response);

    die();

}

add_action('wp_ajax_add_to_cart_ajax_handler', 'add_to_cart_ajax_handler');

add_action('wp_ajax_nopriv_add_to_cart_ajax_handler', 'add_to_cart_ajax_handler');



function auto_redirect_after_logout() {

    wp_redirect( home_url() );

    exit();

}

add_action('wp_logout','auto_redirect_after_logout');



function wc_myog_authentication_checking() {

    if( is_account_page() || is_page('change-password') ) {

        if( is_user_logged_in() ) {

            $user_id = get_current_user_id();

            $user = get_userdata($user_id);

            $user_role = $user->roles;

            $verification = get_field('verification', 'user_'.$user_id);

            $user_status = $verification['verification_status'];



            if( in_array( 'customer', $user_role, true ) && $user_status !== 'verified' ) {

                get_template_part('woocommerce/myaccount/template', 'user-verification');

            }

        

        }

    }





    if (is_user_logged_in() && current_user_can('customer')) {

        if (is_account_page() || is_page('change-password') || is_page('change-email') || is_page('change-contact-number') ) {

            $user_id = get_current_user_id();



            $verification = get_field('verification', 'user_' . $user_id);



            if (empty($verification['verification_status']) || $verification['verification_status'] === 'Pending' || $verification['verification_status'] === 'pending') {

                wp_redirect( wc_get_account_endpoint_url('verification') );

                exit;

            }

        }

    }

}

add_action('template_redirect', 'wc_myog_authentication_checking');



function myog_custom_my_account_menu_items( $menu_links ) {

	// unset( $menu_links[ 'edit-address' ] );

	

	unset( $menu_links[ 'dashboard' ] );

	//unset( $menu_links[ 'dashboard' ] );

	//unset( $menu_links[ 'payment-methods' ] );

	//unset( $menu_links[ 'orders' ] );

	//unset( $menu_links[ 'downloads' ] );

	//unset( $menu_links[ 'edit-account' ] );

	//unset( $menu_links[ 'customer-logout' ] );

	

	return $menu_links;

}

add_filter( 'woocommerce_account_menu_items', 'myog_custom_my_account_menu_items' );

function wc_myaccount_change_password() {

    check_ajax_referer('myog_change_password_nonce', 'nonce');

    $response = array();

    $status = '';

    $message = '';

    $html = '';

    $error = array();



    $current_password = $_POST['current_password'];

    $new_password = $_POST['new_password'];

    $confirm_password = $_POST['confirm_password'];

    $user_id = $_POST['user_id'];

    $length = strlen($new_password) >= 8;

    $uppercase = preg_match('/[A-Z]/', $new_password);

    $lowercase = preg_match('/[a-z]/', $new_password);

    $special_char = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password);

    $no_space = !preg_match('/\s/', $new_password);

    if( !empty($current_password) ) {

        $user = get_userdata($user_id);

        $hashed_password = $user->user_pass;

        // To check the current password inserted correct or not

        if( wp_check_password($current_password, $hashed_password, $user_id) ) { 

            // To prevent the new password is exactly the old password

            if( wp_check_password($new_password, $hashed_password, $user_id) ) {

                // If new password is same to old password, then return error

                $status = '2000';

                $message = 'The new password should not be the same as the old password!';

                $error['new_password'] = 'The new password should not be the same as the old password!';

            }

            else {

                // this password is good to go

                // next is to make verify the password secure or not

                // At least 1 numeric, 1 uppercase, 1 lowercase and 1 symbol, minimum 8 characters

                if ($length && $uppercase && $lowercase && $special_char && $no_space) {



                    if( $confirm_password !== $new_password ) {

                        $status = '2000';

                        $message = "The confirm password is not the same as the new password!";

                        $error['confirm_password'] = "The confirm password is not the same as the new password!";

                    }

                    else {

                        $confirm_length = strlen($confirm_password) >= 8;

                        $confirm_uppercase = preg_match('/[A-Z]/', $confirm_password);

                        $confirm_lowercase = preg_match('/[a-z]/', $confirm_password);

                        $confirm_special_char = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $confirm_password);

                        $confirm_no_space = !preg_match('/\s/', $confirm_password);

                        if ($confirm_length && $confirm_uppercase && $confirm_lowercase && $confirm_special_char && $confirm_no_space) {

                            $user = get_user_by( 'ID', $user_id );

                            if($user) {

                                wp_set_password( $new_password, $user_id );

                                $status = '1000';

                                $message = 'Password changed successfully!';

                                $logout_link = wp_logout_url( home_url() );

                                $html = "<div class='modal fade modal-myog-proceed-logout' id='modal-myog-proceed-logout' tabindex='-1' aria-labelledby='modalMyogLogout' aria-modal=true role='dialog' data-backdrop='static' data-keyboard=false><div class='modal-dialog modal-dialog-centered'><div class='modal-content'><div class='modal-body'><h5 class='mb-0'>Password reset successfully! Please logout and sign in again to access the account.</h5></div><div class='modal-footer'><button type='button' class='btn btn-logout-action btn-proceed' id='myog-logout-proceed' data-action='proceed' onclick=\"window.location.href = '\\'".$logout."\\'\";\"><span>Proceed Logout</span></button></div></div></div></div>";

                            }

                            else {

                                $status = '2000';

                                $message = 'Something went wrong! This user is invalid!';

                            }

                        }

                        else {

                            $status = '2000';

                            $message = "The confirm password must include: <span class='d-block'>1. Minimum 8 Characters.</span><span class='d-block'>2. At Least ONE Capital Letter.</span><span class='d-block'>3. At least ONE Number.</span><span class='d-block'>4. At Least ONE Special Character eg. !@#$%^&*.</span><span class='d-block'>5. No spacing.</span>";

                            $error['confirm_password'] = "The confirm password must include: <span class='d-block'>1. Minimum 8 Characters.</span><span class='d-block'>2. At Least ONE Capital Letter.</span><span class='d-block'>3. At least ONE Number.</span><span class='d-block'>4. At Least ONE Special Character eg. !@#$%^&*.</span><span class='d-block'>5. No spacing.</span>";

                        }

                    }

                }

                else {

                    $status = '2000';

                    $message = "The new password must include: <span class='d-block'>1. Minimum 8 Characters.</span><span class='d-block'>2. At Least ONE Capital Letter.</span><span class='d-block'>3. At least ONE Number.</span><span class='d-block'>4. At Least ONE Special Character eg. !@#$%^&*.</span><span class='d-block'>5. No spacing.</span>";

                    $error['new_password'] = "The new password must include: <span class='d-block'>1. Minimum 8 Characters.</span><span class='d-block'>2. At Least ONE Capital Letter.</span><span class='d-block'>3. At least ONE Number.</span><span class='d-block'>4. At Least ONE Special Character eg. !@#$%^&*.</span><span class='d-block'>5. No spacing.</span>";

                }

            }

        }

        else {

            $status = '2000';

            $message = 'Invlid Password!';

            $error['current_password'] = 'Invalid Password!';

        }

    }

    else {

        $status = '2000';

        $message = 'Error occured!';

        $error['current_password'] = 'Please fill in the current password!';

    }



    $response = array(

        'status' => $status,

        'message' => $message,

        'html' => $html,

        'error' => $error

    );



    echo json_encode($response);



    die();

}

add_action('wp_ajax_wc_myaccount_change_password', 'wc_myaccount_change_password');

add_action('wp_ajax_nopriv_wc_myaccount_change_password', 'wc_myaccount_change_password');



function wc_myog_lost_password() {

    check_ajax_referer('myog_lost_password_nonce', 'nonce');

    $response = array();

    $status = '';

    $message = '';

    $html = '';

    $error = array();



    $user_input = $_POST['user_login'];



    if( !empty($user_input) ) {

        if ( is_email( $user_input ) ) {

            $user = get_user_by( 'email', $user_input );

        }

        else {

            $user = get_user_by( 'login', $user_input );

        }



        if( $user ) {

            $reset_key = get_password_reset_key( $user );

            $reset_link = network_site_url( "wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode( $user->user_login ), 'login' );

    

            // Send reset email

            $message = "Hi, \n\nClick the following link to reset your password: \n$reset_link\n\nThanks.";

            wp_mail( $user->user_email, 'Password Reset', $message );

            $status = '1000';

            $message = 'Password reset successfully! Please check your email for the temporarily password.';

        }

        else {

            $status = '2000';

            $message = 'Field is empty!';

            $error['user_login'] = 'User not found. Please check your username or email.';

        }

    }

    else {

        $status = '2000';

        $message = 'Field is empty!';

        $error['user_login'] = 'Please insert the username or email address!';

    }

    

    

    $response = array(

        'status' => $status,

        'message' => $message,

        'html' => $html,

        'error' => $error

    );



    echo json_encode($response);



    die();

}

add_action('wp_ajax_nopriv_wc_myog_lost_password', 'wc_myog_lost_password');



function wc_myog_registration() {

    check_ajax_referer('myog_registration_nonce', 'nonce');

    $response = array();

    $status = '';

    $message = '';

    $html = '';

    $error = array();



    $email = sanitize_email( $_POST['email'] );

    $dial_code = sanitize_text_field( $_POST['dial_code'] );

    $contact_number = sanitize_text_field( $_POST['contact_number'] );

    $mobile_number = substr($dial_code, 1).$contact_number;

    $password = sanitize_text_field( $_POST['new_password'] );

    $confirm_password = sanitize_text_field( $_POST['confirm_new_password'] );

    $fullname = sanitize_text_field( $_POST['fullname'] );

    $nationality = sanitize_text_field( $_POST['nationality'] );

    $nric_passport = sanitize_text_field( $_POST['nric_passport'] );

    $confirm_nric_passport = sanitize_text_field( $_POST['confirm_nric_passport'] );

    $date_of_birth = sanitize_text_field( $_POST['dob'] );

    $gender = sanitize_text_field( $_POST['gender'] );

    $billing_name = sanitize_text_field( $_POST['billing_name'] );

    $billing_dial_code = sanitize_text_field( $_POST['billing_dial_code'] );

    $billing_contact_number = sanitize_text_field( $_POST['billing_phone'] );

    $billing_mobile_number = substr($billing_dial_code, 1).$billing_contact_number;

    $billing_country = sanitize_text_field( $_POST['billing_country'] );

    $billing_state = sanitize_text_field( $_POST['billing_state'] );

    $billing_city = sanitize_text_field( $_POST['billing_city'] );

    $billing_postcode = sanitize_text_field( $_POST['billing_postcode'] );

    $billing_address = sanitize_text_field( $_POST['mailing_address'] );

    

    $length = strlen($password) >= 8;

    $uppercase = preg_match('/[A-Z]/', $password);

    $lowercase = preg_match('/[a-z]/', $password);

    $special_char = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

    $no_space = !preg_match('/\s/', $password);



    $malaysia_pattern = '/^1\d{8,9}$/';

    $singapore_pattern = '/^[689]\d{7}$/';

    // dial_code = +60, +65

    // preg_match($malaysia_pattern, $my_number);

    // preg_match($singapore_pattern, $sg_number);



    if( empty($email) ) {

        $status = '2000';

        $message = "Error";

        $error['email'] = 'The email address is required!';

    }

    else {

        if( !is_email($email) ) {

            $status = '2000';

            $message = "Error";

            $error['email'] = 'The email address is invalid!';

        }

        else {

            if( email_exists($email) ) {

                $status = '2000';

                $message = "Error";

                $error['email'] = 'This email address has been used!';

            }

            else {

                if( $dial_code == '+65' ) {

                    $mobile_pattern = $singapore_pattern;

                }

                else {

                    $mobile_pattern = $malaysia_pattern;

                }

                

                if( !preg_match($mobile_pattern, $contact_number) ) {

                    $status = '2000';

                    $message = 'Error';

                    $error['contact_number'] = 'Contact number is invalid!';

                }

                else {

                    $args = array(

                        'meta_key'   => 'user_additional_information_contact_number',

                        'meta_value' => $mobile_number,

                        'number'     => 1,

                        'fields'     => 'ID',

                    );

                    $existing_number = get_users($args);



                    if( !empty( $existing_number ) ) {

                        $status = '2000';

                        $message = 'This contact number is used! ('.$existing_number[0].'--'.$mobile_number.')';

                        $error['contact_number'] = 'This contact number is used!';

                    }

                    else {

                        if ( empty($password) || !$length && !$uppercase && !$lowercase && !$special_char && !$no_space) {

                            $status = '2000';

                            $message = "Error";

                            $error['password'] = 'The passwords is invalid!';

                        }

                        else {

                            if( $confirm_password !== $password ) {

                                $status = '2000';

                                $message = "Error";

                                $error['confirm_password'] = 'The confirm password does not match!';

                            }

                            else {

                                if( strlen($fullname) <= 0 ) {

                                    $status = '2000';

                                    $message = "Error";

                                    $error['fullname'] = 'The full name must not leave empty!';

                                }

                                else {

                                    if( empty($nationality) ) {

                                        $status = '2000';

                                        $message = 'Error';

                                        $error['nationality'] = 'Please select your nationality!';

                                    }

                                    else {

                                        if( empty($nric_passport) ) {

                                            $status = '2000';

                                            $message = 'Please insert your National ID Number!';

                                            $error['nric_passport'] = 'Please insert your National ID Number!';

                                        }

                                        else {

                                            $malaysianNRICPattern = '/^\d{12}$/';

                                            $singaporeNRICPattern = '/^[STFG]\d{7}[A-Z]$/';

                                            $malaysianPassportPattern = '/^[A-Z0-9]{6,9}$/i';

                                            $singaporePassportPattern = '/^[A-Z0-9]{6,9}$/i';

                                        

                                            if ( preg_match($malaysianNRICPattern, $nric_passport) ||

                                                preg_match($singaporeNRICPattern, $nric_passport) ||

                                                preg_match($malaysianPassportPattern, $nric_passport) ||

                                                preg_match($singaporePassportPattern, $nric_passport) )  {

                                                    

                                                if( $confirm_nric_passport !== $nric_passport ) {

                                                    $status = '2000';

                                                    $message = 'The National ID Number for confirmation is not match!';

                                                    $error['confirm_nric_passport'] = 'The National ID Number for confirmation is not match!';

                                                }

                                                else {

                                                    $nationality_field = 'user_additional_information_nationality';

                                                    $nric_passport_field = 'user_additional_information_nric_passport';

                                                    $check_nric_passport = get_users(array(

                                                        'meta_query' => array(

                                                            'relation' => 'AND',

                                                            array(

                                                                'key'   => $nationality_field,

                                                                'value' => $nationality,

                                                            ),

                                                            array(

                                                                'key'   => $nric_passport_field,

                                                                'value' => $nric_passport,

                                                            ),

                                                        ),

                                                        'fields' => 'ID',

                                                    ));



                                                    if(!empty($check_nric_passport)) {

                                                        $status = '2000';

                                                        $message = 'This National ID Number is already existed!';

                                                        $error['nric_passport'] = 'This National ID Number is already existed!';

                                                    }

                                                    else {

                                                        if( empty($date_of_birth) ) {

                                                            $status = '2000';

                                                            $message = 'Error';

                                                            $error['dob'] = 'Please select the date of birth!';

                                                        }

                                                        else {

                                                            if( empty($gender) ) {

                                                                $status = '2000';

                                                                $message = 'Error';

                                                                $error['gender'] = 'Please select a gender!';

                                                            }

                                                            else {

                                                                if( empty($billing_name) ) {

                                                                    $status = '2000';

                                                                    $message = 'Error';

                                                                    $error['billing_name'] = 'Billing name is required!';

                                                                }

                                                                else {

                                                                    if( $billing_dial_code == '+65' ) {

                                                                        $billing_mobile_pattern = $singapore_pattern;

                                                                    }

                                                                    else {

                                                                        $billing_mobile_pattern = $malaysia_pattern;

                                                                    }

                                                                    

                                                                    if( !preg_match($billing_mobile_pattern, $billing_contact_number) ) {

                                                                        $status = '2000';

                                                                        $message = 'Error';

                                                                        $error['billing_contact_number'] = 'Billing contact number is invalid!';

                                                                    }

                                                                    else {

                                                                        if( empty($billing_country) ) {

                                                                            $status = '2000';

                                                                            $message = 'Error';

                                                                            $error['billing_country'] = 'Billing country is invalid!';

                                                                        }

                                                                        else { 

                                                                            if( empty($billing_state) ) {

                                                                                $status = '2000';

                                                                                $message = 'Error';

                                                                                $error['billing_state'] = 'Billing state is invalid!';

                                                                            }

                                                                            else {

                                                                                if( empty($billing_city) ) {

                                                                                    $status = '2000';

                                                                                    $message = 'Error';

                                                                                    $error['billing_city'] = 'Billing city / town is invalid!';

                                                                                }

                                                                                else {

                                                                                    if( empty($billing_postcode) ) {

                                                                                        $status = '2000';

                                                                                        $message = 'Error';

                                                                                        $error['billing_postcode'] = 'Billing postcode is invalid!';

                                                                                    }

                                                                                    else {

                                                                                        if( empty($billing_address) ) {

                                                                                            $status = '2000';

                                                                                            $message = 'Error';

                                                                                            $error['billing_address'] = 'Billing address is required!';

                                                                                        }

                                                                                        else {

                                                                                            // Create user account and get the user ID

                                                                                            $user_id = wp_create_user( $mobile_number, $password, $email );

                                                                                            if( is_wp_error( $user_id ) ) {

                                                                                                $status = '2000';

                                                                                                $message = 'Something went wrong during the registration! Please try again later.';

                                                                                            }

                                                                                            else {

                                                                                                $user = new WP_User( $user_id );

                                                                                                update_user_meta( $user_id, 'first_name', $fullname );

                                                                                                $display_name = $fullname;

                                                                                                update_user_meta( $user_id, 'nickname', $display_name );

                                                                                                wp_update_user( array( 'ID' => $user_id, 'display_name' => $fullname, 'user_nicename' => $fullname, 'role' => 'customer' ) );

                                                                                                update_field( 'user_additional_information', array(

                                                                                                    'gender' => $gender,

                                                                                                    'date_of_birth' => $date_of_birth,

                                                                                                    'dial_code' => $dial_code,

                                                                                                    'contact_number' => $mobile_number,

                                                                                                    'nric_passport' => $nric_passport,

                                                                                                    'nationality' => $nationality,

                                                                                                ), 'user_'.$user_id );

                                                                                                update_field( 'verification', array(

                                                                                                    'verification_status' => 'Pending',

                                                                                                    'otp_status' => 'Pending',

                                                                                                ), 'user_'.$user_id);

                                                                                                update_user_meta( $user_id, 'billing_address_1', $billing_address );

                                                                                                update_user_meta( $user_id, 'billing_first_name', $billing_name );

                                                                                                update_user_meta( $user_id, 'billing_email', $email );

                                                                                                update_user_meta( $user_id, 'billing_phone', $billing_mobile_number );

                                                                                                update_user_meta( $user_id, 'billing_country', $billing_country );

                                                                                                update_user_meta( $user_id, 'billing_state', $billing_state );

                                                                                                update_user_meta( $user_id, 'billing_city', $billing_city );

                                                                                                update_user_meta( $user_id, 'billing_postcode', $billing_postcode );

                                

                                                                                                // Add signon

                                                                                                $creds = array(

                                                                                                    // 'user_login'    => $username,

                                                                                                    'user_login'    => $mobile_number,

                                                                                                    'user_password' => $password,

                                                                                                    'remember'      => $remember_me

                                                                                                );

                                                                            

                                                                                                $login = wp_signon($creds, false);

                                                                            

                                                                                                if (is_wp_error($login)) {

                                                                                                    $status = '2000';

                                                                                                    $message = $login->get_error_message();

                                                                                                }

                                                                                                else{

                                                                                                    $status = '1000';

                                                                                                    $message = 'Registration successful!';

                                                                                                }

                                                                                            }

                                                                                        }

                                                                                    }

                                                                                }

                                                                            }

                                                                        }

                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                            else {

                                                $status = '2000';

                                                $message = 'Error';

                                                $error['nric_passport'] = 'The National ID Number is invalid!';

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    }



    $response = array(

        'status' => $status,

        'message' => $message,

        'html' => $html,

        'error' => $error

    );



    echo json_encode($response);



    die();

}

add_action('wp_ajax_wc_myog_registration', 'wc_myog_registration');

add_action('wp_ajax_nopriv_wc_myog_registration', 'wc_myog_registration');



function wc_myog_verification_request_otp() {

    check_ajax_referer('myog_verification_nonce', 'nonce');

    $response = array();

    $status = '';

    $message = '';



    $user_id = $_POST['user_id'];

    $method = $_POST['method'];

    $timestamp = $_POST['timestamp'];

    $verify = get_field('verification', 'user_' . $user_id);

    $existing_timestamp = get_field('verification_otp_request_time', 'user_' . $user_id);

    $request_count = get_field('verification_otp_request_counts', 'user_' . $user_id);

    $time_diff = $timestamp - $existing_timestamp;

    if ($request_count >= 3 && $time_diff < 300) {

        $response['status'] = '2000';

        $response['error']['otp'] = 'You have reached the maximum number of requests. Please try again later.';

        echo json_encode($response);

        wp_die();

    }



    if( $method == 'mobile' || $method == 'email' ) {

        if($time_diff > 300) {

            update_field('verification', array(

                'otp_request_counts' => 0,

                'otp_request_time' => $timestamp,

            ), 'user_'.$user_id);

        }

        else {

            update_field('verification', array(

                'otp_request_counts' => $request_count+1,

            ), 'user_'.$user_id);

        }



        if( $method == 'mobile' ) {

            $otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $user_phone = get_field('user_additional_information_contact_number', 'user_'. $user_id);

            $number_length = strlen($user_phone);

            $hashed_number = str_repeat('*', $number_length - 4) . substr($user_phone, -4);

            update_field('verification', array(

                'otp_code' => $otp,

                'otp_request_time' => $timestamp,

                'otp_status' => 'Requesting',

            ), 'user_'.$user_id);

            

            $response['status'] = '1000';

            $response['message'] = 'A 6 digits OTP has been sent to <strong>'.$hashed_number.'</strong>.';

        }

        else if( $method == 'email' ) {

            $otp = strtoupper(wp_generate_password(8, false, false));

            $user = get_userdata($user_id);

            $user_email = $user->user_email;

            update_field('verification', array(

                'otp_code' => $otp,

                'otp_request_time' => $timestamp,

                'otp_status' => 'Requesting',

            ), 'user_'.$user_id);



            // $response['status'] = '1000';

            // $response['message'] = 'A security code has been sent to <strong>'.$user_email.'</strong>.';

            // $response['email'] = $user_email;

            // $response['otp'] = $otp;

            

            $subject = 'MYOG Account Verification';

            $message = "Your security code is: $otp";

            $headers = array('Content-Type: text/html; charset=UTF-8');

            $mail = wp_mail($user_email, $subject, $message, $headers);



            if ($mail) {

                update_field('user_additional_information', array(

                    'otp_code' => $otp,

                    'otp_request_time' => $timestamp,

                    'otp_status' => 'Requesting',

                ), 'user_'.$user_id);



                $response['status'] = '1000';

                $response['message'] = 'A security code has been sent to <strong>'.$user_email.'</strong>.';

            }

            else {

                $response['status'] = '2000';

                $response['message'] = 'Error occured!';

                $response['error']['otp'] = 'Failed to send security code. Please try again.';

            }

        }

    }

    else {

        $response['status'] = '2000';

        $response['message'] = 'Something wrong happened!';

        $response['error']['request_type'] = 'Invalid request!';

    }



    echo json_encode($response);



    die();

}

add_action('wp_ajax_wc_myog_verification_request_otp', 'wc_myog_verification_request_otp');

add_action('wp_ajax_nopriv_wc_myog_verification_request_otp', 'wc_myog_verification_request_otp');



function generate_country_options() {

    ob_start();

    global $countries;



    foreach ($countries as $key => $country) {

        // echo '<option value="'. esc_attr($country['code']) .'" data-key="'.$key.'">'. esc_html($country['country']) .'</option>';

        echo '<option value="'. esc_attr($country['country']) .'" data-key="'.$key.'">'. esc_html($country['country']) .'</option>';

    }



    return ob_get_clean();

}

add_shortcode('generate_country_options', 'generate_country_options');



function wc_myog_user_account_verification() {

    check_ajax_referer('myog_verification_nonce', 'nonce');

    $response = array();

    $user_id = $_POST['user_id'];

    $method = $_POST['method'];

    $timestamp = $_POST['timestamp'];

    $verify = get_field('verification', 'user_'.$user_id);

    $record_otp = get_field('verification_otp_code', 'user_'.$user_id);

    $submission_otp = '';

    if( $method == 'email' ) {

        $submission_otp = $_POST['security_code'];

        if( strlen($submission_otp) !== 8 ) {

            $response['status'] = '2000';

            $response['message'] = 'Invalid format for security code!';

            $response['error']['verification_code'] = 'Invalid format for security code!';

            echo json_encode($response);

            wp_die();

        }

    }

    else if( $method == 'mobile' ) {

        $otp_input_1 = $_POST['otp_input_1'];

        $otp_input_2 = $_POST['otp_input_2'];

        $otp_input_3 = $_POST['otp_input_3'];

        $otp_input_4 = $_POST['otp_input_4'];

        $otp_input_5 = $_POST['otp_input_5'];

        $otp_input_6 = $_POST['otp_input_6'];

        $submission_otp = $otp_input_1 . $otp_input_2 . $otp_input_3 . $otp_input_4 . $otp_input_5 . $otp_input_6;

        if( strlen($submission_otp) !== 6 ) {

            $response['status'] = '2000';

            $response['message'] = 'Invalid format for OTP code!';

            $response['error']['verification_code'] = 'Invalid format for OTP code!';

            echo json_encode($response);

            wp_die();

        }

    }

    else {

        $response['status'] = '2000';

        $response['message'] = 'Invalid verification method!';

        $response['error']['method'] = 'Invalid verification method!';

        echo json_encode($response);

        wp_die();

    }



    $request_time = get_field('verification_otp_request_time', 'user_'.$user_id);

    $time_diff = $timestamp - $request_time;

    if( $time_diff > 300 ) {

        $response['status'] = '2000';

        $response['message'] = 'The verification code has been expired!';

        $response['error']['verification_code'] = 'The verification code has been expired!';

        echo json_encode($response);

        wp_die();

    }



    if( $submission_otp === $record_otp ) {

        if( update_field('verification_verification_status', 'Verified', 'user_'.$user_id) && update_field('verification_otp_status', 'Verified', 'user_'.$user_id) ) {

            $response['status'] = '1000';

            $response['message'] = 'Verification successful!';

        }

        else {

            $response['status'] = '2000';

            $response['message'] = 'Verification unsuccessful! Please try to request a new verification code.';

        }



    }

    else {

        $response['status'] = '2000';

        if($method == 'email') {

            $response['message'] = 'Invalid security code!';

            $response['error']['verification_code'] = 'Invalid security code!';

        }

        else if($method == 'email') {

            $response['message'] = 'Invalid OTP code!';

            $response['error']['verification_code'] = 'Invalid OTP code!';

        }

    }





    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myog_user_account_verification', 'wc_myog_user_account_verification');

add_action('wp_ajax_nopriv_wc_myog_user_account_verification', 'wc_myog_user_account_verification');



function wc_myog_select_verification_method() {

    check_ajax_referer('myog_verification_nonce', 'nonce');

    $response = array();

    $user_id = $_POST['user_id'];

    $method = $_POST['method'];

    $timestamp = $_POST['timestamp'];

    $user = get_userdata($user_id);

    $email = $user->user_email;

    $contact = $user->user_login;



    if( empty($user_id) || empty($method) ) {

        $response['status'] = '2000';

        $response['message'] = 'Something wrong happened! Please try again later!';

        $response['error']['method'] = 'Something wrong happened! Please try again later!';

    }

    else {

        if( $method == 'email' ) {

            $otp = strtoupper(wp_generate_password(8, false, false));

            $subject = 'MYOG Account Verification';

            $message = "Your verification code is: $otp";

            $headers = array('Content-Type: text/html; charset=UTF-8');

            $otp_sent = wp_mail($email, $subject, $message, $headers);

        }

        else if( $method == 'mobile' ) {

            $otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $api_user = 'wMvbmn9dYA';

            $api_pass = 'rJ5o0Q01ImzYuAJnFUeaeil6uKTDGvRNVvPijI2f';

            $url = "https://sms.360.my/gw/bulk360/v3_0/send.php?user=".urlencode($api_user)."&pass=".urlencode($api_pass)."&from=66688&to=" . $contact . "&text=" . rawurlencode('MyOriGene: Your OTP is '.$otp.'. Keep it secure and do not share it.');

    

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $sentResult = curl_exec($ch);

            curl_close($ch);

    

            if( $sentResult === false ) {

                $response['status'] = '2000';

                $response['message'] = 'Something went wrong while trying to send the OTP!';

                echo json_encode($response);

                wp_die();

            }

            else {

                $sentResult = trim($sentResult);

                $sms360_response = json_decode($sentResult, true);

                if( $sms360_response['code'] !== 200 ) {

                    $sms_api_error = $sms360_response['desc'];

                    $response['status'] = '2000';

                    $response['message'] = 'Something went wrong while trying to send the OTP!';

                    echo json_encode($response);

                    wp_die();

                }

                else {

                    $otp_sent = $sentResult;

                }

            }

        }

        else {

            $response['status'] = '2000';

            $response['message'] = 'Invalid verification method!';

            $response['error']['method'] = 'Invalid verification method!';

            echo json_encode($response);

            wp_die();

        }



        if ($otp_sent) {



            update_field('verification_verification_method', ucfirst($method), 'user_' . $user_id);

            update_field('verification_otp_code', $otp, 'user_' . $user_id);

            update_field('verification_otp_request_time', $timestamp, 'user_' . $user_id);

            update_field('verification_otp_status', 'Requesting', 'user_' . $user_id);

            

            $response['status'] = '1000';

            $response['message'] = 'Requested '.$method.' verification successfully!';

        }

        else {

            error_log('Unable to send email');

            $response['status'] = '2000';

            $response['message'] = 'Something went wrong when applying verification! Please try again later!';

        }

    }



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myog_select_verification_method', 'wc_myog_select_verification_method');

add_action('wp_ajax_nopriv_wc_myog_select_verification_method', 'wc_myog_select_verification_method');



function wc_myog_reset_verification_method() {

    check_ajax_referer('myog_verification_nonce', 'nonce');

    $response = array();

    $user_id = $_POST['user_id'];

    update_field('verification_verification_method', '', 'user_' . $user_id);

    update_field('verification_otp_code', '', 'user_' . $user_id);

    update_field('verification_otp_request_time', '', 'user_' . $user_id);

    update_field('verification_otp_request_counts', '0', 'user_' . $user_id);

    update_field('verification_otp_status', '', 'user_' . $user_id);

    $response['status'] = '1000';

    $response['message'] = 'Reset successful';



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myog_reset_verification_method', 'wc_myog_reset_verification_method');

add_action('wp_ajax_nopriv_wc_myog_reset_verification_method', 'wc_myog_reset_verification_method');



function wc_myaccount_change_email() {

    check_ajax_referer('myog_change_account_email', 'nonce');

    $user_id = intval($_POST['user_id']);

    $new_email = sanitize_email($_POST['new_email']);

    $timestamp = current_time('timestamp');



    $user = get_user_by('id', $user_id);

    $user_email = $user->user_email;

    if( !$user ) {

        $response['status'] = 2000;

        $response['message'] = 'This user is not exists!';

        $response['error']['user_id'] = 'This user is not exists!';

    }

    else {

        if( !is_email($new_email) ) {

            $response['status'] = 2000;

            $response['message'] = 'Invalid email address!';

            $response['error']['email'] = 'Invalid email address!';

        }

        else {

            if ($new_email === $user_email) {

                $response['status'] = 2000;

                $response['message'] = 'The new email address must not be the same as the current email address!';

                $response['error']['email'] = 'The new email address must not be the same as the current email address!';

            }

            else {

                if( email_exists($new_email) ) {

                    $response['status'] = 2000;

                    $response['message'] = 'The new email address is used!';

                    $response['error']['email'] = 'The new email address is used!';

                }

                else {

                    $otp = strtoupper(wp_generate_password(8, false, false));

                    $subject = 'MYOG Change Email Verification';

                    $message = "Your security code is: $otp";

                    $headers = array('Content-Type: text/html; charset=UTF-8');

                    $mail = wp_mail($new_email, $subject, $message, $headers);

                    if( $mail ) {

                        update_field('reset_field_otp_email', $otp, 'user_'.$user_id);

                        update_field('reset_field_otp_email_request_time', $timestamp, 'user_'.$user_id);

                        update_field('reset_field_otp_email_status', 'Requesting', 'user_'.$user_id);

                        update_field('reset_field_temp_email', $new_email, 'user_'.$user_id);

                        

                        $response['status'] = 1000;

                        $response['message'] = 'Request successful';

                    }

                    else {

                        $response['status'] = 2000;

                        $response['message'] = 'Something went wrong while sending security code to '.$new_email;

                        $response['error']['security_code'] = 'Something went wrong while sending security code to '.$new_email;

                    }

                }

            }

        }

    }



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_email', 'wc_myaccount_change_email');

add_action('wp_ajax_nopriv_wc_myaccount_change_email', 'wc_myaccount_change_email');



function validateContactNumber($dial_code, $mobile) {

    if( $dial_code == '60' ) {

        if(preg_match('/^1\d{8,9}$/', $mobile) ) {

            return true;

        }

        else {

            return false;

        }

    }

    else if( $dial_code == '65' ) {

        if(preg_match('/^[689]\d{7}$/', $mobile) ) {

            return true;

        }

        else {

            return false;

        }

    }

}



function wc_myaccount_change_account_mobile() {

    check_ajax_referer('myog_change_account_mobile', 'nonce');

    $user_id = intval($_POST['user_id']);

    $current_user = wp_get_current_user();

    $dial_code = $_POST['dial_code'];

    $new_contact_number = $_POST['new_contact_number'];

    $timestamp = current_time('timestamp');

    if($user_id !== $current_user->ID) {

        $response['status'] = 2000;

        $response['message'] = 'This is an unauthorized access!';

    }

    else {

        $dial_code = substr($dial_code, 1);

        $validMobile = validateContactNumber($dial_code, $new_contact_number);

        if($validMobile) {

            $contact = $dial_code.$new_contact_number;

            $current_user_mobile = $current_user->user_login;

            if( $contact === $current_user_mobile ) {

                $response['status'] = 2000;

                $response['message'] = 'The new contact number must be not the same as the current contact number!';

                echo json_encode($response);

                wp_die();

            }



            $otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $api_user = 'wMvbmn9dYA';

            $api_pass = 'rJ5o0Q01ImzYuAJnFUeaeil6uKTDGvRNVvPijI2f';

            $url = "https://sms.360.my/gw/bulk360/v3_0/send.php?user=".urlencode($api_user)."&pass=".urlencode($api_pass)."&from=66688&to=" . $contact . "&text=" . rawurlencode('MyOriGene: Your OTP is '.$otp.'. Keep it secure and do not share it.');

    

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $sentResult = curl_exec($ch);

            curl_close($ch);

    

            if( $sentResult === false ) {

                $response['status'] = '2000';

                $response['message'] = 'Something went wrong while trying to send the OTP!';

                echo json_encode($response);

                wp_die();

            }

            else {

                $sentResult = trim($sentResult);

                $sms360_response = json_decode($sentResult, true);

                if( $sms360_response['code'] !== 200 ) {

                    $sms_api_error = $sms360_response['desc'];

                    $response['status'] = '2000';

                    $response['message'] = 'Something went wrong while trying to send the OTP!';

                    echo json_encode($response);

                    wp_die();

                }

                else {

                    $otp_sent = $sentResult;

                }



                if ($otp_sent) {

                    update_field('reset_field_otp_mobile', $otp, 'user_' . $user_id);

                    update_field('reset_field_otp_mobile_status', 'Requesting', 'user_' . $user_id);

                    update_field('reset_field_otp_mobile_request_time', $timestamp, 'user_' . $user_id);

                    update_field('reset_field_temp_mobile', $contact, 'user_' . $user_id);

                    

                    $response['status'] = '1000';

                    $response['message'] = 'Requested '.$method.' verification successfully!';

                    $logout_link = wp_logout_url( home_url() );

                    $html = "<div class='modal fade modal-myog-proceed-logout' id='modal-myog-proceed-logout' tabindex='-1' aria-labelledby='modalMyogLogout' aria-modal=true role='dialog' data-backdrop='static' data-keyboard=false><div class='modal-dialog modal-dialog-centered'><div class='modal-content'><div class='modal-body'><h5 class='mb-0'>Password reset successfully! Please logout and sign in again to access the account.</h5></div><div class='modal-footer'><button type='button' class='btn btn-logout-action btn-proceed' id='myog-logout-proceed' data-action='proceed' onclick=\"window.location.href = '\\'".$logout."\\'\";\"><span>Proceed Logout</span></button></div></div></div></div>";

                }

                else {

                    error_log('Unable to send email');

                    $response['status'] = '2000';

                    $response['message'] = 'Something went wrong when applying verification! Please try again later!';

                }

            }

        }

        else {

            $response['status'] = 2000;

            $response['message'] = 'The contact number format is invalid!';

        }

    }

    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_account_mobile', 'wc_myaccount_change_account_mobile');



function wc_myaccount_change_account_mobile_otp_verify() {

    global $wpdb;

    check_ajax_referer('myog_change_account_mobile', 'nonce');

    $user_id = intval($_POST['user_id']);

    $otp = strval($_POST['otp_input_1']).strval($_POST['otp_input_2']).strval($_POST['otp_input_3']).strval($_POST['otp_input_4']).strval($_POST['otp_input_5']).strval($_POST['otp_input_6']);



    $user = get_user_by('id', $user_id);

    $current_user_id = get_current_user_id();

    $user_email = $user->user_email;

    if ( $user_id === $current_user_id ) {

        if( strlen($otp) === 6 ) {

            $current_timestamp = current_time('timestamp');

            $reset_field = get_field('reset_field', 'user_'.$user_id);

            $check_otp = $reset_field['otp_mobile'];

            $check_request_time = $reset_field['otp_mobile_request_time'];



            $time_diff = $$current_timestamp - $check_request_time;

            if( $time_diff >= 300 ) {

                $response['status'] = 2000;

                $response['message'] = 'The OTP code had expired! Please request a new OTP code.';

                $response['error']['otp'] = 'The OTP code had expired! Please request a new OTP code.';

            }

            else {

                if( $check_otp !== $otp ) {

                    $response['status'] = 2000;

                    $response['message'] = 'The OTP code is invalid!';

                    $response['error']['otp'] = 'The OTP code is invalid!';

                }

                else {

                    $temp_mobile = get_field('reset_field_temp_mobile', 'user_'.$user_id);

                    update_field('reset_field_otp_mobile_status', 'Requesting', 'user_'.$user_id);

                    

                    

                    $updated = $wpdb->update(

                        $wpdb->users,

                        array('user_login' => $temp_mobile),

                        array('ID' => $user_id),

                        array('%s'),

                        array('%d')

                    );



                    if ($updated !== false) {

                        update_field('reset_field_otp_mobile', '', 'user_'.$user_id);

                        update_field('reset_field_otp_mobile_status', 'Completed', 'user_'.$user_id);

                        update_field('reset_field_otp_mobile_request_time', '', 'user_'.$user_id);

                        update_field('reset_field_otp_mobile_request_count', '0', 'user_'.$user_id);

                        update_field('reset_field_temp_mobile', '', 'user_'.$user_id);

                        update_field('user_additional_information_contact_number', $temp_mobile, 'user_'.$user_id);

                        update_user_meta($user_id, 'billing_phone', $temp_mobile);

    

                        $response['status'] = 1000;

                        $response['message'] = 'The mobile number has been updated succesfully! Please sign in again...';

                        $logout_link = wp_logout_url( home_url() );

                        $html = "<div class='modal fade modal-myog-proceed-logout' id='modal-myog-proceed-logout' tabindex='-1' aria-labelledby='modalMyogLogout' aria-modal=true role='dialog' data-backdrop='static' data-keyboard=false><div class='modal-dialog modal-dialog-centered'><div class='modal-content'><div class='modal-body'><h5 class='mb-0'>Password reset successfully! Please logout and sign in again to access the account.</h5></div><div class='modal-footer'><button type='button' class='btn btn-logout-action btn-proceed' id='myog-logout-proceed' data-action='proceed' onclick=\"window.location.href = '\\'".$logout."\\'\";\"><span>Proceed Logout</span></button></div></div></div></div>";

                    }

                    else {

                        $response['status'] = 2000;

                        $response['message'] = 'Enable to update the contact number at the moment, please try it again later.';

                    }

                }

            }

        }

        else {

            $response['status'] = 2000;

            $response['message'] = 'Invalid OTP format!';

        }

    }

    else {

        $response['status'] = 2000;

        $response['message'] = 'Unauthorized access!';

    }



    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_account_mobile_otp_verify', 'wc_myaccount_change_account_mobile_otp_verify');



function wc_myog_change_account_mobile() {

    check_ajax_referer('myog_change_account_mobile', 'nonce');

    $user_id = intval($_POST['user_id']);

    $new_mobile = $_POST['otp_input_1']+$_POST['otp_input_2']+$_POST['otp_input_3']+$_POST['otp_input_4']+$_POST['otp_input_5']+$_POST['otp_input_6'];

    $timestamp = $_POST['timestamp'];



    $user = get_user_by('id', $user_id);

    $user_email = $user->user_email;

    if( strlen($new_mobile) !== 6 ) {

        $response['status'] = 2000;

        $response['message'] = 'Invalid OTP format!';

        $response['error']['otp'] = 'Invalid OTP format!';

    }

    else {

        if( !$user ) {

            $response['status'] = 2000;

            $response['message'] = 'This user is not exists!';

            $response['error']['user_id'] = 'This user is not exists!';

        }

        else {

            if( !is_email($new_email) ) {

                $response['status'] = 2000;

                $response['message'] = 'Invalid email address!';

                $response['error']['email'] = 'Invalid email address!';

            }

            else {

                if ($new_email === $user_email) {

                    $response['status'] = 2000;

                    $response['message'] = 'The new email address must not be the same as the current email address!';

                    $response['error']['email'] = 'The new email address must not be the same as the current email address!';

                }

                else {

                    if( email_exists($new_email) ) {

                        $response['status'] = 2000;

                        $response['message'] = 'The new email address is used!';

                        $response['error']['email'] = 'The new email address is used!';

                    }

                    else {

                        $otp = strtoupper(wp_generate_password(8, false, false));

                        $subject = 'MYOG Change Email Verification';

                        $message = "Your security code is: $otp";

                        $headers = array('Content-Type: text/html; charset=UTF-8');

                        $mail = wp_mail($new_email, $subject, $message, $headers);

                        if( $mail ) {

                            update_field('reset_field_otp_email', $otp, 'user_'.$user_id);

                            update_field('reset_field_otp_email_request_time', $timestamp, 'user_'.$user_id);

                            update_field('reset_field_otp_email_status', 'Requesting', 'user_'.$user_id);

                            update_field('reset_field_temp_email', $new_email, 'user_'.$user_id);

                            

                            $response['status'] = 1000;

                            $response['message'] = 'The security code is sent to '.$new_email;

                        }

                        else {

                            $response['status'] = 2000;

                            $response['message'] = 'Something went wrong while sending security code to '.$new_email;

                            $response['error']['security_code'] = 'Something went wrong while sending security code to '.$new_email;

                        }

                    }

                }

            }

        }

    }



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myog_change_account_mobile', 'wc_myog_change_account_mobile');

add_action('wp_ajax_nopriv_wc_myog_change_account_mobile', 'wc_myog_change_account_mobile');



function wc_myaccount_change_email_verify_otp() {

    check_ajax_referer('myog_change_account_email', 'nonce');

    $response = array();

    $user_id = $_POST['user_id'];

    $metod = $_POST['method'];

    $security_code = $_POST['security_code'];

    $timestamp = current_time('timestamp');

    if( empty($security_code) || strlen($security_code) !== 8 ) {

        $response['status'] = 2000;

        $response['message'] = 'The security code is invalid!';

        $response['error']['security_code'] = 'The security code is invalid!';

        echo json_encode($response);

        wp_die();

    }

    else {

        $otp_email = get_field('reset_field_otp_email', 'user_'.$user_id);

        $otp_email_request_time = get_field('reset_field_otp_email_request_time', 'user_'.$user_id);

        $otp_email_request_count = get_field('reset_field_otp_email_request_count', 'user_'.$user_id);

        $time_diff = $timestamp - $otp_email_request_time;

        if( $time_diff >= 300 ) {

            $response['status'] = 2000;

            $response['message'] = 'The security code had expired! Please request a new security code.';

            $response['error']['security_code'] = 'The security code had expired! Please request a new security code.';

        }

        else {

            if( $otp_email !== $security_code ) {

                $response['status'] = 2000;

                $response['message'] = 'The security code is invalid!';

                $response['error']['security_code'] = 'The security code is invalid!';

            }

            else {

                $temp_email = get_field('reset_field_temp_email', 'user_'.$user_id);

                update_field('reset_field_otp_email_status', 'Requesting', 'user_'.$user_id);

                update_user_meta( $user_id, 'billing_email', $temp_email );

                $new_userdata = array(

                    'ID' => $user_id,

                    'user_email' => $temp_email,

                );

                $user_alter = wp_update_user($new_userdata);

                if( is_wp_error($user_alter) ) {

                    $response['status'] = 2000;

                    $response['message'] = $user_alter->get_error_message();

                    $response['error']['email'] = $user_alter->get_error_message();

                }

                else {

                    update_field('reset_field_otp_email', '', 'user_'.$user_id);

                    update_field('reset_field_otp_email_status', 'Completed', 'user_'.$user_id);

                    update_field('reset_field_otp_email_request_time', '', 'user_'.$user_id);

                    update_field('reset_field_otp_email_request_count', '0', 'user_'.$user_id);

                    update_field('reset_field_temp_email', '', 'user_'.$user_id);



                    $response['status'] = 1000;

                    $response['message'] = 'Email address update succesfully! Please sign in again...';

                    $logout_link = wp_logout_url( home_url() );

                    $html = "<div class='modal fade modal-myog-proceed-logout' id='modal-myog-proceed-logout' tabindex='-1' aria-labelledby='modalMyogLogout' aria-modal=true role='dialog' data-backdrop='static' data-keyboard=false><div class='modal-dialog modal-dialog-centered'><div class='modal-content'><div class='modal-body'><h5 class='mb-0'>Password reset successfully! Please logout and sign in again to access the account.</h5></div><div class='modal-footer'><button type='button' class='btn btn-logout-action btn-proceed' id='myog-logout-proceed' data-action='proceed' onclick=\"window.location.href = '\\'".$logout."\\'\";\"><span>Proceed Logout</span></button></div></div></div></div>";

                }

            }

        }

    }



    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_email_verify_otp', 'wc_myaccount_change_email_verify_otp');

add_action('wp_ajax_nopriv_wc_myaccount_change_email_verify_otp', 'wc_myaccount_change_email_verify_otp');



function wc_myaccount_change_email_request_otp() {

    check_ajax_referer('myog_change_account_email', 'nonce');

    $user_id = intval($_POST['user_id']);

    $timestamp = current_time('timestamp');

    $user = get_userdata($user_id);

    if( !$user ) {

        $response['status'] = 2000;

        $response['message'] = 'This user is not exists!';

        $response['error']['user_id'] = 'This user is not exists!';

    }

    else {

        $otp_email = get_field('reset_field_otp_email_code', 'user_'.$user_id);

        $otp_email_request_time = get_field('reset_field_otp_email_request_time', 'user_'.$user_id);

        $otp_email_request_count = get_field('reset_field_otp_email_request_count', 'user_'.$user_id);

        $time_diff = $timestamp - $otp_email_request_time;



        if ($otp_email_request_count >= 3 && $time_diff < 300) {

            $response['status'] = 2000;

            $response['message'] = 'You have reached the maximum number of requests. Please try again later.';

            $response['error']['security_code'] = 'You have reached the maximum number of requests. Please try again later.';

            echo json_encode($response);

            wp_die();

        }

    

        if($time_diff > 300) {

            update_field('reset_field', array(

                'otp_email_request_count' => 0,

                'otp_email_request_time' => $timestamp,

            ), 'user_'.$user_id);

        }

        else {

            update_field('reset_field', array(

                'otp_email_request_count' => intval($otp_email_request_count)+1,

            ), 'user_'.$user_id);

        }



        $new_security_code = strtoupper(wp_generate_password(8, false, false));

        // $new_security_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $new_email = get_field('reset_field_temp_email', 'user_'.$user_id);

        

        $subject = 'MYOG Account Verification';

        $message = "Your new security code is: $new_security_code";

        $headers = array('Content-Type: text/html; charset=UTF-8');

        $mail = wp_mail($new_email, $subject, $message, $headers);



        if ($mail) {

            update_field('reset_field', array(

                'otp_email' => $new_security_code,

                'otp_email_request_time' => $timestamp,

                'otp_email_status' => 'Requesting',

            ), 'user_'.$user_id);



            $response['status'] = '1000';

            $response['message'] = 'A security code has been sent to <strong>'.$new_email.'</strong>.';

        }

        else {

            $response['status'] = '2000';

            $response['message'] = 'Error occured!';

            $response['error']['security_code'] = 'Failed to send security code. Please try again.';

        }

    }



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_email_request_otp', 'wc_myaccount_change_email_request_otp');

add_action('wp_ajax_nopriv_wc_myaccount_change_email_request_otp', 'wc_myaccount_change_email_request_otp');





function wc_myaccount_change_mobile_request_otp() {

    check_ajax_referer('myog_change_account_mobile', 'nonce');

    $user_id = intval($_POST['user_id']);

    $timestamp = current_time('timestamp');

    $user = get_userdata($user_id);

    if( !$user ) {

        $response['status'] = 2000;

        $response['message'] = 'This user is not exists!';

        $response['error']['user_id'] = 'This user is not exists!';

    }

    else {

        $otp_mobile = get_field('reset_field_otp_mobile_code', 'user_'.$user_id);

        $otp_mobile_request_time = get_field('reset_field_otp_mobile_request_time', 'user_'.$user_id);

        $otp_mobile_request_count = get_field('reset_field_otp_mobile_request_count', 'user_'.$user_id);

        $time_diff = $timestamp - $otp_mobile_request_time;



        if ($otp_mobile_request_count >= 3 && $time_diff < 300) {

            $response['status'] = 2000;

            $response['message'] = 'You have reached the maximum number of requests. Please try again later.';

            $response['error']['security_code'] = 'You have reached the maximum number of requests. Please try again later.';

            echo json_encode($response);

            wp_die();

        }

    

        if($time_diff > 300) {

            update_field('reset_field', array(

                'otp_mobile_request_count' => 0,

                'otp_mobile_request_time' => $timestamp,

            ), 'user_'.$user_id);

        }

        else {

            update_field('reset_field', array(

                'otp_mobile_request_count' => intval($otp_mobile_request_count)+1,

            ), 'user_'.$user_id);

        }



        // $new_otp = strtoupper(wp_generate_password(8, false, false));

        $new_otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $new_mobile = get_field('reset_field_temp_mobile', 'user_'.$user_id);

        

        $api_user = 'wMvbmn9dYA';

        $api_pass = 'rJ5o0Q01ImzYuAJnFUeaeil6uKTDGvRNVvPijI2f';

        $url = "https://sms.360.my/gw/bulk360/v3_0/send.php?user=".urlencode($api_user)."&pass=".urlencode($api_pass)."&from=66688&to=" . $new_mobile . "&text=" . rawurlencode('MyOriGene: Your new OTP is '.$new_otp.'. Keep it secure and do not share it.');



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $sentResult = curl_exec($ch);

        curl_close($ch);



        if( $sentResult === false ) {

            $response['status'] = '2000';

            $response['message'] = 'Something went wrong while trying to send the OTP!';

            echo json_encode($response);

            wp_die();

        }

        else {

            $sentResult = trim($sentResult);

            $sms360_response = json_decode($sentResult, true);

            if( $sms360_response['code'] !== 200 ) {

                $sms_api_error = $sms360_response['desc'];

                $response['status'] = '2000';

                $response['message'] = 'Something went wrong while trying to send the OTP!';

                echo json_encode($response);

                wp_die();

            }

            else {

                $otp_sent = $sentResult;

            }

        }



        if ($otp_sent) {

            update_field('reset_field', array(

                'otp_mobile' => $new_otp,

                'otp_mobile_request_time' => $timestamp,

                'otp_mobile_status' => 'Requesting',

            ), 'user_'.$user_id);



            $count_number = strlen($new_mobile);

            $censored_mobile = str_repeat('*', $count_number - 4 ) . substr($new_mobile, -4);

            $response['status'] = '1000';

            $response['message'] = 'A OTP code has been sent to <strong>'.$censored_mobile.'</strong>.';

        }

        else {

            $response['status'] = '2000';

            $response['message'] = 'Error occured!';

            $response['error']['otp'] = 'Failed to send OTP code. Please try again.';

        }

    }



    echo json_encode($response);



    wp_die();

}

add_action('wp_ajax_wc_myaccount_change_mobile_request_otp', 'wc_myaccount_change_mobile_request_otp');



// To access backend availabl country for the billing & shipping country and states

function update_allowed_countries_based_on_api() {

    $api_url = 'https://stagingapi.myorigene.com/api/v1.0.0/get-country-data';

    $response = wp_remote_get($api_url);

    

    if (is_wp_error($response)) {

        return;

    }



    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body, true);



    if (isset($data['code']) && $data['code'] === 1000 && isset($data['data']['country_data'])) {

        $country_data = $data['data']['country_data'];



        $new_allowed_countries = [];

        foreach ($country_data as $country) {

            if (!empty($country['country_code'])) {

                $new_allowed_countries[] = strtoupper($country['country_code']);

            }

        }



        $existing_allowed_countries = get_option('woocommerce_specific_allowed_countries', []);



        sort($new_allowed_countries);

        sort($existing_allowed_countries);

        

        if ($new_allowed_countries !== $existing_allowed_countries) {

            // If they are different, update the WooCommerce allowed countries setting

            update_option('woocommerce_specific_allowed_countries', $new_allowed_countries);

        }

    }

}

add_action('init', 'update_allowed_countries_based_on_api');



function myog_product_insights($atts) {    

    ob_start();

    echo '<div class="myog-product-insights">';

        echo '<div class="myog-insight-header d-block text-left mb-4"><h2 class="elementor-heading-title">Insights</h2></div>';

        echo '<div class="myog-insight-body">';

            echo '<div class="myog-insights" id="myog-insights">';

                echo '<div class="loading" style="display: block;"><span class="loader"></span></div>';

                

            echo '</div>';

        echo '</div>';

    echo '</div>';

    echo '<script type="text/javascript">';

        echo 'document.addEventListener("DOMContentLoaded", function () {';

            echo 'jQuery(document).ready(function($) {';

                echo 'if( $("#myog-insights")[0] ) {';

                    echo '$.ajax({';

                        echo 'url: myog.ajaxurl,';

                        echo 'method: "POST",';

                        echo 'data: { action: "myog_preview_product_insights" },';

                        echo 'success: function(data){';

                            echo '$("#myog-insights .loading").fadeOut();';

                            echo 'var response = JSON.parse(data);';

                            echo 'if(response.code === 1000) {';

                                echo 'var $html = "";';

                                echo 'response.data.forEach(function(item, index) { ';

                                    echo 'var $module_name = item.module_name;';

                                    echo 'var $module_slug = $module_name.replace(/\s+/g, "-").replace(/---/g, "-").toLowerCase();';

                                    echo 'var $module_insights = item.insight;';

                                    echo 'var $module_counts = $module_insights.length;';

                                    echo 'var $insight_text = "Insight";';

                                    echo 'if( $module_counts > 1){$insight_text = "Insights";}';

                                    echo 'var $module_url = myog.home_url+"/dna-test-kit/?insight="+ $module_slug;';

                                        echo '$html += \'<div class="myog-insight insight-\'+$module_slug+\'"><div class="myog-insight-inner">\';';

                                            echo '$html += \'<div class="myog-insight-thumbnail"><img src="/wp-content/uploads/2024/11/myog-insight-\'+$module_slug+\'.png" class="img-fluid w-100"/></div>\';';

                                            echo '$html += \'<div class="myog-insight-content d-none d-md-block">\';';

                                                echo '$html += \'<div class="myog-insight-title text-capitalize">\'+$module_name+\'</div>\';';

                                                echo '$html += \'<div class="myog-insight-number">\'+$module_counts+\' \'+$insight_text+\'</div>\';';

                                            echo '$html += \'</div>\';';

                                            echo '$html += \'<div class="myog-insight-cta text-left text-md-center"><div class="myog-insight-title text-capitalize d-block d-md-none">\'+$module_name+\'</div><a href="\' + $module_url + \'" class="btn btn-cta text-md-uppercase">See <span class="d-none d-md-inline-block">Full List</span><span class="d-inline-block d-md-none">All \'+$module_counts+\' insights</span></a></div>\';';

                                        echo '$html += \'</div></div>\';';

                                echo '}); ';

                                echo '$(\'.myog-product-insights #myog-insights\').html($html);';

                                echo 'if(response.data.length>3) { if(!$(\'.myog-product-insights #myog-insights .myog-insight-read-more\')[0]) { $(\'.myog-product-insights #myog-insights\').parent().append(\'<div class="myog-insight-read-more d-block d-md-none w-100 text-center">See All</div>\'); } }';

                            echo '}';

                            echo 'else { console.log("Failed => "+response.message); }';

                        echo'},';

                        echo 'error: function(xhr){ $("#myog-insights .loading").fadeOut(); console.log(xhr); console.log("Error");}';

                    echo '});';

                echo '}';

            echo '});';

        echo '});';

        echo 'jQuery(document).ready(function($){function t(){window.matchMedia("(max-width: 767px)").matches?($(".myog-product-insights .myog-insight:gt(2)").hide(),$(".myog-product-insights .myog-insight-read-more").text("Show All"),$(window).off("resize",t)):($(".myog-product-insights .myog-insight").show(),$(".myog-product-insights .myog-insight-read-more").text("Show Less"))}t(),$(window).on("resize",function(){window.matchMedia("(min-width: 768px)").matches&&$(".myog-product-insights .myog-insight-read-more").text("Show Less"),t()});let i=!1;$(document).on("click",".myog-product-insights .myog-insight-read-more",function(){console.log("Clicked");i?($(".myog-product-insights .myog-insight:gt(2)").slideUp(),$(this).text("Show All"),$("html,body").animate({scrollTop:$(".myog-product-insights .myog-insight").offset().top-100})):($(".myog-product-insights .myog-insight:gt(2)").slideDown(),$(this).text("Show Less")),i=!i})});';

    echo '</script>';

    return ob_get_clean();

}

add_shortcode('myog_product_insights', 'myog_product_insights');



function myog_preview_product_insights() {

    // check_ajax_referer('myog_preview_product_insights', 'nonce');

    $response = array();

    $api_url = "https://stagingapi.myorigene.com/api/v1.0.0/get-modules/1";

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {

        return 'Error fetching product insights';

    }

    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body, true);

    $response = $data;



    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_myog_preview_product_insights', 'myog_preview_product_insights');

add_action('wp_ajax_nopriv_myog_preview_product_insights', 'myog_preview_product_insights');



function myog_myaccount_edit_profile() {

    check_ajax_referer('myog_myaccount_edit_profile', 'nonce');

    $response = array();

    $user_id = $_POST['user_id'];

    $fullname = $_POST['first_name'];

    $nationality = $_POST['nationality'];

    // $nric_passport = $_POST['nric_passport'];

    $default_dob = $_POST['dob'];

    $dob = date('d/m/Y', strtotime($_POST['dob']) );

    $gender = $_POST['gender'];

    $user = get_user_by('id', $user_id);



    if( $user ) {



        if( empty($fullname) || empty($nationality) || empty($dob) || empty($gender) ) {

            $response['status'] = 2000;

            $response['message'] = 'All field(s) is/are mandatory!';

            if( empty($fullname) ) {

                $response['error']['fullname'] = 'The full name is required!';

            }

            if( empty($nationality) ) {

                $response['error']['nationality'] = 'The nationality is required!';

            }

            if( empty($dob) ) {

                $response['error']['dob'] = 'The date of birth is required!';

            }

            if( empty($gender) ) {

                $response['error']['gender'] = 'The gender is required!';

            }

        }

        else {

            $user_first_name = $user->first_name;

            $user_nationality = get_field('user_additional_information_nationality', 'user_'.$user_id);

            $user_nric_passport = get_field('user_additional_information_nric_passport', 'user_'.$user_id);

            $user_dob = get_field('user_additional_information_date_of_birth', 'user_'.$user_id);

            $user_gender = get_field('user_additional_information_gender', 'user_'.$user_id);



            $overwrite_fullname = false;

            $overwrite_dob = false;

            $overwrite_nationality = false;

            $overwrite_gender = false;

            if( $fullname !== $user_first_name ) {

                $overwrite_fullname = true;

            }

            if( $nationality !== $user_nationality ) {

                $overwrite_nationality = true;

            }

            if( $dob !== $user_dob ) {

                $overwrite_dob = true;

            }

            if( $gender !== $user_gender ) {

                $overwrite_gender = true;

            }



            if( $overwrite_fullname == false && $overwrite_nationality == false && $overwrite_dob == false && $overwrite_gender == false ) {

                $response['status'] = 2000;

                $response['message'] = 'No update required!';

                $response['update'] = false;

            }

            else {

                if( $fullname !== $user_first_name ) {

                    wp_update_user( array(

                        'ID' => $user_id,

                        'first_name' => $fullname,

                        'display_name' => $fullname,

                    ));

                    update_user_meta( $user_id, 'nickname', $fullname );

                    $response['update']['fullname'] = 'The full name has been updated!';

                }

                if( $nationality !== $user_nationality ) {

                    update_field('user_additional_information', array( 'nationality' => $nationality ), 'user_'.$user_id);

                    $response['update']['nationality'] = 'The nationality has been updated!';

                }

                if( $dob !== $user_dob ) {

                    update_field('user_additional_information_date_of_birth', $default_dob, 'user_'.$user_id);

                    $response['update']['dob'] = 'The date of birth has been updated! ('.$default_dob.')';

                }

                if( $gender !== $user_gender ) {

                    update_field('user_additional_information', array( 'gender' => $gender ), 'user_'.$user_id);

                    $response['update']['gender'] = 'The gender has been updated!';

                }

                $response['status'] = 1000;

                $response['message'] = 'Update successfully!';

            }

        }

    }

    else {

        $response['status'] = 2000;

        $response['message'] = 'Invalid access!';

    }



    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_myog_myaccount_edit_profile', 'myog_myaccount_edit_profile');

add_action('wp_ajax_nopriv_myog_myaccount_edit_profile', 'myog_myaccount_edit_profile');



function myog_dna_test_kit_insights($atts) {

    $api_url = "https://stagingapi.myorigene.com/api/v1.0.0/get-modules/1";

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {

        return 'Error fetching product insights';

    }

    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body, true);

    ob_start();

    if (isset($data['code']) && $data['code'] === 1000 && isset($data['data'])) {

        echo '<div class="myog-modules-insights" id="modules-insights">';

?>

    <div class="myog-module-nav d-none d-md-block">

        <h2>Insights</h2>

        <nav class="nav nav-tabs">

        <?php foreach ($data['data'] as $key=>$module) {

            $nav_active = '';

            if($key==0){ $nav_active = ' active';}

            $module_name = $module['module_name'];

            $module_slug = strtolower(str_replace([' ', '---'], '-', $module_name));

            echo '<li class="nav-item'.$nav_active.'" id="nav-'.$module_slug.'-tab" data-toggle="tab" href="#nav-'.$module_slug.'" role="tab" aria-controls="nav-'.$module_slug.'" aria-selected="true"><span>'.$module_name.'</span></li>';

        } ?>

        </nav>

    </div>

    <div class="myog-module-body tab-content d-none d-md-block">

    <?php foreach ($data['data'] as $key => $module) {

        $module_name = $module['module_name'];

        $module_slug = strtolower(str_replace([' ', '---'], '-', $module_name));

        $module_insight = $module['insight'];

        $module_counts = count($module_insight);

        $current_active = '';

        if( $key==0 ) {

            $current_active = ' show active';

        }

        echo '<div class="tab-pane fade'.$current_active.'" id="nav-'.$module_slug.'" role="tabpanel" aria-labelledby="nav-'.$module_slug.'-tab">';

            echo '<div class="myog-module-title d-block w-100 text-center">';

                echo '<h3 class="mb-1">'.$module_name.'</h3>';

                echo '<p class="mb-0">'.$module_counts.' insights</p>';

            echo '</div>';

            echo '<div class="myog-module-list">';

            foreach($module_insight as $key => $item) {

                $index = str_pad($key, 2, '0', STR_PAD_LEFT);

                echo '<div class="myog-module-item d-flex align-items-center justify-content-start myog-module-item-'.$index.'">';

                    echo '<img src="/wp-content/uploads/2024/11/icon-insight-list-tick.png" class="myog-module-item-icon"/>';

                    echo '<p class="mb-0">'.$item.'</p>';

                echo '</div>';

            }

            echo '</div>';

        echo '</div>';

    } ?>

    </div>



    <div class="myog-insight-accordion d-flex flex-column d-md-none" id="myog-insight-accordion">

    <?php foreach ($data['data'] as $key => $module) {

        $module_name = $module['module_name'];

        $module_slug = strtolower(str_replace([' ', '---'], '-', $module_name));

        $module_insights = $module['insight'];

        $module_counts = count($module_insights);

        $current_active = '';

        $insight_text = 'insight';

        if( $module_counts > 1){

            $insight_text = 'insights';

        }

        if( $key==0 ) {

            $current_active = ' show active';

        }

        $i = $key+1;

        $index = str_pad($i,2,'0',STR_PAD_LEFT);

    ?>

        <div class="card card-<?php echo $module_slug;?> border-0" id="card-<?php echo $module_slug;?>">

            <div class="card-header bg-transparent border-0 p-0" id="heading-insight-<?php echo $index;?>">

                <h5 class="mb-0">

                    <button class="btn btn-link d-flex flex-row align-items-center w-100 text-capitalize bg-transparent position-relative" data-toggle="collapse" data-target="#accordion-insight-<?php echo $index;?>" aria-expanded="true" aria-controls="accordion-insight-<?php echo $index;?>">

                        <div class="myog-insight-thumbnail"><img src="/wp-content/uploads/2024/11/myog-insight-<?php echo $module_slug;?>.png" class="img-fluid w-100"></div>

                        <div class="myog-insight-content">

                            <div class="myog-insight-title"><?php echo $module_name;?></div>

                            <div class="myog-insight-number" data-insights="<?php echo $module_counts;?>"><?php echo $module_counts. ' ' .$insight_text;?></div>

                        </div>

                        <div class="accordion-arrow"><i class="fa fa-caret-down" aria-hidden="true"></i></div>

                    </button>

                </h5>

            </div>

            <div id="accordion-insight-<?php echo $index;?>" class="collapse" aria-labelledby="heading-insight-<?php echo $index;?>" data-parent="#myog-insight-accordion">

                <div class="card-body">

                <?php foreach($module_insights as $key=>$item) {

                    $j = str_pad($key,2,'0',STR_PAD_LEFT);

                    echo '<div class="myog-module-item d-flex align-items-center justify-content-start myog-module-item-'.$j.'">';

                        echo '<img src="/wp-content/uploads/2024/11/icon-insight-list-tick.png" class="myog-module-item-icon"/>';

                        echo '<p class="mb-0">'.$item.'</p>';

                    echo '</div>';

                } ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

<?php

        echo '</div>';

    }

    else {

        echo '<div class="myog-dna-test-kit-insights"><div class="myog-log">No insights available.</div></div>';

    }

    return ob_get_clean();

}

add_shortcode('myog_dna_test_kit_insights', 'myog_dna_test_kit_insights');



function myog_add_to_cart() {

    check_ajax_referer('myog_add_to_cart', 'nonce');

    $response = array();

    $prod_id = $_POST['prod_id'];

    $prod_amount = $_POST['prod_amount'];

    $cart_url = wc_get_cart_url();

    $status = 'failed';



    if ($prod_id && WC()->cart->add_to_cart($prod_id, $prod_amount)) {

        $product = wc_get_product($prod_id);

        $cart_total_amount = WC()->cart->get_cart_total();

        $cart_total_quantity = WC()->cart->get_cart_contents_count();

        $product_title = $product ? $product->get_title() : '';



        $response['status'] = 1000;

        $response['message'] = $product_title.' has been added to your cart.';

        $response['cart_amount'] = $cart_total_amount;

        $response['cart_quantity'] = $cart_total_quantity;

        $status = 'success';

    }

    else {

        $response['status'] = 2000;

        $response['message'] = 'Something went wrong while adding the item! Please try again later.';

    }

    $response['popup'] = '<div class="modal fade add-to-cart-popup" id="add-to-cart-popup" tabindex="-1" role="dialog" aria-labelledby="add-to-cart-popup" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-body position-relative"><button type="button" class="modal-close position-absolute" id="modal-close"><span class="d-none">Close</span></button><div class="modal-inner" id="modal-inner"><img src="/wp-content/uploads/2024/11/myog-icon-status-'.$status.'.svg" class="modal-icon"/><p class="mb-0">'.$response["message"].'</p></div><div class="btn-wrapper"><a href="'.$cart_url.'" class="btn btn-cta elementor-button"><span>Go to Cart</span></a></div></div></div></div></div>';



    echo json_encode($response);

    wp_die();

}

add_action('wp_ajax_myog_add_to_cart', 'myog_add_to_cart');

add_action('wp_ajax_nopriv_myog_add_to_cart', 'myog_add_to_cart');