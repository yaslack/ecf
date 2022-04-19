<?php

class Client {
    protected string $FirstName;
    protected string  $LastName;
    protected string  $Priority;
    protected string  $EMAIL;
    protected string  $ORDER;
    function __construct() {
        $this->FirstName = "";
        $this->LastName = "";
        $this->Priority = -1;
        $this->EMAIL = "";
        $this->ORDER = -1;
    }
    public function updateClient($FName,$LName,$Priority,$EMAIL,$ORDER){
        $this->FirstName = $FName;
        $this->LastName = $LName;
        $this->Priority = $Priority;
        $this->EMAIL = $EMAIL;
        $this->ORDER = $ORDER;
    }
    public function getLoginClient(){

        return [$this->FirstName,$this->LastName,$this->Priority,
        $this->EMAIL,$this->ORDER];
    } 
    public function logoutClient(){
        $this->FirstName = "";
        $this->LastName = "";
        $this->Priority = -1; 
        $this->EMAIL = "";
        $this->ORDER = -1;  
    }
}
    $client = new Client();
?>