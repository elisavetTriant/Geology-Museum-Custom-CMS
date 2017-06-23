<?php
class Image extends AppModel {

	var $name = 'Image';
	
	var $actsAs = array('MeioUpload' => array(
      'filename' => array(
            'dir' => 'img{DS}{model}{DS}{field}',  
            'create_directory' => true,
            'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
            'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
			'max_size'=>'1.2 MB',
            'thumbsizes' => array(
                   'small'  => array('width'=>100, 'height'=>100),
                   'medium' => array('width'=>220, 'height'=>220),
                  'large'  => array('width'=>800, 'height'=>600)
           )
			'fields' => array( 
				'filesize' => 'filename_filesize', 
				'mimetype' => '{field}_mimetype', 
			    'dir' => 'filenames_folder' 
			)  
 	
       )
     )
  );
	
 
}
?>