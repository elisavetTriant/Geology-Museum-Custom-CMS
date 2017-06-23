<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');

    function login(){
	}
	
	
    function logout(){
        $this->Session->del('Permissions');
        $this->redirect($this->Auth->logout());
    }

	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		
		$user = $this->User->read(null, $id);
		$sample_count = count($user['Sample']);
		$role_count = count($user['Role']);
		$this->set('user', $user);
		$this->set('sample_count', $sample_count);
		$this->set('role_count', $role_count);
		
		
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			if ($this->data['User']['password_confirm1'] == $this->data['User']['password_confirm2']){ 
				$this->User->create();
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['password_confirm1']);
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'confirmation_msg'));
					$this->redirect(array('action'=>'admin_index'));
				} else {
					$this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
				}
			} else {
				$this->Session->setFlash(__('Error: Password mismatch. Please try again.', true), 'default', array('class' => 'error_msg'));	
			}
		}
		
		if (empty($this->data)){
			$this->data['User']['active']=1;
		}
		
		$roles = $this->User->Role->generateList();
		$this->set(compact('roles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		//post data has been sent
		if (!empty($this->data)) {
				
				if (!empty($this->data['User']['password_confirm1']) && !empty($this->data['User']['password_confirm2'])){
					
					if ($this->data['User']['password_confirm1'] == $this->data['User']['password_confirm2']){
						
						$this->data['User']['password'] = $this->Auth->password($this->data['User']['password_confirm1']);
						
						$this->User->validate = $this->User->validate_edit;
						
						if ($this->User->save($this->data)) {
							$this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'confirmation_msg'));
							$this->redirect(array('action'=>'admin_index'));
						} else {
		
							$this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
						}
					}//confirm password eguality
					else{
						$this->Session->setFlash(__('Error: Password mismatch. Please try again', true), 'default', array('class' => 'error_msg'));	
					}
				}else if (empty($this->data['User']['password_confirm1']) && empty($this->data['User']['password_confirm2'])){ //
					
					$this->User->validate = $this->User->validate_edit;
					
					if ($this->User->save($this->data)) {
							$this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'confirmation_msg'));
							$this->redirect(array('action'=>'admin_index'));
						} else {
		
							$this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
					}
				}
		}
		
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->generateList();
		$this->set(compact('roles'));
	}

	
	function admin_changepassword($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid User.', true), 'default', array('class' => 'warning_msg'));
				$this->redirect(array('action'=>'admin_index'));
			}
			
			if (!empty($this->data)){					
					
					if ($this->data['User']['password_confirm1'] == $this->data['User']['password_confirm2']){
						
						//then attempt a save operation. 
						$this->data['User']['password'] = $this->Auth->password($this->data['User']['password_confirm1']);
						
						$this->User->validate = $this->User->validate_change_pwd;
						
						if ($this->User->save($this->data)) {
							$this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'confirmation_msg'));
							$this->redirect(array('action'=>'admin_index'));
						} else {
		
							$this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
						}
					
					} //end  if (equality of passwords)
					else{
						$this->Session->setFlash(__('Error: Password mismatch. Please try again', true), 'default', array('class' => 'error_msg'));		}
									
			}//end !empty($this->data)
			
			if (empty($this->data)) {
				$this->data['User']['id'] = $id;
			}
			$this->User->recursive = -1;
			$user = $this->User->read(null, $id);
			$this->set('user', $user);

		}

	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>