<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

$sthmdir = get_template_directory();
$bprs = false;

$ipstid = get_the_ID();


?>
<div id="secondary" class="widget-area">
  <div class="panel_top">
  	<?php
  $description = get_bloginfo( 'description', 'display' );

  if(!empty($description))
  {
?><div style="margin-bottom:50px;">
      <h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
    </div>
    <?php
  }

?></div>
  	<?php
  if(is_single())
  {
?><div class="panel_categories_main" style="margin-bottom:20px;">
    <div style="margin-bottom:20px;">
      <h3>Categor&iacute;as del Art&iacute;culo</h3>
    </div>
    <div style="padding-bottom:15px;">
      <?php
    $arrpstctgys = get_the_category();
    $pstctgy = NULL;


    if(is_array($arrpstctgys))
    {
      if(!empty($arrpstctgys))
      {
      } //if(!empty($arrtpctgys))

      foreach($arrpstctgys as $pstctgy)
      {
        if($pstctgy->slug == "presentacion")
          $bprs = true;

        if(!$bprs)
        {
?><div class="pctgys_link">
        <!--
        <?php echo $pstctgy->cat_ID; ?>: <?php echo $pstctgy->name; ?> - <?php echo $pstctgy->slug; ?>
        -->
        <a href="<?php echo get_category_link($pstctgy->cat_ID); ?>"
          title="<?php echo $pstctgy->name; ?>">
          <?php echo $pstctgy->name; ?></a>
      </div>
      <?php
        }
        else
        {
?><div class="pctgys_link">
        <!--
        <?php echo $pstctgy->cat_ID; ?>: <?php echo $pstctgy->name; ?> - <?php echo $pstctgy->slug; ?>
        -->
        <?php echo $pstctgy->name; ?>
      </div>
      <?php
        } //if(!$bprs)
      } //foreach($arrpstctgys as $pstctgy)
    } //if(is_array($arrpstctgys))

?></div>
  </div>
  <?php
    if(!$bprs)
    {
      include($sthmdir . "/includes/boxes/box_sidebar_author.php");
      include($sthmdir . "/includes/boxes/box_sidebar_tags.php");
    } //if(!$bprs)
  } //if(is_single())

?><div class="panel_top">
  	<?php
  if(is_home()
    || is_single())
  {
?><div style="margin-bottom:30px;">
<?php include($sthmdir . "/includes/boxes/box_sidebar_contactform.php"); ?>
    </div>
    <?php
  }
  else  //It's not the Home Page
  {
?>

    <?php
  } //if(is_home()|| is_single())

?></div>
  <?php
  $tpctgy = get_category_by_slug("areas-trabajo");
  $itpctgyid = $tpctgy->term_id;

  //echo "ctgy ($itpctgyid) '{$tpctgy->cat_name}'"; (< ?php echo $itpctgyid; ? >)

?><div class="panel_categories_main" style="margin-bottom:20px;">
    <div style="margin-bottom:20px;">
      <h2>&Aacute;reas de Trabajo</h2>
    </div>
    <div style="padding-bottom:15px;">
      <?php

  $arrtpctgys = get_categories(array("parent" => $itpctgyid));


  if(is_array($arrtpctgys))
  {
    if(!empty($arrtpctgys))
    {
    } //if(!empty($arrtpctgys))

    foreach($arrtpctgys as $tpctgy)
    {
?><div class="pctgys_link">
        <!--
        <?php echo $tpctgy->cat_ID; ?>: <?php echo $tpctgy->name; ?> - <?php echo $tpctgy->slug; ?><br />
        -->
        <a href="<?php echo get_category_link($tpctgy->cat_ID); ?>"
          title="<?php echo $tpctgy->name; ?>">
          <?php echo $tpctgy->name; ?></a>
      </div>
      <?php
    } //foreach($arrtpctgys as $tpctgy)
  } //if(is_array($arrtpctgys))

?></div>
  </div>
	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
	<nav role="navigation" class="navigation site-navigation secondary-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
