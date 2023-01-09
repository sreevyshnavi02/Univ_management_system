<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="lp_styles.css">
        <div class="form">
            <h1>Puducherry Technological University</h1>
        </div>
    </head>
    <body>
        <form action = 'exam_reg.php' method = 'post'>

            <!-- regno as input -->
            <label for="regno">Registration number:</label><br>
            <input type="text" id="regno" name="regno"><br>
            
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
            
            <input name = 'submit_regno' type="submit" value="submit">
        </form>
    </body>
</html>