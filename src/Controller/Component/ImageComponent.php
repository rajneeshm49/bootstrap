<?php
namespace App\Controller\Component;
/**
 * Image Component, responsible for uploading the file.
 */
// App::uses('Component', 'Controller');
use Cake\Controller\Component;

class ImageComponent extends Component
{
	var $components = array('PImage');
	
	/**
	 * This variable stores the maximum allowed file size(in kilobytes) for uploaded files.
	 * Please note that this can also be limited on the form and by php itself. Default is 2048(2 MB).
	 */
	var $maxFileSize = 2048;

	/**
	 * This variable stores the maximum allowed width for uploaded files.
	 */
	var $maxWidth = 1000;
	
	/**
	 * This variable stores the maximum allowed height for uploaded files.
	 */
	var $maxHeight = 1000;
	
	/**
	 * This variable stores the minimum allowed width for uploaded files.
	 */
	var $minWidth;
	
	/**
	 * This variable stores the minimum allowed height for uploaded files.
	 */
	var $minHeight;
	
	/**
	 * Exact width of uploaded image
	 */
	var $width;
	
	/**
	 * Exact height of uploaded image
	 */
	var $height;
	
	/**
	 * This array stores all allowed types
	 */	
	var $allowedType = array('jpg', 'jpeg', 'gif', 'png'); //, 'png'
				  
	/*
		These variables are used to store information about errors or/information that needs to be stored while using this component. Do not modify these.
	*/
	var $errorMessage = null;
	var $isError = false;
	var $lastUploadData;
	var $class_name = null;
	var $resizeConfig = array();
	/*var $thumbnail_width = 80;
	var $thumbnail_height = 80;
	var $photo_width = 184;
	var $photo_height = 184;
	var $quality = 100;*/
    
    /**
     * This method takes a reference to the controller which is loading it
     */
    function initialize(Controller $controller, $settings = array()) {
    	// saving the controller reference for later use
    	$this->controller = $controller;    
    }
    
    function beforeRender(Controller $controller) {
    
    }
    function beforeRedirect(Controller $controller, $url, $status = NULL, $exit = true){
		
	}
    function startup(Controller $controller) {
    
    }
    
    function shutdown(Controller $controller) {
    
    }
	
    /**
     * Returns information about last upload
     * @return array
     */
	function getLastUploadInfo() {
		if(!is_array($this->lastUploadData)) {
			$this->setError('No upload detected');
		} else {
			return $this->lastUploadData;
		}
	}
	
	/**
	 * Sets the image constraints
	 * @param $options contains different image constraints
	 * @return void
	 */
	function set_image_constraints($options) {
		$this->minHeight = (empty($options['minHeight'])) ? 0 :  $options['minHeight'];
		$this->minWidth  = (empty($options['minWidth']))  ? 0 :  $options['minWidth'];
		$this->maxHeight = (empty($options['maxHeight'])) ? 0 :  $options['maxHeight'];
		$this->maxWidth  = (empty($options['maxWidth']))  ? 0 :  $options['maxWidth'];
		$this->height    = (empty($options['height']))    ? 0 :  $options['height'];
		$this->width     = (empty($options['width']))     ? 0 :  $options['width'];
		$this->thumbnail_width = (empty($options['thumbnail_width'])) ? 0 : $options['thumbnail_width'];
		$this->thumbnail_height = (empty($options['thumbnail_height'])) ? 0 : $options['thumbnail_height'];
		/*$this->photo_width = (empty($options['photo_width'])) ? 0 : $options['photo_width'];
		$this->photo_height = (empty($options['photo_height'])) ? 0 : $options['photo_height'];*/
		$this->class_name     = (empty($options['class_name'])) ? '' :  $options['class_name'];
		$this->quality     = (empty($options['quality'])) ? $this->quality :  $options['quality'];
	}
	
	/**
	 * Checks for basic validations like directory exists and file upload was not errornous
	 * 
	 * @return unknown_type
	 */
	function do_basic_check($field, $dir) {
		if($this->class_name)
		{
			$files = id_to_text($this->class_name, $this->controller->request->data);
		}
		else
		{
			$modal_class_name = (array_keys($this->controller->request->data));
			$i = 0;
			$key_to_use = 0;
			foreach($modal_class_name as $modal_class_val)
			{
				if(isset($modal_class_val[$field]))
				{
					$key_to_use = $i;
				}
				$i++;
			}
			
			$files = $this->controller->request->data[$modal_class_name[$key_to_use]];
		}
		// Check that the two method variables are set
		if(empty($field) || empty($dir)) {
			$this->setError('You must supply a file field name and a directory on the server');
			return false;
		}
		
		// Check that the upload file field exists
		if(!isset($files[$field])) {
			$this->setError('No file supplied');
			return false;
		}
		
		// Check that the file upload was not errornous
		if($files[$field]['error'] != 0) {
			switch($files[$field]['error']) {
				case 1:
					$this->setError('The file is too large (server)');
					break;				
				case 2:
					$this->setError('The file is too large (form)');
					break;				
				case 3:
					$this->setError('The file was only partially uploaded');
					break;				
				case 4:
					$this->setError('No file was uploaded');
					break;				
				case 5:
					$this->setError('The servers temporary folder is missing');
					break;				
				case 6:
					$this->setError('Failed to write to the temporary folder');
					break;
			}
			
			return false;
		}
		
		// Check that the supplied dir ends with a DS
		if($dir[(strlen($dir)-1)] != DS) {
			$dir .= DS;
		}

		// Check that the given dir is writable
		if(!is_dir($dir) || !is_writable($dir)) {
			$this->setError('The supplied upload directory does not exist or is not writable');
			return false;
		}
		
		return true;
	}
	
	/**
	 * Returns true if file type and size are valid
	 * 
	 * Different checks done are like : allowed file type, image dimension constraints
	 * are satisfied, max upload size
	 * 
	 * @param string $field  name of form field
	 * @return boolean true if all conditions are satisfied
	 *                 false otherwise
	 */
	function is_valid_file_type_and_size($field) {
		
		if($this->class_name)
		{
			$files = $this->controller->request->data[$this->class_name];
		}
		else
		{
			$modal_class_name = (array_keys($this->controller->request->data));
			$i = 0;
			$key_to_use = 0; 
			foreach($modal_class_name as $modal_class_val)
			{
				if(isset($modal_class_val[$field]))
				{
					$key_to_use = $i;
				}
				$i++;
			}
			
			$files = $this->controller->request->data[$modal_class_name[$key_to_use]];
		}
		// check that the file is of a legal type
		$file_ext = explode(".", $files[$field]['name']);
		$filetype = end($file_ext);
		if(!in_array(strtolower($filetype), array_merge($this->allowedType, array_map('strtoupper', $this->allowedType)))) {
			$this->setError('This file type is not supported');
			return false;
		}
		
		// check that the file is smaller than the maximum filesize.
		if((filesize($files[$field]['tmp_name'])/2048) > $this->maxFileSize) {
			$this->setError('The file is too large (application)');
			return false;
		}
		
		// file dimension check
		list($width, $height, $type, $attr) = getimagesize($files[$field]['tmp_name']);
		
		if(!empty($this->width) && $this->width != $width) {
			$this->setError('Width should be ' . $this->width . 'px');
			return false;
		} else {
			if(!empty($this->minWidth) && ($width < $this->minWidth)) {
				$this->setError('Minimum Width should be ' . $this->minWidth . 'px');
				return false;
			}
			if(!empty($this->maxWidth) && ($width > $this->maxWidth)) {
				$this->setError('Exceeding allowed maximum width, i.e. ' . $this->maxWidth . 'px');
				return false;
			}
		}
		
		if(!empty($this->height) && $this->height != $height) {
			$this->setError('Height should be ' . $this->height . 'px');
			return false;
		} else {
			if(!empty($this->minHeight) && ($height < $this->minHeight)) {
				$this->setError('Minimum Height should be ' . $this->minHeight . 'px');
				return false;
			}
			if(!empty($this->maxHeight) && ($height > $this->maxHeight)) {
				$this->setError('Exceeding allowed maximum height, i.e. ' . $this->maxHeight . 'px');
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Uplods the resource 
	 * 
	 * Options can be specified as - 
	 * field : name of file upload field
	 * uploadDirectory : directory where resource will be uploaded
	 * uploadFileName : new file name after upload (if no file name is passed
	 * 	then filename is generated using timestamp. 
	 * maxHeight : maximum height of image 
	 * maxWidth : maximum width of image
	 * minHeight : minimum height of image
	 * minWidth : minimum width of image
	 * height : required excat height of image
	 * width : required excat width of image
	 * createThumbnail : set to true if thumbnail needs to be created
	 * thumbnailDirectory : thumbnail directory
	 * thumbnailWidth : thumbnail width
	 * thumbnailHeight : thumbnail height
	 * 
	 * NOTE: if height / width option is specified then maximum and minimum
	 * constraints will be ignored
	 * 
	 * @param $options options to be used for resource upload 
	 * @return array
	 */
	function upload($options)
	{
		$field = (empty($options['field'])) ? '' :  $options['field'];
		$upload_dir = (empty($options['uploadDirectory'])) ? '' :  $options['uploadDirectory'];
		$imageName = (empty($options['uploadFileName'])) ? '' :  $options['uploadFileName'];
		
		$this->set_image_constraints($options);
		if(!empty($this->class_name))
		{
			$files = id_to_text($this->class_name, $this->controller->request->data);
		}
		else
		{
			$modal_class_name = (array_keys($this->controller->request->data));
			$i = 0;
			$key_to_use = 0;
			foreach($modal_class_name as $modal_class_val)
			{
			    
				if(isset($modal_class_val[$field]))
				{
					$key_to_use = $i;
				}
				$i++;
			}
			$files = $this->controller->request->data[$modal_class_name[$key_to_use]];
		} 
		if($this->do_basic_check($field, $upload_dir) && $this->is_valid_file_type_and_size($field))
		{			
			$file_ext = explode(".", $files[$field]['name']);
			$filetype = end($file_ext);
			// Generating the file name
			if(!$imageName)
			{
				$file_ext = explode(".", $files[$field]['name']);
				$filetype = end($file_ext);				
				$newfile = $this->getFileName($filetype);
			}
			else
			{
				$newfile = $imageName . '.' . $filetype;
			}
			
			// Move the uploaded file to the directory
			if(!move_uploaded_file($files[$field]['tmp_name'], $upload_dir.$newfile))
			{
				// Set the error and return false
				$this->setError('The uploaded file could not be moved to the directory local');
				return false;
			}
	
			$this->lastUploadData['file_name'] = $newfile;
			
			 // if create thumbnail and thumbnail directory strung is not null
			if(!empty($options['createThumbnail']) && !empty($options['thumbnailDirectory']))
			{
				list($width, $height, $type, $attr) = getimagesize($upload_dir.$newfile);
				
				$thumbnail_width = ($this->thumbnail_width)? $this->thumbnail_width : 80;//ceil($width * 0.1);
				$thumbnail_height = ($this->thumbnail_height)? $this->thumbnail_height : 80;//ceil($height * 0.1);
				
				if(!$this->PImage->resizeImage('resize', $newfile, $upload_dir, $options['thumbnailDirectory'], $newfile, $thumbnail_width, $thumbnail_height))
				{
					$this->setError('Thumbnail could not be created');
					return false;
				}
				if(!empty($options['photoImage'])){ 
					$photo_width = ($this->photo_width)? $this->photo_width : 184; 
					$photo_height = ($this->photo_height)? $this->photo_height : 184; 
					if(!$this->PImage->resizeImage('resize', $newfile, $upload_dir, $options['thumbnailDirectory'], 'th_'.$newfile, $photo_width, $photo_height, $this->quality))
					{
						$this->setError('Thumbnail could not be created');
						return false;
					}
				}
			}
			if(count($this->resizeConfig)){
				foreach($this->resizeConfig as $sizeIndex => $config) {
					list($width, $height, $type, $attr) = getimagesize($upload_dir.$newfile);
					$imageName = $newfile;
					if(isset($config['suffix'])) {
						$pos = $pos = strrpos($newfile, ".");;
						$filename = substr($newfile, 0, $pos);
						$fileextension = substr($newfile, $pos);
						$imageName = $filename.$config['suffix'].$fileextension;
					}
					if(isset($config['prefix'])) {
						$imageName = $config['prefix'].$newfile;
					}
					if(!isset($config['height'])){
					    $config['height'] = $height;
					}
					if(!$this->PImage->resizeImage('resize', $newfile, $upload_dir, $config['upload_dir'], 
							$imageName, $config['width'], $config['height'], $this->quality))	{
						$this->setError('Thumbnail could not be created');
						return false;
					}
				}
			}			
		}
		else
		{
			return false;
		}
		
		return true;
	}
	
	/**
	 * Returns file name with which file will be uploaded
	 * 
	 * @param $file_type uploaded file name
	 * @return string new file name
	 */
	function getFilename($file_type) {
		$stamp = strtotime ("now");
		$temp = $stamp.rand(10, 99);
		$temp = str_replace(".", "", $temp);
		settype($temp, "string");
		$temp .= ".";
		$temp .= $file_type;
		return $temp;
	}
	
	/**
	 * setError
	 * Set the errorMessage and isError variables.
	 */
	function setError($error) {
		$this->isError = true;
		$this->errorMessage = $error;
	}
}
?>