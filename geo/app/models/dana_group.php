<?php
class DanaGroup extends AppModel {

	var $name = 'DanaGroup';
		
	var $hasMany = array(
					 'Mineral' => array(
						 'className' => 'Mineral',
						 'foreignKey' => 'dana_group_id',
						 'dependent'=> false)
	);
	
	var $validate = array(
		'name_eng' => array('rule' => array('minLength', 1) ),
		'name_gr' => array('rule' => array('minLength', 1) ),
		
	);
	
	
	function generateList(){
	
		$danaGroupList = $this->find('all', 
			array('fields' => array('id', 'name_gr', 'name_eng') , 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $danaGroupList,
			'{n}.DanaGroup.id',
			 array('%s | %s', '{n}.DanaGroup.name_gr', '{n}.DanaGroup.name_eng')
	    ); 
		
		return $list;
	
	}
	
	function getRelatedSamples($id){
	
		$query = 'SELECT * FROM samples As Sample 
				  LEFT JOIN minerals AS Mineral ON Sample.mineral_id=Mineral.id
				  LEFT JOIN dana_groups as DanaGroup ON Mineral.dana_group_id=DanaGroup.id
				  WHERE DanaGroup.id = '.$id;
		
		return $this->query($query);
	
	}
	
	function getSamplesCount($id){
	
		$query = 'SELECT count(*) AS SampleCount FROM samples As Sample 
				  LEFT JOIN minerals AS Mineral ON Sample.mineral_id=Mineral.id
				  LEFT JOIN dana_groups as DanaGroup ON Mineral.dana_group_id=DanaGroup.id
				  WHERE DanaGroup.id = '.$id;
		
		return $this->query($query);
	
	}
	
		//used in the front-end (serach minerals by dana group)
		function getDanaGroupsSampleCount($lang = 'gr'){
	
		$query_text = "SELECT DanaGroup.id, DanaGroup.name_$lang, count( Sample.id ) AS samplesCount
					   FROM samples AS Sample INNER JOIN minerals AS Mineral ON ( `Sample`.`mineral_id` = `Mineral`.`id` )
					   INNER JOIN dana_groups AS DanaGroup ON ( `Mineral`.`dana_group_id` = `DanaGroup`.`id` )
					   GROUP BY DanaGroup.id
					   ORDER BY DanaGroup.id";
		
		 return $this->query($query_text);
	
	}
	
	function findMineralNames($id, $lang = 'gr'){
	
	$query_text = "Select Sample.id, Sample.name_$lang, count(Sample.id) AS count
				   FROM samples AS Sample LEFT JOIN minerals AS Mineral ON ( `Sample`.`mineral_id` = `Mineral`.`id` )
				   LEFT JOIN dana_groups AS DanaGroup ON ( `Mineral`.`dana_group_id` = `DanaGroup`.`id` )
				   WHERE `DanaGroup`.`id` = $id
				   GROUP BY Sample.name_$lang
				   ORDER BY Sample.name_$lang";
				
		 return $this->query($query_text);
	}


}
?>