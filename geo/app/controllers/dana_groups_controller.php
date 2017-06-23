<?php
class DanaGroupsController extends AppController {

	var $name = 'DanaGroups';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');

	
	function index(){
	
		$lang = $this->Session->read('Config.language');
		
		$danaGroupsWithSampleCount = $this->DanaGroup->getDanaGroupsSampleCount($lang);
		foreach ($danaGroupsWithSampleCount  AS $index => $danaGroup){
			$minerals = $this->DanaGroup->findMineralNames($danaGroup['DanaGroup']['id'], $lang);
			$danaGroupsWithSampleCount[$index]['Minerals'] = $minerals;
		}
		
		$this->set('dana_groups', $danaGroupsWithSampleCount);
	    $this->set('lang', $lang);
	
	}
	
	function admin_index() {
		$this->DanaGroup->recursive = 0;
		$this->set('danas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Dana.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('dana', $this->DanaGroup->read(null, $id));
		$this->set('samples', $this->DanaGroup->getRelatedSamples($id));
		$this->set('sample_count', $this->DanaGroup->getSamplesCount($id));
	    $this->set('mineral_count', $this->DanaGroup->Mineral->find('count', array('conditions' => array('Mineral.dana_group_id' => $id))));

	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->DanaGroup->create();
			if ($this->DanaGroup->save($this->data)) {
				$this->Session->setFlash(__('The Dana Group has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->DanaGroup->id));
			} else {
				$this->Session->setFlash(__('The Dana Group could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Dana Group', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->DanaGroup->save($this->data)) {
				$this->Session->setFlash(__('The Dana Group has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Dana Group could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DanaGroup->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Dana Group', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->DanaGroup->del($id)) {
			$this->Session->setFlash(__('Dana Group deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>