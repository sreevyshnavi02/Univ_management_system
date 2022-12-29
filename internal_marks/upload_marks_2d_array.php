<?php 

    include '../header.php';
    // $_SESSION['regno'] = '';
    
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
                    </tr>
            ");

            $int_marks_array = array();
            // print_r($get_enrolled_students);
            foreach($get_enrolled_students as $stud_details){
                // echo("Inside foreach");
                array_push(
                    $int_marks_array, 
                    array($stud_details['regno'], $stud_details['sname'], -1, -1)
                    );
                // print_r($int_marks_array);
                // echo("<tr><form class='marks_of_each_student' method='post' action = '".$_SERVER['PHP_SELF']."'>");
                // echo("<td>".$stud_details['regno']."</td>");
                // echo("<td>".$stud_details['sname']."</td>");
                // echo("<td><input type='text' name='marks'></td>");
                // echo("<td><input type='text' name='attendance'></td>");
                // echo("<td><input type='submit' name='submit_marks_attendance' class='submit_marks_attendance' value='Done'>");
                // $_SESSION['regno'] = $stud_details['regno'];
                // $_SESSION['session'] = $_POST['session'];
                // $_SESSION['course_code'] = $_POST['course_code'];
                // echo("</form>");
                
                //insert data into the u_course_regn table
                
            }

            foreach($int_marks_array as $i => $row){
                // print_r("i = ".$i);
                // echo("<br>");
                // print_r($row);
                // echo("<br>");
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
            echo("</table>");
            if($int_marks_array[0][2] != -1){
                // echo()
                echo("Printing this");
                print_r($int_marks_array);
            }
        } 
        else{
            echo('Upload Karo');
        }
    } 
?>