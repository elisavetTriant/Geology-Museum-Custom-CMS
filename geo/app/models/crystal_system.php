<?php
class CrystalSystem extends AppModel {

	var $name = 'CrystalSystem';
		
	var $hasMany = array(
					 'Mineral' => array(
						 'className' => 'Mineral',
						 'foreignKey' => 'crystal_system_id',
						 'dependent'=> false)
	);
	
	var $validate = array(
		'name_eng' => array('rule' => array('minLength', 1) ),
		'name_gr' => array('rule' => array('minLength', 1) ),
		
	);
	
	function generateList(){
	
		$crystalList = $this->find('all', 
			array('fields' => array('id', 'name_gr', 'name_eng'), 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $crystalList,
			'{n}.CrystalSystem.id',
			 array('%s | %s', '{n}.CrystalSystem.name_gr', '{n}.CrystalSystem.name_eng')
	    ); 
		
		return $list;
	
	}
	
	//used in the back-end
	function getRelatedSamples($id){
	
		$query = 'SELECT * FROM samples As Sample 
				  LEFT JOIN minerals AS Mineral ON Sample.mineral_id=Mineral.id
				  LEFT JOIN crystal_systems as CrystalSystem ON Mineral.crystal_system_id=CrystalSystem.id
				  WHERE CrystalSystem.id = '.$id;
		
		return $this->query($query);
	
	}
	
	//used in the back-end to retrieve the number of records
	function getSamplesCount($id){
	
		$query = 'SELECT count(*) AS SampleCount FROM samples As Sample  
				  LEFT JOIN minerals AS Mineral ON Sample.mineral_id=Mineral.id
				  LEFT JOIN crystal_systems as CrystalSystem ON Mineral.crystal_system_id=CrystalSystem.id
				  WHERE CrystalSystem.id = '.$id;
		
		return $this->query($query);
	
	}
	
	//used in the front-end (serach minerals by crystal system)
	//returns an array of the crystal system and nuber of records
		function getCrystalSystemsSampleCount($lang = 'gr'){
	
		$query_text = "SELECT CrystalSystem.id, CrystalSystem.name_$lang, count( Sample.id ) AS samplesCount
					   FROM samples AS Sample INNER JOIN minerals AS Mineral ON ( `Sample`.`mineral_id` = `Mineral`.`id` )
					   INNER JOIN crystal_systems AS CrystalSystem ON ( `Mineral`.`crystal_system_id` = `CrystalSystem`.`id` )
					   GROUP BY CrystalSystem.name_$lang
					   ORDER BY CrystalSystem.name_$lang";
		
		 return $this->query($query_text);
	
	}
	
	function findMineralNames($id, $lang = 'gr'){
	
	$query_text = "Select Sample.id, Sample.name_$lang, count(Sample.id) AS count
				   FROM samples AS Sample LEFT JOIN minerals AS Mineral ON ( `Sample`.`mineral_id` = `Mineral`.`id` )
				   LEFT JOIN crystal_systems AS CrystalSystem ON ( `Mineral`.`crystal_system_id` = `CrystalSystem`.`id` )
				   WHERE `CrystalSystem`.`id` = $id
				   GROUP BY Sample.name_$lang
				   ORDER BY Sample.name_$lang";
				
		 return $this->query($query_text);
	}

}
?>