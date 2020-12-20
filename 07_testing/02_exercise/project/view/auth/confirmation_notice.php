<?php

if(count($_POST) > 0) {

    $user = new \Model\User(
        (int)$_POST["id"],
        $_POST["name"],
        $_POST["surname"],
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_DEFAULT)
    );

    $storageFact = new \Storage\StorageFactoryImpl();

    $mySqlStorage = $storageFact->create("mysql");
    $mySqlStorage->store($user);
};
?>

<h2>Please confirm user registration...</h2>