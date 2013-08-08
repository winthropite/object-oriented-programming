<?php

namespace CDIA;

use \CDIA\Photo;

class Gallery {
	
    public static function getAllPhotos() {
        $dir = new \DirectoryIterator(UPLOAD_PATH);
        
        $photos = array();
        
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot() && !$fileinfo->isDir()) {
                $path = BASE_PATH . 'uploads/' . $fileinfo->getFilename();
                
                $photo = new Photo($path);
                
                $photos[] = $photo;
            }
        }
        
        return $photos;
    }
    
}

?>