<?php
require('database.php');
//checking the status of logged in user and his role
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
            <div style=" display: inline-block;">
                   <h1 style="line-height: 0; font-family: helvetica;">Module Materials</h1>
                </div>
                <div class="logout-btn">
                <a href="studentdash.php">🔙 Back to Student Dashboard</a>
                </div>
                

            </div>
            <div class="dash-centre">
            <table>
                <thead>
                <th width="10%" class="snoid"></th>
                    <th width="35%"></th>
                    <th width="25%"></th>
                </thead>

                <tbody>
               

                <?php
                //getting the module id
                //scanning the folder with that module id
                //extracting the folder
                $mid = $_GET['id'];
                $dir = "./files/$mid";
                if(is_dir($dir)) {
                    $files = scandir($dir);
                    foreach($files as $file) {
                        if($file != '.' && $file != '..') {
                            echo '
                            <tr>
                            <td class="snoid">#</td>';
                            
                            echo "<td>$file</td><br>
                            <td><a href='$dir/$file' style='text-decoration: none;'>Download</a></td>
                            </tr>";
                        }
                    }
                } else {
                    echo "<tr><td class='snoid'>#</td><td>Error: Directory not found.</td><td></td></tr>";
                }
                ?>
                </tbody>
            </table>


               

            </div>
        </div>

    </body>

</html>
<?php
}else{
	header("Location: student-login.php");
}
?>