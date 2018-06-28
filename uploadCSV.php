<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT');
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");

    $link=mysqli_connect("localhost","dorm","admin@)!*", "dorm" );
    
    if (!$link){
        echo "MySQL 접속 에러 : ";
        echo mysqli_connect_error();
        exit();
    }

    $sql = "delete from user";

    $result = mysqli_query($link, $sql);
    
    if(!$result){
        echo "<script type=\"text/javascript\">alert('4.SQL문 처리중 에러 발생 : ');</script>";
        echo mysqli_error($link);
    }

    mysqli_set_charset($link,"utf8");

    if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
            
            $file = fopen($filename, "r");
            $idx = 0;  
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                if($idx!=0){
                    $sql = "INSERT INTO user(room_num, name, emirim_id, password,  student_phone, parent_phone) VALUES (".$getData[0].",  '".$getData[1]."',  '".$getData[2]."', '".$getData[3]."', '".$getData[4]."',  '".$getData[5]."')";
                    // $sql = "INSERT INTO user VALUES ('".$getData[0]."',  '".$getData[2]."',  '".$getData[3]."', ".$getData[0].", '".$getData[4]."',  '".$getData[5]."')";
                    // echo "<script type=\"text/javascript\">alert('".$getData[1]."');</script>";
                    $result = mysqli_query($link, $sql);
                    if(!$result){
                        echo "<script type=\"text/javascript\">alert('4.SQL문 처리중 에러 발생 : ');</script>";
                        echo mysqli_error($link);
                    }
                }
                $idx += 1;
	         }
			
	         fclose($file);	
		 }
	}	 
    mysqli_close($link);

	echo "<script type=\"text/javascript\">alert(\"파일 업로드를 성공했습니다.\");window.location = \"https://dorm.emirim.kr/OhDormitoryAdmin/auth.html\"</script>";	
 ?>