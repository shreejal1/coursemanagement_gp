<?php
session_start();

if(isset($_SESSION['user']) && $_SESSION['user'] == "staff") {
    $file_path = $_GET['pathing'];
    echo $file_path;
    if(file_exists($file_path)) {
        if(unlink($file_path)) {
            echo "File deleted successfully.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error: Failed to delete file.";
            echo error_get_last()['message']; // Debug statement to print last error
        }
    } else {
        echo "Error: File not found.";
    }
} else {
    header("Location: staff-login.php");
    exit();
}
?>