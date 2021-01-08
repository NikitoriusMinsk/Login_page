<?php
    include "CRUD.php";
    
    $worker = new CRUD("users.xml");
    $login = $_POST["login"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    //check if password match
    if($password != $_POST['confirm']){
        echo -1;
        exit;
    }
    //check login 
    if(!preg_match('/^(?=.{6,})[a-zA-Z0-9]*$/m', $login)){
        echo -2;
        exit;
    }
    //check password
    if(!preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/m', $password)){
        echo -3;
        exit;
    }
    //check email
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo -4;
        exit;
    }
    //check name 
    if(!preg_match('/^(?=.{2,})[a-zA-Z0-9]*$/m',$name)){
        echo -5;
        exit;
    }

    $worker->RegisterUser($login,$password,$email,$name);

?>