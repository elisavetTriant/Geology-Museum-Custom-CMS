<?php 
/**
 * Thumbnail Generator for CakePHP that uses phpThumb (http://phpthumb.sourceforge.net/)
 *
 * @package default
 * @author Nate Constant
 **/ 

class ThumbComponent{
	
	/**
	 * The mime types that are allowed for images
	 */
	var $allowed_mime_types = array('image/jpeg','image/pjpeg','image/gif','image/png');
	
	/**
	 * File system location to save thumbnail to.  ** Must be writable by webserver 
	 */
	var $image_location = 'images';
	
	/**
	 * Array of errors
	 */
	var $errors = array();
	
	/**
	 * Default width if not set
	 */
	var $width = 100;
	
	/**
	 * Default height if not set
	 */
	var $height = 100;
	
	/**
	 * do we zoom crop the image?
	 */
	var $zoom_crop = 0;//do not zoom crop
	
	/**
	 * The original image uploaded
	 * @access private
	 */
	var $file;
	
	var $controller;
	var $model;
	
	function startup( &$controller ) {
      $this->controller = &$controller;
    }
	
	/**
	 * This is the method that actually does the thumbnail generation by setting up 
	 * the parameters and calling phpThumb
	 *
	 * @return bool Success?
	 * @author Nate Constant
	 **/
	function generateThumb($filename,$model){
		// Make sure we have the name of the uploaded file and that the Model is specified
		if(empty($filename) || !$this->controller->data[$model][$filename]){
			$this->addError('non-existant file'.$filename);
			return false;
		}
		// save the file to the object
		$this->file = $this->controller->data[$model][$filename];
		
		// verify that the size is greater than 0 ( emtpy file uploaded )
		if(!$this->file['size']){
			$this->addError('File Size is 0');
			return false;
		}
		
		// verify that our file is one of the valid mime types
		if(!in_array($this->file['type'],$this->allowed_mime_types)){
			$this->addError('Invalid File type: '.$this->file['type']);
			return false;
		}
		// verify that the filesystem is writable, if not add an error to the object
		// dont fail if not and let phpThumb try anyway
		if(!is_writable(WWW_ROOT.DS.$this->image_location)){
			$this->addError('directory: '.WWW_ROOT.DS.$this->image_location.' is not writable.');
		}
		
		// Load phpThumb
		vendor('phpThumb'.DS.'phpthumb.class');
		$phpThumb = new phpThumb();
		$phpThumb->setSourceFilename($this->file['tmp_name']);
		$phpThumb->setParameter('w',$this->width);
		$phpThumb->setParameter('h',$this->height);
		$phpThumb->setParameter('zc',$this->zoom_crop);
		if($phpThumb->generateThumbnail()){
			if(!$phpThumb->RenderToFile(WWW_ROOT.DS.$this->image_location.DS.$this->file['name'])){
				$this->addError('Could not render file to: '.$this->image_location.DS.$this->file['name']);
			}
		} else {
			$this->addError('could not generate thumbnail');
			$this->addError(implode('; ',$phpThumb->debugmessages));
		}
		
		// if we have any errors, remove any thumbnail that was generated and return false
		if(count($this->errors)>0){
			if(file_exists(WWW_ROOT.DS.$this->image_location.DS.$this->file['name'])){
				unlink(WWW_ROOT.DS.$this->image_location.DS.$this->file['name']);
			}
			return false;
		} else return true;
			
	}
	
	function addError($msg){
		$this->errors[] = $msg;
	}
	
}
?>