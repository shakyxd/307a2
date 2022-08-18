<?php

class Signup extends Dbh{

    protected function setUser($uid,$pwd,$utype){
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_utype) VALUES (?, ?, ?);');
        
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid,$hashedPwd,$utype))){
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($uid){
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ?;');
        
        if(!$stmt->execute(array($uid))){
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