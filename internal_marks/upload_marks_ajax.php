<?php include '../header.php'; ?>

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
            console.log("Regno: ");
            // console.log(document.getElementById(i).getElementById("regno").textContent);
            console.log(document.getElementById("marks").value);
            console.log(document.getElementById("attendance").value);
            data.append("regno", document.getElementById("regno").textContent);
            data.append("marks", document.getElementById("marks").value);
            data.append("attendance", document.getElementById("attendance").value);

            //sending an XML HTTP req
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "dummy.php");
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
            } 
            else{
                echo('csv Upload Karo');
            }
        } 
    
    ?>
    
    <table class='marks_table'>
        <tr>
            <th>Regno</th>
            <th>Name</th>
            <th>Internal Marks(Out of 40)</th>
            <th>Attendance(in %)</th>
            <th></th>
        </tr>
        <script> var i = 1; </script>
        <?php
            foreach($get_enrolled_students as $stud_details){
        ?>
                <form id = "row_form" onsubmit = "return ajax_post()">
                
                <?php
                echo("<tr id = 'temp'>");
                ?>
                <script>
                    i++;
                    console.log("Current value of i = ", i);
                    document.getElementById('temp').id = i;
                </script>
                <?php
                echo("<td id = 'regno'>".$stud_details['regno']."</td>");
                echo("<td>".$stud_details['sname']."</td>");
                echo("<td><input type='text' id='marks'></td>");
                echo("<td><input type='text' id='attendance'></td>");
                echo("<td><input type='submit' name='submit_marks_attendance' class='submit_marks_attendance' value='Done'>");
                echo("</tr>");
                $_SESSION['regno'] = $stud_details['regno'];
                $_SESSION['session'] = $_POST['session'];
                $_SESSION['course_code'] = $_POST['course_code'];
                echo("</form>");
                // echo("Before insert");  
            }
            echo("</table>");
        ?>
    <!-- <input type="submit" value = "Done"> -->
    </form>
</body>
</html>