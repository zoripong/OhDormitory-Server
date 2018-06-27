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
$washer_num = $_REQUEST["washer_num"];
$wash_time = $_REQUEST["wash_time"];
$emirim_id = $_REQUEST["emirim_id"];
$isInsert = $_REQUEST["isInsert"];


$data = array();
$return_code=-1;

$sql ="";
if($isInsert == "true"){
    //insert
    $sql = "insert into wash_applying_user (wash_day,washer_num,wash_time,emirim_id) values(".$date.", ".$washer_num.", ".$wash_time.", '".$emirim_id."')";
    //echo $sql;
    $result=mysqli_query($link, $sql);
    if($result){
        $return_code=1;

    }else{
        $return_code=0;

    }

}else{
    $sql = "delete from wash_applying_user where wash_day=".$date." and washer_num=".$washer_num." and wash_time=".$wash_time." and emirim_id='".$emirim_id."';";
    //echo $sql;

    $result=mysqli_query($link, $sql);
    if($result){
        $return_code=2;

    }else{
        $return_code=0;

    }

}

array_push($data,array(
    'return_code'=>$return_code
));

header('Content-Type: application/json; charset=utf8');
$json = json_encode(array("return_code"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
echo $json;
    
mysqli_close($link);
    
?>