<?php



function getDatabseConnectionInfo(){
    
    $servername = "localhost";
    $dbName = "mysql";
    $username = "root";
    $password = "mysql";

    $info = array($servername,$dbName,$username,$password);
    
    return $info;
}

function connect(){

    $info = getDatabseConnectionInfo();

    $servername = $info[0];
    $dbName = $info[1];
    $username = $info[2];
    $password =$info[3];

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }


    return $conn;
}


?>