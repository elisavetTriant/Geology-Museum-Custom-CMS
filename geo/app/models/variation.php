<?php
class Variation extends AppModel {

	var $name = 'Variation';
	
	var $validate = array(
		'name_eng' => array('rule' => array('minLength', 1) ),
		'name_gr' => array('rule' => array('minLength', 1) ),
		
	);
		
	var $belongsTo = array(
					'Mineral' => array(
							'className' => 'Mineral',
							'foreignKey' => 'mineral_id',
							)
					);
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'variation_id',
						 'dependent'=> false),
	);
	
	
	function generateList($mineral_id = NULL){
	
		if ($mineral_id)
			$conditions =  array('mineral_id' => $mineral_id);
		else
			$conditions = array();
			
		$variationList = $this->find('all', 
			array('fields' => array('id', 'name_gr', 'name_eng'), 'conditions'=> $conditions, 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $variationList,
			'{n}.Variation.id',
			 array('%s | %s', '{n}.Variation.name_gr','{n}.Variation.name_eng' )
	    ); 
		
		return $list;
	
	}
	//expects an array of variation records (sent through the Mineral.add, Mineral.edit forms) and the id of the related mineral record
	//expected array format: "Variation.{$i}.field_name
	function saveMineralVariations($variationRecords = array(), $mineral_id){

		foreach($variationRecords as $index => $variationRecord) {
			
			$variation = array('Variation' => $variationRecord);	
				
			if (array_key_exists('id', $variation['Variation'])) {//this function has been called from the Mineral.edit form
	
					if (!empty($variation['Variation']['id'])) { //it's an update or delete
						
						if ( empty($variation['Variation']['name_gr']) && empty($variation['Variation']['name_eng'])) {
							$this->del($variation['Variation']['id']);
						} else {
							$this->id = $variation['Variation']['id'];
							$this->set($variation);
							$this->save();
						}
					}
					
				     if (empty($variation['Variation']['id']) && (!empty($variation['Variation']['name_gr']) || !empty($variation['Variation']['name_eng'])) ) { //this is a new variation record!
						$this->create();
						$variation['Variation']['mineral_id'] = $mineral_id;
						$this->set($variation);
						$this->save();
					}
						
			} else { //this function has been called from the Sample.add form
					if (!empty($variation['Variation']['name_gr']) || !empty($variation['Variation']['name_eng']) ) {
						$this->create();
						$variation['Variation']['mineral_id'] = $mineral_id;
						$this->set($variation);
						$this->save();
					}
					
			}
	
		 }//end foreach
	
	}//end function
}
?>