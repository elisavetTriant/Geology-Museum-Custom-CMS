<?php
class Estimation extends AppModel {

	var $name = 'Estimation';
		
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'estimation_id',
						 'dependent'=> false)
	);
	
	var $validate = array(
		'name' => array('rule' => array('minLength', 1) ),
		
	);
	
	function generateList(){
	
		$estimationList = $this->find('all', 
			array('fields' => array('id', 'name'), 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $estimationList,
			'{n}.Estimation.id',
			 array('%s', '{n}.Estimation.name')
	    ); 
		
		return $list;
	
	}

}
?>