<?php
class Sample extends AppModel {

	var $name = 'Sample';
		
	var $hasAndBelongsToMany = array(
                        'AssociateMineral' => array(
                         'className' => 'Mineral',
                         'joinTable' => 'minerals_samples',
                         'foreignKey' => 'sample_id',
                         'associationForeignKey' => 'mineral_id',
                         'unique' => true
                        )
     ); 
	
	var $hasMany = array(
					 'IdHistory' => array(
						 'className' => 'IdHistory',
						 'foreignKey' => 'sample_id',
						 'dependent'=> true),
					'Attachment' => array(
						'className'=>'Attachment',
						'foreignKey' => 'foreign_key',
						'conditions' => array('Attachment.model' => 'samples'),
						'dependent'=> true
				
				)
	); 
	var $belongsTo = array(
					'Country' => array(
							'className' => 'Country',
							'foreignKey' => 'country_id'
							),
					'Mineral' => array(
							'className' => 'Mineral',
							'foreignKey' => 'mineral_id'
							),
					'Variation' => array(
							'className' => 'Variation',
							'foreignKey' => 'variation_id'
							),
					'Collection' => array(
							'className' => 'Collection',
							'foreignKey' => 'collection_id'
							),		
					'Estimation' => array(
							'className' => 'Estimation',
							'foreignKey' => 'estimation_id'
							),
					'User' => array(
							'className' => 'User',
							'foreignKey' => 'user_id'
							)
					 
	 ); 
	
	var $validate = array(
		'name' => array('rule' => array('minLength', 1) ),
		'height' => array('rule' => 'numeric', 'allowEmpty' => true),
		'width' => array('rule' => 'numeric', 'allowEmpty' => true),
		'length' => array('rule' => 'numeric', 'allowEmpty' => true),
		'acquisition_date' => array('rule' => 'date'),
		
);

	
	
	function beforeSave() {
		
		  $this->data['Sample']['new_code'] = $this->generateNewCode($this->data['Sample']['mineral_id']);
		  $names = $this->Mineral->getNames($this->data['Sample']['mineral_id']);
		  $this->data['Sample']['name_gr'] = $names['name_gr'];
		  $this->data['Sample']['name_eng'] = $names['name_eng'];
		 
		return true;
	
	}

    /*Gets the (selected from the add form )mineral_id
	   Asks Mineral Model to retrieve: Dana Code for that mineral
	   Gets Count of Samples with that mineral_id
	   Concats this data to create the new code: DanaCode_Count+1
	*/
	
	function generateNewCode($mineral_id){
		
		$danaCode = $this->Mineral->getDanaCode($mineral_id);
		
		$count = $this->findCount(array('mineral_id' => $mineral_id), -1);
		
		return $danaCode.'_'.($count+1);
	
	}
	
	function getRelatedSamples($sample_id, $mineral_id){
	
		return $relatedSamplesList = $this->find('all', 
			array('conditions'=> array('Sample.mineral_id' => "$mineral_id", 'Sample.id <>'=>"$sample_id"), 'recursive' =>1)
	     );	
	
	}
	
	function getAlphabeticalSamples($lang = 'gr'){
	
		$alphabet = array(
			'gr' => array('α', 'β', 'γ', 'δ', 'ε', 'ζ', 'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω'),
			'eng' => array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 	'q', 'r', 's', 't', 	'u', 'v', 'w', 'x', 'y','z')
		);
		
		foreach ($alphabet[$lang] as $key){
			$result[$key] = $this->query("SELECT Sample.id, Sample.name_$lang FROM samples as Sample WHERE name_$lang Like '$key%' group by name_$lang");
		}
		
		return $result;
	}
	
}
?>