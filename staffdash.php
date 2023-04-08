<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "staff"){
    $stu = $pdo->query("SELECT * FROM staff WHERE staff_id = '".$_SESSION['id']."'");
    $datastu = $stu->fetch();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Staff Dashboard-Course</title>
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
                    $mods = $pdo->query("SELECT course_id FROM staff WHERE staff_id = '".$_SESSION['id']."'");
                    $datamod = $mods->fetch();
                    $modules = $pdo->query("SELECT * FROM staff_module WHERE staff_id = '".$_SESSION['id']."'");
                    foreach($modules as $modsvals){
                        $modsu = $pdo->query("SELECT * FROM module WHERE id = '".$modsvals['module_id']."'");
                        $rcs = $modsu->rowCount();
                        if($rcs > 0){
                            foreach($modsu as $modus){
                
                echo '<a href="add-material.php?id='.$modus['id'].'" style="text-decoration: none; color: black;"><div id="courseitems">
                        <h2 style="line-height: 0; font-family: helvetica; margin-left: 2%;">'.$modus['id'].'</h2>
                        <h2 style="line-height: 0; font-family: helvetica; margin-left: 2%;">'.$modus['name'].'</h2>
                        <h4 style="line-height: 0; font-family: helvetica; margin-left: 2%;">Credits: '.$modus['credit'].'</h4>

                </div></a><br><br>';
                        }
                    }
                    }

                ?>
            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: staff-login.php");
}
?>