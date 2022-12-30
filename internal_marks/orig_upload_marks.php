<?php 

    include '../header.php';
    // $_SESSION['regno'] = '';
    
    if(isset($_POST['submit_marks_attendance'])){
        $insert_marks = mysqli_query($conn, "
            update u_course_regn
            set internal_marks = '$_POST[marks]',
            attendance = '$_POST[attendance]'
            where regno = '$_SESSION[regno]'
            and course_code = '$_SESSION[course_code]'
            and SESSION = '$_SESSION[session]';
        ");
        
        // if(mysqli_affected_rows($conn) > 0){
        //     echo(":)</td></tr>");
        // }
        // else{
        //     echo(":(</td></tr>");
        // }
    }


    if(isset($_POST['submit_option'])){
        if($_POST['upload_marks_radio'] == 'enter_manually'){
            
            
            // display each student's name
            // (from the students enrolled in that course based on course code and session)
            $get_enrolled_students = mysqli_query($conn, 
                "select c.regno, s.sname 
                from u_course_regn c, u_student s 
                where c.course_code = '$_POST[course_code]' 
                and c.session = '$_POST[session]' 
                and c.regno = s.regno;"
            );

            // Make a table
            echo("
                <table class='marks_table'>
                    <tr>
                        <th>Regno</th>
                        <th>Name</th>
                        <th>Internal Marks(Out of 40)</th>
                        <th>Attendance(in %)</th>
                        <th></th>
                    </tr>
            ");


            // print_r($get_enrolled_students);
            foreach($get_enrolled_students as $stud_details){
                // echo("Inside foreach");
                echo("<tr><form class='marks_of_each_student' method='post' action = '".$_SERVER['PHP_SELF']."'>");
                echo("<td>".$stud_details['regno']."</td>");
                echo("<td>".$stud_details['sname']."</td>");
                echo("<td><input type='text' name='marks'></td>");
                echo("<td><input type='text' name='attendance'></td>");
                echo("<td><input type='submit' name='submit_marks_attendance' class='submit_marks_attendance' value='Done'>");
                $_SESSION['regno'] = $stud_details['regno'];
                $_SESSION['session'] = $_POST['session'];
                $_SESSION['course_code'] = $_POST['course_code'];
                echo("</form>");
                
                //insert data into the u_course_regn table
                
            }
            echo("</table>");
        } 
        else{
            echo('Upload Karo');
        }
    } 
?>