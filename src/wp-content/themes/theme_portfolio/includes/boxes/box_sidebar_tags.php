<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$arrpsttgs = get_the_tags();
$psttg = NULL;


if(is_array($arrpsttgs))
{
  if(!empty($arrpsttgs))
  {
?><div class="panel_categories_main" style="margin-bottom:20px;">
    <div style="margin-bottom:20px;">
      <h3>Palabras Clave del Art&iacute;culo</h3>
    </div>
    <div style="padding-bottom:15px;">
      <?php
      foreach($arrpsttgs as $psttg)
      {
?><div class="pctgys_link">
        <!--
        <?php echo $psttg->term_id; ?>: <?php echo $psttg->name; ?> - <?php echo $psttg->slug; ?>
        -->
        <a href="<?php echo get_tag_link($psttg->term_id); ?>"
          title="<?php echo $psttg->name; ?>">
          <?php echo $psttg->name; ?></a>
      </div>
      <?php
      } //foreach($arrpsttgs as $psttg)

?></div>
  </div>
  <?php
  } //if(!empty($arrpsttgs))
} //if(is_array($arrpsttgs))

?>