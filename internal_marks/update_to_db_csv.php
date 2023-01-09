<?php
    include '../header.php';

    $file_name = $_FILES['file_upload']['name'];
    $file = fopen("$file_name", 'r');
    // echo("fopen status = ".$file);

    $i = 0;

    while(($data = fgetcsv($file, 1000,",")) !== FALSE){
        $arr[] = $data;
        echo("<br><br>");
        // print_r($arr);
        $marks = $arr[$i][2];
        $attendance = $arr[$i][3];
        $regno = $arr[$i][0];
        $course_code = $_SESSION['course_code'];
        
        $update_query = "
        update u_course_regn
        set internal_marks = '$marks',
        attendance = '$attendance'
        where regno = '$regno'
        and course_code = '$course_code';";
        
        $update_query_run = mysqli_query($conn, $update_query);
        
        $i++;
    }

    //display all the data
    include 'download_pdf.php';

    echo("<br><br>");
    fclose($file);

?>