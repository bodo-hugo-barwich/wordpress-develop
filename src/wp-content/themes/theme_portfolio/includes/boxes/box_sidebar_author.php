<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



  $arrprspsts = NULL;
  $prspst = NULL;
  $iprsid = -1;
  $sprslnknm = "";
  $sprscntnt = "";
  $sprsimghtml = "";
  $sprsimgurl = "";

  $arrpstimgs = NULL;
  $ipstimgcnt = -1;
  $spstimgsrh = '/<img[^>]*src="([^\"]*)"[^>]*>/i';


  $sprslnknm = get_post_meta($ipstid, "author_slug", true);

  //echo "pst ($ipstid): atr slg: '" . print_r($sprslnknm, true) . "'<br />\n";

  if(!empty($sprslnknm))
  {
?><div class="panel_author" style="margin-bottom:20px;">
  <?php

    $arrprspsts = get_posts(array('name' => $sprslnknm, 'post_type' => 'post'
      , 'post_status' => 'publish', 'posts_per_page' => 1));

    if(isset($arrprspsts))
      if(is_array($arrprspsts)
        && !empty($arrprspsts))
      {
        $prspst = $arrprspsts[0];

        if(isset($prspst))
        {
          //var_dump($prspst);
          $iprsid = $prspst->ID;
          $sprscntnt = $prspst->post_content;
          $sprsimghtml = get_the_post_thumbnail($iprsid, "thumbnail");

          //echo "pst ($iprsid): ''<br />\n";
          //echo "pst img. '$sprsimghtml'<br />\n";

          if(!empty($sprsimghtml))
            $ipstimgcnt = preg_match($spstimgsrh, $sprsimghtml, $arrpstimgs);

          if($ipstimgcnt > 0)
            if(is_array($arrpstimgs))
            {
              //echo "pst imgs: '" . print_r($arrpstimgs, true) . "'<br />\n";

              if(count($arrpstimgs) > 1)
                $sprsimgurl = $arrpstimgs[1];

            } //if(is_array($arrpstimgs))

          setup_postdata($prspst);

?><div>
      <div style="height:100px; margin-bottom:20px;">
        <div class="entry-content" style="float:left;">
          <a href="<?php echo get_permalink($iprsid); ?>" rel="bookmark"
            title="<?php echo get_the_title($iprsid); ?>">
            <img src="<?php echo $sprsimgurl; ?>"
              alt="<?php echo get_the_title($iprsid); ?>"
              title="<?php echo get_the_title($iprsid); ?>" /></a>
        </div>
        <div style="float:left; width:55%; margin-left:10px;">
          <header class="entry-header">
            <h3 style="margin-top:0px;">
              <a href="<?php echo get_permalink($iprsid); ?>" rel="bookmark"
                title="<?php echo get_the_title($iprsid); ?>">
                <?php echo get_the_title($iprsid); ?></a>
            </h3>
          </header>
        </div>
      </div>
      <div>
        <!--
        <header class="entry-header">
          <h3>
            <a href="<?php echo get_permalink($iprsid); ?>" rel="bookmark"
              title="<?php echo get_the_title($iprsid); ?>">
              <?php echo get_the_title($iprsid); ?></a>
          </h3>
        </header>
        -->
        <div class="entry-summary">
          <?php

          //the_excerpt();
          //echo "'" . extractExcerptfromContent($sprscntnt, 100) . "'";
          echo extractExcerptfromContent($sprscntnt, 100);
          ?>
        </div><!-- .entry-summary -->
      </div>
    </div>
  <?php

          } //if(isset($prspst))
        } //if(is_array($arrprspsts) && !empty($arrprspsts))

?></div>
  <?php
  } //if(!empty($sprslnknm))

?>