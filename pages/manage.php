
<?php
 
$dir = "../assets/hotels";
$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
$numberHotels = iterator_count($fi);
$hotelsName = scandir($dir);



function firstCarousel(){
    $manager = GetManagers();
    echo'
    <div class="carousel-item active img-fluid">
        <img src="../assets/hotels/'.$manager[0].'/facade/'.$manager[0].'.jpg" class="d-block w-100" >
    </div>
    ';
}

function restCarousel(){
    
    $manager = GetManagers();
    $numberHotels = count($manager);
    for($i=1; $i<=$numberHotels-1; $i++){
    echo '
    <div class="carousel-item">
        <img src="../assets/hotels/'.$manager[$i].'/facade/'.$manager[$i].'.jpg" class="d-block w-100" >
    </div>
    ';
    }
}


function test(){
    $managers = GetManagers();
}






?>
