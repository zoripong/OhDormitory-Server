<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");

date_default_timezone_set('Asia/Seoul');
$today = date("Y-m-d");
//echo $today;

$link=mysqli_connect("localhost","dorm","admin@)!*", "dorm" );
if (!$link)
{
    echo "MySQL 접속 에러 : ";
    echo mysqli_connect_error();
    exit();
}

mysqli_set_charset($link,"utf8");

//시간이 지난 공지사항 전부 삭제
$sql = "SELECT notice_id FROM notice WHERE DATE(d_time) < '".$today."'";
$result = mysqli_query($link, $sql);
if($result){
        while($row = mysqli_fetch_array($result)){
                $id = $row[0];
                $table = array('notice', 'basic_notice', 'clean_notice');
                for($i = 0; $i < sizeof($table); $i++){
                        $noticeSql = "DELETE FROM ".$table[$i]." WHERE notice_id=".$id;
                        $noticeResult = mysqli_query($link, $noticeSql);

                        if(!$noticeResult){
                                echo "SQL문 처리중 에러 발생 : ";
                                echo mysqli_error($link);
                        }
                }

        }
}

$sql="select * from notice";

$result=mysqli_query($link,$sql);
$data = array();
if($result){

    while($row=mysqli_fetch_array($result)){
        $row_array = array(
                'notice_id'=>$row[0],
                'title' => $row[1],
                'type'=>$row[2],
                'w_time'=>$row[3],
                'd_time'=>$row[4]
        );
        $data[$row[0]] = $row_array;

        switch($row[2]){
            case "0":
                $sub_sql = "select * from basic_notice where notice_id = ".$row[0];
                $sub_result = mysqli_query($link, $sub_sql);
                while($sub_row = mysqli_fetch_array($sub_result)){
                    $data[$row[0]]['detail'] = array('content' => $sub_row[1]);
                }
                break;
            case "1":
                $detail_array = array();
                $sub_sql = "select * from clean_notice where notice_id=".$row[0];
                $sub_result = mysqli_query($link, $sub_sql);
                while($sub_row = mysqli_fetch_array($sub_result)){
                        $detail_array[(string)$sub_row[1]]=$sub_row[2];
                }
                $data[$row[0]]['detail']=$detail_array;
                break;
            case "2":
                $sub_sql = "select * from sleepout_notice where notice_id=".$row[0];
                $sub_result = mysqli_query($link, $sub_sql);
                while($sub_row = mysqli_fetch_array($sub_result)){
                
                        $data[$row[0]]['detail'] = array(
                        'application_deadline'=>$sub_row[1],
                        'sleep_w_time'=>$sub_row[2],
                        'sleep_d_time'=>$sub_row[3],
                        'send'=>$sub_row[4]
                    );
                }
                break;
            }
        }
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("notice"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
    }else{
        echo "SQL문 처리중 에러 발생 : ";
        echo mysqli_error($link);
    }
    mysqli_close($link);
?>
        