<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTU-COE</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
    <?php 

        include '../header.php';
        // $_SESSION['regno'] = '';
        $int_marks_array = array();

        if(isset($_POST['submit_marks_attendance'])){
            echo("inside if");
            foreach($int_marks_array as $i => $row){
                print_r($_POST['int_marks_array']);
                echo("inside foreach");
                $update_query = "
                update u_course_regn
                set internal_marks = '$row[2]',
                attendance = '$row[3]'
                where regno = '$row[0]';";
                
                $update_query_run = mysqli_query($conn, $update_query);
                
                if(mysqli_affected_rows($conn) > 0){
                    echo(":)</td></tr>");
                }
                else{
                    echo(":(</td></tr>");
                }  
            }
        }



        if(isset($_POST['submit_option'])){
            if($_POST['upload_marks_radio'] == 'enter_manually'){  
                // allow user to manully enter the marks
                
                // display each student's name
                // (from the students enrolled in that course based on course code and session)
                $_SESSION['course_code'] = $_POST['course_code'];
                $_SESSION['session'] = $_POST['session'];
                
                $get_enrolled_students = mysqli_query($conn, 
                "select c.regno, s.sname 
                from u_course_regn c, u_student s 
                where c.course_code = '$_POST[course_code]' 
                and c.session = '$_POST[session]' 
                and c.regno = s.regno;"
                );

                //displaying the session and course code
                echo("Session: ".$_SESSION['session']);
                echo("<br><br>");
                echo("Course code: ".$_SESSION['course_code']);
                
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
                
                // print_r($get_enrolled_students);
                foreach($get_enrolled_students as $stud_details){
                    // echo("Inside foreach");
                    array_push(
                        $int_marks_array, 
                        array($stud_details['regno'], $stud_details['sname'], -1, -1)
                    );
                }
                
                echo("<form method = 'POST' action = '".$_SERVER['PHP_SELF']."'> ");
                foreach($int_marks_array as $i => $row){
                    echo("
                    <tr>
                    <td>".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td><input type = 'number' min = 0 max = 40 id = 'int_marks'></td>
                    <td><input type = 'number' min = 0 max = 100 id = 'attendance'></td>
                    </tr>
                    ");
                    $row[2] = "<script>document.getElementById('int_marks')</script>";
                    $row[3] = "<script>document.getElementById('attendance')</script>";
                }
                $_POST['int_marks_array'] = $int_marks_array;
                echo("</table>");
                echo("<input type = 'submit' name='submit_marks_attendance'>");
                // print_r($int_marks_array);
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
</body>
</html>