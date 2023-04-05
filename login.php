<?php
require 'database.php';

$email = $_POST['email'];
$password = $_POST['password'];
$usertype = $_GET['type'];

if($usertype === "admin"){
    $comp = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if ($password === $info['password']) {
                header("Location: student-reg.php");
                exit();
            } else {
                header("Location: admin-login.php");
                exit();
            }
        }
    }
    
    else{
        header("Location: admin-login.php");
        exit(); 
    }
}
else if($usertype === "staff"){

    $comp = $pdo->prepare("SELECT * FROM staff WHERE email = :email");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if ($password === $info['password']) {
                header("Location: student-reg.php");
                exit();
            } else {
                header("Location: staff-login.php");
                exit();
            }
        }
    }
    else{
        header("Location: staff-login.php");
        exit();
    }

}
else if($usertype === "student"){

    $comp = $pdo->prepare("SELECT * FROM student WHERE email = :email");
    $const = ["email" => $email];
    $comp->execute($const);
    $rows = $comp->rowCount();
    if ($rows > 0) {
        $credentials = $comp->fetchAll();
        foreach ($credentials as $info) {
            if ($password === $info['password']) {
                header("Location: student-reg.php");
                exit();
            } else {
                header("Location: student-login.php");
                exit();
            }
        }
    }
    
    else{
        header("Location: student-login.php");
        exit();
    }

}

?>