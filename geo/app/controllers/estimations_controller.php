<?php
class EstimationsController extends AppController {

	var $name = 'Estimations';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');


	function admin_index() {
		$this->Estimation->recursive = 0;
		$this->set('estimations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Estimation.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$estimation = $this->Estimation->read(null, $id);
		$sample_count = count($estimation['Sample']);
		$this->set('estimation', $estimation);
		$this->set('sample_count', $sample_count);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Estimation->create();
			if ($this->Estimation->save($this->data)) {
				$this->Session->setFlash(__('The Estimation has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->Estimation->id));
			} else {
				$this->Session->setFlash(__('The Estimation could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Estimation', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Estimation->save($this->data)) {
				$this->Session->setFlash(__('The Estimation has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Estimation could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Estimation->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Estimation', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Estimation->del($id)) {
			$this->Session->setFlash(__('Estimation deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>