<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 */

//echo "index.php<br />\n";

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
    <?php
$hmctgy = get_category_by_slug("portada");
$ihmctgyid = $hmctgy->term_id;
$ihmpstid = -1;

//echo "hm ctgy ($ihmctgyid) '{$hmctgy->cat_name}'";

$arrhmpsts = get_posts(array('category' => $ihmctgyid));

if(!empty($arrhmpsts))
  if(is_array($arrhmpsts))
  {
    foreach($arrhmpsts as $hmpst)
    {
      //var_dump($mnpst);

      setup_postdata($hmpst);

      $ihmpstid = $hmpst->ID;
?>
		<div>
      <header class="entry-header">
        <h3 class="entry-title"><?php echo get_the_title($ihmpstid); ?></h3>
      </header>
      <div class="entry-content">       
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
      </div>
		</div><!-- .entry-content -->
      <?php
    } //foreach($arrhmpsts as $hmpst)
  } //if(is_array($arrhmpsts))

  
$prsctgy = get_category_by_slug("presentacion");
$prspst = NULL;

$iprsctgyid = $prsctgy->term_id;
$iprspstid = -1;
$sprspstcntnt = "";
$sprspstimghtml = "";
$sprspstimgurl = "";

$arrpstimgs = NULL;
$ipstimgcnt = -1;
$ipstimgstrt = -1;
$spstimgsrh = '/<img[^>]*src="([^\"]*)"[^>]*>/i';



//echo "prs ctgy ($iprsctgyid) '{$prsctgy->cat_name}'";

$arrprspsts = get_posts(array('category' => $iprsctgyid));

if(!empty($arrprspsts))
  if(is_array($arrprspsts))
  {
    foreach($arrprspsts as $prspst)
    {
      //var_dump($prspst);

      $iprspstid = $prspst->ID;
      $sprspstcntnt = $prspst->post_content;
      $sprspstimghtml = "";
      $sprspstimgurl = "";

      if(has_post_thumbnail($iprspstid))
        $sprspstimghtml = get_the_post_thumbnail($iprspstid, "medium");

      if(empty($sprspstimghtml))
        $ipstimgstrt = strpos($sprspstcntnt, "<img ");
      else
        $ipstimgstrt = 0;

      if($ipstimgstrt !== false)
      {
        if(!empty($sprspstimghtml))
          $ipstimgcnt = preg_match($spstimgsrh, $sprspstimghtml, $arrpstimgs);
        else
          $ipstimgcnt = preg_match($spstimgsrh, $sprspstcntnt, $arrpstimgs);

        if($ipstimgcnt > 0)
          if(is_array($arrpstimgs))
          {
            //echo "pst imgs: '" . print_r($arrpstimgs, true) . "'<br />\n";
            
            if(count($arrpstimgs) > 0)
              $sprspstimghtml = $arrpstimgs[0];

            if(count($arrpstimgs) > 1)
              $sprspstimgurl = $arrpstimgs[1];

          } //if(is_array($arrpstimgs))
      } //if($ipstimgstrt !== false)  width="200"

      setup_postdata($prspst);

?><div style="clear:left; margin-top:20px;">
      <table width="100%">
        <tr>
          <td valign="top" style="padding:0px 20px 20px 0px;">
            <div class="entry-content">
              <a href="<?php echo get_permalink($iprspstid); ?>" rel="bookmark"
                title="<?php echo get_the_title($iprspstid); ?>">
                <img src="<?php echo $sprspstimgurl; ?>"
                  alt="<?php echo get_the_title($iprspstid); ?>"
                  title="<?php echo get_the_title($iprspstid); ?>" /></a>
            </div>
          </td>
          <td valign="top">
            <header class="entry-header">
              <h3 class="entry-title">
                <a href="<?php echo get_permalink($iprspstid); ?>" rel="bookmark"
                  title="<?php echo get_the_title($iprspstid); ?>">
                  <?php echo get_the_title($iprspstid); ?></a>
              </h3>
            </header>
            <div class="entry-summary">
              <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
          </td>
          </tr>
        </table>
      </div>
      <?php
    } //foreach($arrprspsts as $prspst)

    wp_reset_postdata();
  } //if(is_array($arrprspsts))

?><div id="panel_posts_featured">
      <?php

$tpctgy = get_category_by_slug("areas-trabajo");
$itpctgyid = $tpctgy->term_id;

//echo "tp ctgy ($itpctgyid) '{$tpctgy->cat_name}'<br />\n";

$arrtpctgys = get_categories(array("parent" => $itpctgyid));
$arrtpctgyids = array();
$stpctgyids = "";
$itpctgycnt = -1;


if(is_array($arrtpctgys))
  foreach($arrtpctgys as $tpctgy)
    $arrtpctgyids[] = $tpctgy->cat_ID;

$itpctgycnt = count($arrtpctgyids);

if($itpctgycnt > 0)  
  $stpctgyids = implode(", ", $arrtpctgyids);

//echo "tp ctgys '$stpctgyids'<br />\n";

$arrtppsts = get_posts(array("posts_per_page" => 2, "category" => "$stpctgyids"));
$tppst = NULL;
$itppstid = -1;
$itppst = 0;


if(!empty($arrtppsts))
  if(is_array($arrtppsts))
  {
    foreach($arrtppsts as $tppst)
    {
      if($itppst > 0)
      {
?><div style="float:left; margin-left:4%; margin-right:4%;">
        <div class="post_seperator">
        </div>
      </div>
      <?php

      } //if($itppst > 0)

      //var_dump($prspst);

      $itppstid = $tppst->ID;

      setup_postdata($tppst);

?><div style="float:left; width:45%;">
        <header class="entry-header">
          <h3 class="entry-title">
            <a href="<?php echo get_permalink($itppstid); ?>" rel="bookmark"
              title="<?php echo get_the_title($itppstid); ?>">
              <?php echo get_the_title($itppstid); ?></a>
          </h3>
        </header>
        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
      </div>
      <?php

      //Count the Posts
      $itppst++;

    } //foreach($arrprspsts as $prspst)

    wp_reset_postdata();
  } //if(is_array($arrtppsts))

?></div>
    </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>