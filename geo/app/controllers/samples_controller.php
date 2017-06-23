<?php
class SamplesController extends AppController {

	var $name = 'Samples';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime', 'Javascript', 'Ajax');
	 var $paginate = array(
			 'limit' => 25,
			 'conditions' => array('Sample.active' => '1'),
			 'order' => array(
			 'Sample.modified' => 'DESC'
			 )
		);
	
	var $components = array('RequestHandler');

	
	function displayCase() {
		$this->set('samples', $this->Sample->getDisplayCaseSamples());
	    $this->set('versionInfo', $this->Sample->Attachment->versions);
		$this->set('lang', $this->Session->read('Config.language'));

	}
	
	function index() {
		$this->Sample->recursive = 1;
		$this->paginate= array('limit' => 32, 'conditions' => array('Sample.active' => '1'),'order' => array('Sample.modified' => 'DESC'));
		$this->set('samples', $this->paginate());
		$this->set('versionInfo', $this->Sample->Attachment->versions);
	    $this->set('lang', $this->Session->read('Config.language'));

	}
	
	function perCountry($country_id) {
		$this->paginate = array('conditions'=>array('Sample.country_id'=>$country_id, 'Sample.active' => '1'), 'order' => array('Sample.modified' => 'DESC'), 'recursive'=>1);
		$this->set('samples', $this->paginate());
	    $this->set('lang', $this->Session->read('Config.language'));
		$this->set('versionInfo', $this->Sample->Attachment->versions); 

	}
	
	function perCollection($collection_id) {
		$this->paginate = array('conditions'=>array('Sample.collection_id'=>$collection_id, 'Sample.active' => '1' ), 'order' => array('Sample.modified' => 'DESC'), 'recursive'=>1);
		$this->set('samples', $this->paginate());
	    $this->set('lang', $this->Session->read('Config.language'));
		$this->set('versionInfo', $this->Sample->Attachment->versions); 

	}
	
	function alphabetical() {
		$lang = $this->Session->read('Config.language');
		$this->set('samples', $this->Sample->getAlphabeticalSamples($lang));
	    $this->set('lang', $lang);

	}

	function display($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sample.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		$sample =  $this->Sample->read(null, $id);
		$sampleMineralId= $sample['Sample']['mineral_id'] ;
		
		$this->set('sample', $sample);
		$this->set('relatedSamples', $this->Sample->getRelatedSamples($id, $sampleMineralId));
		$sampleCrystalSystemId = $sample['Mineral']['crystal_system_id'];
		$this->Sample->Mineral->CrystalSystem->recursive = -1;
		$crystalSystem= $this->Sample->Mineral->CrystalSystem->read(null, $sampleCrystalSystemId);
		$this->set('crystalSystem', $crystalSystem['CrystalSystem']);
		$this->set('versionInfo', $this->Sample->Attachment->versions); //we're gonna show only thumbnails + medium version
		$this->set('lang', $this->Session->read('Config.language'));
	}

	function admin_filter() {
		if (!empty($this->data)){
			$name_gr = $this->data['Sample']['name_gr'];
			$name_eng = $this->data['Sample']['name_eng'];
			$dana_code = $this->data['Sample']['dana_code'];
			$variation = $this->data['Sample']['variation_id'];
			$user = $this->data['Sample']['user_id'];
			$collection = $this->data['Sample']['collection_id'];
			$country = $this->data['Sample']['country_id'];
			$conditions= array();
			
			if (!empty($name_gr))
				$conditions['Sample.name_gr LIKE'] = "$name_gr%";
			if (!empty($name_eng))
				$conditions['Sample.name_eng LIKE'] = "$name_eng%";
			if (!empty($dana_code))
				$conditions['Sample.new_code LIKE'] = "$dana_code%";
			if (!empty($variation))
				$conditions['Sample.variation_id'] = $variation;
			if (!empty($user))
				$conditions['Sample.user_id'] = $user;
			if (!empty($collection))
				$conditions['Sample.collection_id'] = $collection;
			if (!empty($country))
				$conditions['Sample.country_id'] = $country;
			
			$samples = $this->Sample->findAll($conditions);
			$countSamples = count($samples);
			$this->set('samples',$samples);
			$this->set('countSamples', $countSamples);
			$this->set('versionInfo', $this->Sample->Attachment->versions);

		}
		
		$variations = $this->Sample->Variation->generateList();
		$users = $this->Sample->User->generateList();
		$collections = $this->Sample->Collection->generateList();
		$countries = $this->Sample->Country->generateList();
		$this->set(compact('variations', 'users', 'collections', 'countries'));
	}
	
	
	function admin_index() {
		$this->Sample->recursive = 1;
		$this->set('samples', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sample.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('sample', $this->Sample->read(null, $id));
		$this->set('thumbInfo', $this->Sample->Attachment->versions['Thumbnail']); //we're gonna show only thumbnails
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			$this->Sample->create();
			
			if ($this->Sample->save($this->data)) {
				//save associate code history records
			    $sample_id = $this->Sample->id;
				$this->Sample->IdHistory->saveSamplesHistories($this->data['IdHistory'], $sample_id);
				
				$this->Session->setFlash(__('The Sample has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$sample_id));
			} else {
				$this->Session->setFlash(__('The Sample could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		
		if (empty($this->data)){//now set the default values of the form
			$this->data['Sample']['exhibition'] = '1';
			$this->data['Sample']['active'] = '1';
		}
		
		$this->data['Sample']['user_id'] = $this->Auth->user('id'); //takes user info from the Session
		
		$minerals = $this->Sample->Mineral->generateList();
		$associateMinerals = $minerals;
		$countries = $this->Sample->Country->generateList();
		$collections = $this->Sample->Collection->generateList();
		$estimations = $this->Sample->Estimation->generateList();
		$this->set(compact('minerals', 'associateMinerals',  'variations', 'countries', 'collections', 'estimations'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Sample', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sample->save($this->data)) {
				$this->Sample->IdHistory->saveSamplesHistories($this->data['IdHistory'], $this->data['Sample']['id']);
				$this->Session->setFlash(__('The Sample has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Sample could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sample->read(null, $id);
		}
		$minerals = $this->Sample->Mineral->generateList();
		$associateMinerals = $minerals;
		$variations = $this->Sample->Variation->generateList($this->data['Sample']['mineral_id']);	
		$countries = $this->Sample->Country->generateList();
		$collections = $this->Sample->Collection->generateList();
		$estimations = $this->Sample->Estimation->generateList();
		
		$this->set(compact('minerals', 'associateMinerals', 'variations', 'current_variation','countries', 'collections', 'estimations'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sample', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}

		if ($this->Sample->del($id, true)) {
			$this->Session->setFlash(__('Sample deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>