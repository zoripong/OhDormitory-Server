<?php

// TODO
error_reporting(E_ALL);

ini_set("display_errors", 1);

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
"user_score" : {
    "emirim_id" : {
        [
            "id" : id,
            "date" : date,
            "score_id" :score_id
        ],
        [
            "id" : id,
            "date" : date,
            "score_id" :score_id
        ]
    }

}*/


$sql="select * from user_score order by emirim_id";

$result=mysqli_query($link,$sql);
$data = array();
$data_user_detail = array();
$emirim_id ="";
$isFirst = true;

if($result){
    while($row=mysqli_fetch_array($result)){
        
        if($isFirst){
            $emirim_id = $row[1];
            $isFirst = false;
        }
        

        if($emirim_id != $row[1]){
            $data_user_detail = array();
            $emirim_id = $row[1];
        }

        array_push($data_user_detail, array(
            'id' => $row[0],
            'date' => $row[2],
            'score_id' => $row[3]  
        ));

        $data[$emirim_id] = $data_user_detail;

    }

        header('Content-Type: application/json; charset=utf8');
        $json = json_encode(array("user_score"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        echo $json;
    }else{
        echo "SQL문 처리중 에러 발생 : ";
        echo mysqli_error($link);
    }
    mysqli_close($link);


?>