<?php

class Signup extends Dbh{

    protected function setUser($uid,$surname,$email,$phone,$pwd,$utype){
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid,users_sname,users_email,users_ph,users_pwd, users_utype) VALUES (?,?,?,?,?,?);');
        
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid,$surname,$email,$phone,$hashedPwd,$utype))){
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($email){
        $stmt = $this->connect()->prepare('SELECT users_email FROM users WHERE users_email = ?;');
        
        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        $resultcheck = false;
        if($stmt->rowCount() > 0){
            $resultcheck = false;
        }
        else{
            $resultcheck = true;
        }
        return $resultcheck;
    }

}
?>