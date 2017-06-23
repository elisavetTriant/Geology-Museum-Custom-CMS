<?php
class MyHtmlHelper extends Helper{

var $helpers = array('Html');



	 function showStatusIcon($status_flag) {
		  
		  //@param string $path Path to the image file, relative to the app/webroot/img/ directory.
		  $active_icon = $this->Html->image('action_links/active.png');
		  $inactive_icon = $this->Html->image('action_links/inactive.png');	  
		  
		  if ($status_flag == 1)
		  	$status_icon = $active_icon;
		  else if ($status_flag == 0)
		  	$status_icon = $inactive_icon;
		  
		  return $status_icon;
	 }




}
?>