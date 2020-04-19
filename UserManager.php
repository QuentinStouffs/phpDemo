<?php
require_once('DbManager.php');

class UserManager extends DbManager
{
    private $user_list;

    function __construct() {
        parent::__construct();
        $this->table = 'users';
        $this->user_list = array();
    }

    function save($data) {

        $data['pk'] = -1;
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['name'],
            'password' =>$data['password'],
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);
        if ($user) {
            $this->persist($user);
        }
    }

    function fetchAll() {
        $results = $this->fetchAllInArray();
        foreach($results as $user) {
            array_push($this->user_list, $this->create($user));
        }
        return $this->user_list;
    }

    function fetch($pk) {
        return $this->create($this->fetchOne($pk));
    }

    function create($data) {
        return new User(
            $data['pk'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at']
        );
    }

    function update($data) {
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['name'],
            'password' =>$data['password'],
            'created_at' => $data['created_at'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($user) {
            $this->updateTable($user);
        }
    }
}