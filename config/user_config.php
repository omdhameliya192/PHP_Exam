<?php

class user_Config{

    public $HOSTNAME = "127.0.0.1";
    public $USERNAME = "root";
    public $PASSWORD = "";
    public $DB_NAME = "php";
    public $con_res;

    public function connect(){
        $this->con_res = mysqli_connect($this->HOSTNAME,$this->USERNAME,$this->PASSWORD,$this->DB_NAME);
        return $this->con_res;
    }

    public function insert($name,$email,$password){
        $this->connect();

        $_hash_password = password_hash($password,PASSWORD_DEFAULT);

        $query = "INSERT INTO user(name,email,password) VALUES('$name','$email','$_hash_password');";

        $res = mysqli_query($this->con_res,$query);
        return $res;
    }

    public function login($email,$password){

        $this->connect();

        $query = "SELECT * FROM user WHERE email = '$email'";

        $obj = mysqli_query($this->con_res,$query);

        $record = mysqli_fetch_assoc($obj);

        $hash_pass = $record['password'];

        $res = password_verify($password, $hash_pass);

        if($res){
            return true;
        }else{
            return false;
        }

    }

    public function insert_image($name,$path){
        $this->connect();

        $query = "INSERT INTO images(name,path) VALUES('$name','$path');";

        $res = mysqli_query($this->con_res,$query);
        return $res;
    }

    public function select_one_image($id){
        $this->connect();

        $query = "SELECT * FROM images WHERE id=$id";

        $res = mysqli_query($this->con_res,$query);
        $recode = mysqli_fetch_assoc($res);
        return $recode;
    }

    public function delete_image($id){
        $this->connect();

        $recode = $this->select_one_image($id);

        $isUnlink = unlink("../uploads/" .$recode['name']);

        if($isUnlink){
            $query = "DELETE FROM imsges WHERE id=$id";

        $res = mysqli_query($this->con_res,$query);
        return $res;
        }else{
            return false;
        }
    }

}

?>