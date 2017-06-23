<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 00:33:52 -0600 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppController extends Controller {
    /**
     * components
     * 
     * Array of components to load for every controller in the application
     * 
     * @var $components array
     * @access public
     */
    var $components = array('Auth', 'Cookie', 'PImage', 'P28n');
	var $helpers = array('Html', 'MyHtml','Form', 'Menu', 'MyTime','Javascript');
    /**
     * beforeFilter
     * 
     * Application hook which runs prior to each controller action
     * 
     * @access public 
     */
    function beforeFilter(){
        
        //Set application wide actions which do not require authentication
        $this->Auth->allow(array('index', 'displayCase', 'display', 'view', 'alphabetical','perCollection', 'perCountry', 'change', 'shuntRequest'));
	    //$this->Auth->allow('*'); //for development
		//Set the default login action
		 $this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
        //Set the default redirect for users who logout
       	$this->Auth->logoutRedirect = '/';
        //Set the default redirect for users who login
        $this->Auth->loginRedirect = '/admin/samples/';		
        //Extend auth component to include authorisation via isAuthorized action
        $this->Auth->authorize = 'controller';
        //Restrict access to only users with an active account
        $this->Auth->userScope = array('User.active = 1');
        //Pass auth component data over to view files
        $this->set('Auth',$this->Auth->user());
		//if admin area default to greek lang
		if (isset($this->params['admin']))
			$this->P28n->change('gr');
    }
    /**
     * beforeRender
     * 
     * Application hook which runs after each action but, before the view file is 
     * rendered
     * 
     * @access public 
     */  
   
   
   
    function beforeRender(){
        if (isset($this->params['admin']))
			$this->layout = 'admin';
		$this->set('lang', $this->Session->read('Config.language'));
		
    }
   
   
    /**
     * isAuthorized, we need this function because we set $this->Auth->authorize = 'controller';
     * 
     * Called by Auth component for establishing whether the current authenticated 
     * user has authorization to access the current controller:action
     * 
     * @return true if authorised/false if not authorized
     * @access public
     */
    function isAuthorized(){
        return $this->__permitted($this->name,$this->action);
    }
    /**
     * __permitted
     * 
     * Helper function returns true if the currently authenticated user has permission 
     * to access the controller:action specified by $controllerName:$actionName
     * @return 
     * @param $controllerName Object
     * @param $actionName Object
     */
	 function __permitted($controllerName,$actionName){
        //Ensure checks are all made lower case
        $controllerName = low($controllerName);
        $actionName = low($actionName);
        //If permissions have not been cached to session...
        if(!$this->Session->check('Permissions')){
            //...then build permissions array and cache it
            $permissions = array();
            //everyone gets permission to logout
            $permissions[]='users:logout';
            //Import the User Model so we can build up the permission cache
            App::import('Model', ('User'));
            $thisUser = new User;
            //Now bring in the current users full record along with groups
            $thisRoles = $thisUser->find(array('User.id'=>$this->Auth->user('id')));
            $thisRoles = $thisRoles['Role'];
            foreach($thisRoles as $thisRole){
                $thisPermissions = $thisUser->Role->find(array('Role.id'=>$thisRole['id']));
                $thisPermissions = $thisPermissions['Permission'];
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
            }
            //write the permissions array to session
            $this->Session->write('Permissions',$permissions);
        }else{
            //...they have been cached already, so retrieve them
            $permissions = $this->Session->read('Permissions');
			
        }		
		
		
		//Now iterate through permissions for a positive match
        foreach($permissions as $permission){
		
			$permission = trim(low($permission));
			
			if($permission == '*'){
                return true;//Super Admin Bypass Found
            }
           
		    if($permission == $controllerName.':*'){
                return true;//Controller Wide Bypass Found
            }
            
			if($permission == $controllerName.':'.$actionName){
                
				return true;//Specific permission found
			
            }
        }		
        return false;
    }
}
?>