<?php
    include "CRUD.php";

    $worker = new CRUD("users.xml");

    $worker->LogIn($_POST["login_"], $_POST["password_"]);

?>