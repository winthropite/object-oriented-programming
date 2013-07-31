<?php

setlocale(LC_MONETARY, 'en_US');

class Product {
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    
    public function getSalePrice() {
        return money_format('%.2n', floatval($this->price) * .5);
    }
    
    public function __toString() {
        return $this->name;
    }
}

$product = new Product('movie', 9.95);

echo "<p>The sale price of the {$product} is {$product->getSalePrice()}</p>";

?>