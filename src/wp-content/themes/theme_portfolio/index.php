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
		<?php if ( have_posts() ) : /*echo "has posts.<br />\n";*/ ?>
      <?php
if(!is_singular()
  && !is_404())
{
  global $wp_query;

  $trm = NULL;
  $itrmid = -1;
  $strmtp = "";
  $itrmpstcnt = $wp_query->found_posts;
  $strmlnk = "";

  $sbodytitle = "";
  $ipgnr = $wp_query->query_vars["paged"];
  $ipgcnt = $wp_query->max_num_pages;
  $ipgpstcnt = get_option("posts_per_page");
  $spgprvlnk = "";
  $spgnxtlnk = "";


  //echo "arr qry: '" . print_r($wp_query->query_vars, true) . "'<br />\n";

  if($ipgnr < 2)
    $ipgnr = 1;

  if(is_category())
  {
    $sbodytitle = single_term_title("", false);

    $trm = get_term_by("name", $sbodytitle, "category");
  }
  elseif(is_tag())
  {
    $sbodytitle = single_term_title("", false);

    $trm = get_term_by("name", $sbodytitle, "post_tag");
  } //if(is_category())

  if(isset($trm))
  {
    $itrmid = $trm->term_id;
    $strmtp = $trm->taxonomy;
    //$itrmpstcnt = $trm->count;

    if(is_category())
      $strmlnk = get_category_link($itrmid);
    elseif(is_tag())
      $strmlnk = get_tag_link($itrmid);

  } //if(isset($trm))

  //echo "bdy ttl (tp: '$strmtp'; id: '$itrmid'; cnt: '$itrmpstcnt'): '$sbodytitle'<br />\n";
  //echo "trm lnk: '$strmlnk'<br />\n";

?><header class="entry-header">
        <h1 class="entry-title"><?php echo $sbodytitle; ?></h1>
      </header>
      <div class="entry-content">
        <p>
          <?php
  //echo "pg nr: '$ipgnr'; pg cnt: '$ipgcnt'; pg pst cnt: '$ipgpstcnt'<br />\n";

  if($itrmpstcnt > 0)
  {
    if($itrmpstcnt > 1)
    {
?><?php echo $itrmpstcnt . " Art&iacute;culos encontrados"; ?>
          <?php
    }
    else  //There is only 1 Post
    {
?><?php echo $itrmpstcnt . " Art&iacute;culo encontrado"; ?>
          <?php
    } //if($itrmpstcnt > 1)
  } //if($itrmpstcnt > 0)

  if($ipgcnt > 1)
  {
?><?php echo " en " . $ipgcnt . " P&aacute;ginas"; ?><br />
          <?php
    if(!empty($strmlnk))
    {
      if($ipgnr > 2)
        $spgprvlnk = $strmlnk . "page/" . ($ipgnr - 1) . "/";
      else
        $spgprvlnk = $strmlnk;

      $spgnxtlnk = $strmlnk . "page/" . ($ipgnr + 1) . "/";
    } //if(!empty($strmlnk))
  }
  else  //There is only 1 Page
  {
?><br />
          <?php
  } //if($ipgcnt > 1)

  if($ipgnr < 2)
  {
?><b><?php echo "P&aacute;gina de Inicio"; ?></b>
          <?php
  }
  else  //It is not the First Page
  {
    if(!empty($strmlnk))
    {
      if($ipgnr > 2)
      {
?><a href="<?php echo $spgprvlnk; ?>"
            title="&aacute;gina Anterior">
            P&aacute;gina Anterior</a>
          <?php
      }
      else  //It's the Second Page
      {
?><a href="<?php echo $spgprvlnk; ?>"
            title="P&aacute;gina de Inicio">
            P&aacute;gina de Inicio</a> &#171;
          <?php
      } //if($ipgnr > 2)
    } //if(!empty($strmlnk))

?><b><?php echo "P&aacute;gina No. " . $ipgnr; ?></b>
          <?php
  } //if($ipgnr < 2)

  if($ipgcnt > $ipgnr)
    if(!empty($strmlnk))
    {
?>&#187; <a href="<?php echo $spgnxtlnk; ?>"
            title="P&aacute;gina Siguiente">
            P&aacute;gina Siguiente</a>
          <?php
    } //if(!empty($strmlnk))
?>
        </p>
      </div><!-- .entry-content -->
      <?php
  if(is_category()
    || is_tag())
  {
    $arrskypsts = NULL;
    $arrskypstids = NULL;
    $skypst = NULL;
    $iskypstcnt = -1;

    $iskypstid = -1;
    $sskypstlnknm = "";
    $sskypstcntnt = "";
    $sskypstsmryhtml = "";
    $sskypstimghtml = "";
    $sskypstimgurl = "";

    $arrpstimgs = NULL;
    $ipstimgcnt = -1;
    $spstimgsrh = '/<img[^>]*src="([^\"]*)"[^>]*>/i';


    $arrskypstids = get_option("sticky_posts");
    $iskypstcnt = count($arrskypstids);

    //echo "sky pst ids: '" . print_r($arrskypstids, true) . "'<br />\n";

    if($iskypstcnt > 0)
    {
      if(is_category())
        $arrskypsts = get_posts(array("category" => $itrmid
          , "post__in" => get_option("sticky_posts"), "ignore_sticky_posts" => 1
          , "paged" => ($ipgnr > 1 ? $ipgnr : 0)));
      elseif(is_tag())
        $arrskypsts = get_posts(array("tag_id" => $itrmid
          , "post__in" => get_option("sticky_posts"), "ignore_sticky_posts" => 1
          , "paged" => ($ipgnr > 1 ? $ipgnr : 0)));

    } //if($iskypstcnt > 0)

    if(isset($arrskypsts))
      if(is_array($arrskypsts)
        && !empty($arrskypsts))
      {
        foreach($arrskypsts as $skypst)
        {
          //var_dump($skypst);
          $iskypstid = $skypst->ID;
          $sskypstcntnt = $skypst->post_content;
          $sskypstsmryhtml = $skypst->post_excerpt;
          $sskypstimghtml = get_the_post_thumbnail($iskypstid, "thumbnail");

          //echo "pst ($iskypstid): ''<br />\n";
          //echo "pst img. '$sskypstimgurl'<br />\n";

          if(!empty($sskypstimghtml))
            $ipstimgcnt = preg_match($spstimgsrh, $sskypstimghtml, $arrpstimgs);

          if($ipstimgcnt > 0)
            if(is_array($arrpstimgs))
            {
              //echo "pst imgs: '" . print_r($arrpstimgs, true) . "'<br />\n";

              if(count($arrpstimgs) > 1)
                $sskypstimgurl = $arrpstimgs[1];

            } //if(is_array($arrpstimgs))

          setup_postdata($prspst);

?><article id="post-<?php echo $iskypstid; ?>" <?php post_class(); ?>>
        <?php
          if(!empty($spstimgurl))
          {
?><div class="entry-content" style="float:left; margin:0px 15px 15px 0px;">
      <a href="<?php echo get_permalink($iskypstid); ?>" rel="bookmark"
        title="<?php echo get_the_title($iskypstid); ?>">
        <img src="<?php echo $spstimgurl; ?>"
          alt="<?php echo get_the_title($iskypstid); ?>"
          title="<?php echo get_the_title($iskypstid); ?>" style="float:left; width:100px;" /></a>
        </div>
        <?php
          } //if(!empty($spstimgurl))

          if(!empty($spstimgurl))
          {
?><header class="entry-header entry-list">
        <?php
          }
          else  //The Post doesn't have an Image
          {
?><header class="entry-header entry-list" style="width:100%;">
        <?php
          } //if(!empty($spstimgurl))

?>
          <h3 class="entry-title">
            <a href="<?php echo get_permalink($iskypstid); ?>" rel="bookmark"
              title="<?php echo get_the_title($iskypstid); ?>">
              <?php echo get_the_title($iskypstid); ?></a>
        	</h3>
        </header><!-- .entry-header -->

        <div class="entry-content">
          <?php if ( empty($sskypstsmryhtml) ) : // Only display Excerpts for Search ?>
            <?php echo extractExcerptfromContent($sskypstcntnt, 100); ?>
          <?php else : ?>
            <?php the_excerpt(); ?>
          <?php endif; ?>
        </div><!-- .entry-content -->

        <footer class="entry-meta">
          <div class="comments-link">
            <a href="<?php echo get_permalink($iskypstid); ?>" rel="bookmark"
              title="<?php echo get_the_title($iskypstid); ?>">
              <?php echo "Leer todo el Art&iacute;culo"; ?></a>
          </div>
        </footer><!-- .entry-meta -->
			</article><!-- #post -->
          <?php



        } //foreach($arrskypsts as $skypst)
      } //if(is_array($arrskypsts) && !empty($arrskypsts))

    wp_reset_postdata();

  } //if(is_category() || is_tag())
} //if(!is_singular() && !is_404())

?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>

        <?php if ( is_single() ) : ?>
          <?php comments_template( '', true ); ?>
        <?php endif; // is_single() ?>

			<?php endwhile; ?>

			<?php //twentytwelve_content_nav( 'nav-below' );
      ?>

		<?php else : /*echo "doesn't have posts.<br />\n";*/ ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->
		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>