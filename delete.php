<?php
require('database.php');
//checking the user status and his role
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    if(isset($_GET['id']) && isset($_GET['type'])){
        //running the following codes if the hit button relates to course edit
        if($_GET['type'] == "course"){
        $cid = $_GET['id'];
        $arc = $pdo->query("UPDATE course SET status = 'ARCHIVED' WHERE id = '$cid'");
        if($arc){
            // $arcstdcr = $pdo->query("UPDATE student SET status = 'ARCHIVED' WHERE course_id = '$cid'");
            // $arcstfcr = $pdo->query("UPDATE staff SET status = 'ARCHIVED' WHERE course_id = '$cid'");
            $arcmodcr = $pdo->query("UPDATE module SET status = 'ARCHIVED' WHERE course_id = '$cid'");
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
    }

    //running the following codes if the hit button relates to staff edit
else if($_GET['type'] == "staff"){
    $cid = $_GET['id'];
    $arc = $pdo->query("UPDATE staff SET status = 'ARCHIVED' WHERE staff_id = '$cid'");
    header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
}
    //running the following codes if the hit button relates to student edit
else if($_GET['type'] == "student"){
    $cid = $_GET['id'];
    $arc = $pdo->query("UPDATE student SET status = 'ARCHIVED' WHERE student_id = '$cid'");
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