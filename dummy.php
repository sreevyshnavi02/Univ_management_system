<?php
    include 'connection.php';
    // print_r($_POST);
    // echo('<script>console.log("Printing from dummy.php");');
    // echo($_POST['regno']);

    $insert_marks = mysqli_query($conn, "
        update u_course_regn
        set internal_marks = '$_POST[marks]',
        attendance = '$_POST[attendance]'
        where regno = '$_POST[regno]'
        and course_code = '$_SESSION[course_code]'
        and SESSION = '$_SESSION[session]';
    ");
    
    if(mysqli_affected_rows($conn) > 0){
        // echo(":)</td></tr>");
        $pass = true;
    }
    else{
        // echo(":(</td></tr>");
        $pass = false;
    }



    // $pass = true;

    echo $pass ? "OK" : "ERROR OCCURED";

?>