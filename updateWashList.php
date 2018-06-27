<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
$link=mysqli_connect("localhost","dorm","admin@)!*", "dorm" );
date_default_timezone_set('Asia/Seoul');
$date = date('w');
if (!$link)
{
    echo "MySQL 접속 에러 : ";
    echo mysqli_connect_error();
    exit();
}

mysqli_set_charset($link,"utf8");   

/*
// this.washer_num = washer_num;
// this.wash_time = wash_time;
// this.emirim_id = emirim_id;
// this.isInsert = isInsert;
*/

$washer_num = $_POST["washer_num"];
$wash_time = $_POST["wash_time"];
$emirim_id = $_POST["emirim_id"];
$isInsert = $_POST["isInsert"];

echo $isInsert;

$sql ="";
if($isInsert === "true"){
    //insert
    $sql = "insert into wash_applying_user values(null, ".$date.", ".$washer_num.", ".$wash_time.", '".$emirim_id."')";
}else{
    $sql = "delete from wash_applying_user where wash_day=".$date." AND washer_num=".$washer_num." AND wash_time=".$wash_time." AND emirim_id='".$emirim_id."'";

}

$result=mysqli_query($link, $sql);

if(!$result){

    echo "SQL문 처리중 에러 발생 : ";
    echo mysqli_error($link);
}
    
mysqli_close($link);
//TODO Delete    
?>
