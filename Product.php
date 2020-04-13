<?php 
//objet metier - entities
class Product {
    private $pk;
    private $name;
    private $price;
    private $vat = 21;
    private $price_vat;
    private $price_total;
    private $quantity;
    
    function __construct($pk, $name, $price, $quantity) {
        $this->pk = $pk;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->calculateVat();
    }
    
    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }

    function calculateVat() {
        $this->price_vat = ($this->price/100)*$this->vat;
        $this->price_total = $this->price + $this->price_vat;
    }
}
