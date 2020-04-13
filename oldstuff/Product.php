<?php


class Product
{
    private $pk;
    private $name;
    private $price;
    private $vat;
    private $price_vat;
    private $price_total;
    private $quantity;

    /**
     * Product constructor.
     * @param $pk
     * @param $name
     * @param $price
     * @param $vat
     * @param $price_vat
     * @param $price_total
     * @param $quantity
     */
    public function __construct($pk, $name, $price, $vat, $price_vat, $price_total, $quantity)
    {
        $this->pk = $pk;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->price_vat = $price_vat;
        $this->price_total = $price_total;
        $this->quantity = $quantity;
    }

   function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
   }

   function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
   }

}