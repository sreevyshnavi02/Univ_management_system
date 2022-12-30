<?php include '../header.php'; 

    // $int_marks_array = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTU-COE</title>

    <script>
        function ajax_post(){
            // getting the marks sand attendance from the form
            var data = new FormData();
            
            <?php print_r($_POST['int_marks_array']); ?>

            data.append("regno", document.getElementById("regno").textContent);
            data.append("marks", document.getElementById("marks").value);
            data.append("attendance", document.getElementById("attendance").value);

            //sending an XML HTTP req
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_marks_to_db.php");
            xhr.onload = function(){
                console.log("Response from dummy.php");
                console.log(this.response);

                if(this.response == "OK"){
                    document.getElementById("row_form").reset();
                    alert("Updated! :)");
                }
                else{
                    alert(":(");
                }
            }
            xhr.send(data);

            // to prevent HTML form from submitting
            return false;
        }
    </script>
</head>
<body>
    <?php
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
                echo("
                <table class='marks_table'>
                <tr>
                    <th>Regno</th>
                    <th>Name</th>
                    <th>Internal Marks(Out of 40)</th>
                    <th>Attendance(in %)</th>
                </tr>
                <script> var i = 1; </script>");
            

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
                echo("</table>");
                $_POST['int_marks_array'] = $int_marks_array;
                echo("<input type = 'submit' name='submit_marks_attendance'>");
                echo("</table>");
                echo("</form>");


            } 
            else{
                echo('csv Upload Karo');
            }
        } 
    
    ?>
    
    
</body>
</html>