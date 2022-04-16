<?php


if(isset($_POST['validate'])) {
    if($_POST['validate'] == 'CheckLogin') {
        CheckLogin($_POST['email'],$_POST['password']);
    }
    else if($_POST['validate'] == 'CheckRegister') {
        CheckRegister($_POST['email']);
    }
    else if($_POST['validate'] == 'CreateInfo') {
        CreateInfoManager($_POST['Name'],$_POST['City'],$_POST['Adress'],$_POST['Description'],
        $_POST['FirstName'],$_POST['LastName'],$_POST['Email'],$_POST['Password']);
    }
}



function GetManagers(){
    $conn = connect();

    $sql = 'select * from hotels';
    $statement = $conn->query($sql);


    $managers = $statement->fetchAll(PDO::FETCH_ASSOC);

    $result = array();

    if ($managers) {
        foreach ($managers as $manager) {
            $result[] = $manager['manager'];
        }
    }

    return $result;
}

function getHotels(){
    
    $conn = connect();

    $sql = 'select * from hotels';
    $statement = $conn->query($sql);


    $hotels = $statement->fetchAll(PDO::FETCH_ASSOC);

    $result = array();

    if ($hotels) {
        foreach ($hotels as $hotel) {
            $result[] = $hotel['HotelName'];
        }
    }

    return $result;
}

function getClientConnection($Email){

    $conn = connect();

    $sql =  'select * From ACCOUNT WHERE Email = "'.$Email.'"';
    $statement = $conn->query($sql);


    $client = $statement->fetchAll(PDO::FETCH_ASSOC);

    $result = array();

    $clientInfo[] = $client[0]['FirstName'];
    $clientInfo[] = $client[0]['LastName'];

    return $clientInfo;
}

function CheckRegister($Email){

    if($Email == ""){
        echo "Empty";
        return false;
    }
    
    require_once 'dbConnect.php';
    $conn = connect();

    
    $sql = 'select * From ACCOUNT WHERE Email = "'.$Email.'"';

    $statement = $conn->query($sql);
    $Client = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($Client) {
        echo "Exist";
        return false;
    }

    echo "Correct";
    return true;
}

function CheckLogin($Email,$Password){

    if($Email == ""){
        echo "Email empty";
        return false;
    }
    else if($Password == ""){
        echo "Password empty";
        return false;
    }

    require_once 'dbConnect.php';
    $conn = connect();

    
    $sql = 'select * From ACCOUNT WHERE Email = "'.$Email.'"';

    $statement = $conn->query($sql);
    $Client = $statement->fetchAll(PDO::FETCH_ASSOC);
    $hash = null;
    if ($Client) {
        $hash = $Client[0]['Password'];
        //echo "Correct Email!";
    }
    else{
        echo "Incorrect Email!";
        return false;
    }

    
    $verify = password_verify($Password, $hash);
  
    // Print the result depending if they match
    if ($verify) {
        //echo 'Password Verified!';
    } else {
        echo 'Incorrect Password!';
        return false;
    }
    echo 'Correct';
    return true;
}

function createAccount ($FirstName,$LastName,$Email,$Password,$Priority=0)
{
    require_once 'dbConnect.php';
    $conn = connect();
    $sql = 'Insert Into ACCOUNT () Values(?,?,?,?,?)';
    $sql= $conn->prepare($sql);
    $hash = crypt($Password, PASSWORD_DEFAULT);

    $sql->execute([$FirstName, $LastName, $Email, $hash, $Priority]);
    
}



function getAdminInput($hotel){

    require_once 'dbConnect.php';
    $conn = connect();

    
    $sql = 'select * From hotels WHERE HotelName = "'.$hotel.'"';

    $statement = $conn->query($sql);
    $Client = $statement->fetchAll(PDO::FETCH_ASSOC);
    $name = $Client[0]['HotelName'];
    $manager = $Client[0]['manager'];
    $city = $Client[0]['city'];
    $adress = $Client[0]['adress'];
    $description = $Client[0]['description'];
    $FirstName = explode(' ',$Client[0]['manager'])[0];
    $LastName = explode(' ',$Client[0]['manager'])[1];

    $sql = 'select * From account WHERE priority = 1
    and FirstName = "'.$FirstName.'" and LastName = "'.$LastName.'"';

    $statement = $conn->query($sql);
    $Client2 = $statement->fetchAll(PDO::FETCH_ASSOC);
    $Email = $Client2[0]['Email'];
    $Hash = $Client2[0]['Password'];
    
    echo '{"Name":"'.$name.'","City":"'.$city.'",
        "Adress":"'.$adress.'","LastName":"'.$LastName.'",
        "FirstName":"'.$FirstName.'","Email":"'.$Email.'",
        "Hash":"'.$Hash.'","Description":'.json_encode($description).'}';

}

function createHotel($Manager,$HotelName,$Description,$Adress,$City){
    require_once 'dbConnect.php';
    $conn = connect();
    $sql = 'Insert Into hotels () Values(?,?,?,?,?)';
    $sql= $conn->prepare($sql);
    $sql->execute([$Manager, $HotelName, $Description, $Adress, $City]);
}

function CreateInfoManager($Name,$City,$Adress,$Description,$FirstName,$LastName,$Email,$Password){
    if(CheckRegister($Email)){
        createAccount($FirstName,$LastName,$Email,$Password,1);
        $managerName = $FirstName." ".$LastName;
        createHotel($managerName,$Name,$Description,$Adress,$City);
    }

}

?>
