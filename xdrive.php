<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "student"){
    $stu = $pdo->query("SELECT * FROM student WHERE student_id = '".$_SESSION['id']."'");
    $datastu = $stu->fetch();
    
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
            echo "<script>alert('Error: File extension not allowed, please choose a PDF, DOC, DOCX, or TXT file.');</script>";
        } elseif($file_size > 1000000) {
            echo "<script>alert('Error: File size must be less than 1MB.');</script>";
        } else {
            $s_id = $_SESSION['id'];
            $upload_dir = "./xdrivefiles/$s_id/";
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $upload_path = "./xdrivefiles/$s_id/" . $s_id . "_" . basename($file_name);
            if(move_uploaded_file($file_tmp, $upload_path)) {
                echo "File uploaded successfully.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "<script>alert('Error: Failed to upload file.');</script>";
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
                    </div>
                    <div style="width: 500px;">
                    <form action="" method="POST" enctype="multipart/form-data" style="width: 100%; align-items: center; display: block;">
                        <input type="file" name="file" required>
                        <button type="submit" value="Upload File">Upload File</button>
                    </form>
                    </div>
                
                <div class="logout-btn">
                <a href="studentdash.php">🔙 Back to Student Dashboard</a>
                    <a href="logout.php">Log out</a>
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
                $s_id = $_SESSION['id'];
                $dir = "./xdrivefiles/$s_id";
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
                    }}
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