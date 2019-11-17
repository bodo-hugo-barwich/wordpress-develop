<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$ipstid = -1;
$spstnm = "otras_paginas";

$serrmsgrqd = "Este campo es necesario";
$serrmsgeml = "Por favor, introduzca su dirección de correo";


if(is_single())
{
  $ipstid = get_the_ID();
  $spstnm = get_post_field("post_name", $ipstid);
}
elseif(is_home())
{
  $spstnm = "portada";
} //if(is_single())

?>
<script src='<?php echo site_url(); ?>/wp-content/plugins/easy-contact-forms/easy-contact-forms-forms.1.4.9.js' type='text/javascript'></script>
<table id="panel_contactform_sidebar" style="width:100%;">
  <tr><td style='padding-top:20px;vertical-align:top'>
    <script type='text/javascript'>if (typeof(ecfconfig) == 'undefined'){var ecfconfig={};}ecfconfig[2]={};var ufobaseurl =  '<?php echo site_url(); ?>/wp-admin/admin-ajax.php';if (typeof(ufoFormsConfig) == 'undefined') {var ufoFormsConfig = {};ufoFormsConfig.submits = [];ufoFormsConfig.resets = [];ufoFormsConfig.validations = [];}ufoFormsConfig.phonenumberre = /^(\+{0,1}\d{1,2})*\s*(\(?\d{3}\)?\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;</script>
    <link href='<?php echo site_url(); ?>/wp-content/plugins/easy-contact-forms/forms/styles/formscompressed/css/std.css?ver=1.4.9' rel='stylesheet' type='text/css'/>
    <link href='<?php echo site_url(); ?>/wp-content/plugins/easy-contact-forms/forms/styles/formscompressed/css/icons.css?ver=1.4.9' rel='stylesheet' type='text/css'/>
    <div class='ufo-form' id='ufo-form-id-2'>
      <noscript><form method='post'><input type='hidden' name='cf-no-script' value='1'/></noscript>
      <input type='hidden' id='ufo-form-hidden-2' name='hidden-2' value='ufo-form-id-2' />
<input type='hidden' id='ufo-form-pagename' name='ufo-form-pagename' value='<?php echo $spstnm; ?>' />
<input type="hidden" id="ufo-preview" value="true"/>
<input type='hidden' id='ufo-sign' name='ufo-sign' value='2be725212f045b03622c943f5749e3f21409776663' />
<div><h3 >Contactenos</h3>
  <div class='ufo-fieldtype-4 ufo-customform-row ufo-row-3326' style='margin-top:10px;'>
    <div class='ufo-cell-3326-1-row' id='ufo-cell-3326-1'>
      <span class='ufo-cell-center' id='ufo-cell-3326-1-center'>
        <label for='ufo-field-id-3326'  style='text-align:left'>
          Nombre <span class='ufo-customfields-required-suffix'>*</span>
        </label>
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3326-1-right'>
        <p style='display:none'></p></span></div>
    <div class='ufo-cell-3326-2-row' id='ufo-cell-3326-2'>
      <span class='ufo-cell-center' id='ufo-cell-3326-2-center'>
        <script type='text/javascript'>ufoFormsConfig.validations.push({"events":{"blur":["required"]},"Required":true,"RequiredMessage":"<?php echo $serrmsgrqd; ?>","AbsolutePosition":true,"RequiredMessagePosition":"right","id":"ufo-field-id-3326","form":"ufo-form-id-2"});
        </script>
        <input type='text' id='ufo-field-id-3326' name='id-3326' value='' />
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3326-2-right'>
      <div id='ufo-field-id-3326-invalid'  style='display:none'></div></span>
    </div>
  </div>
  <div class='ufo-fieldtype-4 ufo-customform-row ufo-row-3327' style='margin-top:10px;'>
    <div class='ufo-cell-3327-1-row' id='ufo-cell-3327-1'>
      <span class='ufo-cell-center' id='ufo-cell-3327-1-center'>
        <label for='ufo-field-id-3327'  style='text-align:left'>Apellidos</label></span>
    </div>
    <div class='ufo-cell-3327-2-row' id='ufo-cell-3327-2'>
      <span class='ufo-cell-center' id='ufo-cell-3327-2-center'>
        <input type='text' id='ufo-field-id-3327' value='' name='id-3327' /></span></div>
  </div>
  <div class='ufo-fieldtype-5 ufo-customform-row ufo-row-3328' style='margin-top:10px;'>
    <div class='ufo-cell-3328-1-row' id='ufo-cell-3328-1'>
      <span class='ufo-cell-center' id='ufo-cell-3328-1-center'>
        <label for='ufo-field-id-3328'  style='text-align:left'>
          Correo Electrónico <span class='ufo-customfields-required-suffix'>*</span></label>
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3328-1-right'><p style='display:none'></p></span>
    </div>
    <div class='ufo-cell-3328-2-row' id='ufo-cell-3328-2'>
      <span class='ufo-cell-center' id='ufo-cell-3328-2-center'>
        <script type='text/javascript'>ufoFormsConfig.validations.push({"events":{"blur":["required","email"]},"Required":true,"Validate":true,"showValid":true,"ValidMessageAbsolutePosition":true,"ValidMessagePosition":"right","RequiredMessage":"<?php echo $serrmsgeml; ?>","AbsolutePosition":true,"RequiredMessagePosition":"right","id":"ufo-field-id-3328","form":"ufo-form-id-2"});</script>
        <input type='text' id='ufo-field-id-3328' name='id-3328' value='' />
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3328-2-right'>
        <div id='ufo-field-id-3328-invalid'  style='display:none'></div>
        <div id='ufo-field-id-3328-valid'  style='display:none'></div>
      </span>
    </div>
  </div>
  <div class='ufo-fieldtype-10 ufo-customform-row ufo-row-3329' style='margin-top:10px;'>
    <div class='ufo-cell-3329-1-row' id='ufo-cell-3329-1'>
      <span class='ufo-cell-center' id='ufo-cell-3329-1-center'>
        <label for='ufo-field-id-3329'  style='text-align:left'>
          Su Consulta <span class='ufo-customfields-required-suffix'>*</span></label>
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3329-1-right'><p style='display:none'></p></span>
    </div>
    <div class='ufo-cell-3329-2-row' id='ufo-cell-3329-2'>
      <span class='ufo-cell-center' id='ufo-cell-3329-2-center'>
        <script type='text/javascript'>ufoFormsConfig.validations.push({"events":{"blur":["required"]},"Required":true,"RequiredMessage":"<?php echo $serrmsgrqd; ?>","AbsolutePosition":true,"RequiredMessagePosition":"right","id":"ufo-field-id-3329","form":"ufo-form-id-2"});</script>
        <textarea id='ufo-field-id-3329' name='id-3329'></textarea>
      </span>
      <span class='ufo-cell-right' id='ufo-cell-3329-2-right'>
      <div id='ufo-field-id-3329-invalid'  style='display:none'></div>
      </span>
    </div>
  </div>
  <div class='ufo-fieldtype-6 ufo-customform-row ufo-row-3332' style='margin-top:10px;'>
    <div class='ufo-cell-3332-2-row' id='ufo-cell-3332-2'>
      <span class='ufo-cell-center' id='ufo-cell-3332-2-center'>
        <script type='text/javascript'>var c = {};c.id = 'ufo-field-id-3332';c.form = 'ufo-form-id-2';c.Label = 'Enviar';ufoFormsConfig.submits.push(c);</script>
        <span id='ufo-field-id-3332-span'>
          <noscript>
          <button type='submit' id='ufo-field-id-3332' name='id-3332' >Enviar</button>
          </noscript>
        </span></span></div>
  </div></div>
<div id='ufo-form-id-2-message'></div>
<noscript></form></noscript>
    </div>
  </td></tr>
</table>
