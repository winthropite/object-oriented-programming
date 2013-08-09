<?php

namespace CDIA;

class Photo {
    public $filename;
    public $category;

    public function __construct($filename, $category) {
        $this->filename = $filename;
        $this->category = $category;
    }

    public function __toString() {
        return BASE_PATH . 'uploads/' . $this->category . '/' . $this->filename;
    }
}

?>