<?php
/**
 * Anwalt Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package Anwalt
 * @subpackage Setup Functions
 */

if(!function_exists('shortenText')):
/**
 * This Function
 * @param type $stext
 * @param int $ilength
 * @return type
 */
function shortenText($stext, $ilength = 100)
{
  $srstxt = $stext;


  if(!empty($stext))
  {
    $itxtln = mb_strlen($stext);


    //echo "sht txt ln: '$itxtln'<br />\n";

    if(!is_numeric($ilength))
      $ilength = 100;

    if($itxtln > $ilength)
    {
      $ishtps = $ilength - 1;


      if($stext[$ishtps] != " ")
      {
        //echo "txt strt chr (ps: '$ishtps'): '{$stext[$ishtps]}'<br />\n";

        $ifstps = mb_strrpos($stext, " ", (($itxtln - $ilength + 1) * (-1)));
        $ilstps = mb_strpos($stext, " ", $ishtps);
        $ifstdst = $ishtps - $ifstps;
        $ilstdst = $ilstps - $ishtps;


        //echo "fst ps: '$ifstps'; lst ps: '$ilstps'; fst dst: '$ifstdst'; lst dst: '$ilstdst'<br />\n";

        if($ilstdst < $ifstdst)
          $srstxt = mb_substr($stext, 0, $ilstps);
        else
          $srstxt = mb_substr($stext, 0, $ifstps);
        
      }
      else
        $srstxt = mb_substr($stext, 0, $ishtps);

      $srstxt = mb_ereg_replace('^[[:blank:]]+', "", $srstxt);
      $srstxt = mb_ereg_replace('[\,\.[:blank:]]+$', "", $srstxt);
    } //if($itxtln > $ilength)

  } //if(!empty($stext))


  return $srstxt;
}
endif;

if(!function_exists('extractExcerptfromContent')):
/**
 * This Function extracts the Excerpt from the Post Content.<br />
 * It takes into account the "< !--more-- >" Tag and eliminates HTML Tags.
 * @param string $spostcontent
 * @param string $ilength
 * @return string
 */
function extractExcerptfromContent($spostcontent, $ilength = 55)
{
  $spostexcerpt = "";


  if(!empty($spostcontent))
  {
    $sexpthtml = "";
    $smrtag = "<!--more-->";
    $imrtgps = -1;

    $imrtgps = mb_strpos($spostcontent, $smrtag);

    //echo "mr ps: '$imrtgps'<br />\n";

    if($imrtgps !== false)
      $sexpthtml = mb_substr($spostcontent, 0, $imrtgps);
    else
      $sexpthtml = $spostcontent;

    if(!empty($sexpthtml))
    {
      $sexpthtml = '<meta http-equiv="content-type" content="text/html; charset=utf-8">' . "\n"
        . $sexpthtml;

      $htmldoc = new DOMDocument("1.0", "UTF-8");
      $lstbdyelems = NULL;
      $bdyelem = NULL;

      //$htmldoc->loadHTML(utf8_decode($sexpthtml));
      $htmldoc->loadHTML($sexpthtml);

      $lstbdyelems = $htmldoc->getElementsByTagName("body");
            
      if($lstbdyelems->length > 0)
        $bdyelem = $lstbdyelems->item(0);

      if(isset($bdyelem))
      {
        //var_dump($bdyelem);
        
        $spostexcerpt = $bdyelem->nodeValue;
        
        if($imrtgps === false)
          $spostexcerpt = shortenText($spostexcerpt, $ilength);

      } //if(isset($bdyelem))

      //Free the HTML Document Object
      unset($htmldoc);

    } //if(!empty($sexpthtml))

  } //if(!empty($spostcontent))


  return $spostexcerpt;
}
endif;

if ( ! function_exists( 'theme_setup' ) ) :
/**
 * Anwalt Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
function theme_setup()
{
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
}
endif; // theme_setup

add_action( 'after_setup_theme', 'theme_setup' );


if ( ! function_exists( 'theme_wp_title' ) ) :
/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
endif; // theme_wp_title

add_filter( 'wp_title', 'theme_wp_title', 10, 2 );


if ( ! function_exists( "theme_main_query" ) ) :
// My function to modify the main query object
function theme_main_query( $query )
{
  if($query->is_category()
    || $query->is_tag())
  {
    //Change the query for the category post listing

    unset($query->query_vars["post__not_in"]);

    $query->query_vars["post__not_in"] = get_option("sticky_posts");
    $query->query_vars["ignore_sticky_posts"] = 1;
    
  } //if($query->is_category() || $query->is_tag())
}
// Hook my above function to the pre_get_posts action
add_action( "pre_get_posts", "theme_main_query" );
endif;



if ( ! function_exists( 'theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						( $comment->user_id === $post->post_author ) ? get_comment_author_link() : get_comment_author( $comment->comment_ID ),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>Autor del Art&iacute;culo</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time(),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s a las %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
