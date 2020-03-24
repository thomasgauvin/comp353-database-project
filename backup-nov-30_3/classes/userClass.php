<?php

class User{
    public $fName;
    public $lName;
    public $admin;
    public $controller;
    public $userID;

    public $email;
    public $password;

    function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }
}

?>