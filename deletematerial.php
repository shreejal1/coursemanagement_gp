<?php
session_start();
//checking the user login status and his role
if(isset($_SESSION['user']) && ($_SESSION['user'] == "staff") || $_SESSION['user'] == "student") {
    //getting the file path and setting it to a variable
    $file_path = $_GET['pathing'];
    echo $file_path;
    //checkning the file status and deleting if available
    if(file_exists($file_path)) {
        if(unlink($file_path)) {
            echo "<script>alert('File deleted successfully.')</script>";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "<script>alert('Failed to delete file.')</script>";
            // Debug statement to print th last error
            echo error_get_last()['message']; 
        }
    } else {
        echo "<script>alert('File not found.')</script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>