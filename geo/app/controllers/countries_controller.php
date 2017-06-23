<?php
class CountriesController extends AppController {

	var $name = 'Countries';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');


	function index(){
		$lang = $this->Session->read('Config.language');
		$countriesCount = $this->Country->getCountriesSampleCount($lang);
		if(isset($this->params['requested'])) {
             $countriesCount['lang'] = $lang;
			 return $countriesCount;
        } 
		$this->set('countries', $countriesCount);
	    $this->set('lang', $lang);
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Country.', true), 'default', array('class' => 'warning_msg'));;
			$this->redirect(array('action'=>'index'));
		}
		$this->Country->recursive = 2;
		$this->set('country', $this->Country->read(null, $id));
		$this->set('versionInfo', $this->Country->Sample->Attachment->versions);
		$this->set('lang', $this->Session->read('Config.language'));

	}

	
	function admin_index() {
		$this->Country->recursive = 0;
		$this->set('countries', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Country.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('country', $this->Country->read(null, $id));
		$this->set('sample_count', $this->Country->Sample->find('count', array('conditions' => array('Sample.country_id' => $id))));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Country->create();
			if ($this->Country->save($this->data)) {
				$this->Session->setFlash(__('The Country has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->Country->id));
			} else {
				$this->Session->setFlash(__('The Country could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Country', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Country->save($this->data)) {
				$this->Session->setFlash(__('The Country has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Country could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Country->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Country', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Country->del($id)) {
			$this->Session->setFlash(__('Country deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>