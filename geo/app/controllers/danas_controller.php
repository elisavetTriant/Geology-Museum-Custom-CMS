<?php
class DanasController extends AppController {

	var $name = 'Danas';
	var $helpers = array('Html', 'Form', 'Menu');

	function admin_index() {
		$this->Dana->recursive = 0;
		$this->set('danas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Dana.', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('dana', $this->Dana->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Dana->create();
			if ($this->Dana->save($this->data)) {
				$this->Session->setFlash(__('The Dana has been saved', true));
				$this->redirect(array('action'=>'admin_view/'.$this->Dana->id));
			} else {
				$this->Session->setFlash(__('The Dana could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Dana', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Dana->save($this->data)) {
				$this->Session->setFlash(__('The Dana has been saved', true));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Dana could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Dana->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Dana', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Dana->del($id)) {
			$this->Session->setFlash(__('Dana deleted', true));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>