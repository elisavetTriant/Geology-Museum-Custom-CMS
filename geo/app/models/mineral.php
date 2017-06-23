<?php
class Mineral extends AppModel {

	var $name = 'Mineral';
		
	var $belongsTo = array(
					'CrystalSystem' => array(
							'className' => 'CrystalSystem',
							'foreignKey' => 'crystal_system_id'
							),
					'DanaGroup' => array(
							'className' => 'DanaGroup',
							'foreignKey' => 'dana_group_id'
							)
	);
	
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'mineral_id',
						 'dependent'=> false),
					 'Variation' => array(
						 'className' => 'Variation',
						 'foreignKey' => 'mineral_id',
						 'dependent'=> true)
	);
	
	var $validate = array(
		'name_eng' => array('rule' => array('minLength', 1)),
		'name_gr' => array('rule' => array('minLength', 1))
	);


	function generateList(){
	
		$mineralList = $this->find('all', 
			array('fields' => array('id', 'name_eng', 'name_gr') ,'conditions' => array('active' => '<> 0'), 'order' => array('name_gr' => 'ASC'), 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $mineralList,
			'{n}.Mineral.id',
			 array('%s | %s', '{n}.Mineral.name_gr', '{n}.Mineral.name_eng')
	    ); 
		
		return $list;
	
	}
	
	function generateFullList(){
	
		$mineralList = $this->find('all', 
			array('fields' => array('id', 'name_eng', 'name_gr') , 'order' => array('name_eng' => 'ASC'), 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $mineralList,
			'{n}.Mineral.id',
			 array('%s | %s', '{n}.Mineral.name_eng', '{n}.Mineral.name_gr')
	    ); 
		
		return $list;
	
	}
	
	
	function getDanaCode($mineral_id){
	
		$mineral = $this->find('first', 
			array('fields' => array('dana_code') ,'conditions' => array('id' => $mineral_id), 'recursive' =>-1)
	     );
	
		return $mineral['Mineral']['dana_code'];
		
	}
	
	function getNames($mineral_id){
	
		$mineral = $this->find('first', 
			array('fields' => array('name_gr', 'name_eng') ,'conditions' => array('id' => $mineral_id), 'recursive' =>-1)
	     );
	
		return $mineral['Mineral'];
		
	}
}
?>