<?php
class MineralsController extends AppController {

	var $name = 'Minerals';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime', 'Javascript', 'Ajax');


	function admin_filter(){
		if (!empty($this->data)) {
			$name = $this->data['Mineral']['name'];
			$dana_code = $this->data['Mineral']['dana_code'];
			$conditionString = '';
			if (!empty($name))
				$conditionString = 'Mineral.name_gr LIKE ' ."'$name%'". ' OR ' .'Mineral.name_eng LIKE '."'$name%'";
			if (!empty($dana_code) && !empty($conditionString))
				$conditionString = $conditionString.' OR '.'Mineral.dana_code LIKE '."'$dana_code%'";
			else if (!empty($dana_code))
				$conditionString = 'Mineral.dana_code LIKE '."'$dana_code%'";	
			if (empty($conditionString))
				$conditionString = '1 = 1';	
			
			$queryText = "SELECT `Mineral`.`id`, `Mineral`.`dana_code`, `Mineral`.`name_gr`, `Mineral`.`name_eng`, `Mineral`.`chem_formula`, `Mineral`.`crystal_system_id`, `Mineral`.`dana_group_id`, `Mineral`.`created`, `Mineral`.`modified`, `Mineral`.`active`, `Mineral`.`user_id`, `CrystalSystem`.`id`, `CrystalSystem`.`name_gr`, `CrystalSystem`.`name_eng`, `CrystalSystem`.`created`, `CrystalSystem`.`modified`, `DanaGroup`.`id`, `DanaGroup`.`name_gr`, `DanaGroup`.`name_eng`, `DanaGroup`.`created`, `DanaGroup`.`modified`, `DanaGroup`.`deleted` FROM `minerals` AS `Mineral` LEFT JOIN `crystal_systems` AS `CrystalSystem` ON (`Mineral`.`crystal_system_id` = `CrystalSystem`.`id`) LEFT JOIN `dana_groups` AS `DanaGroup` ON (`Mineral`.`dana_group_id` = `DanaGroup`.`id`) WHERE ".$conditionString;
			$result = $this->Mineral->query($queryText);
			$this->set('minerals', $result);
		}			
	
	}

	function admin_index() {
		
		$this->paginate = array('conditions'=>array('Mineral.active'=>1 ), 'order' => array('Mineral.modified' => 'DESC'), 'recursive'=>0);
		$this->set('minerals', $this->paginate());
		
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Mineral.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		
		$mineral = $this->Mineral->read(null, $id);
		$sample_count = count($mineral['Sample']);
		$variation_count = count($mineral['Variation']);
		$this->set('mineral', $mineral);
		$this->set('sample_count', $sample_count);
		$this->set('variation_count', $variation_count);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Mineral->create();
			if ($this->Mineral->save($this->data)) {
				
				//save associate variation records
			    $mineral_id = $this->Mineral->id;
				$this->Mineral->Variation->saveMineralVariations($this->data['Variation'], $mineral_id);
				$this->Session->setFlash(__('The Mineral has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->Mineral->id));
			} else {
				$this->Session->setFlash(__('The Mineral could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		
		if (empty($this->data)) {
			$this->data['Mineral']['active'] = 1;
		}
		$crystalSystems = $this->Mineral->CrystalSystem->generateList();
		$danaGroups = $this->Mineral->DanaGroup->generateList();
		$this->set(compact('crystalSystems', 'danaGroups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Mineral', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Mineral->save($this->data)) {
				//save associate variation records
			    $mineral_id = $this->data['Mineral']['id'];
				$this->Mineral->Variation->saveMineralVariations($this->data['Variation'], $mineral_id);
				$this->Session->setFlash(__('The Mineral has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Mineral could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mineral->read(null, $id);
		}
		$crystalSystems = $this->Mineral->CrystalSystem->generateList();
		$danaGroups = $this->Mineral->DanaGroup->generateList();
		$this->set(compact('crystalSystems', 'danaGroups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Mineral', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Mineral->del($id)) {
			$this->Session->setFlash(__('Mineral deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>