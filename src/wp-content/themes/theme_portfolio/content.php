<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 */



$pst = get_post();
$ipstid = $pst->ID;
$spstcntnthtml = $pst->post_content;
$spstsmryhtml = $pst->post_excerpt;
$spstimghtml = "";
$spstimgurl = "";

$arrpstimgs = NULL;
$ipstimgcnt = -1;
$ipstimgstrt = -1;
$spstimgsrh = '/<img[^>]*src="([^\"]*)"[^>]*>/i';


if(!is_singular())
{
  $spstimghtml = get_the_post_thumbnail($ipstid, "thumbnail");

  if(empty($spstimghtml)
    && !empty($spstcntnthtml))
  {
    $ipstimgcnt = preg_match($spstimgsrh, $spstcntnthtml, $arrpstimgs);

    if($ipstimgcnt > 0)
      if(is_array($arrpstimgs))
      {
        //echo "pst imgs: '" . print_r($arrpstimgs, true) . "'<br />\n";

        if(count($arrpstimgs) > 0)
          $spstimghtml = $arrpstimgs[0];

        if(count($arrpstimgs) > 1)
          $spstimgurl = $arrpstimgs[1];

      } //if(is_array($arrpstimgs))
  } //if(empty($spstimghtml))
}
else  //if(!is_singular())
  $spstimghtml = get_the_post_thumbnail($ipstid, "large");

//echo "pst ($iprsid): ''<br />\n";
//echo "pst img. '$spstimghtml'<br />\n";

if(empty($spstimgurl))
{
  if(!empty($spstimghtml))
    $ipstimgcnt = preg_match($spstimgsrh, $spstimghtml, $arrpstimgs);

  if($ipstimgcnt > 0)
    if(is_array($arrpstimgs))
    {
      //echo "pst imgs: '" . print_r($arrpstimgs, true) . "'<br />\n";

      if(count($arrpstimgs) > 1)
        $spstimgurl = $arrpstimgs[1];

    } //if(is_array($arrpstimgs))
} //if(empty($spstimgurl))

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
    <?php
if(!empty($spstimgurl))
{
?><div class="entry-content" style="float:left; margin:0px 15px 15px 0px;">
      <?php
  if(!is_single())
  {
?><a href="<?php the_permalink(); ?>" rel="bookmark"
        title="<?php the_title(); ?>">
        <img src="<?php echo $spstimgurl; ?>"
          alt="<?php the_title(); ?>"
          title="<?php the_title(); ?>" style="float:left; width:100px;" /></a>
    <?php
  } //if(!is_single())

?></div>
    <?php
} //if(!empty($spstimgurl)) 

if(!is_singular())
{
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
}
else  //It's a Single Post Page
{
  ?><header class="entry-header">
        <?php
} //if(!is_singular())
?>
			<?php if ( ! post_password_required() && ! is_attachment() ) :
				//the_post_thumbnail();
			endif; ?>

			<?php if(is_singular()) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"
          title="<?php the_title(); ?>">
          <?php the_title(); ?></a>
			</h3>
			<?php endif; // if(is_singular()) ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php elseif ( !is_singular() ) : //Build the Excerpt for Post Lists ?>
		<div class="entry-content">
      <?php if ( empty($spstsmryhtml) ) : // Only display Excerpts for Search ?>
        <?php echo extractExcerptfromContent($spstcntnthtml, 100); ?>
      <?php else : ?>
        <?php the_excerpt(); ?>
      <?php endif; ?>
		</div><!-- .entry-content -->
		<?php else : ?>
		<div class="entry-content">
          <?php
if(!empty($spstimgurl))
{
?><div class="entry-content" style="float:left; margin:0px 15px 15px 0px;">
      <?php
  if(is_singular())
  {
?><img src="<?php echo $spstimgurl; ?>"
        alt="<?php the_title(); ?>"
        title="<?php the_title(); ?>" /></a>
    <?php
  } //if(is_singular())

?></div>
    <?php
} //if(!empty($spstimgurl))

?>

			<?php the_content("Leer m&aacute;s ..."); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'P&aacute;ginas:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
      <?php
  if(!is_singular())
  {
?><div class="comments-link">
      <a href="<?php the_permalink(); ?>" rel="bookmark"
        title="<?php the_title(); ?>">
        <?php echo "Leer m&aacute;s sobre el Art&iacute;culo"; ?></a>
      </div>
      <?php
  } //if(!is_singular())

?>
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Comente sobre el Art&iacute;culo', 'twentytwelve' ) . '</span>', __( '1 Comentario', 'twentytwelve' ), __( '% Comentarios', 'twentytwelve' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php //twentytwelve_entry_meta();
      ?>
			<?php edit_post_link( __( 'Editar', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
