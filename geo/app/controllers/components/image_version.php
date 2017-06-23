<?php
/** Image Version Component 
 * 
 * A custom component for automagically creating thumbnail versions of any image within your app.
 * Example controller use:
 * $images = $this->{$this->modelClass}->find('first'); 	
 * $this->set('clear', $this->ImageVersion->flushVersion($images['Piece']['file'], array(150, 75), true));
 * $this->set('thumbnail', $this->ImageVersion->version($images['Piece']['file'], array(150, 75)));
 * 	(that would clean out the entire folder 150x75 and then make a thumbnail again and return a path to $thumbnail for the view)
 *
 * @link			http://www.concepthue.com
 * @author			Tom Maiaroto
 * @modifiedby		Tom
 * @lastmodified	2008-09-25 01:00:00
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class ImageVersionComponent extends Object {
/**
 * Components
 *
 * @return void
 */
	//var $components = array('Session');
	var $controller;
/**
 * Startup
 *
 * @param object $controller
 * @return void
 */
	function initialize(&$controller) {
		$this->controller = $controller;			
	}
	
	/**
	 * Returns a path to the generated thumbnail.
	 * It will only generate a thumbnail for an image if the source is newer than the thumbnail,
	 * or if the thumbnail doesn't exist yet.
	 * 
	 * Note: Changing the quality later on after a thumbnail is already generated would have 
	 * no effect. Original source images would have to be updated (re-uploaded or modified via
	 * "touch" command or some other means). Or the existing thumbnail would have to be destroyed
	 * manually or with the flushVersions() method below.
	 *  
	 * @param $image String[required] Location of the source image.
	 * @param $size Array[optional] Size of the thumbnail. Default: 75x75
	 * @param $thumbQuality Int[optional] Quality of the thumbnail. Default: 85%
	 * 
	 * @return String path to thumbnail image.
	 */
	function version($source=null, $thumbSize=array(75, 75), $thumbQuality=85, $crop=false) {
		// if no source provided, don't do anything
		if(empty($source)): return false; endif;
		
		$webroot = new Folder(WWW_ROOT);
		$this->webRoot = $webroot->path;
		
		// set the size
		$thumb_size_x = $thumbSize[0];
		$thumb_size_y = $thumbSize[1];
						
		// round the thumbnail quality in case someone provided a decimal
		$thumbQuality = ceil($thumbQuality);
		// or if a value was entered beyond the extremes
		if($thumbQuality > 100): $thumbQuality = 100; endif;
		if($thumbQuality < 0): $thumbQuality = 0; endif;
		
		// get full path of source file	(note: a beginning slash doesn't matter, the File class handles that I believe)
		$originalFile = new File($this->webRoot . $source);	
		$source = $originalFile->Folder->path.DS.$originalFile->name().'.'.$originalFile->ext();
		// if the source file doesn't exist, don't do anything
		if(!file_exists($source)): return false; endif;
		
		// get the destination where the new file will be saved (including file name)		
		$pathToSave = $this->createPath($originalFile->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1]);					
		$dest = $originalFile->Folder->path.DS.$thumb_size_x.'x'.$thumb_size_y.DS.$originalFile->name().'.'.$originalFile->ext();										
		
	        // First make sure it's an image that we can use (bmp support isn't added, but could be)
		switch($originalFile->ext()):
			case 'jpg':
			case 'jpeg':
			case 'gif':
			case 'png':
			break;
			default:
				return false;
			break;
		endswitch;

		// Then see if the size version already exists and if so, is it older than our source image?
		if(file_exists($originalFile->Folder->path.DS.$thumb_size_x.'x'.$thumb_size_y.DS.$originalFile->name().'.'.$originalFile->ext())):
			$existingFile = new File($dest);
			if( date('YmdHis', $existingFile->lastChange()) > date('YmdHis', $originalFile->lastChange()) ):
				// if it's newer than the source, return the path. the source hasn't updated, so we don't need a new thumbnail.
				return substr(strstr($existingFile->Folder->path.DS.$existingFile->name().'.'.$existingFile->ext(), 'webroot'), 7);				
			endif;
		endif;
			
		// Get source image dimensions
		$size = getimagesize($source);
		$width = $size[0];
		$height = $size[1];
		// $x and $y here are the image source offsets
		$x = NULL;
		$y = NULL;
		
		// don't allow new width or height to be greater than the original (Thanks to TimThumb for thinking about something I didn't)
		if( $thumb_size_x > $width ) { $thumb_size_x = $width; }
		if( $thumb_size_y > $height ) { $thumb_size_y = $height; }	
		// generate new w/h if not provided (cool, idiot proofing)
		if( $thumb_size_x && !$thumb_size_y ) {
			$thumb_size_y = $height * ( $thumb_size_x / $width );
		}
		elseif($thumb_size_y && !$thumb_size_x) {
			$thumb_size_x = $width * ( $thumb_size_y / $height );
		}
		elseif(!$thumb_size_x && !$thumb_size_y) {
			$thumb_size_x = $width;
			$thumb_size_y = $height;
		}
				
		// If the thumbnail is square		
		if($thumbSize[0] == $thumbSize[1]) {
			if($width > $height) {
				$x = ceil(($width - $height) / 2 );
				$width = $height;
			} elseif($height > $width) {
				$y = ceil(($height - $width) / 2);
				$height = $width;
			} 	
		// else if the thumbnail is rectangular, don't stretch it
		} else {
			// if we aren't cropping then keep aspect ratio and contain image within the specified size
			if($crop === false) {
				$ratio_orig = $width/$height;
				if ($thumb_size_x/$thumb_size_y > $ratio_orig) {
				   $thumb_size_x = $thumb_size_y*$ratio_orig;
				} else {
				   $thumb_size_y = $thumb_size_x/$ratio_orig;
				}
			}			
			// if we are cropping...
			if($crop === true) {
				// Next 10 lines. Big thanks to: TimThumb script created by Tim McDaniels and Darren Hoyt with tweaks by Ben Gillbanks (http://code.google.com/p/timthumb/)
				// I would reccommend TimThumb to anyone (and myself if I didn't have this thing nearly complete).
				$cmp_x = $width  / $thumb_size_x;
				$cmp_y = $height / $thumb_size_y;
				// calculate x or y coordinate and width or height of source
				if ( $cmp_x > $cmp_y ) {
					$width = round( ( $width / $cmp_x * $cmp_y ) );
					$x = round( ( $width - ( $width / $cmp_x * $cmp_y ) ) / 2 );
				}
				elseif ( $cmp_y > $cmp_x ) {
					$height = round( ( $height / $cmp_y * $cmp_x ) );
					$y = round( ( $height - ( $height / $cmp_y * $cmp_x ) ) / 2 );
				}
				/////		
			}
		}
		
		switch($originalFile->ext()):
		case 'png':
			// Create PNG
			if($thumbQuality != 0):
				$thumbQuality = ceil(($thumbQuality / 10)); // 0-9 is the range for png	
			endif;				
			$new_im = ImageCreatetruecolor($thumb_size_x,$thumb_size_y);
			$im = imagecreatefrompng($source);
			imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size_x,$thumb_size_y,$width,$height);	
						
			imagepng($new_im,$dest,$thumbQuality);
			
			$outputPath = new File($dest);
			$finalPath = substr(strstr($outputPath->Folder->path.DS.$outputPath->name().'.'.$outputPath->ext(), 'webroot'), 7);
		break;
		
		case 'gif':
			// Create GIF		
			$new_im = ImageCreatetruecolor($thumb_size_x,$thumb_size_y);
			$im = imagecreatefromgif($source);
			imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size_x,$thumb_size_y,$width,$height);	
			imagegif($new_im,$dest); // no quality setting
			
			$outputPath = new File($dest);
			$finalPath = substr(strstr($outputPath->Folder->path.DS.$outputPath->name().'.'.$outputPath->ext(), 'webroot'), 7);
		break;
		
		case 'jpg':
		case 'jpeg':
		default:
			// Create JPG		
			$new_im = ImageCreatetruecolor($thumb_size_x,$thumb_size_y);
			$im = imagecreatefromjpeg($source);
			imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size_x,$thumb_size_y,$width,$height);	
			imagejpeg($new_im,$dest,$thumbQuality);
			
			$outputPath = new File($dest);			
			$finalPath = substr(strstr($outputPath->Folder->path.DS.$outputPath->name().'.'.$outputPath->ext(), 'webroot'), 7);
			// PHP 5.3.0 would allow for a true flag as the third argument in strstr()...
			// which would take out "webroot" so substr() wasn't required, but for the PHP 4 people...			
		break;		
		endswitch;
			
		return $finalPath;		
	}

/**
* Deletes a single thumbnail or a directory of thumbnail versions created by the component.
* Useful during development, or when changing the crop flag or dimensions often to keep tidy.
* Maybe say a hypothetical CMS has an admin option for a user to change the thumbnail size of
* a profile photo...well, we might want to run this to clean out the old versions right?
* Or when a record was deleted containing an image that has a version...afterDelete()...
*    
* @param $source String[required] Location of a source image.
* @param $thumbSize Array[optional] Size of the thumbnail. Default: 75x75
* @param $clearAll Boolean[optional] Clear all the thumbnails in the same directory. Default: false
* 
* @return
*/
	function flushVersion($source=null, $thumbSize=array(75, 75), $clearAll=false) {
		if((is_null($source)) || (!is_string($source))): return false; endif;
		$webroot = new Folder(WWW_ROOT);
			// take off any beginning slashes (webroot has a trailing one)
			if(substr($source, 0, 1) == '/'):
				$source = substr($source, 1);
			endif;
						
			$pathToFile = $webroot->path . $source;
			$file = new File($pathToFile);
					
			//debug($file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1].DS.$file->name);
			// REMOVE THE FILE (doesn't matter if we remove the directory too later on)
			if(file_exists($file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1])):
				if(unlink($file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1].DS.$file->name)):
					//debug('The file was deleted.');	
				else:
					//debug('The file could not be deleted.');
				endif;
			endif;		
		
		// IF SPECIFIED, REMOVE THE DIRECTORY AND ALL FILES IN IT
		if($clearAll === true):
			if($webroot->delete($file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1])):
				//debug('All files in the folder: '.$file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1].' have been deleted including the folder.');
			else:
				//debug('The folder: '.$file->Folder->path.DS.$thumbSize[0].'x'.$thumbSize[1].' and its files could not be deleted.');
			endif;
		endif;	
		return;	
	}
	
/**
 * Pass a full path like /var/www/htdocs/app/webroot/files
 * Don't include trailing slash.
 * 
 * @param $path String[optional]
 * @return String Path.
 */
	function createPath($path = null) {
		//$path = $this->webRoot . 'files' . DS . $path;
			$directories = explode('/', $path);
			$root = '';	
				// looks to see if a slash was included in the path to begin with and if so it removes it
				if($directories[0] == '') {
						array_shift($directories);
				}
			foreach($directories as $directory) {
				if(!file_exists($root .DS. $directory)) { 
					mkdir($root .DS. $directory);	
				}
					$root = $root .DS. $directory;
			}
		// put a trailing slash on
		$root = $root . DS;
		return $root;
	}	
}
?>