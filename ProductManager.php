<?php
//dao = data acces object
//dal = data access layer
class ProductManager {
    private $table;
    private $connection;
    private $product_list;
    
    function __construct() {
        $this->table = 'products';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo_php', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, price, vat, price_vat, price_total, quantity) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
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
            try {
                $statement = $this->connection->prepare(
                    "UPDATE {$this->table} SET name = ?, price = ?, vat = ?, price_vat = ?, price_total = ?, quantity = ? WHERE pk = ?"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity'),
                    $product->__get('pk')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }
    
    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $product) {
                array_push($this->product_list, $this->create($product));
            }
            return $this->product_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }    
    }
    
    function fetch($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $this->create($result);
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }
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
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            if($statement->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return false;
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
