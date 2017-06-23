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
		'height' => array('rule' => 'numeric', 'allowEmpty' => true),
		'width' => array('rule' => 'numeric', 'allowEmpty' => true),
		'length' => array('rule' => 'numeric', 'allowEmpty' => true),
		'acquisition_date' => array('rule' => 'date'),
		
);

	
	
	function beforeSave() {
		
		  if (isset($this->data['Sample']['id'])){//this is a call from admin_edit
		 	//now find this sample's saved mineral_id
			$sample_data = $this->find('first', array('conditions'=>array('Sample.id'=>$this->data['Sample']['id'])));
			$saved_mineral_id = $sample_data['Sample']['mineral_id'];
			if ($saved_mineral_id != $this->data['Sample']['mineral_id']) //then the mineral has been changed, generate new code!			
			 	$this->data['Sample']['new_code'] = $this->generateNewCode($this->data['Sample']['mineral_id']);
		  }
		  else //this is a call from admin_add
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
		
		$countArray = $this->query("SELECT MAX(cast(Substring( `new_code` , instr( new_code, '_' ) +1, Char_length( new_code )) AS UNSIGNED))
									AS count FROM `samples`AS Sample WHERE new_code LIKE '$danaCode%'");
		if  (!empty($countArray[0][0]['count']))
			$count = intval($countArray[0][0]['count'])+1;
		else
			$count = 1;
				
		return $danaCode.'_'.$count;
	
	}
	
	function getRelatedSamples($sample_id, $mineral_id){
	
		return $relatedSamplesList = $this->find('all', 
			array('conditions'=> array('Sample.mineral_id' => "$mineral_id", 'Sample.id <>'=>"$sample_id", 'Sample.active' =>'1'), 'recursive' =>1)
	     );	
	
	}
	
	function getAlphabeticalSamples($lang = 'gr'){
	
		$alphabet = array(
			'gr' => array('α', 'β', 'γ', 'δ', 'ε', 'ζ', 'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω'),
			'eng' => array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 	'q', 'r', 's', 't', 	'u', 'v', 'w', 'x', 'y','z')
		);
		
		foreach ($alphabet[$lang] as $key){
			$result[$key] = $this->query("SELECT Sample.id, Sample.name_$lang FROM samples as Sample WHERE name_$lang Like '$key%' AND Sample.active =1 group by name_$lang");
		}
		
		return $result;
	}
	
	function getDisplayCaseSamples(){
	
	  $query_text = "SELECT *
				   FROM Samples AS Sample
				   WHERE active = '1' && exhibition = '1'
				   LIMIT 32
				   ";
		 
	  $samples =  $this->query($query_text);
	  
	  foreach ($samples as $key => $sample){
	  			
		$attachments = $this->Attachment->getRelatedAttachments('samples', $sample['Sample']['id']);
	    $samples[$key]['Attachment'] = $attachments;
	  
	  }
	  
	 
	  return $samples;
	
	}
	
}
?>