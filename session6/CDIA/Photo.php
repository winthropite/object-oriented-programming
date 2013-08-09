<?php

namespace CDIA;

class Photo {
    public $path;
    public $category;

    public function __construct($path, $category) {
        $this->path = $path;
        $this->category = $category;
    }

    public function __toString() {
        return $this->path;
    }
}

?>