<?php
class PermissionsController extends AppController {

	var $name = 'Permissions';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');

	function admin_index() {
		$this->Permission->recursive = 0;
		$this->set('permissions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Permission.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		
		$permission = $this->Permission->read(null, $id);
		$roles= count($permission['Role']);
		$this->set('permission', $permission);
		$this->set('role_count', $roles);
		
		
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Permission->create();
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The Permission has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_index'));
			} else {
				$this->Session->setFlash(__('The Permission could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		$roles = $this->Permission->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Permission', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The Permission has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_index'));
			} else {
				$this->Session->setFlash(__('The Permission could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permission->read(null, $id);
		}
		$roles  = $this->Permission->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Permission', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Permission->del($id)) {
			$this->Session->setFlash(__('Permission deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>