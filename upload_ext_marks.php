<?php 
    include '../header.php';

    if(isset($_POST['submit_option']))
    {
        if($_POST['upload_marks_radio'] == 'enter_manually')
        {
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
                        <th>External Marks(Out of 60)</th>
                        <th></th>
                    </tr>
            ");


            // print_r($get_enrolled_students);
            foreach($get_enrolled_students as $stud_details){
                // echo("Inside foreach");
                // echo($_SERVER['PHP_SELF']);
                echo("<tr><form class='marks_of_each_student' method='post' action = 'upload.php'>");
                echo("<td>".$stud_details['regno']."</td>");
                echo("<td>".$stud_details['sname']."</td>");
                echo("<td><input type='text' name='marks'></td>");
                // echo("<td><input type='text' name='attendance'></td>");
                echo("<td><input type='submit' name='submit_marks_attendance' class='submit_marks_attendance' value='Done'>");
                // echo("<td><button class='submit_marks_attendance' id='submit_marks_attendance' onclick = 'insert_query()'>DONE</button></td>");
                $_SESSION['regno'] = $stud_details['regno'];
                $_SESSION['session'] = $_POST['session'];
                $_SESSION['course_code'] = $_POST['course_code'];
                echo("</form>");
                echo("Before insert");  
            }
            echo("</table>");
            // $select_rn_q = mysqli_query($conn, "SELECT regno from u_exam_regn");
            // foreach($select_rn_q as $x){
            //     $insert_q = mysqli_query($conn, "INSERT into u_external_marks(regno,course_code) values($x[regno],$_SESSION[course_code])");
            // }
            //     $insert_marks_q = "UPDATE u_external_marks
            //     set external_marks = '$_POST[marks]',
            //     where regno = '$_SESSION[regno]'
            //     and course_code = '$_SESSION[course_code]'";
            //     $insert_marks = mysqli_query($conn,$insert_marks_q);

            // if($insert_q){
            //     echo(":)</td></tr>");
            // }
            // else{
            //     echo(":(</td></tr>");
            // }
    
        } 
        else{
            // upload csv file

            // get a file as input

            echo("<form action = 'file_upload.php' method = 'POST' enctype = 'multipart/form-data'>
            <input type = 'file' name = 'file_upload'>
            <input type = 'submit' value = 'submit'>
            </form>");
            
        }
    }
    ?>


