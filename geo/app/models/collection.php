<?php
class Collection extends AppModel {

	var $name = 'Collection';
	
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'collection_id',
						 'dependent'=> false)
	);
	
	var $validate = array(
		'name' => array('rule' => array('minLength', 1) ),
		
	);
	
	
	//called in order to create the front-end list of collections: collection.name(sample count)
	function getCollectionsSampleCount(){
	
		$query_text = "SELECT Collection.id, Collection.name, count( Sample.id ) AS samplesCount
					   FROM samples AS Sample INNER JOIN collections AS Collection ON ( Sample.collection_id = Collection.id )
					   GROUP BY Collection.name
					   ORDER BY samplesCount DESC";
		
		 return $this->query($query_text);
	
	}
	
	
	function generateList(){
	
		$collectionList = $this->find('all', 
			array('fields' => array('id', 'name') , 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $collectionList,
			'{n}.Collection.id',
			 array('%s', '{n}.Collection.name')
	    ); 
		
		return $list;
	
	}

}
?>