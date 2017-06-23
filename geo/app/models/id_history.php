<?php
class IdHistory extends AppModel {

	var $name = 'IdHistory';
	
	var $belongsTo = array('Sample');
	
	
	
	
	//expects an array of history records (sent through the Sample.add, Sample.edit forms) and the id of the related sample record
	//expected array format: "IdHistory.{$i}.field_name
	function saveSamplesHistories($historyRecords = array(), $sample_id){

		foreach($historyRecords as $index => $codeHistory) {
			
			$idHistory = array('IdHistory' => $codeHistory);	
				
			if (array_key_exists('id', $idHistory['IdHistory'])) {//this function has been called from the Sample.edit form
	
					if (!empty($idHistory['IdHistory']['id'])) { //it's an update or delete
						
						if ( empty($idHistory['IdHistory']['old_code'])) {
							$this->del($idHistory['IdHistory']['id']);
						} else {
							$this->set($idHistory);
							$this->save();
						}
					}
					
				     if (empty($idHistory['IdHistory']['id']) && !empty($idHistory['IdHistory']['old_code'])) { //this is a new history record!
						$this->create();
						$idHistory['IdHistory']['sample_id'] = $sample_id;
						$this->set($idHistory);
						$this->save();
					}
						
			} else { //this function has been called from the Sample.add form
					if (!empty($idHistory['IdHistory']['old_code'])) {
						$this->create();
						$idHistory['IdHistory']['sample_id'] = $sample_id;
						$this->set($idHistory);
						$this->save();
					}
					
			}
	
		 }//end foreach
	
	}//end function

}

?>