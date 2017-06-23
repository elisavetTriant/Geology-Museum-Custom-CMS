<?php
class Country extends AppModel {

	var $name = 'Country';
		
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'country_id',
						 'dependent'=> false)
	);
	
	var $validate = array(
		'name_eng' => array('rule' => array('minLength', 1) ),
		'name_gr' => array('rule' => array('minLength', 1) ),
		
	);
	
	
	function getCountriesSampleCount($lang = 'gr'){
	
		$query_text = "SELECT Country.id, Country.name_$lang, count( Sample.id ) AS samplesCount
					   FROM samples AS Sample INNER JOIN countries AS Country ON ( `Sample`.`country_id` = `Country`.`id` )
					   GROUP BY Country.name_$lang
					   ORDER BY Country.name_$lang";
		
		 return $this->query($query_text);
	
	}
	
	
	function generateList(){
	
		$countryList = $this->find('all', 
			array('fields' => array('id', 'name_gr', 'name_eng') , 'order'=> 'name_gr','recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $countryList,
			'{n}.Country.id',
			 array('%s | %s', '{n}.Country.name_gr', '{n}.Country.name_eng')
	    ); 
		
		return $list;
	
	}

}
?>