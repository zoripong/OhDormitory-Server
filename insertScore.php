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

    $emirim_id = $_POST['emirim_id'];
    $date = $_POST['date'];
    $score_id = $_POST['score_id'];

    $sql = "INSERT INTO user_score VALUES(null, '".$emirim_id."', '".$date.", ".$score_id.")";
    $result=mysqli_query($link,$sql);
    
    if(!$result){
            echo "SQL문 처리중 에러 발생 : ";
            echo mysqli_error($link);
    }

    mysqli_close($link);
?>
