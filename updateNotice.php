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

    $notice_id = $_POST["notice_id"];
    $type = $_POST["type"];
    $title = $_POST["title"];
    $w_time = $_POST["w_time"];
    $d_time = $_POST["d_time"];

    $sql = "UPDATE notice SET title='".$title."', w_time='".$w_time."', d_time='".$d_time."' where notice_id=".$notice_id;
    $result=mysqli_query($link, $sql);

    if(!$result){

        echo "SQL문 처리중 에러 발생 : ";
        echo mysqli_error($link);
    }

    if($type == 0){
        $content = $_POST["content"];
        $sql = "UPDATE basic_notice SET content='".$content."' where notice_id=".$notice_id;
        $result=mysqli_query($link, $sql);
        if(!$result){

            echo "SQL문 처리중 에러 발생 : ";
            echo mysqli_error($link);
        }
    }else if($type == 1){
        // "clean_area" : clean_json,
        $clean_area = $_POST["clean_area"];
        echo "\n".$clean_area."\n";
        for($i = 0; $i < 14; $i++ ){
            //DEBUG
            $sql = "UPDATE clean_notice SET clean_room='".$clean_area[$i]."' where notice_id=".$notice_id." AND clean_area=".$i;
            // echo $sql;
            $result=mysqli_query($link, $sql);
            if(!$result){
    
                echo "SQL문 처리중 에러 발생 : ";
                echo mysqli_error($link);
            }
        }

    }else if($type == 2){
        //"sleep_w_time" : $("#modify_sleep_w_time").val(),
        // "sleep_d_time" : $("#modify_sleep_d_time").val()

        $sleep_w_time = $_POST["sleep_w_time"];
        $sleep_d_time = $_POST["sleep_d_time"];

        $sql = "UPDATE sleepout_notice SET sleep_w_time='".$sleep_w_time."', sleep_d_time='".$sleep_d_time."' where notice_id=".$notice_id;
        $result=mysqli_query($link, $sql);
        if(!$result){

            echo "SQL문 처리중 에러 발생 : ";
            echo mysqli_error($link);
        }
    }

    mysqli_close($link);
        
    //TODO
    // Debug updateNotice.php
    // Test deleteNotice.php
        
        
?>
        
        
