<?php 
    include '../header.php';
    // $_SESSION['regno'] = '';
    
    if(isset($_POST['submit_option'])){

        //storing the entered session and course_code as session variables to access them across multiple php files
        $_SESSION['course_code'] = $_POST['course_code'];
        $_SESSION['session'] = $_POST['session'];


        if($_POST['upload_marks_radio'] == 'enter_manually'){  
            // allow user to manually enter the marks
            
            // display each student's name
            // (from the students enrolled in that course based on course code and session)

            $get_enrolled_students = mysqli_query($conn, 
            "select e.regno, s.sname 
            from u_external_marks e, u_student s 
            where e.course_code = '$_SESSION[course_code]' 
            and e.session = '$_SESSION[session]' 
            and e.regno = s.regno;"
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
            <th>External Marks(Out of 60)</th>
            </tr>
            ");

            $_SESSION['ext_marks_array'] = array();

            
            // print_r($get_enrolled_students);
            foreach($get_enrolled_students as $stud_details){
                array_push(
                    $_SESSION['ext_marks_array'], 
                    array($stud_details['regno'], $stud_details['sname'], -1)
                );
            }
            
            echo("<form method = 'POST' action = 'update_to_db_manual.php'> ");
            

            foreach($_SESSION['ext_marks_array'] as $i => $row){
                // to display the regno(stored at row[0]) and the name of each student(stored at row[1])
                echo("
                <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                ");

                //to get the external marks as input
                echo("
                <td><input type = 'number' min = 0 max = 60 name = 'ext_marks".$i."'></td>
                </tr>
                ");
            }
            echo("</table>");
            echo("<input type = 'submit' name='submit_ext_marks' class='submit_option'>");
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
