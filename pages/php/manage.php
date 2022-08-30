<?php

if ( !isset($_SESSION) ) session_start();


if(isset($_POST['validate'])){
    if($_POST['validate'] == 'currHotel'){
        updateInputs($_POST['hotel']);
    }
    if($_POST['validate'] == 'NumRoom'){
        numRooms();
    }
    if($_POST['validate'] == 'roomIndex'){
        roomIndex();
        roomIndexMore();
    }
    if($_POST['validate'] == 'currHotelReservation'){
        updateRoomsReservation($_POST['hotel']);
    }
}

function getRoomsDescription($numRooms,$Order,$path){

    $description = [];
    for($i=0; $i<$numRooms; $i++){
        if(file_exists($path."room".($i+1).".txt")){
            $filename = $path."room".($i+1).".txt";
            $file = fopen( $filename, "r" );
            
            if( $file == false ) {
               echo ( "Error in opening file" );
               exit();
            }
            
            $filesize = filesize( $filename );
            $description[$i] = fread( $file, $filesize );
            
            fclose( $file );
        }
    }
    return $description;

}


function updateRoomsReservation($hotel){
    require_once 'dbActions.php';
    $order = getOrderFromHotelName($hotel);
    $path = "../../assets/hotels/".$order."/room/";
    $nbFiles=count(scandir($path))-2;
    $nbImg = 0;
    for($i = 1 ; $i<$nbFiles; $i++)
        if (file_exists($path."room".$i.".png")) {
            $nbImg ++;
    }

    echo '{"Order":"'.$order.'","nbImg":"'.$nbImg.'"}';
    
}

function numRooms(){
    $ORDER = $_SESSION['name'][4];
    if(isset($_POST ['validate'])){
        if($_POST['validate'] == 'NumRoom'){
            $rooms = $_POST['numRoom'];
            echo ("<h5 id='numRoomSent'>You have chosen ".$rooms." Room</h5>");
            
            for($i = 0; $i<$rooms; $i++){
                if ( !isset($_SESSION) ) session_start();
                $ORDER = $_SESSION['name'][4];
                $path = "../../assets/hotels/".$ORDER."/room/";
                $description = getRoomsDescription($rooms,$ORDER,$path);
                if(count($description)<($i+1)){
                    $description[$i] = "Example";
                }
                $pathImage='../../assets/hotels/'.$ORDER.'/room/room'.($i+1).'.png';
                if(file_exists($pathImage)){
                    $pathImage ='../assets/hotels/'.$ORDER.'/room/room'.($i+1).'.png';
                }
                else{
                    $pathImage = '..';
                }

                echo('
                <div class="justify-content-center input-group mb-3">
                <div class="form-group">
                  <label for="testAreaRoom'.($i+1).'">Description:</label>
                  <textarea class="form-control" id="testAreaRoom'.($i+1).'" name="description[]" multiple>'.$description[$i].'</textarea>
                </div>
                <div style="padding-left: 30px;">
                  <div>
                    <img width="100" height="100" src='.$pathImage.'>
                  </div>
                    <label for="file">File:</label>
                    <input type="file" name="files[]" accept=".png" multiple>
                </div>
              </div>
                ');

            }
            
        }
    }
    else{
        echo ("<h5 id='numRoomSent'></h5>");
        
    }
}

function numberHotelLabel(){

    $path = 'assets/hotels/';
    $files = array_diff(scandir($path), array('.', '..'));
    $numberFiles = count($files);
    if($numberFiles==0){
        echo("  
        <h1 >
            Sorry no Hotel available at this moment
        </h1>
        ");
    }
    else if($numberFiles==1){
        echo $numberFiles;
        echo("  
        <h1 >
        Discover Our Hotel
        </h1>
        ");
    }
    else{

        echo("  
        <h1 >
            Discover Our ".$numberFiles." Hotels
        </h1>
        ");
    }
}

function firstCarousel(){
    $path = 'assets/hotels/';
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
    
    $path = 'assets/hotels/';
    $files = array_diff(scandir($path), array('.', '..'));
    if(count($files)>1){
        for($i=2; $i<=count($files);$i++){
            echo '
            <div class="carousel-item">
                <img src="assets/hotels/'.$i.'/facade/facade.png" class="d-block w-100" >
            </div>
            ';
        }
    }
}

function roomIndex(){
    
    if(isset($_POST['numActualRoom'])){
        $Order = $_POST['numActualRoom'];
        $path= "../../assets/hotels/".$Order."/room/";
        $files = glob($path."*.txt");
        $numRoom = count($files);
        $description = getRoomsDescription($numRoom,$Order,$path);
        for($i=0; $i<count($description);$i++){
            $imgSrc = "../../assets/hotels/".$Order."/room/room".($i+1).".png";
            if(file_exists($imgSrc)){
                $imgSrc = "assets/hotels/".$Order."/room/room".($i+1).".png";
            }
            else{
                $imgSrc = "assets/NoImage.png";
            }
            echo('
            <div class="row" style="margin-top:10px">
                <div class="col-xs-12 col-sm-6 pull-right">
                    <img width="500" src='.$imgSrc.'
                        class="img-fluid">
                </div>
                <div class="col-xs-12 col-sm-6 pull-left text-center">
                    <p id="descRoom">
                    '.$description[$i].'
                    </p> 
                </div>
            </div>
            '
            );
        }
    }

}

function roomIndexMore(){
    if(isset($_POST['numActualRoom'])){
        echo('
        <div class="justify-content-center input-group mb-3">
            <a id="btnMore" class="navbar-brand m-md-5" href="pages/Hotels.php?hotel='.$_POST['numActualRoom'].'">More..</a>
        </div>
        ');
    }

}

function loadHotelPage($page){
    echo('
    <div id="facadeHotel">
        <img src="../assets/hotels/'.$page.'/facade/facade.png">
    </div>

    ');
    $path= "../assets/hotels/".$page."/room/";
    if(file_exists($path)){
        $files = glob($path."*.txt");
        $numRoom = count($files);
        $descriptionRoom = getRoomsDescription($numRoom,$page,$path);
        for($i=0; $i<count($descriptionRoom);$i++){
            $imgSrc = "../assets/hotels/".$page."/room/room".($i+1).".png";
            if(file_exists($imgSrc)){
                $imgSrc = "../assets/hotels/".$page."/room/room".($i+1).".png";
            }
            else{
                $imgSrc = "../assets/NoImage.png";
            }
            echo('
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 pull-right">
                            <div class="justify-content-center input-group mb-3">
                                <img width="250" src='.$imgSrc.'
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 pull-left text-center">
                            <p id="descRoom">
                            '.$descriptionRoom[$i].'
                            </p> 
                        </div>
                    </div>
                </div>
            ');
        }
    }
    else{
        echo("
        <p>This Hotel does not exist</p>
        ");
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
        <li class="nav-item">
            <a href="pages/Reservation.php" class="nav-link">Book</a>
        </li>
        <li class="nav-item">
            <a href="pages/Book.php" class="nav-link">My Book</a>
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
                <img style="padding:10px" border="0" src="'.$path.'/facade/facade.png" alt="Image" width="100"
                 height="100" />
            ');
            }
        }

    }
}

function bookLoad(){

    require_once 'dbActions.php';

    $book = getBookUser();

    if(count($book[0]) == 0){
        echo('
        <div class="justify-content-center input-group mb-3">
        <h3>You have no reservations</h3>
    </div>
    <div class="justify-content-center input-group mb-3">
        <a href="Reservation.php" class="nav-link">Click here to make one</a>
    </div>
        
        ');
    }
    else{

        echo "<script> window.onload = function() {
            checkBookValidity();
        }; </script>";
    ;    

        for($i = 0 ; $i < count($book[0]); $i++){
            $date1 = explode(':',$book[2][$i])[0];
            $date2 = explode(':',$book[2][$i])[1];
            $name = $book[0][$i].'_'.$book[1][$i].'_'.$book[2][$i];
            echo('
        
            <div class="justify-content-center input-group mb-3">
            <div style="background-color: rgb(43, 43, 43);" class="container">
                <div class="box">
                    <div style="color:white;">
                    Hotel:'.$book[0][$i].'</div>
                    <div style="color:white;">
                    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</div>
                    <div style="color:white;">
                    Room: '.$book[1][$i].'</div>
                </div>
                <div class="box">
                    <div style="color:white;">
                    From '.$date1.' To '.$date2.'</div>
                </div>
                <div class="box">
                <button class = "CancelButton" name ='.$name.' onclick="CancelBook(this.name)" > Cancel Book </button>
                </div>
            </div>
            </div>
            
            ');
        }
    }




}

?>