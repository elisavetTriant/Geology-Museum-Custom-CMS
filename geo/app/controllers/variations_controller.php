<?php
class VariationsController extends AppController {

	var $name = 'Variations';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime', 'Javascript', 'Ajax');
	
	var $components = array('RequestHandler');
	
	
	function index() {
		$this->Variation->recursive = 0;
		$this->set('variations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Variation.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('variation', $this->Variation->read(null, $id));
	}
	
	function admin_update_select() {
	
	 	 if(!empty($this->data['Sample']['mineral_id'])) {
			$mineral_id = $this->data['Sample']['mineral_id'];
			$options = $this->Variation->generateList($mineral_id);
			$this->set('options', $options);
	 	 }

	}
	
	function admin_index() {
		$this->Variation->recursive = 0;
		$this->set('variations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Variation.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$variation = $this->Variation->read(null, $id);
		$sample_count = count($variation['Sample']);
		$this->set('variation', $variation);
		$this->set('sample_count', $sample_count);

	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Variation->create();
			if ($this->Variation->save($this->data)) {
				$this->Session->setFlash(__('The Variation has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'view/'.$this->Variation->id));
			} else {
				$this->Session->setFlash(__('The Variation could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		$minerals = $this->Variation->Mineral->generateList();
		$this->set(compact('minerals'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Variation', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Variation->save($this->data)) {
				$this->Session->setFlash(__('The Variation has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'view/'.$id));
			} else {
				$this->Session->setFlash(__('The Variation could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Variation->read(null, $id);
		}
		$minerals = $this->Variation->Mineral->generateList();
		$this->set(compact('minerals'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Variation', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Variation->del($id)) {
			$this->Session->setFlash(__('Variation deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>