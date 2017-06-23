<?php
class CrystalSystemsController extends AppController {

	var $name = 'CrystalSystems';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');

	
	function index(){
	
		$lang = $this->Session->read('Config.language');
		$crystalSystemsWithSampleCount = $this->CrystalSystem->getCrystalSystemsSampleCount($lang);
		foreach ($crystalSystemsWithSampleCount AS $index => $crystalSystem){
			$minerals = $this->CrystalSystem->findMineralNames($crystalSystem['CrystalSystem']['id'], $lang);
			$crystalSystemsWithSampleCount[$index]['Minerals'] = $minerals;
		}
		
		$this->set('crystal_systems', $crystalSystemsWithSampleCount);
	    $this->set('lang', $lang);
	
	}
	
	function admin_index() {
		$this->CrystalSystem->recursive = 0;
		$this->set('crystalSystems', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid CrystalSystem.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('crystalSystem', $this->CrystalSystem->read(null, $id));
		$this->set('samples', $this->CrystalSystem->getRelatedSamples($id));
		$this->set('sample_count', $this->CrystalSystem->getSamplesCount($id));
	    $this->set('mineral_count', $this->CrystalSystem->Mineral->find('count', array('conditions' => array('Mineral.crystal_system_id' => $id))));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CrystalSystem->create();
			if ($this->CrystalSystem->save($this->data)) {
				$this->Session->setFlash(__('The CrystalSystem has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->CrystalSystem->id));
			} else {
				$this->Session->setFlash(__('The CrystalSystem could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid CrystalSystem', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->CrystalSystem->save($this->data)) {
				$this->Session->setFlash(__('The CrystalSystem has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The CrystalSystem could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CrystalSystem->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for CrystalSystem', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->CrystalSystem->del($id)) {
			$this->Session->setFlash(__('CrystalSystem deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>