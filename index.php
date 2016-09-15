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
  $rowStart = "<div class='row'>";

  $divEnd = "</div>";
  $clearFix = "<div class='clearfix'></div>";

  //parse out content
  $images = explode('<', $content);


  //make content wrapper
  $contentWrapper = $rowStart;
  if(!isset($params['pictures'])){
    $params['pictures'] = 1;
  }
  else {
    switch($params['pictures']){
      case 1:
        $colStart = "<div class='col-md-12'>";
        $contentWrapper .= $colStart;
      case 2:
        $colStart = "<div class='col-md-6'>";
        $contentWrapper .= $colStart . $colStart;
      case 3:
        $colStart = "<div class='col-md-4'>";
        $contentWrapper .= $colStart . $colStart . $colStart;
      case 4:
        $colStart = "<div class='col-md-3'>";
        $contentWrapper .= $colStart . $colStart . $colStart . $colStart;
    }
  }
  print_r($images[1]);
});

?>
