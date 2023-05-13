<?php
require 'database.php';
//checking the essentials fields for loggingg in
if(isset($_GET['type']) && isset($_POST['email']) && isset($_POST['password'])){
$email = $_POST['email'];
$password = $_POST['password'];
$usertype = $_GET['type'];
//if the user is admin checking from the admin table
if($usertype === "admin"){
    $comp = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if (password_verify($password, $info['password'])) {
                $_SESSION['user'] = "admin";
                $_SESSION['id'] = $info['id'];
                header("Location: admindash.php");
                exit();
            } else {
                header("Location: admin-login.php?error=1");
                exit();
            }
        }
    }
    
    else{
        header("Location: admin-login.php?error=1");
        exit(); 
    }
}
//if the user is admin checking from the staff table
else if($usertype === "staff"){

    $comp = $pdo->prepare("SELECT * FROM staff WHERE email = :email AND status = 'ACTIVE'");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if (password_verify($password, $info['password'])) {
                $_SESSION['user'] = "staff";
                $_SESSION['id'] = $info['staff_id'];
                header("Location: staffdash.php");
                exit();
            } else {
                header("Location: staff-login.php?error=1");
                exit();
            }
        }
    }
    else{
        header("Location: staff-login.php?error=1");
        exit();
    }

}
else if($usertype === "student"){
//if the user is admin checking from the student table
    $comp = $pdo->prepare("SELECT * FROM student WHERE email = :email AND status = 'ACTIVE'");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if (password_verify($password, $info['password'])) {
                $_SESSION['user'] = "student";
                $_SESSION['id'] = $info['student_id'];
                header("Location: studentdash.php");
                exit();
            } else {
                header("Location: student-login.php?error=1");
                exit();
            }
        }
    }
    
    else{
        header("Location: student-login.php?error=1");
        exit();
    }

}
}
else{
    header('Location: index.php');
}
?>