<?php

namespace CDIA;

use CDIA\Photo;

class Gallery {

    public $photos = array();

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
                    $path = BASE_PATH . 'uploads/' . end($categories) . '/' . $fileinfo->getFilename();

                    $photo = new Photo($path, end($categories));

                    $this->photos[] = $photo;
                }
            }
        }
    }

}

?>