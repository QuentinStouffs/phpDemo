<?php
class User {
    public $pk;
    public $username;
    public $password;
    public $created_at;
    public $updated_at;

    /**
     * User constructor.
     * @param $pk
     * @param $username
     * @param $password
     * @param $createdAt
     * @param $updatedAt
     */
    public function __construct($pk, $username, $password, $createdAt, $updatedAt)
    {
        $this->pk = $pk;
        $this->username = $username;
        $this->password = $password;
        $this->created_at = $createdAt;
        $this->updated_at = $updatedAt;
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