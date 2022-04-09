
<?php
 
$dir = "../assets/hotels";
$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
$numberHotels = iterator_count($fi);

echo $numberHotels . " number of Hotels";
  
 ?>