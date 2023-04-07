<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
?>
<?php
if(isset($_POST['submit'])){

    $coursename = $_POST['cname'];
    $coursecode = $_POST['ccode'];



    $modules1 = $_POST['mod1'];
    $code1 = $_POST['code1'];

    $modules2 = $_POST['mod2'];
    $code2 = $_POST['code2'];

    $modules3 = $_POST['mod3'];
    $code3 = $_POST['code3'];

    $inscourse = $pdo->query("INSERT INTO course VALUES('$coursecode', '$coursename', 'ACTIVE')");
    if($inscourse){
            $insmods1 = $pdo->query("INSERT INTO module VALUES('$code1', '$modules1', '$coursecode','ACTIVE', '20')");
            $insmods2 = $pdo->query("INSERT INTO module VALUES('$code2', '$modules2', '$coursecode', 'ACTIVE', '20')");
            $insmods3 = $pdo->query("INSERT INTO module VALUES('$code3', '$modules3', '$coursecode', 'ACTIVE', '20')");


            if(empty($_POST['code4']) && empty($_POST['mod4']) && $_POST['code4'] != null && $_POST['mod4'] != null){
                $insmods = $pdo->query("INSERT INTO module VALUES('".$_POST['code4']."', '".$_POST['mod4']."', '$coursecode', 'ACTIVE', '20')");
            }
        
            if(empty($_POST['code5']) && empty($_POST['mod5']) && $_POST['code5'] != null && $_POST['mod5'] != null){
                $insmods = $pdo->query("INSERT INTO module VALUES('".$_POST['code5']."', '".$_POST['mod5']."', '$coursecode', 'ACTIVE', '20')");
            }
            
            if(empty($_POST['code6']) && empty($_POST['mod6']) && $_POST['code6'] != null && $_POST['mod6'] != null){
                $insmods = $pdo->query("INSERT INTO module VALUES('".$_POST['code6']."', '".$_POST['mod6']."', '$coursecode', 'ACTIVE', '20')");
            }

            header("Location: admindash.php");
            exit();
    }

    
    


}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Course Add</title>
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
                    <h1 style="font-family: helvetica; line-height: 0;">COURSE</h1>
                </div>
                <div class="logout-btn">
                    <a href="logout.php">Log out</a>
                </div>

            </div>
            <div class="dash-centre">
        
                <form action="" method="POST" style="align-items: start; font-family: helvetica;">
                    <label for="cname">Enter Course Name</label>
                    <div>
                    <input type="text" name="cname" style="background-color: #e8e8e8;" required placeholder="Course Name">
                    <input type="text" name="ccode" style="background-color: #e8e8e8;" placeholder="Course Code" required>
                    </div><br><br>
                    <label for="m&c">Enter Modules & Module-Code</label>
                    <div>
                    <input type="text" name="mod1" style="background-color: #e8e8e8;" placeholder="Module Name" required>
                    <input type="text" name="code1" style="background-color: #e8e8e8" placeholder="Module Code" required>
                    </div>
                    <div>
                    <input type="text" name="mod2" style="background-color: #e8e8e8;" required>
                    <input type="text" name="code2" style="background-color: #e8e8e8" required>
                    </div>
                    <div>
                    <input type="text" name="mod3" style="background-color: #e8e8e8;" required>
                    <input type="text" name="code3" style="background-color: #e8e8e8" required>
                    </div>
                    <div>
                    <input type="text" name="mod4" style="background-color: #e8e8e8;">
                    <input type="text" name="code4" style="background-color: #e8e8e8">
                    </div>
                    <div>
                    <input type="text" name="mod5" style="background-color: #e8e8e8;">
                    <input type="text" name="code5" style="background-color: #e8e8e8">
                    </div>
                    <div>
                    <input type="text" name="mod6" style="background-color: #e8e8e8;">
                    <input type="text" name="code6" style="background-color: #e8e8e8">
                    </div>
                    <button type="submit" name="submit" id="student-add" style="margin: auto">Add</button>
                </form>

            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: admin-login.php");
}
?>