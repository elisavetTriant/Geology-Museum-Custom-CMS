<?php
/**
 * Image Version Helper class to embed thumbnail images on a page.
 * 
 * @link			http://www.concepthue.com
 * @author			Tom Maiaroto
 * @modifiedby		Tom
 * @lastmodified	2008-10-04 16:11:00
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class ImageVersionHelper extends AppHelper {

	var $helpers = array('Html');
	var $component;

	/**
	 * Returns a block of HTML code that embeds a thumbnail image into a page.
	 * It uses the built in CakePHP HTML helper image method for additional options.
	 *  
	 * @param $image String[required] Location of the source image.
	 * @param $size Array[optional] Size of the thumbnail. Default: 75x75
	 * @param $thumbQuality Int[optional] Quality of the thumbnail. Default: 85%
	 * @param $options Object[optional] An array of options, same as Html->image() helper.
	 * 
	 * @return HTML string including image tag and src attribute, along with any additional options.
	 */
	function version($image=null, $size=array(75, 75), $thumbQuality=85, $crop=false, $options=array()) {
		// remove a slash if one was added accidentally. it doesn't matter either way now.
		// we're always going from the webroot to cover any image in the cake app (typically).
		if(substr($image, 0, 1) == '/'): $image = substr($image, 1); endif;
		
		// init the component, if it hasn't been initialized	
		if(!$this->component):
			$this->component =& ClassRegistry::init('ImageVersionComponent', 'Component');
		endif;
		
		$outputImage = $this->component->version($image, $size, $thumbQuality, $crop);

		$link = $this->Html->image($outputImage, $options);		

		return $this->output("$link");	
	}
	
	/**
	* Deletes a single version thumbnail and/or deletes the entire directory of versions.
	*
	* @param $source String[required] Location of the source image.
	* @param $size Array[optional] Image version.
	* @param $clearAll Boolean[optional] Specify whether or not to remove all versions in a folder.
	* @return
	*/
	function flushVersion($source=null, $size=array(75,75), $clearAll=false) {
		if((is_null($source)) || (!is_string($source))): return false; endif;		
		// init the component, if it hasn't been initialized
		if(!$this->component):
			$this->component =& ClassRegistry::init('ImageVersionComponent', 'Component');
		endif;
		$flush = $this->component->flushVersion($source, $size, $clearAll);
		return;
	}
}
?>