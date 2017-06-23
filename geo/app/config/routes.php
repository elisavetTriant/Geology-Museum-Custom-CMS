<?php
/*
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
	Router::connect('/', array('controller' => 'samples', 'action' => 'displayCase'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/', array('controller' => 'pages', 'action' => 'display'));
/**
 * Then we connect url '/test' to our test controller. This is helpfull in
 * developement.
 */
	Router::connect('/tests', array('controller' => 'tests', 'action' => 'index'));
	
	//route to switch locale
	Router::connect('/lang/*', array('controller' => 'p28n', 'action' => 'change'));
	
	//forgiving routes that allow users to change the lang of any page
	Router::connect('/eng?/*', array(
		'controller' => "p28n",
		'action' => "shuntRequest",
		'lang' => 'eng'
	));
	
	Router::connect('/gr/*', array(
		'controller' => "p28n",
		'action' => "shuntRequest",
		'lang' => 'gr'
	)); 
	
	
