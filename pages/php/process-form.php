<?php

if(isset($_POST["Login"])){ 
    header("Location: ../index.php");
    login();
}

else if(isset($_POST["Register"])){
        header("Location: ../LoginRegister.php");
        register();
    }

function login(){

    $Email = $_POST['emailogin'];

    include_once('Client.php');
    include_once("dbActions.php");
    include_once("dbConnect.php");
    $clientInfo = getClientConnection($Email);
    $FirstName = $clientInfo[0];
    $LastName = $clientInfo[1];
    $client->updateClient($FirstName,$LastName);
    session_start();
    $_SESSION['name'] = $clientInfo;    
}

function register(){


    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['emailregister'];
    $Password = $_POST['passwordregister'];
    
    include_once("dbActions.php");
    createAccount($FirstName,$LastName,$Email,$Password);

}

?>