<?php 
if (isset($this->params['admin'])) $for = 'Admin';
else $for = 'Site';


$menuElements = array(
					'Admin' => array(

								0 => array(
									'title' => __('Samples', true),
									'url' =>  array('admin'=>true, 'controller'=> 'samples', 'action'=> 'index'),
									'class' => '',			
								),
								1 => array(
									'title' => __('Collections', true),
									'url' =>  array('admin'=>true, 'controller'=> 'collections', 'action'=> 'index'), 
									'class' => 'sub'								
								),
								2 => array(
									'title' => __('Countries', true),
									'url' =>   array('admin'=>true, 'controller'=> 'countries', 'action'=> 'index'),
									'class' => 'sub',						
								),
								3 => array(
									'title' =>  __('Estimations', true),
									'url' =>  array('admin'=>true, 'controller'=> 'estimations', 'action'=> 'index'),
									'class' => 'sub',								
								),
								4 => array(
									'title' => __('Minerals', true),
									'url' =>  array('admin'=>true, 'controller'=> 'minerals', 'action'=> 'index'),
									'class' => '',								
								),
								5 => array(
									'title' => __('Variations', true),
									'url' =>  array('admin'=>true, 'controller'=> 'variations', 'action'=> 'index'),
									'class' => 'sub',								
								),
								6 => array(
									'title' => __('Dana Groups', true),
									'url' =>  array('admin'=>true, 'controller'=> 'dana_groups', 'action'=> 'index'),
									'class' => 'sub'	,							
								),
								7 => array(
									'title' => __('Crystal Systems', true),
									'url' =>  array('admin'=>true, 'controller'=> 'crystal_systems', 'action'=> 'index'),
									'class' => 'sub',								
								),
								8 => array(
									'title' => __('Users', true),
									'url' =>  array('admin'=>true, 'controller'=> 'users', 'action'=> 'index'),
									'class' => ''	,							
								),
								9 => array(
									'title' => __('Roles', true),
									'url' =>  array('admin'=>true, 'controller'=> 'roles', 'action'=> 'index'),
									'class' => 'sub',								
								),
								10 => array(
									'title' => __('Permissions', true),
									'url' =>  array('admin'=>true, 'controller'=> 'permissions', 'action'=> 'index'),
									'class' => 'sub',								
						    	),
								11 => array(
									'title' => __('Attachments', true),
									'url' =>  array('admin'=>true, 'controller'=> 'attachments', 'action'=> 'index'),
									'class' => '',								
						    	),
														   
								  
						),
					  'Site' =>
							 array(
							 0 => array(
									'title' => __('Front Page', true),
									'url' =>   array('controller'=> 'pages', 'action'=> 'home'),
									'class' => '',			
								),
								1 => array(
									'title' => __('About', true),
									'url' => array('controller'=> 'pages', 'action'=> 'about'), 
									'class' => ''								
								),
								2 => array(
									'title' => __('Collection', true),
									'url' => array('controller'=> 'samples', 'action'=> 'index'), 
									'class' => ''								
								),
								3 => array(
									'title' => __('Contact', true),
									'url' => array('controller'=> 'pages', 'action'=> 'contact'), 
									'class' => ''								
								),
								
							 ) 
						
						
);
?>			
			
			
			<div id="menu">
				<div id="nav">					 
					<?php 
						echo $menu->generate_simple_menu($menuElements[$for]);
					?>
				</div>
			</div>