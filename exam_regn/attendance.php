<?php
    include 'connection.php';
    $trunc_query = 'truncate table u_exam_regn;';
    mysqli_query($conn, $trunc_query);
    $regno_q = "SELECT  distinct regno from u_course_regn ";
    $regno = mysqli_query($conn, $regno_q);
    foreach($regno as $r)
    {
        // print_r($r);
        $attendance_query = "SELECT session, round(avg(attendance)) as consolidated_attendance from u_course_regn where regno='$r[regno]'";
        $con_attendance = mysqli_query($conn, $attendance_query);
        $data_fetch = mysqli_fetch_assoc($con_attendance);
        
        if($data_fetch['consolidated_attendance'] >= 75){
            $eligible = 1;
        }
        else{
            $eligible = 0;
        }
    
        $att_entry_query = "INSERT into u_exam_regn(regno,session,consolidated_attendance, eligible_for_exam) values('$r[regno]','$data_fetch[session]','$data_fetch[consolidated_attendance]', '$eligible')";
        $att_entry = mysqli_query($conn, $att_entry_query);
        // if($att_entry)
        // {
        //     echo "<br>Success";
        // }
        // else
        // {
        //     echo "Error";
        // }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        //display the consolidated attendance 
        // regno, name, attendance percentage, eligible or not
        $display_att_query = "select e.regno, s.sname, e.consolidated_attendance, e.eligible_for_exam 
        from u_student s, u_exam_regn e 
        where s.regno = e.regno;";
        $display_att_run = mysqli_query($conn, $display_att_query);
    ?>
    <table class = "disp_con_att">
        <tr>
        <th>Regno</th>
        <th>Name</th>
        <th>Consolidated_attendance</th>
        <th>Eligible for exam</th>
        </tr>

        <?php
        foreach($display_att_run as $row){
        ?>
            <tr>
                <td><?php echo($row['regno']); ?></td>
                <td><?php echo($row['sname']); ?></td>
                <td><?php echo($row['consolidated_attendance']); ?></td>
                <td><?php 
                if($row['eligible_for_exam'] == 1){
                    $x = 'Eligible';
                }
                else
                {
                    $x = 'Not Eligible';
                }
                echo($x); ?></td>
        </tr>
        <?php } ?>
</body>
</html>