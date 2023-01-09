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
    $ext_marks = $arr[$i][2];
    $regno = $arr[$i][0];
    $course_code = $_SESSION['course_code'];
    $session = $_SESSION['session'];
    
    $update_query = "
    update u_external_marks
    set external_marks = '$ext_marks'
    where regno = '$regno'
    and course_code = '$course_code'
    and session = '$session';";
    
    $update_query_run = mysqli_query($conn, $update_query);
    
    $i++;
}
// include 'calc_grade.php';
include 'download_pdf.php';

echo("<br><br>");
fclose($file);  
?>