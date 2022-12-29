<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTU-COE</title>
</head>
<body>
    <?php include '../header.php'; ?>
    <form action="upload_marks_2d_array.php" method="post">
        <div class = get_input_details>
            <!-- Course code as input -->
            <div class="input_course_code">
                <label for="course_code_inp">Course code: </label>
                <input type="text" name="course_code" id="course_code_inp" placeholder="IT205">
                <!-- <button type="submit" method="post" name="submit_course_code" class = "submit_course_code">Submit</button> -->
            </div>
            
            <!-- Session as input -->
            <div class="input_session">
                <label for="select_session">Session:</label>
                
                <select name="session" id="select_session">
                    <option value="">Please choose the session</option>
                    <option value="18B">Nov - 2018</option>
                    <option value="19A">May - 2019</option>
                    <option value="19B">Nov - 2019</option>
                    <option value="20A">May - 2020</option>
                    <option value="20B">Nov - 2020</option>
                    <option value="21A">May - 2021</option>
                    <option value="20B">Nov - 2021</option>
                    <option value="21A">May - 2022</option>
                </select>
            </div>
        </div>

        <div class="upload_marks">
            <h5>Please Choose an option: </h5>
            
            <div class="options">
                <input type="radio" value="enter_manually" name="upload_marks_radio" method="post">
                <label for="enter_manually">Enter Marks Manually</label>
                
                <input type="radio" value="upload_csv" name="upload_marks_radio" method="post">
                <label for="enter_manually">Upload CSV file</label>
                
                <button name="submit_option" type="submit" class="submit_option">Proceed</button>
            </div>
        </div>

    </form>

</body>
</html>