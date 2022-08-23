<?php

class SignupContr extends Signup{
    private $uid;
    private $surname;
    private $email;
    private $phone;
    private $pwd;
    private $utype;

    public function __construct($uid,$surname,$email,$phone,$pwd,$utype){
        $this->uid =$uid;
        $this->surname =$surname;
        $this->email=$email;
        $this->phone=$phone;
        $this->pwd =$pwd;
        $this->utype =$utype;
    }

    public function signupUser(){
        if($this->emptyInput()== false){
            header("location:../index.php?error=emptyinput");
            exit();
        }
        if($this->emailTakenCheck()== false){
            header("location:../index.php?error=emailtaken");
            exit();
        }
        $this->setUser($this->uid,$this->surname,$this->email,$this->phone,$this->pwd ,$this->utype);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->uid)||empty($this->surname)||empty($this->email)||empty($this->phone)||empty($this->pwd)||empty($this->utype)){
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function emailTakenCheck(){
        $result= true;
        if(!$this->checkUser($this->email)){
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}
?>