<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php __('Geology museum:'); ?>
		<?php echo $title_for_layout;?>
	</title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');
		
		echo $html->css('admin'); 
		echo $html->css('navigation'); 
		echo $html->css('project_specific'); 
		echo $html->css('lightbox');
		echo $javascript->link('jquery-1.3.2.min'); 
		echo $javascript->link('prototype'); 	 
		echo $javascript->link('scriptaculous');
		echo $javascript->link('lightbox'); 	
		echo $scripts_for_layout;
	?>
   	<script type="text/javascript">
			 //prototype syntax //scriptaculous effect fade
			 Event.observe(window, 'load',
      			function() { 
							
					var rows = $$('tbody tr');  
					for (var i = 0; i < rows.length; i++) {  
						rows[i].onmouseover = function() { $(this).addClassName('highlight'); }  
						rows[i].onmouseout = function() { $(this).removeClassName('highlight'); }  
					}
					;
					var inputs = $$('form input');  
					for (var j = 0; j < inputs.length; j++) {  
						inputs[j].onfocus = function() { $(this).addClassName('highlight-form'); }  
						inputs[j].onblur = function() { $(this).removeClassName('highlight-form'); }  
					};
					
					var selects = $$('form select');  
					for (var t = 0; t < selects.length; t++) {  
						selects[t].onfocus = function() { $(this).addClassName('highlight-form'); }  
						selects[t].onblur = function() { $(this).removeClassName('highlight-form'); }  
					};	
					
					if ($('flashMessage')){
						$('flashMessage').fade({ duration: 2.0, from: 0, to: 1 });
					}
					
					if ($('authMessage')){
						$('authMessage').fade({ duration: 2.0, from: 0, to: 1 });
					}
					
				 }
   			 );
			 			
	</script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php __('Geology museum');?></h1>   		</div>
           <?php if (isset($Auth)) :?>
                <div id="utility_menu">
                	<?php echo __('Welcome User', true).' "'.$Auth['User']['username'].'" , '; ?>
                    <?php echo $html->link(
                                $html->image('user.logout.gif', array('alt'=> __("Logout", true), 'border'=>"0")).' '.__('Logout', true),
                                '/users/logout',
                                null, null, false
                            );
                    ?>
                </div>
              <?php else: ?>
              <div id="utility_menu">
              <?php echo $html->link(
                                $html->image('user.logout.gif', array('alt'=> __("Login", true), 'border'=>"0")).' '.__('Login', true),
                                '/users/login',
                                null, null, false
                            );
                    ?>
                    </div>
            <?php endif; ?>
       	<div id="main_content_admin">
            <div id="sidebar"> 
				<?php echo $this->renderElement('navigation'); ?>
            </div>
            <div id="content">
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
		<div id="footer">
			<div id="copyright">
            Copyright © Ελισάβετ Τριανταφυλλοπούλου, 2010. Με επιφύλαξη παντός δικαιώματος. All rights reserved.
            <?php echo $html->link('Creative Commons Lisence', 'http://creativecommons.org/licenses/by-nc-nd/3.0/deed.el'); ?>
            </div>
			
			<?php echo $html->link(
							$html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
							'http://www.cakephp.org/',
							array('target'=>'_new'), null, false
						);
			?>
		</div>
	</div>
	<?php echo $cakeDebug?>
    
</body>
</html>
 