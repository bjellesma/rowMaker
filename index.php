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
  //if the user only uses the single shortcode tag
  $params = shortcode_atts(
    array(
      'content' => empty($content) ? $content : 'Please use a closing shortcode tag for rowMaker',
      'searchTag' => '[caption'
    ), $params
  );
  $rowStart = '<div class=row><div class=col-md-12>';
  $searchTag = $params['searchTag'];
  $rowEnd = "</div>";
  $clearFix = "<div class='clearfix'></div>";

  //parse out content
  $images = explode($searchTag, $content);


  //make content wrapper
  $contentWrapper = $rowStart;

  //account for offset
  for($i = 1; $i < count($images); $i++){
    $images[$i] = bootStrapWrap($images[$i], count($images) - 1, $searchTag);
    $contentWrapper .= $images[$i];
  }
  $contentWrapper .= $rowEnd . $rowEnd . $clearFix;

  return $contentWrapper;
});

function bootStrapWrap($content, $count, $searchTag){
  //add tag back to content
  $content = $searchTag . $content;
  $colEnd = '</div>';
  switch($count){
    case 1:
      $colStart = '<div class=col-md-12>';
      break;
    case 2:
      $colStart = "<div class='col-md-2'>";
      break;
    case 3:
      $colStart = "<div class='col-md-4'>";
      break;
    case 4:
      $colStart = "<div class='col-md-3'>";
      break;
    default:
      $colStart = '<div class=col-md-12>';
      break;
  }
  //the do shortcode function is necessary because we may have shortcode nested inside which normally isn't interpretted
  $bootstraped = $colStart . do_shortcode($content) . $colEnd;
  return $bootstraped;
}

?>
