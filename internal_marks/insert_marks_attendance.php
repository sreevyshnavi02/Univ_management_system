<!-- insert data into the u_course_regn table -->
<?php
    include('header.php');
    // echo("came here");
    if(isset($_POST['submit_marks_attendance'])){
        // echo("Before insert query");
        $insert_marks = mysqli_query($conn, "
            update u_course_regn
            set internal_marks = '$_POST[marks]',
            attendance = '$_POST[attendance]'
            where regno = '$stud_details[regno]'
            and course_code = '$_POST[course_code]'
            and session = '$_POST[session]';
        ");

        echo("insert query ran");
        
        if($insert_marks){
            echo(":)</td></tr>");
        }
        else{
            echo(":(</td></tr>");
        }
    }
?>