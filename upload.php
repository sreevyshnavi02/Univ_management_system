<?php 
    include '../header.php';

$select_rn_q = mysqli_query($conn, "SELECT regno from u_exam_regn");
print_r($select_rn_q);
echo ($select_rn_q);
    foreach($select_rn_q as $x){
        $insert_q = mysqli_query($conn, "INSERT into u_external_marks(regno,course_code) values($x[regno],$_SESSION[course_code])");
        // print_r($insert_q);
    }
        $insert_marks_q = "UPDATE u_external_marks
        set external_marks = '$_POST[marks]',
        where regno = '$_SESSION[regno]'
        and course_code = '$_SESSION[course_code]'";
        $insert_marks = mysqli_query($conn,$insert_marks_q);

    if($insert_q){
        echo(":)</td></tr>");
    }
    else{
        echo(":(</td></tr>");
    }
?>