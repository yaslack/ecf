<?php
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







?>