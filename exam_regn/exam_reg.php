<?php
    include 'connection.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="lp_styles.css">
        
    </head>
    <body>
    <?php
            include 'fetch_data.php';
    ?>
    
    <div class='img'>
        <img src="ptu_logo.png" alt="PTU logo" style=" width: 10%;height: 30%;display: block;margin-left: auto;margin-right: auto;">
    </div>
    <div class='Header'>
    <h1>Puducherry Technological University<br>(PTU)</h1>
    </div>
    <div class='Details'>
        <h2><b>Examination Wing</b></h2>
        <h3>To<br>
        <b><?php echo("$_SESSION[name]") ?></b>,<br>
        Register Nr:<?php echo "$_SESSION[regno]" ?> <br>
        Programme:<?php echo "$_SESSION[prgm]" ?><br>
        Department:<?php echo "$_SESSION[dept]" ?><br>
        Puducherry Technological University,<br>
        Puducherry-605014<br><br>
        Dear Student,<br>Kindly complete the Exam Application by paying the Exam Fees via online Mode by clicking the <br>
        Following Link. Your Exam Hall Ticket will be emailed after payment validation.
    </h3>
    </div>
    <h1></h1>
    <table class='table1' style="width:100%">
        <tr>
            <th style="width:100px">Subject Code</th>
            <th>Subject Name</th>
            <th>Type</th>
            <th  style="width:15%">Fees in INR</th>
        </tr>
        <?php
            $fee_sum = 0;  
            foreach($subject as $x)
            {
                if(trim($x['course_type'])=='TY'){
                    $x['course_type'] = 'Theory';
                    $fees='250';
                }
                elseif(trim($x['course_type'])=='LB'){
                    $x['course_type'] = 'Laboratory';
                    $fees='350';
                }
                elseif(trim($x['course_type'])=='MC'){
                    $x['course_type'] = 'Mandatory Course';
                    $fees='0';
                }
                else{
                    echo("else.....".$x['course_type']);
                }

                echo "
                <tr>
                    <td>".$x['course_code']."</td>
                    <td>".$x['course_name']."</td>
                    <td>".$x['course_type']."</td>
                    <td>".$fees."</td>
                </tr>";

            $fee_sum += $fees;
            } 
        ?>

    </table>  
    <table class='table2' style="width:100%">
        <?php
        $applnfees = '100';
        $marksfees = '50';
        $totalfees = $applnfees + $marksfees + $fee_sum;
        ?>
        <tr><td>Application Fees</td><td  style="width:15%"><?php echo($applnfees); ?></td></tr>
        <tr><td>Statement of Marks</td><td  style="width:15%"><?php echo($marksfees); ?></td></tr>
        <tr><td>Total Exam Fees Payable</td><td><?php echo($totalfees); ?></td></tr>   
    </table>

    <div class="pay_btn">
        <button class="payment_btn">Proceed to pay</button>
    </div>
    </body>
</html>