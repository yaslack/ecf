<?php

class Client {
    protected string $FirstName;
    protected string  $LastName;
    function __construct() {
        $this->FirstName = "";
        $this->LastName = "";
    }
    public function updateClient($FName,$LName){
        $this->FirstName = $FName;
        $this->LastName = $LName;
    }
    public function getLoginClient(){

        return [$this->FirstName,$this->LastName];
    } 
    public function logoutClient(){
        $this->FirstName = "";
        $this->LastName = "";   
    }
}
    $client = new Client();
?>