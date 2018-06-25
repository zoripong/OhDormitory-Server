<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
$link=mysqli_connect("localhost","dorm","admin@)!*", "dorm" );

if (!$link)
{
    echo "MySQL 접속 에러 : ";
    echo mysqli_connect_error();
    exit();
}

mysqli_set_charset($link,"utf8");   
/*
    jo.put("emirim_id", emirim_id);
    jo.put("password", password);
    jo.put("new_password", newPassword);
*/
$emirim_id = $_REQUEST["emirim_id"];
$password = $_REQUEST["password"];
$new_password = $_REQUEST["new_password"];

$sql = "UPDATE user SET password='".$new_password."' where emirim_id='".$emirim_id."' AND password='".$password."'";
$result=mysqli_query($link, $sql);

if(!$result){

    echo "SQL문 처리중 에러 발생 : ";
    echo mysqli_error($link);
}

mysqli_close($link);
    
?>
