<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    if(isset($_GET['id']) && isset($_GET['type'])){
        if($_GET['type'] == "course"){
        $cid = $_GET['id'];
        $arc = $pdo->query("UPDATE course SET status = 'ACTIVE' WHERE id = '$cid'");
        if($arc){
            // $arcstdcr = $pdo->query("UPDATE student SET status = 'ACTIVE' WHERE course_id = '$cid'");
            // $arcstfcr = $pdo->query("UPDATE staff SET status = 'ACTIVE' WHERE course_id = '$cid'");
            $arcmodcr = $pdo->query("UPDATE module SET status = 'ACTIVE' WHERE course_id = '$cid'");
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
    }


else if($_GET['type'] == "staff"){
    $cid = $_GET['id'];
    $arc = $pdo->query("UPDATE staff SET status = 'ACTIVE' WHERE staff_id = '$cid'");
    header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
}

else if($_GET['type'] == "student"){
    $cid = $_GET['id'];
    $arc = $pdo->query("UPDATE student SET status = 'ACTIVE' WHERE student_id = '$cid'");
    header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
}
}
else{
    header("Location: admindash.php");
    exit();
}
}
else{
	header("Location: admin-login.php");
    exit();
}

?>