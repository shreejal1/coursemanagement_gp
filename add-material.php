<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "staff"){
    $stu = $pdo->query("SELECT * FROM staff WHERE staff_id = '".$_SESSION['id']."'");
    $datastu = $stu->fetch();
    if(isset($_GET['id'])){
    $mid = $_GET['id'];
        $selc = $pdo->query("SELECT * FROM module WHERE id = '$mid'");
        $selcm = $selc->fetch();


    }
    else{
        header("Location: staffdash.php");
        exit();
    }
?>
<?php
    
    if(isset($_FILES['file'])) {
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
        $extensions = array("pdf", "doc", "docx", "txt");
    
        if(in_array($file_ext, $extensions) === false){
            echo "Error: File extension not allowed, please choose a PDF, DOC, DOCX, or TXT file.";
        } elseif($file_size > 1000000) {
            echo "Error: File size must be less than 1MB.";
        } else {
            $upload_dir = "./files/$mid/";
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $upload_path = "./files/$mid/". basename($file_name);
            if(move_uploaded_file($file_tmp, $upload_path)) {
                echo "File uploaded successfully.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error: Failed to upload file.";
            }
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
                    Staff
                </div>
                <div style="width: 500px;">
                    <form action="" method="POST" enctype="multipart/form-data" style="width: 100%; align-items: center; flex-direction: row;">
                        <input type="file" name="file" required>
                        <button type="submit" value="Upload File">Upload File</button>
                    </form>
                    </div>
                <div class="logout-btn">
                <a href="staffdash.php">🔙 Back to Staff Dashboard</a>
                    <a href="logout.php">Log out</a>
                </div>

            </div>
            <div class="dash-centre">
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
            <?php
            echo '<h2 style="font-family: helvetica;">'.$selcm['name'].'</h2><br>';
            echo '<h3 style="font-family: helvetica;">Module Materials</h3>';
            ?>
            </div><br>
            <table>
                <thead>
                <th width="10%" class="snoid"></th>
                    <th width="35%"></th>
                    <th width="25%"></th>
                </thead>

                <tbody>
                    <?php
                    
                    $s_id = $_SESSION['id'];
                    $dir = "./files/$mid";
                    $dirr = "./files/$mid/";
                    if(is_dir($dir)) {
                        $files = scandir($dir);
                        foreach($files as $file) {
                            if($file != '.' && $file != '..') {
                                echo '
                    <tr>
                        <td class="snoid">#</td>
                        <td>'.$file.'</td>';
                        // <td><div class="actions"><a href="deletematerial.php?path='.$dir.$file.'">Delete</a></div></td>
                        echo '<td><div class="actions"><form method="POST" action="deletematerial.php?pathing='.$dirr.$file.'"><button type="submit" name="delbtn"/>Delete</button></form></div></td>
                    
                    </tr>';
                            }
                        }
                    } else {
                        
                        echo "Error: Data not found.";
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
	header("Location: staff-login.php");
}
?>