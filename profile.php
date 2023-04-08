<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "student"){
    $stu = $pdo->query("SELECT * FROM student WHERE student_id = '".$_SESSION['id']."'");
    $datastu = $stu->fetch();
    $stuc = $pdo->query("SELECT * FROM course WHERE id = '".$datastu['course_id']."'");
    $datastuc = $stuc->fetch();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Student Profile</title>
    </head>

    <body>

        <div class="left-window">
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
        </div>
        <div class="main-content">
            <div class="stu_nav">
            <div style=" display: inline-block;">
                    <h1 style="font-family: helvetica; line-height: 0;">My Profile</h1>
                </div>
                <div class="logout-btn">
                <a href="studentdash.php">🔙 Back to Student Dashboard</a>
                    <a href="logout.php">Log out</a>
                </div>

            </div>
            <div class="dash-centre">
                <div class="btns" style="flex-direction: column; justify-content: left; align-items: start;">
                    <h2 style="font-family: helvetica;">Name: <?php echo $datastu['first_name']." ".$datastu['middle_name']." ".$datastu['last_name'];?></h2>
                    <h2 style="font-family: helvetica;">Date Of Birth: <?php echo $datastu['date_of_birth']; ?></h2>
                    <h2 style="font-family: helvetica;">Email Address: <?php echo $datastu['email']; ?></h2>
                    <h2 style="font-family: helvetica;">Phone Number: <?php echo $datastu['contact']; ?></h2>
                    <h2 style="font-family: helvetica;">Student Id: <?php echo $datastu['student_id']; ?></h2>
                    <h2 style="font-family: helvetica;">Faculty: <?php echo $datastuc['name']; ?></h2>
                </div>

            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: student-login.php");
}
?>