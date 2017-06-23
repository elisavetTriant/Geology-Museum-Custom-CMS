<?php
class Attachment extends AppModel {

	var $name = 'Attachment';
	
	var $validate = array(
		'filename' => array('rule' => array('minLength', 5) ),
		
	);
	
	var $belongsTo = array(
        'Sample' => array(
            'className'    => 'Sample',
            'foreignKey'    => 'foreign_key',
			'conditions' => array('Attachment.model' => 'samples')
        ),
    );  

	var $versions = array(
		'Thumbnail'=> array(
			'width' => '150',
			'prefix' => 'w150-'
		),
		'Medium' => array(
			'width' => '400',
			'prefix' => 'w400-'
		),
		'Large' => array(
			'width' => '600',
			'prefix' => 'w600-'
		),
	);
	
	
	var $filesPath = array (
		'default' => 'files/',
		'samples' => 'files/samples/',
		'articles' => 'files/articles/',
	);


	var $validateFile = array(
                          'size' => 1572864, //1.5 MB
                          'mimetype' => array('image/jpeg', 
						  					  'image/jpg', 
											  'image/pjpeg',  
											  'image/gif', 
											  'image/png', 
											  'image/bmp',
											  'image/x-bmp', 
											 // 'application/x-zip-compressed',
											 // 'application/zip',
											 // 'application/pdf', 
											 // 'application/vnd.ms-powerpoint', 
											 // 'application/vnd.ms-excel', 
											 // 'application/msword',
											 // 'text/plain',
											  )
                          );

	
	function afterFind($results) {
			
			foreach ($results as $key => $val) {
				
				if (isset($val['Attachment']['model'])) {
					$results[$key]['Attachment']['path']= '/files/'.$val['Attachment']['model'].'/'.$val['Attachment']['foreign_key'].'/';
				}

				$i = 0; //we have more than one (the find comes from an association)
				if (isset($val['Attachment'][$i])){
					for ($i = 0; $i < count($val['Attachment']); $i++){
						$results[$key]['Attachment'][$i]['path'] = '/files/'.$val['Attachment'][$i]['model'].'/'.$val['Attachment'][$i]['foreign_key'].'/';	
					}
				}				
				
			}
			
			return $results;
	}


	function getRelatedAttachments($model, $foreign_key){				
							
	$params =    array(
				   'conditions' => array('Attachment.foreign_key' => $foreign_key, 'Attachment.model' => $model ), //array of conditions
				   'recursive' => 0, //int
    );
	
	return $attachments = $this->find('all', $params);
	
	}
	
	function getFilename($id){
		
		 $params = array(
			'conditions' => array('Attachment.id' => $id), //array of conditions
			'fields' => array('Attachment.filename'), //array of field names
   		);

		$attachment = $this->find('first', $params);
		return $attachment['Attachment']['filename'];
	
	}
	
	
	function getPath($id){
		
		 $params = array(
			'conditions' => array('Attachment.id' => $id), //array of conditions
			'fields' => array('Attachment.model', 'Attachment.foreign_key' ), //array of field names
   		);

		$attachment = $this->find('first', $params);
		if ($attachment['Attachment']['model']!= NULL)
			return WWW_ROOT.$this->filesPath[$attachment['Attachment']['model']].$attachment['Attachment']['foreign_key'].DS;
		else
			return WWW_ROOT.$this->filesPath['default'];
	
	}
	
}
?>