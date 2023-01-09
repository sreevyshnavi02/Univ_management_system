<?php
    include '../header.php';
    if(isset($_POST['submit_external_marks'])){            
        foreach($_SESSION['ext_marks_array'] as $i => $row){

            //updating the session variable int_marks_array based on the marks and attendance given as input
            $row[2] = $_POST['int_marks'.$i];
            $update_query = "
            update u_external_marks
            set external_marks = '$row[2]',
            where regno = '$row[0]'
            and course_code = '$_SESSION[course_code]';";
            
            $update_query_run = mysqli_query($conn, $update_query);
        }

        include 'calc_grade.php';
        include 'download_pdf.php';
    }

?>