<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $helpers = array('Html', 'Form', 'Menu');
	
	var $validateFile = array(
                          'size' => 1048576, //1 MB
                          'mimetype' => array('image/jpeg', 
						  					  'image/jpg', 
											  'image/pjpeg',  
											  'image/gif', 
											  'image/png', 
											  'image/bmp', 
											  'application/x-zip-compressed',
											  'application/zip',
											  'application/pdf', 
											  'application/vnd.ms-powerpoint', 
											  'application/vnd.ms-excel', 
											  'application/msword',
											  'text/plain',
											  )
                          );
						  
	function generateUniqueFilename($fileName, $path='')
  	{
		$path = empty($path) ? WWW_ROOT.'/files/' : $path;
		$no = 1;
		$newFileName = $fileName;
		while (file_exists("$path/".$newFileName)) {
		  $no++;
		  $newFileName = substr_replace($fileName, "_$no.", strrpos($fileName, "."), 1);
		}
		return $newFileName;
  	}
	
	
	function handleFileUpload($fileData, $fileName){
	
		$file_tmpfilename = $fileData['tmp_name'];
		$file_name = $fileData['name'];
		$file_size = $fileData['size'];
		$file_type = $fileData['type'];
		$file_error = $fileData['error'];


	
	
	
	}
	
	
	function handleFileUpload_backup($fileData, $fileName)
	  {
		$error = '';
	 
	 
		//If size is provided for validation check with that size. Else compare the size with INI file
		if (($this->validateFile['size'] && $fileData['size'] > $this->validateFile['size']) || $fileData['error'] == UPLOAD_ERR_INI_SIZE)
		{
		  $error = 'File is too large to upload';
		}
		elseif ($fileData && (!in_array( $fileData['type'], $this->validateFile['mimetype']) ))
		{
		  //File type is not the one we are going to accept. Error!!
		  $error = 'Invalid file type';
		}
		else
		{
		  //Data looks OK at this stage. Let's proceed.
		  if ($fileData['error'] == UPLOAD_ERR_OK)
		  {
			//Oops!! File size is zero. Error!
			if ($fileData['size'] == 0)
			{
			  $error = 'Zero size file found.';
			}
			else
			{
			  if (is_uploaded_file($fileData['tmp_name']))
			  {
				//Finally we can upload file now. Let's do it and return without errors if success in moving.
				if (!move_uploaded_file($fileData['tmp_name'], WWW_ROOT.'/files/'.$fileName))
				{
				  $error = 'Error in uploading the file';
				}
			  }
			  else
			  {
				$error = 'Error in uploading the file';
			  }
			}
		  }
		}
		return $error;
 	 }
	
	
	 function deleteMovedFile($fileName)
	  {
		if (!is_file($fileName)){
		  return true;
		}
		if(unlink($fileName))
		{
		  return true;
		}
		return false;
 	 }
	
	
	function admin_index() {
		$this->Attachment->recursive = 0;
		$this->set('attachments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Attachment.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
	}

	function admin_add() {
		if (empty($this->data)) {
			
			$this->Attachment->create();
			
		} else if ($this->Attachment->validates()){
			
	   		 if (!empty($this->data['Attachment']['filename']['tmp_name'])) {
				  
				  $fileName = $this->generateUniqueFilename($this->data['Attachment']['filename']['name']);
				  $error = $this->handleFileUpload($this->data['Attachment']['filename'], $fileName);	  
			} else{
			
				$fileName = '';
				$error = '';
			}
			if (empty($error)){
					  
				 $this->data['Attachment']['filename'] = $fileName;
					  
				if ($this->Attachment->save($this->data)){
					$this->Session->setFlash(__('The Attachment has been saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.'.$error , true));
				}  
			} else {
			  $this->Attachment->set($this->data);
			  $this->Session->setFlash(__('The Attachment could not be saved. Error: '.$error , true));
			}
			

		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The Attachment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attachment->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Attachment', true));
			$this->redirect(array('action'=>'index'));
		}else {
		
			$fileName = $this->Attachment->getFilename($id);
			//$this->log('filename: '.$fileName);
		
		}
		if ($this->Attachment->del($id)) {
			unlink(WWW_ROOT.'files\\'.$fileName);
			$this->Session->setFlash(__('Attachment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>