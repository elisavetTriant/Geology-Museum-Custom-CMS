<?php
class ImagesController extends AppController {

	var $name = 'Images';
	var $helpers = array('Html', 'Form', 'Menu');
	var $components  = array('Thumb');

	function index() {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Image.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}


	function admin_index() {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Image.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}

	 function admin_add(){
        if(!empty($this->data)){
            if($this->data['Image']['filename']['size']){
                pr($this->data);
                if(!$this->Thumb->generateThumb('thumbnail','Image')){
                    pr($this->Thumb->errors); 
                }            
            }
        }
		if (empty($this->data)){
			$this->data['Image']['model'] = Inflector::singularize($this->name);
		
		}
    } 
	

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Image', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The Image has been saved', true));
				$this->redirect(array('action'=>'admin_view/'.$id));
			} else {
				$this->Session->setFlash(__('The Image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
		$crystalSystems = $this->Image->CrystalSystem->generateList();
		$danaGroups = $this->Image->DanaGroup->generateList();
		$this->set(compact('crystalSystems', 'danaGroups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Image', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Image->del($id)) {
			$this->Session->setFlash(__('Mineral deleted', true));
			$this->redirect(array('action'=>'admin_index'));
		}
	}

}
?>