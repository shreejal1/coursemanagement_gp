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
        <title>Student Dashboard-Course</title>
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
            <div style=" display: inline-block;">
                    <h1 style="font-family: helvetica; line-height: 0;">Course</h1>
                </div>
                <div class="logout-btn">
                    <a href="logout.php">Log out</a>
                </div>

            </div>
            <div class="dash-centre">
                <?php
                    $mods = $pdo->query("SELECT course_id FROM student WHERE student_id = '".$_SESSION['id']."'");
                    $datamod = $mods->fetch();
                    $modules = $pdo->query("SELECT * FROM module WHERE course_id = '".$datamod['course_id']."'");
                    foreach($modules as $modsvals){
                
                echo '<div id="courseitems">
                        <h2 style="line-height: 0; font-family: helvetica; margin-left: 2%;">'.$modsvals['id'].'</h2>
                        <h2 style="line-height: 0; font-family: helvetica; margin-left: 2%;">'.$modsvals['name'].'</h2>
                        <h4 style="line-height: 0; font-family: helvetica; margin-left: 2%;">Credits: '.$modsvals['credit'].'</h4>

                </div><br><br>';
                    }

                ?>
            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: student-login.php");
}
?>