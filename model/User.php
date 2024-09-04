<?php 

class User {
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}