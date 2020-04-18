<?php
require_once("DbManager.php");
//dao = data acces object
//dal = data access layer
class ProductManager extends DbManager {
    private $product_list;
    
    function __construct() {
        parent::__construct();
        $this->table = 'products';
        $this->product_list = array();
    }

    function verif($data){
        $flag = 0;
        if (preg_match( '/[!@#$%^&*(),.?":{}|<>]/',$data['name'])) {
            $flag+=1;
        }
        if (!is_numeric($data['price']) && $data['price'] < 0) {
            $flag += 1;
        }
        if (!is_numeric($data['quantity']) && $data['price'] < 0) {
            $flag += 1;
        }

        return $flag == 0;
    }

    function save($data) {
        if(!$this->verif($data)){
            return false;
        }
        $data['pk'] = -1;
        $product = $this->create([
            'pk' => $data['pk'],
            'name' => $data['name'],
            'price' =>$data['price'],
            'vat' => 0,
            'price_vat' => 0, 
            'price_total' => 0,
            'quantity' => $data['quantity']
        ]);
        
        if ($product) {
            $this->persist($product);
        } 
    }

    function update($data) {
        if(!$this->verif($data)) {
            return false;
        }
        $product = $this->create([
            'pk' => $data['pk'],
            'name' => $data['name'],
            'price' =>$data['price'],
            'quantity' => $data['quantity']
        ]);

        if ($product) {
            $this->updateTable($product);
        }
    }
    
    function fetchAll() {
        $results = $this->fetchAllInArray();
        foreach($results as $product) {
            array_push($this->product_list, $this->create($product));
        }
        return $this->product_list;
    }
    
    function fetch($pk) {

        return $this->create($this->fetchOne($pk));
    }
    
    function create($data) {
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['quantity']
        );
    }

    function delete($pk) {
        return $this->erase($pk);
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
}
