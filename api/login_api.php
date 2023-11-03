<?php

header("Access-Control-Allow-Methods: POST");
include("../config/user_config.php");
$config = new user_Config();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $config->login($email,$password);

    if($res){
        $arr['data'] = "login successfully....";
    }else{
        $arr['data'] = "user not  Failed.....";
    }

}else{
    $arr['error'] = "only psot HTTP method is allowed.....";
}

echo json_encode($arr);

?>