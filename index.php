<?php
/*
Plugin Name: Row Maker
Plugin URI: http://billjellesmawebdev.com
Description: A simple plugin so that user's can easily create bootstraped rows and columns via shortcode
Author: Bill Jellesma
Author URI: http://billjellesmawebdev.com
*/
/*
The plugin will take whatever content the user specifies between [rows] and [/rows]
the plugin works by counting the number of images inbetween shortcode tags
*/

add_shortcode('rows', function($params, $content){
  $rowStart = '<div class=row>';

  $rowEnd = "</div>";
  $clearFix = "<div class='clearfix'></div>";

  //parse out content
  $images = preg_split('/^\<img$/ ', $content);


  //make content wrapper
  $contentWrapper = $rowStart;

  //account for offset
  for($i = 0; $i <= count($images) - 1; $i++){
    $images[$i] = bootStrapWrap($images[$i], count($images));
    $contentWrapper .= $images[$i];
  }
  $contentWrapper .= $rowEnd . $clearFix;

  return $contentWrapper;
});

function bootStrapWrap($content, $count){
  $colEnd = '</div>';
  switch($count){
    case 1:
      $colStart = '<div class=col-md-12>';
    case 2:
      $colStart = "<div class='col-md-6'>";
    case 3:
      $colStart = "<div class='col-md-4'>";
    case 4:
      $colStart = "<div class='col-md-3'>";
    default:
      $colStart = '<div class=col-md-12>';
  }
  $bootstraped = $colStart . $content . $colEnd;
  return $bootstraped;
}

?>
