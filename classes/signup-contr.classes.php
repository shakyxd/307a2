<?php

class SignupContr extends Signup{
    private $uid;
    private $pwd;
    private $utype;

    public function __construct($uid,$pwd,$utype){
        $this->uid =$uid;
        $this->pwd =$pwd;
        $this->utype=$utype;
    }

    public function signupUser(){
        if($this->emptyImput()== false){
            header("location:../index.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid()== false){
            header("location:../index.php?error=username");
            exit();
        }
        if($this->uidTakensCheck()== false){
            header("location:../index.php?error=usernametaken");
            exit();
        }
        $this->setUser($this->uid,$this->pwd ,$this->utype);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->uid)||empty($this->pwd)||empty($this->utype)){
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUid(){
        $result = true;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result;
        if(!$this->checkUser($this->uid)){
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}
?>