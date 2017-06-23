 <?php
 class DarkAuthComponent extends Object {
   //user model name
  var $user_model_name = 'User';
  
   //user model fields for user and password.
   var $user_name_field = 'email';
   var $user_pass_field = 'pswd';
  
   //do you want to case fold the username before verifying? either 'lower','upper','none', to change case to lower/upper/leave it alone before matching.
   var $user_name_case_folding = 'lower';
    
   //surely you have a field in you users table to show whether the user is active or not? set to null if not.
   var $user_live_field = 'live';
   var $user_live_value = 1;
  
   //Group for access control if used, and the field for matching the name.
   var $group_model_name = 'Group';
   var $group_name_field = 'name';
  
   //set to false if you don use a HABTM group relationship.
   var $HABTM = true;
  
   //if you want a single group to have automatically granted access to any restriction.
   var $superuser_group = 'Root';
  
   //this is the login and deny views (I usually suggest keeping this in the root of your views folder)
   var $login_view = '/login';  
   var $deny_view = '/deny';  
  
   // NB this is were to **redirect** AFTER logout by default
   var $logout_page = '/';
  
   //This message is setFlash()'d on failed login.
   var $login_failed_message = '<p class="error">Login Failed, Please check your details and try again.</p>';
  
   //Message to setFlash after logout.
   var $logout_message = '<p class="success">You have been succesfully logged out.</p>';
  
   //Allow use of cookies to remember authenticated sessions.
   var $allow_cookie = false;
  
   //how long until cookies expire (by default). format is "strtotime()" based (http://php.net/strtotime).
   var $cookie_expiry = '+6 Months';
  
   //some random stuff that someone is unlikey to guess.
   var $session_secure_key = 'sRmtVStkedAdlxBy';
  
   /**
    * You can edit this function to explain how you want to hash your passwords.
    * Also you can use it as a static function in your controller to hash passwords beforeSave
   */
   function hasher($plain_text){
     $hashed = md5('dark'.$plain_text.'cake');
    return $hashed;
   }
 
 ##########################################################################
  /*
   * DON'T EDIT THESE OR ANYTHING BELOW HERE UNLESS YOU KNOW WHAT YOU'RE DOING
   */
   var $controller;
   var $here;
   var $components=array('Session');
   var $current_user;
   var $from_session;
   var $from_post;
   var $from_cookie;
  
 
   function startup(&$controller){
  
      //Let's check they have changed the secure key from the default.
         if($this->session_secure_key == 'sRmtVStkedAdlxBy'){
            die('<p>Please change the DarkAuth::session_secure_key value from it default.</p>');
         }
       
     $this->controller = $controller;
   
     $this->here = substr($this->controller->here,strlen($this->controller->base));
      
     $this->controller->_login();
    
    //now check session/cookie info.
     $this->getUserInfoFromSessionOrCookie();
  
     //now see if the calling controller wants auth
     if( array_key_exists('_DarkAuth', $this->controller) ){
       // We want Auth for any action here
       if(!empty($this->controller->_DarkAuth['onDeny'])){
               $deny = $this->controller->_DarkAuth['onDeny'];
             }else{
               $deny = null;
             }
             if(!empty($this->controller->_DarkAuth['required'])){
               $this->requiresAuth($this->controller->_DarkAuth['required'],$deny);
            }else{
         $this->requiresAuth(null,$deny);
       }
     }
    //finally give the view access to the data
     $DA = array(
       'User'=>$this->getUserInfo(),
      'Access'=>$this->getAccessList()
     );
    $this->controller->set('_DarkAuth',$DA);
   }
  
     function secure_key(){
         static $key;
         if(!$key){
             $key = md5(Configure::read('Security.salt').'!DarkAuth!'.$this->session_secure_key);
         }
         return $key;
     }
  
   function requiresAuth($groups=array(),$deny_redirect=null){
         if( empty($this->current_user) ){
             // Still no info! render login page!
             if($this->from_post){
                 $this->Session->setFlash($this->login_failed_message);
             }
      $this->controller->render($this->login_view);
       exit();
     }else{
       if($this->from_post){
                 // user just authed, so redirect to avoid post data refresh.
                $this->controller->redirect($this->here,null,null,true);
                 exit();
       }
       // User is authenticated, so we just need to check against the groups.
       if( empty($groups) ){
         // No Groups specified so we are good to go!
         $deny = false;
       }else{
         $deny = !$this->isAllowed($groups);
       }
       if($deny){
         // Current User Doesn't Have Access! DENY
         if($deny_redirect){
                     $this->controller->redirect($deny_redirect);
                     exit();
                 }else{
                     $this->controller->render($this->deny_view);
                     exit();
                 }
       }
     }
     return true;
   }
  
   function isAllowed($groups=array()){
     if( empty($this->current_user) ){
       // No information about the user! FALSE
       return false;
     }else{
       // User is authenticated, so we just need to check against the groups.
       if( empty($groups) ){
         // No Groups specified so we are good to go! TRUE
         return true;
       }
      
       if(!is_array($groups)){
         //if a string passed, turn to an array with one element
         $groups = array(0 => $groups);
       }
      
       $access = $this->getAccessList();
            
       foreach($groups as $g){
         if(array_key_exists($g,$access) && $access[$g]){
           return true;
         }
       }
     }
   }
 
   function getCookieInfo(){
         if(!array_key_exists('DarkAuth',$_COOKIE)){
             //No cookie
             return false;
         }
         list($hash,$data) = explode("|||",$_COOKIE['DarkAuth']);
         if($hash != md5($data.$this->secure_key())){
             //Cookie has been tampered with
             return false;
         }
         $crumbs = unserialize(base64_decode($data));
         if(!array_key_exists('username',$crumbs) ||
              !array_key_exists('password',$crumbs) ||
              !array_key_exists('expiry'  ,$crumbs)){
             //Cookie doesn't contain the correct info.
             return false;
         }
         if(!isset($crumbs['expiry']) || $crumbs['expiry'] <= time()){
             //Cookie is out of date!
             return false;
         }
         //All checks passed, cookie is genuine. remove expiry time and return
         unset($crumbs['expiry']);
         return $crumbs;        
   }
  
   function setCookieInfo($data,$expiry=0){
       if($data === false){
             //remove cookie!
             $cookie = false;
             $expiry = 100; //should be in the past enough!
       }else{
             $serial = base64_encode(serialize($data));
             $hash = md5($serial.$this->secure_key());
             $cookie = $hash."|||".$serial;
         }
         if($_SERVER['SERVER_NAME']=='localhost'){
           $domain = null;
        }else{
           $domain = '.'.$_SERVER['SERVER_NAME'];
         }
         return setcookie('DarkAuth', $cookie, $expiry, $this->controller->base, $domain);
   }
  
   function authenticate_from_post($data){
         $this->from_post = true;
         return $this->authenticate($data);
   }
   function authenticate_from_session($data){
         $this->from_session = true;
         return $this->authenticate($data);
     }
   function authenticate_from_cookie(){
         $this->from_cookie = true;
         return $this->authenticate($this->getCookieInfo());
     }
    
   function authenticate($data){
         if($data === false){
             $this->destroyData();
             return false;
         }
     if($this->from_session || $this->from_cookie){
       $hashed_password = $data['password'];
     }else{
       $hashed_password = $this->hasher($data['password']);
     }    
     switch($this->user_name_case_folding){
             case 'lower':
                 $data['username'] = strtolower($data['username']);
                 break;            
             case 'upper';
                 $data['username'] = strtoupper($data['username']);
                 break;
             default: break;
     }
     $conditions = array(
       $this->user_model_name.".".$this->user_name_field => $data['username'],
       $this->user_model_name.".".$this->user_pass_field => $hashed_password
     );
     if($this->user_live_field){
       $field = $this->user_model_name.".".$this->user_live_field;
       $conditions[$field] = $this->user_live_value;
     };
     $check = $this->controller->{$this->user_model_name}->find($conditions);
     if($check){
        $this->Session->write($this->secure_key(),$check);
        if(
                   $this->allow_cookie && //check we're allowing cookies
                   $this->from_post && //check this was a posted login attempt.
                   array_key_exists('remember_me',$data) && //check they where given the option!
                   $data['remember_me'] == true //check they WANT a cookie set
              ){
                  // set our cookie!
                  if(array_key_exists('cookie_expiry',$data)){
                   $this->cookie_expiry = $data['cookie_expiry'];
                 }else{
                    $this->cookie_expiry;
                  }
                  if(strtotime($this->cookie_expiry) <= time()){
                     // Session cookie? might as well not set at all...
                  }else{
                   $expiry = strtotime($this->cookie_expiry);
                    $this->setCookieInfo(array('username'=>$data['username'], 'password'=>$hashed_password, 'expiry'=>$expiry), $expiry);
                  }
              }
        $this->current_user = $check;
        return true;
     }else{
         if($this->from_post){
           $this->Session->setFlash($this->login_failed_message);
             }
       $this->destroyData();
       return false;
     }
   }
  
   function getUserInfo(){
     return $this->current_user[$this->user_model_name];
   }
   function getAllUserInfo(){
     return $this->current_user;
   }
   function getAccessList(){
     static $access_list = false;
     if(!$access_list){
       $access_list = $this->_generateAccessList();
     }
     return $access_list;
   }
   function _generateAccessList(){
     if(!$this->group_model_name){
       return array();
     }
     $all_groups = $this->controller->{$this->user_model_name}->{$this->group_model_name}->find('list');
     if(!count($all_groups)){  return array(); }
     $access = array_combine($all_groups,array_fill(0,count($all_groups),0)); //create empty array.
    
     if(empty($this->current_user)){
       // NO AUTHENTICATION, SO EMTPY ARRAY!
       return $access;
     }
     if($this->HABTM){
       // could be many groups
       $ugroups = Set::combine($this->current_user[$this->group_model_name],'{n}.id','{n}.'.$this->group_name_field);
       foreach($all_groups as $id => $role){
         if(in_array($role,$ugroups)){
           $access[$role] = 1;
         }else{
           $access[$role] = 0;
         }
       }
     }else{
       // single group assoc, id = user.group_id
       $foreign_key = $this->controller{$this->user_model_name}->belongsTo[$this->group_model_name]['foreignKey'];
       foreach($all_groups as $id => $role){
         if($this->current_user[$this->user_model_name][$foreign_key] == $id){
           $access[$role] = 1;
         }else{
           $access[$role] = 0;
         }
       }
     }
     if($this->superuser_group && $access[$this->superuser_group]){
       return array_combine($all_groups,array_fill(0,count($all_groups),1));
     }else{
       return $access;
     }
   }
  
   function destroyData(){
     $this->Session->delete($this->secure_key());
     if($this->allow_cookie){
	        $this->setcookieInfo(false);
     }
     $this->current_user = null;
   }
 
   function logout($redirect=false){
     $this->destroyData();
     if(!$redirect){
       $redirect = $this->logout_page;
     }
         $this->Session->setFlash($this->logout_message);
     $this->controller->redirect($redirect,null,true);
     exit();
   }
  
   function getUserInfoFromSessionOrCookie(){
     if( !empty($this->current_user) ){
       return false;
     }
     if($this->Session->valid() && $this->Session->check($this->secure_key()) ){
       $this->current_user = $this->Session->read($this->secure_key());
       return $this->authenticate_from_session(array(
         'username' => $this->current_user[$this->user_model_name][$this->user_name_field],
         'password' => $this->current_user[$this->user_model_name][$this->user_pass_field],
       ));
     }elseif($this->allow_cookie){
             return $this->authenticate_from_cookie();
     }
   }
 }
 ?>