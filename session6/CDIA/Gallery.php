<?php

namespace CDIA;

use CDIA\Photo;

class Gallery {

    private $photos = array();

    public function __construct($directory) {
        $this->getPhotosByDirectory($directory);
    }

    public function getPhotosByDirectory($directory) {
        $dirit = new \DirectoryIterator($directory);

        foreach($dirit as $fileinfo) {
            if (!$fileinfo->isDot() && $fileinfo->getFilename() !== '.DS_Store') {
                $categories = explode('/', $fileinfo->getPath());

                $path = end($categories) . '/' . $fileinfo->getFilename();

                if ($fileinfo->isDir()) {
                    $this->getPhotosByDirectory($path);
                } else {
                    $photo = new Photo($fileinfo->getFilename(), end($categories));

                    $this->photos[] = $photo;
                }
            }
        }
    }
    
    public function getPhotos($category = null) {
        if ($category !== null) {
            return array_filter($this->photos, function($item) use ($category) {
                return $item->category === $category;
            });
        } else {
            return $this->photos;
        }
    }

}

?>