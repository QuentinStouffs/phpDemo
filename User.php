<?php
class User {
    private $pk;
    private $username;
    private $password;
    private $createdAt;
    private $updatedAt;

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
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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