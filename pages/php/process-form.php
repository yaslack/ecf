<?php

if(isset($_POST["Login"])){ 
    login();
    header("Location: http://localhost:3000/index.php");
    die();
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
    $Priority = $clientInfo[2];
    $EMAIL = $clientInfo[3];
    $ORDER = $clientInfo[4];
    $client->updateClient($FirstName,$LastName,$Priority,$EMAIL,$ORDER);
    session_start();
    $_SESSION['name'] = $clientInfo;
    var_dump($_SESSION);

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