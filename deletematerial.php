<?php
session_start();
//checking the user login status and his role
if(isset($_SESSION['user']) && $_SESSION['user'] == "staff") {
    //getting the file path and setting it to a variable
    $file_path = $_GET['pathing'];
    echo $file_path;
    //checkning the file status and deleting if available
    if(file_exists($file_path)) {
        if(unlink($file_path)) {
            echo "File deleted successfully.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Failed to delete file.";
            // Debug statement to print th last error
            echo error_get_last()['message']; 
        }
    } else {
        echo "File not found.";
    }
} else {
    header("Location: staff-login.php");
    exit();
}
?>