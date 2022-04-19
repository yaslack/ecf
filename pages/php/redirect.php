<?php
  if ( !isset($_SESSION) ) session_start();

function RedirectAdmin(){
    if(isset($_SESSION['name'])){
        if($_SESSION['name'][2] != 2)
        header('Location: Error.php');
    }
    else{
        header('Location: Error.php');
    }

}

function RedirectManager(){
    if(isset($_SESSION['name'])){
        if($_SESSION['name'][2] != 1)
        header('Location: Error.php');
    }
    else{
        header('Location: Error.php');
    }
}

function RedirectLoginRegister(){
    if(isset($_SESSION['name'])){
        header('Location: Error.php');
    }
}



?>