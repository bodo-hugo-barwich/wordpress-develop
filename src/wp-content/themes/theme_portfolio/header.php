<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


  $ssitetitle = html_entity_decode(get_bloginfo( 'name', 'display' ), ENT_QUOTES, "utf-8");
  $ssiteslogan = get_bloginfo( 'description' );
  $ssitemntitle = $ssitetitle;
  $ssitesbtitle = "";


  $idshps = mb_strpos($ssitetitle, "–");

  if($idshps !== false)
  {
    $ssitemntitle = trim(mb_substr($ssitetitle, 0, $idshps));
    $ssitesbtitle = trim(mb_substr($ssitetitle, $idshps + 1));
  }


?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link href="<?php echo get_template_directory_uri(); ?>/style.css?ver=3.9.1" id="theme-anwalt-css" rel="stylesheet" type="text/css" media="all" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup style="height:60px;">
      <!-- <div style="height:60px;"> -->
        <?php
  if(is_home() && ! is_paged())
  {
?><!-- <div style="float:left;"> -->
          <h1 class="site-title">
            <div style="float:left; margin-right:10px;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              <?php echo $ssitemntitle; ?></a>
            </div>
            <div style="float:left;">
            <span class="subtitle">&#8211;</span>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="subtitle" rel="home">
              <?php echo $ssitesbtitle; ?></a>
            </div>
          </h1>
        <!-- </div> -->
        <div style="float:left;">
        <h2 class="site-description"><?php echo $ssiteslogan; ?></h2>
        </div>
      <?php
  }
  else  //It's not the Home Page  margin:27px 0px 0px 20px;
  {
?><div style="float:left;">
          <div class="headertitle site-title">
            <div style="float:left; margin-right:10px;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              <?php echo $ssitemntitle; ?></a>
            </div>
            <div style="float:left;">
            <span class="headertitle subtitle">&#8211;</span>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="subtitle" rel="home">
              <?php echo $ssitesbtitle; ?></a>
            </div>
          </div>
        </div>
        <div style="float:left;">
          <div class="headerslogan site-description"><?php echo $ssiteslogan; ?></div>
        </div>
      <?php
  } //if(is_home() && ! is_paged())

  ?><!-- </div> -->
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
      <div style="float:right;">
			<div class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></div>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>">
        <?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
      </div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper" style="padding:0px 15px;">