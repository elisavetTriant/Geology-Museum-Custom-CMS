<?php
class RolesController extends AppController {

	var $name = 'Roles';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');

	function admin_index() {
		$this->Role->recursive = 0;
		$this->set('roles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Role.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		
		$role = $this->Role->read(null, $id);
		$permissions= count($role['Permission']);
		$users= count($role['User']);
		$this->set('role', $role);
		$this->set('user_count', $users);
		$this->set('permission_count', $permissions);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Role->create();
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash(__('The Role has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_index'));
			} else {
				$this->Session->setFlash(__('The Role could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		$permissions = $this->Role->Permission->generateList();
		$this->set(compact('permissions'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Role', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash(__('The Role has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_index'));
			} else {
				$this->Session->setFlash(__('The Role could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Role->read(null, $id);
		}
		$permissions = $this->Role->Permission->generateList();
		$this->set(compact('permissions'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Role', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Role->del($id)) {
			$this->Session->setFlash(__('Role deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>