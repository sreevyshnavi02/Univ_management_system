<?php
    include '../header.php';
    if(isset($_POST['submit_marks_attendance'])){
        // print_r($_POST);
        // print_r($_SESSION['int_marks_array']);
        
        foreach($_SESSION['int_marks_array'] as $i => $row){

            //updating the session variable int_marks_array based on the marks and attendance given as input
            $row[2] = $_POST['int_marks'.$i];
            $row[3] = $_POST['attendance'.$i];
            $update_query = "
            update u_course_regn
            set internal_marks = '$row[2]',
            attendance = '$row[3]'
            where regno = '$row[0]'
            and course_code = '$_SESSION[course_code]'
            and session = '$_SESSION[session]';";
            
            $update_query_run = mysqli_query($conn, $update_query);
        }
        
        include 'download_pdf.php';
    }

?>