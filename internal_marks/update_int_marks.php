<?php 
    include '../header.php';
    
    if(isset($_POST['submit_option'])){

        //storing the entered session and course_code as session variables to access them across multiple php files
        $_SESSION['course_code'] = $_POST['course_code'];
        $_SESSION['session'] = $_POST['session'];

        if($_POST['upload_marks_radio'] == 'enter_manually'){  
            // allow user to manully enter the marks
            
            // display each student's name
            // (from the students enrolled in that course based on course code and session)
            
            $get_enrolled_students = mysqli_query($conn, 
            "select c.regno, s.sname 
            from u_course_regn c, u_student s 
            where c.course_code = '$_POST[course_code]' 
            and c.session = '$_POST[session]' 
            and c.regno = s.regno;"
            );

            //displaying the session and course code
            echo("<div class='course_details'>");
            echo("Session: ".$_SESSION['session']);
            echo("<br><br>");
            echo("Course code: ".$_SESSION['course_code']);
            echo("</div>");

            // Make a table
            echo("
            <table class='marks_table'>
            <tr>
            <th>Regno</th>
            <th>Name</th>
            <th>Internal Marks(Out of 40)</th>
            <th>Attendance(in %)</th>
            </tr>
            ");

            $_SESSION['int_marks_array'] = array();

            
            // print_r($get_enrolled_students);
            foreach($get_enrolled_students as $stud_details){
                // echo("Inside foreach");
                array_push(
                    $_SESSION['int_marks_array'], 
                    array($stud_details['regno'], $stud_details['sname'], -1, -1)
                );
            }
            
            echo("<form method = 'POST' action = 'update_to_db_manual.php'> ");
            

            foreach($_SESSION['int_marks_array'] as $i => $row){
                // to display the regno(stored at row[0]) and the name of each student(stored at row[1])
                echo("
                <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                ");

                //
                echo("
                <td><input type = 'number' min = 0 max = 40 name = 'int_marks".$i."'></td>
                <td><input type = 'number' min = 0 max = 100 name = 'attendance".$i."'></td>
                </tr>
                ");
            }
            echo("</table>");
            $submit_btn_style = 'margin: 1rem auto; background-color: black;';
            echo("<input type = 'submit' name='submit_marks_attendance' class='submit_marks_attendance' style=".$submit_btn_style.">");
            // print_r($_SESSION['int_marks_array']);

        } 
        else{
            // upload csv file
            
            //displaying the session and course code
            echo("<div class='course_details'>");
            echo("Session: ".$_SESSION['session']);
            echo("<br><br>");
            echo("Course code: ".$_SESSION['course_code']);
            echo("</div>");

            // get a file as input
            echo("
            <div class = 'get_csv_file'>
                <form action = 'update_to_db_csv.php' method = 'POST' enctype = 'multipart/form-data'>
                    <input type = 'file' name = 'file_upload'>
                    <input type = 'submit' value = 'submit' class='submit_option'>
                </form>
            </div>");
            
        }
    } 
?>
