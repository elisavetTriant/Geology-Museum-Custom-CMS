<?php
class CollectionsController extends AppController {

	var $name = 'Collections';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');
	var $paginate = array('Collection'=>array( 'limit' => 10,
											    'order' => array(
												'Collection.modified' => 'ASC')
												)
						);


	function index(){
		$collectionsCount =  $this->Collection->getCollectionsSampleCount();
		
		if(isset($this->params['requested'])) {
             return $collectionsCount;
        } 
		
		$this->set('collections', $collectionsCount);
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Collection.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Collection->recursive = 2;
		$this->set('collection', $this->Collection->read(null, $id));
		$this->set('versionInfo', $this->Collection->Sample->Attachment->versions);
		$this->set('lang', $this->Session->read('Config.language'));

	}
	
	function admin_index() {
		$this->Collection->recursive = 0;
		$this->set('collections', $this->paginate('Collection'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Collection.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('collection', $this->Collection->read(null, $id));
		$this->set('sample_count', $this->Collection->Sample->find('count', array('conditions' => array('Sample.collection_id' => $id))));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Collection->create();
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The Collection has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$this->Collection->id));
			} else {
				$this->Session->setFlash(__('The Collection could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Collection', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The Collection has been saved', true), 'default', array('class' => 'confirmation_msg'));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Collection could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Collection', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Collection->del($id)) {
			$this->Session->setFlash(__('Collection deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>