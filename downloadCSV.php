<?php
setlocale(LC_CTYPE, 'ko_KR.utf8'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");

$con=mysqli_connect("localhost","dorm","admin@)!*", "dorm" );

if (!$con)
{
    echo "MySQL 접속 에러 : ";
    echo mysqli_connect_error();
    exit();
}

$query = "SELECT room_num, name, emirim_id, password, student_phone, parent_phone FROM user";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
header('Content-Encoding: UTF-8');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=학생계정정보.csv');
echo "\xEF\xBB\xBF"; 
$output = fopen('php://output', 'w');
// fputcsv($output, array('emirim_id', 'password', 'name', 'room_num', 'student_phone', 'parent_phone'));
fputcsv($output, array( '호수', '이름', '계정', '비밀번호',  '학생 번호', '학부모 번호'));

if (count($users) > 0) {

    foreach ($users as $row) {
        //$row[4] = "0"+$row[4];
        fputcsv($output, $row);
    }
}



?>
