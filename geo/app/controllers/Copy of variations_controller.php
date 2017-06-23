<?php
class VariationsController extends AppController {

	var $name = 'Variations';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime', 'Javascript', 'Ajax');
	
	var $components = array('RequestHandler');
	
	
	function admin_index() {

    $this->set('minerals', $this->Variation->Mineral->generateList());

  	}

	
	function admin_update_select() {
	
	  if(!empty($this->data['Sample']['mineral_id'])) {
	
		$mineral_id = $this->data['Sample']['mineral_id'];
	
		$options = $this->Variation->generateList($mineral_id);
	
		$this->set('options', $options);
	
	  }

}

}
?>