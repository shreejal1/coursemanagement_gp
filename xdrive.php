<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "student"){
    $stu = $pdo->query("SELECT * FROM student WHERE student_id = '".$_SESSION['id']."'");
    $datastu = $stu->fetch();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Student-XDRIVE</title>
    </head>

    <body>

        <div class="left-window">
            <img class="profile-image" src="./images/user.jpg" alt="Profile Image">
            <?php echo $datastu['first_name']." ".$datastu['middle_name']." ".$datastu['last_name']; ?>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
        </div>
        <div class="main-content">
            <div class="stu_nav">
                <div id="drive-logo">
                    <img class="drive-image" src="./images/drive.png" alt="Drive Logo">
                    <h3>Drive</h3>
                    <div class="addfiles">
                        <button id="choose-file-button">Add</button>
                        <input type="file" id="file-input" style="display:none;"/>
                        <button type="submit" id="upload-button" style="display:none;">Upload</button>
                    </div>
                    <script src="./upload.js"></script>
                </div>
                <div class="logout-btn">
                    <a href="logout.php">Log out</a>
                </div>

            </div>
            <div class="dash-centre">
                <div class="item">Item 1</div>
                
            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: student-login.php");
}
?>