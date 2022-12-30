<?php

    //displaying the session and course code
    echo("Session: ".$_SESSION['session']);
    echo("<br><br>");
    echo("Course code: ".$_SESSION['course_code']);
    $get_data = mysqli_query($conn, 
        "select c.regno, s.sname, c.internal_marks, c.attendance
        from u_course_regn c, u_student s
        where c.course_code = '$_SESSION[course_code]' 
        and c.session = '$_SESSION[session]' 
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
    $int_marks_array = array();
    
    //fetch all the data from the u_course_regn into $int_marks_array
    foreach($get_data as $stud_details){
        // echo("Inside foreach");
        // print_r($stud_details);
        array_push(
            $int_marks_array, 
            array($stud_details['regno'], $stud_details['sname'], $stud_details['internal_marks'], $stud_details['attendance'])
        );
    }

    

    foreach($int_marks_array as $i => $row){
        echo("
        <tr>
            <td>".$row[0]."</td>
            <td>".$row[1]."</td>
            <td>".$row[2]."</td>
            <td>".$row[3]."</td>
        </tr>
        ");
    }
    echo("</table>");

?>