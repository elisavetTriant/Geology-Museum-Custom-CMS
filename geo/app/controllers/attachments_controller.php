<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $helpers = array('Html', 'Form', 'Menu', 'MyTime');
	 var $paginate = array(
			 'limit' => 20,
			 'order' => array(
			 'Attachment.date_added' => 'DESC'
			 )
		);
	
	function admin_index() {
		$this->Attachment->recursive = 0;
		$this->set('attachments', $this->paginate());
		$this->set('thumbInfo', $this->Attachment->versions['Thumbnail']); //we're gonna show only thumbnails
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Attachment.', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
		$this->set('versions', $this->Attachment->versions);
	}


	function admin_add($model=NULL, $id=NULL) {
		if (empty($this->data)) {
			$this->Attachment->create();			
		}
		
		if (!empty($this->data)){
			
			$model=$this->data['Attachment']['model'];
			$id = $this->data['Attachment']['foreign_key'];
			//debug('File data before validates:'. print_r($this->data['Attachment']['filename']));
			
			if ($this->Attachment->validates()){
				//debug('It validateds!', true);
				
				$fileName = '';
				$error = '';
				
				$path = WWW_ROOT.$this->Attachment->filesPath['default'];
				 if ($model && $id){
				 	$path = WWW_ROOT.$this->Attachment->filesPath[$model];
   					App::import('Core', 'Folder');
            		$newFolder = new Folder;
					if ($newFolder->create($path.$id)){
						$path = $path.$id.'/';						
					}
				 
				 }
				 //debug('Path: '.$path);	
				 //debug('File data before file upload attempt:'. print_r($this->data['Attachment']['filename']));
				 		
				 if (!empty($this->data['Attachment']['filename']['name'])) {	 	  			  
					  $fileName = $this->data['Attachment']['filename']['name'];
					  $error = $this->handleFileUpload($this->data['Attachment']['filename'], $fileName, $path);	  
				} 
				
				//debug('File data after file upload attempt:'. print_r($this->data['Attachment']['filename']));				
				//debug('Error: '.$error);
				
				if (empty($error)){	  
					 $this->data['Attachment']['filename'] = $fileName;
					 //make versions
					 foreach($this->Attachment->versions as $version){
						$this->PImage->resizeImage('resize', $fileName, $path, $version['prefix'].$fileName, $version['width'], false, 90);
					}  
					if ($this->Attachment->save($this->data)){
						$this->Session->setFlash(__('The Attachment has been saved', true), 'default', array('class' => 'confirmation_msg'));
						$this->redirect(array('action'=>'index'));
					} else {
						$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.'.$error , true), 'default', array('class' => 'error_msg'));
					}  
				} else {
				  $this->Attachment->set($this->data);
				  $this->Session->setFlash(__('The Attachment could not be saved. Error: <br />'.$error , true), 'default', array('class' => 'error_msg'));
				}
			}
		}
		 if ($model && $id){
				$this->data['Attachment']['model'] =  $model;
				$this->data['Attachment']['foreign_key'] =  $id;
		}else{
			$model = '';
			$id = '';
		}
		$models = array('samples'=>'Sample', 'articles'=>'Article');
		$this->set(compact('models'));
		
		if ($model == 'samples')
			$sample = $this->Attachment->Sample->find('first', array('conditions' => array('Sample.id'=> $id)));
		
		$this->set(compact('sample'));
		
		
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Attachment', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}
		
		
		if (!empty($this->data)) {
					
			$error = '';
			//debug('File data before file upload attempt:'.print_r($this->data['Attachment']['file']));
			
			//we have an attempt to upload a new image
			if (!empty($this->data['Attachment']['file']['name'])) {
					  
				//make path and folder if not exists
				$model=$this->data['Attachment']['model'];
				$sample_id = $this->data['Attachment']['foreign_key'];
				
				$path = WWW_ROOT.$this->Attachment->filesPath[$model];
				App::import('Core', 'Folder');
            	$newFolder = new Folder;
				if ($newFolder->create($path.$sample_id)){
						$path = $path.$sample_id.'/';						
				}
				
				$fileName = $this->data['Attachment']['file']['name'];
				$error = $this->handleFileUpload($this->data['Attachment']['file'], $fileName, $path);	  
				
				if (empty($error)){	
					//new filename to save in the database
					$this->data['Attachment']['filename'] = $fileName;
					//make versions
					 foreach($this->Attachment->versions as $version){
						$this->PImage->resizeImage('resize', $fileName, $path, $version['prefix'].$fileName, $version['width'], false, 90);
					 }  
				}else { //error naot empty. Set the data that was passed from the form back to the view and show the appr. message
				  $this->Attachment->set($this->data);
				  $this->Session->setFlash(__('The Attachment could not be saved. Error: <br />'.$error , true), 'default', array('class' => 'error_msg'));
				}
			}//end attempt to update the image file 
			
			//if empty error: it is empty when a) new file upload haven't taken place or b) has taken place and everything is OK
			if (empty($error)){
				//attempt to save the data
				if ($this->Attachment->save($this->data)) {
						$this->Session->setFlash(__('The Attachment has been saved', true), 'default', array('class' => 'confirmation_msg'));						$this->redirect(array('action'=>'index'));
				} else {
						$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.', true), 'default', array('class' => 'error_msg'));
				}//end else $this->Attachment->save($this->data)
			}//empty error
		}//end !empty this data.
		
		if (empty($this->data)) {
			$this->Attachment->recursive = -1;
			$this->data = $this->Attachment->read(null, $id);
			$model = $this->data['Attachment']['model'];
			
		}
		
		if ($model == 'samples'){
			$sample_id = $this->data['Attachment']['foreign_key'];//works on empty data and not
			$this->Attachment->Sample->recursive = -1;
			$sample = $this->Attachment->Sample->find('first', array('conditions' => array('Sample.id'=> $sample_id)));
			$this->set(compact('sample'));
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Attachment', true), 'default', array('class' => 'warning_msg'));
			$this->redirect(array('action'=>'index'));
		}else {
		
			$fileName = $this->Attachment->getFilename($id);
			$path = $this->Attachment->getPath($id);
		
		}
		if ($this->Attachment->del($id)) {
			@unlink($path.$fileName);
			foreach($this->Attachment->versions as $version){
				@unlink($path.$version['prefix'].$fileName);
			}
			$this->Session->setFlash(__('Attachment deleted', true), 'default', array('class' => 'confirmation_msg'));
			$this->redirect(array('action'=>'index'));
		}
	}

	
	function handleFileUpload($fileData, $fileName, $path){
	
		$file_tmpfilename = $fileData['tmp_name'];
		$file_name = $fileData['name'];
		$file_size = $fileData['size'];
		$file_type = $fileData['type'];
		$file_error = $fileData['error'];

		$error_message = '';
		
		//Error != 0. Error while uploading
		if($file_error > 0){
			switch($file_error){
				case 1: $error_message = __('The uploaded file exceeds the upload_max_filesize directive in php.ini. ', true);break;
				case 3: $error_message = __('The uploaded file was only partially uploaded. ', true);break;
				case 4: $error_message = __('No file was uploaded. ', true);break;
			}//end switch
			return $error_message;
		}//Value: 0; There is no error, the file uploaded with success. 
		else if ($file_error == 0){
		
			if (!in_array($file_type, $this->Attachment->validateFile['mimetype'])){
				$error_message .= __('Invalid file type. ', true);
			}
			
			
			if ($file_size > $this->Attachment->validateFile['size']) {
				$error_message .= __('File is too large to upload - files up to 1.5 MB allowed. ', true);
			}
			
			//was the file uploaded through http post?
			if (is_uploaded_file($file_tmpfilename)){
				//Finally we can move the file from the TMP folder now, if there is not an error already.
				//Let's do it and return without errors if success in moving.
				if (empty($error_message)){
					if (!move_uploaded_file($file_tmpfilename, $path.$fileName)){
						  $error_message .= __('There was an error while uploading the file. ', true);
					}
				}
			}
			else{
				
				$error_message .= __('Error in uploading the file. Possible file attack! ', true);
			}
			
			//debug($file_type, true);
			//debug($this->Attachment->validateFile['mimetype'], true);
			//debug($error_message, true);
		}//end else if ($file_error == 0)
		return $error_message;
	
	}
	
}
?>