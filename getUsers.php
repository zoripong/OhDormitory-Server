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

$sql="select * from user";

$result=mysqli_query($link,$sql);
$data = array();
if($result){
    while($row=mysqli_fetch_array($result)){
                array_push($data, array(
                        'emirim_id'=>$row[0],
                        'password' => $row[1],
                        'name'=>$row[2],
                        'room_num'=>$row[3],
                        'student_phone'=>$row[4],
                        'parent_phone'=>$row[5]
                ));
        }
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("user"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
    }else{
        echo "SQL문 처리중 에러 발생 : ";
        echo mysqli_error($link);
    }
    mysqli_close($link);


?>