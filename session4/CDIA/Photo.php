<?php

namespace CDIA;

class Photo {
    
    public $path;
    
    public function __construct($path) {
        $this->path = $path;
    }
    
    public function __toString() {
        return $this->path;
    }
    
}

?>