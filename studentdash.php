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
        <title>Student Dashboard</title>
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
            <div style=" display: inline-block;
  padding: 10px 20px;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;">
                    Student
                </div>
                <div class="logout-btn">
                <a onclick="return clickfunction()" href="logout.php">Log out</a>
                    <script>
function clickfunction() {
  var result = confirm("Are you sure you want to log out?");
  if (result == true) {
    return true;
  } else {
    return false;
  }
}
</script>
                </div>

            </div>
            <div class="dash-centre">
                <div class="btns" style="flex-direction: column; justify-content: left; align-items: start;">
                <br><a href="xdrive.php" style="background-color: #79e979;">X-Drive</a>
                    <br><a href="profile.php" style="background-color: #e73838;">Profile</a>
                    <br><a href="course.php" style="background-color: #5257f6;">Course & Module Material</a>
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