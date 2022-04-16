<?php
session_start();

if(isset($_POST['validate'])){
    if($_POST['validate'] == 'currHotel'){
        updateInputs($_POST['hotel']);
    }
}

function firstCarousel(){
    $manager = GetManagers();
    echo'
    <div class="carousel-item active img-fluid">
        <img src="assets/hotels/'.$manager[0].'/facade/'.$manager[0].'.jpg" class="d-block w-100" >
    </div>
    ';
}

function restCarousel(){
    
    $manager = GetManagers();
    $numberHotels = count($manager);
    for($i=1; $i<=$numberHotels-1; $i++){
    echo '
    <div class="carousel-item">
        <img src="assets/hotels/'.$manager[$i].'/facade/'.$manager[$i].'.jpg" class="d-block w-100" >
    </div>
    ';
    }
}

function navbar2Options(){

    if(isset($_SESSION['name'])){
        $FName = $_SESSION['name'][0];
        $LName   = $_SESSION['name'][1];
    }
    else{
        $FName = "";
        $LName   = "";
    }
    if($FName == "" && $LName == ""){
        echo('
        <li class="nav-item">
            <a href="pages/LoginRegister.php" class="nav-link">Login/Register</a>
        </li>
        <li class="nav-item">
            <a href="pages/Contact.php" class="nav-link">Contact us</a>
        </li>
        ');
    }
    else{
        echo('
        <li class="nav-item">
            <p>'.'Hi '.$FName.' '.$LName.'</p>
        </li>
        <li class="nav-item">
            <a href="pages/Contact.php" class="nav-link">Contact us</a>
        </li>
        <li class="nav-item">
            <a href="pages/Logout.php" class="nav-link">Logout</a>
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





?>
