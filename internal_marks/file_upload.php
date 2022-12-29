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

        $update_query = "
        update u_course_regn
        set internal_marks = '$marks',
        attendance = '$attendance'
        where regno = '$regno';";
        
        $update_query_run = mysqli_query($conn, $update_query);
        
        // if(mysqli_affected_rows($conn) > 0){
        //     echo(":)</td></tr>");
        // }
        // else{
        //     echo(":(</td></tr>");
        // }
        echo(mysqli_affected_rows($conn). " rows were updated!");
        
        $i++;
    }
    
    echo("<br><br>");
    // var_dump($arr);
    fclose($file);

?>