<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php __('Mineralogy and Petrology museum: '); ?>
		<?php echo $title_for_layout;?>
	</title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');
		echo $javascript->link('jquery-1.3.2.min'); 
		echo $javascript->link('jquery.easing.1.3'); 
		echo $javascript->link('jquery-galleryview-1.1/jquery.galleryview-1.1'); 
		echo $javascript->link('jquery-galleryview-1.1/jquery.timers-1.1.2');
		
		echo $html->css('layout'); 
		echo $html->css('horizontal_navigation'); 
		echo $html->css('project_specific'); 
		echo $html->css('typography'); 
		echo $html->css('display_case'); 
		echo $scripts_for_layout;
	?>
    <!--[if IE 6]>
    <?php echo $html->css('ie_fix');?>
    <![endif]-->
    
	<script> 
     $(document).ready(function(){
		$('#photos').galleryView({
			panel_width: 600,
			panel_height: 450,
			frame_width: 150,
			frame_height: 112,
			border: '30px solid #000',
			filmstrip_position: 'top',
    		overlay_position: 'top',
			easing: 'easeInExpo',
    		nav_theme: 'light',
			pause_on_hover: true


		});
	});
    
    </script>

</head><body>
	<div id="wrapper">

    <div id="header">
        <div id="logo"><h1><?php __('Mineralogy and Petrology museum');?><br /><span><?php __('Aristotle University Of Thessaloniki')?></span></h1></div>
        <div id="header_menu_contain">
            <ul class="lang">
                 <li class="en"><?php echo $html->link('english', '/lang/eng'); ?></li>
                 <li class="gr"><?php echo $html->link('ελληνικά', '/lang/gr'); ?></li>
              </ul>
           	<?php echo $this->renderElement('navigation'); ?>
        </div>
    </div>

    <div id="header-banner"><?php echo $this->renderElement('header_photos'); ?> </div>
	<div id="main-content">
        <div id="left_col">
            <div class="inside">
            <?php
                    if ($session->check('Message.flash')) {
                            $session->flash();
                    }
                     if ($session->check('Message.auth')) {
                         $session->flash('auth');
                     }
                ?>
             <?php echo $content_for_layout;?>
            </div>
        </div>
    
        <div id="right_col">
             <div id="right_content">              
              <h2><?php __('Mineral samples')?></h2>
              <ul>
              	<li><?php echo $html->link(__('Alphabetical index', true), array('controller'=>'samples', 'action'=>'alphabetical'))?></li>
              	<li><?php echo $html->link(__('Per crystal system', true), array('controller'=>'crystalSystems', 'action'=>'index'))?></li>
              	<li><?php echo $html->link(__('Per Dana Classification', true), array('controller'=>'danaGroups', 'action'=>'index'))?></li>
              </ul>
              
			  <?php echo $this->renderElement('collections'); ?>
              <?php echo $this->renderElement('countries'); ?>
             </div>
             
         <div id="right_end">&nbsp;</div>  
        </div>
     </div>

    <div id="footer">&nbsp;</div>

</div><!-- end of wrapper -->
	<?php echo $cakeDebug?>
</body>
</html>