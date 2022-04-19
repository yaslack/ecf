<?php

if ( !isset($_SESSION) ) session_start();


if(isset($_POST['validate'])){
    if($_POST['validate'] == 'currHotel'){
        updateInputs($_POST['hotel']);
    }
}

function numberHotelLabel(){

    $path = '../assets/hotels/';
    $files = array_diff(scandir($path), array('.', '..'));
    if(count($files)==0){
        echo("  
        <h1 >
            Sorry no Hotel available at this moment
        </h1>
        ");
    }
    else if(count($files)==1){
        echo count($files);
        echo("  
        <h1 >
        Discover Our Hotel
        </h1>
        ");
    }
    else{

        echo("  
        <h1 >
            Discover Our ".count($files)." Hotels
        </h1>
        ");
    }
}

function firstCarousel(){
    $path = '../assets/hotels/';
    $files = array_diff(scandir($path), array('.', '..'));
    if(count($files)==0){
        echo "0 Image Loaded";
    }
    else{
        echo'
        <div class="carousel-item active img-fluid">
            <img src="assets/hotels/1/facade/facade.png" class="d-block w-100" >
        </div>
        ';

    }
}

function restCarousel(){
    
    $path = '../assets/hotels/';
    $files = array_diff(scandir($path), array('.', '..'));
    if(count($files)==0){
        echo "0 Image Loaded";
    }
    else{
        for($i=1; $i<=count($files);$i++){
            echo '
            <div class="carousel-item">
                <img src="assets/hotels/'.($i+1).'/facade/facade.png" class="d-block w-100" >
            </div>
            ';
        }
    }
}

function navbar2Options(){

    if(isset($_SESSION['name'])){
        $FName = $_SESSION['name'][0];
        $LName   = $_SESSION['name'][1];
        echo('
        <li class="nav-item">
            <p>'.'Hi '.$FName.' '.$LName.'</p>
        </li>
        <li class="nav-item">
            <a href="../index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="pages/Contact.php" class="nav-link">Contact us</a>
        </li>
        <li class="nav-item">
            <a href="pages/Logout.php" class="nav-link">Logout</a>
        </li>
        ');
        if($_SESSION['name'][2] == 1){
            echo('
            <li class="nav-item">
                <a href="pages/Manager.php" class="nav-link">Manager</a>
            </li>
            ');
        }
        else if($_SESSION['name'][2] == 2){
            echo('
            <li class="nav-item">
                <a href="pages/Admin.php" class="nav-link">Admin</a>
            </li>
            ');
        }
    }
    else{
        echo('
        <li class="nav-item">
            <a href="pages/LoginRegister.php" class="nav-link">Login/Register</a>
        </li>
        <li class="nav-item">
            <a href="pages/Contact.php" class="nav-link">Contact us</a>
        </li>
        ');
    }

}

function AdminHotelsChose(){
    $hotels = getHotels();
    foreach($hotels as $index=>$hotel){
        //$number = $index+1;
        echo '<option value="'.$hotel.'">'.$hotel.'</option>';
    }
}

function updateInputs($hotel){
    require_once 'dbActions.php';
    getAdminInput($hotel);

}

function facadeImage(){
    if(isset($_SESSION['name'])){
        $ORDER = $_SESSION['name'][4];
        $path = '../assets/hotels/'.$ORDER;
        if (!file_exists($path)) {
            mkdir($path.'/facade', 0777, true);
            mkdir($path.'/room', 0777, true);
            echo "0 Image Loaded";
        }
        else{
            $files = array_diff(scandir($path.'/facade'), array('.', '..'));
            if(count($files)==0){
                echo "0 Image Loaded";
            }
            else{
                echo('
                <img border="0" src="'.$path.'/facade/facade.png" alt="Image" width="100"
                 height="100" />
            ');
            }
        }

    }
}

?>