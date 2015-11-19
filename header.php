<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "content" div.
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <title><?php 
            if (is_front_page() || is_home()) { 
                bloginfo('name'); 
                if (get_option('main_service_type')) { echo ' | '; echo get_option('main_service_type'); }
                elseif (get_option('blogdescription')) { echo ' | '; echo get_option('blogdescription'); }
            }
            else {
                if ( function_exists('rwmb_meta') && rwmb_meta('pweb_title') ) {
                    echo rwmb_meta( 'pweb_title' ); echo " | "; bloginfo('name'); 
                }
                elseif ( get_the_title()) { the_title(); echo ' | '; bloginfo('name'); }
                else { bloginfo('name'); }
            }?></title>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if (function_exists('rwmb_meta')) { if (rwmb_meta('pweb_description')) echo rwmb_meta("pweb_description");} ?>" />
    <meta name="author" content="I.Tomilenko@ProperWeb" />
    <meta name="keywords" content="<?php if (function_exists('rwmb_meta')) { if (rwmb_meta('pweb_keywords')) echo rwmb_meta("pweb_keywords");} ?>" />

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans|Philosopher:400,700,400italic,700italic&subset=latin<?php if (strtolower(get_locale()) == 'ru_ru') echo ',cyrillic'; ?>' >
    <link rel="stylesheet" type='text/css' href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <?php wp_head(); ?>
</head>

<body>
    <div id="cap"></div>
    <div id="wrap">
        <div id="header" class="row">
            <div id="logo" class="large-12 columns">
                <!--<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="">-->
                <?php if (get_option('main_service_type')) : ?>
                <h2 id="what"><?php echo get_option('main_service_type'); ?></h2>
                <?php endif; ?>
                <h1 id="who"><?php bloginfo('name'); ?></h1>
                <h3 id="why"><?php bloginfo('description'); ?></h3>
            </div>
        </div>
        
        <?php include_once 'parts/magellan.php'; ?>
        
        <div id="content">	


