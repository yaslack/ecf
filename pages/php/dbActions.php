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
    else if($_POST['validate'] == 'UpdateInfo') {
        UpdateInfoManager($_POST['Order'],$_POST['Name'],$_POST['City'],$_POST['Adress'],$_POST['Description'],
        $_POST['FirstName'],$_POST['LastName'],$_POST['Email'],$_POST['Password']);
    }
    else if($_POST['validate'] == 'DeleteInfo') {
        DeleteInfoManager($_POST['Order'],$_POST['Email']);
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
    $clientInfo[] = getClientPriority($Email);
    $clientInfo[] = $Email;

    if(getClientPriority($Email) ==  1){
        $sql =  'select `order` from hotels where Email = "'.$Email.'"';
        $statement = $conn->query($sql);
        $client = $statement->fetchAll(PDO::FETCH_ASSOC);
        $clientInfo[] = $client[0]['order'];
    }
    else{
        $clientInfo[] = -1;
    }

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
    $order = $name = $Client[0]['order'];
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
    
    echo '{"Order":"'.$order.'","Name":"'.$name.'","City":"'.$city.'",
        "Adress":"'.$adress.'","LastName":"'.$LastName.'",
        "FirstName":"'.$FirstName.'","Email":"'.$Email.'",
        "Hash":"'.$Hash.'","Description":'.json_encode($description).'}';

}

function createHotel($Email,$Manager,$HotelName,$Description,$Adress,$City){
    require_once 'dbConnect.php';

    $conn = connect();

    $sql = 'select Max(`order`) from hotels';

    $statement = $conn->query($sql);
    $MaxOrder = $statement->fetchAll(PDO::FETCH_ASSOC);
    $MaxOrderValue = $MaxOrder[0]["Max(`order`)"]; 

    $sql = 'Insert Into hotels (`order`,manager,HotelName,description,adress,city,Email) Values(?,?,?,?,?,?,?)';
    $sql= $conn->prepare($sql);
    $sql->execute([$MaxOrderValue+1,$Manager, $HotelName, $Description, $Adress, $City,$Email]);
}

function CreateInfoManager($Name,$City,$Adress,$Description,$FirstName,$LastName,$Email,$Password){
    if(CheckRegister($Email)){
        createAccount($FirstName,$LastName,$Email,$Password,1);
        $managerName = $FirstName." ".$LastName;
        createHotel($Email,$managerName,$Name,$Description,$Adress,$City);
    }

    echo "Correct";

}

function UpdateInfoManager($Order,$Name,$City,$Adress,$Description,$FirstName,$LastName,$Email,$Password){
    require_once 'dbConnect.php';
    
    $conn = connect();
    $managerName = $FirstName." ".$LastName;
    $data = [
        'manager'=>$managerName, 
        'HotelName' => $Name, 
        'Description' => $Description,
        'Adress' => $Adress,
        'city' => $City,
        'Order' => (int)$Order
   ];
   
   $sql = "UPDATE hotels SET manager=:manager,
    HotelName=:HotelName, description=:Description,
     adress=:Adress, city=:city WHERE `order`=:Order";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    
    $sql = "UPDATE account SET FirstName=?, LastName=?, Password=? WHERE Email=?";
    $stmt= $conn->prepare($sql);
    $hash = crypt($Password, PASSWORD_DEFAULT);
    $stmt->execute([$FirstName, $LastName, $hash, $Email]);

    echo "Correct";
      
}

function DeleteInfoManager($Order,$Email){
    require_once 'dbConnect.php';
    $conn = connect();
    $sql =  " DELETE FROM hotels WHERE `order`=?";
    $sql= $conn->prepare($sql);
    $sql->execute([$Order]);

    $sql =  " DELETE FROM account WHERE Email=?";
    $sql= $conn->prepare($sql);
    $sql->execute([$Email]); 

    $sql =  "UPDATE hotels set `order` = `order`-1 where `order` > ?";
    $sql= $conn->prepare($sql);
    $sql->execute([$Order]);

    $path = 'assets/hotels/'.$Order.'/';

    deleteDir($path);

    echo "Correct";

}

function getClientPriority($Email){
    require_once 'dbConnect.php';
    $conn = connect();

    $sql = 'SELECT Priority FROM account where Email= "'.$Email.'"';
    $statement = $conn->query($sql);
    // get all publishers
    $Priority = $statement->fetchAll(PDO::FETCH_ASSOC);
    $PriorityValue = $Priority[0]["Priority"];
    return $PriorityValue;
} 

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);

}


?>
