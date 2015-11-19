<?php
/**
 * The theme functions
 *
 * @package ProperWeb
 * @subpackage ProperMagellan
 * @since ProperMagellan 1.0
 * @uses Meta Box: 'rwmb_meta_boxes' @see http://metabox.io/
 * @uses Breadcrumb NavXT: 'bcn_display' @see http://mtekk.us/code/breadcrumb-navxt/
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
    $content_width = 1000;
}

// Removing all the junk from wordpress head we don't need.
require_once(get_template_directory().'/functions/cleanup.php'); 

// Add relevant stylesheets and scripts within <head> tags (register scripts and stylesheets)
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Add menu compatible with 'foundation' framework
require_once(get_template_directory().'/functions/menu.php');
require_once(get_template_directory().'/functions/menu-walkers.php'); 

// Register new custom fields in Settings > General
require_once(get_template_directory().'/functions/admin.php'); 

// Register sidebars/widget areas
//require_once(get_template_directory().'/functions/sidebars.php'); 

// Add support for meta tags (custom fields)
require_once(get_template_directory().'/functions/meta.php'); 

// Customize login page
require_once(get_template_directory().'/functions/login.php'); 

// Theme support (featured image)
require_once(get_template_directory().'/functions/theme-support.php'); 

// Pagination compatible with 'foundation' markup
require_once(get_template_directory().'/functions/pagination.php'); 

// Custom comments list
require_once(get_template_directory().'/functions/comments.php');

// Custom search form
require_once(get_template_directory().'/functions/search-form.php');

/* SHORTCODES */

//Create shortcode to add Guest Book on the page
//Don't confuse with comments, which are added automatically once enabled for the post
add_shortcode('gbook', 'pweb_gbook');
//usage [gbook]
function pweb_gbook() {	
    ob_start();
    include('functions/gbook.php');
    $gbook = ob_get_clean(); //Get the buffer and erase it
    return $gbook;
}

//create shortcode to mention the company name ostentatiously in articles/posts
add_shortcode('company', 'pweb_company');

//usage [company]
function pweb_company() {
    $company = get_bloginfo();
    return "«<strong><em><span class=\"company\">{$company}</span></em></strong>»";
}
  
//create shortcode to make a separator of the new article within the page
add_shortcode('article', 'pweb_article');

//usage [article title=""]
function pweb_article( $atts ) {
    return '<h2 class="title">' . $atts[title] . '</h2>';
}

//Create shortcode for promotions to use the featured image as a background image
//and to highlight the promo's startand end date
add_shortcode('promo', 'pweb_promo');

//usage [promo start="mm/dd/yy" end="mm/dd/yy" height="px" bgsize="%" line=""]
function pweb_promo( $atts, $content = null  ) {
    global $featured_image_url;
    $regex = "/^[0-1][0-9]\/[0-3][0-9]\/[1-2][0-9]$/";	//american format
    $dated = true;
    $start = 0;
    $end = 0;
    preg_match($regex, trim($atts[start]), $start_date);
    preg_match($regex, trim($atts[end]), $end_date);
    try {
        if ( array_key_exists('start',$atts) && array_key_exists('end',$atts) ) {
                $start = new DateTime($start_date[0]);
                $end = new DateTime($end_date[0]);
        }
        elseif ( array_key_exists('start',$atts) ) {
                $start = new DateTime($start_date[0]);
        }
        elseif (array_key_exists('end',$atts) ) {
                $end = new DateTime($end_date[0]);
        }
        else $dated = false;
    }
    catch (Exception $e) { $dated = false; }

    if ( $dated ) { 
        if ( $start && $end ) {
                $range = date_format($start, get_option( 'date_format' )) . ' – '. date_format($end, get_option( 'date_format' ));
        }
        elseif ( $start ) $range = date_format($start, get_option( 'date_format' ));
        else $range = __('till ') . date_format($end, get_option( 'date_format' ));
        $period = 
            '<div class="row meta-data promo-date">'
            . '<p class="small-12 columns">' . $range . '</p>'
            . '<p class="line small-12 columns"></p></div>';
    }
    else $period = '';
    return ($period . '<div class="promo" style="height:'.$atts[height].'px;background-size:'.$atts[bgsize].'%; background-image: url('.$featured_image_url.'); line-height:'.$atts[line].'">'. $content . '</div>');
}

//Load translations
add_action('after_setup_theme', 'pweb_theme_setup');

function pweb_theme_setup(){
    load_theme_textdomain('pweb', get_template_directory() . '/lang');
}

// CHANGE LOCAL LANGUAGE
// for translations debug purposes (ex. www.example.com/?l=ru_RU)
// must be called before load_theme_textdomain()
add_filter( 'locale', 'pweb_theme_localized' );

function pweb_theme_localized( $locale )
{
    if ( isset( $_GET['l'] ) ) {
        return sanitize_key( $_GET['l'] );
    }

    return $locale;
}

?>
