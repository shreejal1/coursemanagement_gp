<?php
require('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
</head>
<body>
            <div class="left-window">
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
            <div class="blue-block"></div>
        </div>
        <div class="main-content">
            <div class="dash-centre" style="margin-top: 20px; height: 100%; margin-bottom: 45px">
            <!-- <div class="stu_nav" style="justify-content: center">
                <h1 style="top: 5%; position: fixed; font-family: helvetica;">Forgot Password?</h1>
                <h6 style="font-family: helvetica;">Enter the information to reset your password</h6>
            </div> -->
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h1 style="font-family: helvetica;">Forgot Password?</h1>
            <h6 style="font-family: helvetica; margin-top: -10px;">Enter the information to reset your password</h6>
            </div>
                <form action="" method="POST" style="font-family: helvetica; align-items: start; margin-left: 7%; margin-right: 7%">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="test@example.com" style="width: 100%;" required/>
                <label for="phone">Phone</label>
                <input type="number" name="phone" style="width: 100%;" required/>
                <label for="id">ID(Student/Staff)</label>
                <div  style="width: 100%;">
                <input type="text" name="id" style="width: 50%;" required/>
                <label for="role" style="font-family: helvetica; margin-left: 50px;">Role</label>
                    <input type="radio" name="role" value="staff" checked>Staff</input>    
                    <input type="radio" name="role" value="student">Student</input>
                    <input type="radio" name="role" value="admin">Admin</input>
                </div>
                <label for="npass">New Password</label>
                <input type="password" name="npassword" style="width: 100%;" required/>

                <label for="npass">Confirm Password</label>
                <input type="password" name="cpassword" style="width: 100%;" required/>
                    
                    <button type="submit" name="submit" id="student-add" style="margin: auto; display: block;">Submit</button>
                </form>

                <div class="popup-overlay" id="popup-overlay">
					<div class="popup">
						<ul id="validation-errors">

                        <?php
if(isset($_POST['submit'])){
    $email = strtoupper($_POST['email']);
    $id = strtoupper($_POST['id']);
    $role = $_POST['role'];
    $pass = $_POST['cpassword'];
    $npass = $_POST['npassword'];
    $npassh = password_hash($_POST['npassword'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    if($pass === $npass){
        if($role == "admin"){
            $sel = $pdo->query("SELECT * FROM admin WHERE id = '$id'");
            $rc = $sel->rowCount();
            if($rc > 0){
                $data = $sel->fetch();
                if($data['email'] == $email && $data['id'] == $id && $data['number'] == $phone){
                    $ins = $pdo->prepare("UPDATE admin SET password = :password WHERE id = :id");
                    $cons =['id' => $id, 'password' => $npassh];
                    $ins->execute($cons);
                    header("Location: admin-login.php");
                }else{
                    echo "The credentials doesn't match";
                }
            }
            else{
                echo "The credentials doesn't match";
            }
           

        }
        else if($role == "staff"){
            $sel = $pdo->query("SELECT * FROM staff WHERE staff_id = '$id'");
            $rc = $sel->rowCount();
            if($rc > 0){
                $data = $sel->fetch();
                if($data['email'] == $email && $data['staff_id'] == $id && $data['contact'] == $phone){
                    $ins = $pdo->prepare("UPDATE staff SET password = :password WHERE staff_id = :id");
                    $cons =['id' => $id, 'password' => $npassh];
                    $ins->execute($cons);
                    header("Location: staff-login.php");
                }
                else{
                    echo "The credentials doesn't match";
                }
            }
            else{
                echo "The credentials doesn't match";
            }

        }
        else if($role == "student"){
            $sel = $pdo->query("SELECT * FROM student WHERE student_id = '$id'");
            $rc = $sel->rowCount();
            if($rc > 0){
                $data = $sel->fetch();
                if($data['email'] == $email && $data['student_id'] == $id && $data['contact'] == $phone){
                    $ins = $pdo->prepare("UPDATE student SET password = :password WHERE student_id = :id");
                    $cons =['id' => $id, 'password' => $npassh];
                    $ins->execute($cons);
                    header("Location: student-login.php");
                }
                else{
                    echo "The credentials doesn't match";
                }
            }
            else{
                echo "The credentials doesn't match";
            }

        }
    }
    else{
        echo "The password fields don't match.";
    }






}
?>

                        </ul>
					</div>
				</div>
            </div>
        </div>
    </body>
</html>
