<?php
require('database.php');
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    $crs = $pdo->query("SELECT COUNT(id) FROM course WHERE status = 'ARCHIVED'");
    $course = $crs->fetch();
    $stf = $pdo->query("SELECT COUNT(staff_id) FROM staff WHERE status = 'ARCHIVED'");
    $staff = $stf->fetch();
    $std = $pdo->query("SELECT COUNT(student_id) FROM student WHERE status = 'ARCHIVED'");
    $student = $std->fetch();

    $datacourse = $pdo->query("SELECT * FROM course WHERE status = 'ARCHIVED'");
    $datastaff = $pdo->query("SELECT * FROM staff WHERE status = 'ARCHIVED'");
    $datastudent = $pdo->query("SELECT * FROM student WHERE status = 'ARCHIVED'");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Archived Dashboard</title>
</head>
<body>
<div class="left-window">
            <img class="profile-image" src="./images/user.jpg" alt="Profile Image">
            ADMIN
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
                    Admin
                </div>
                    <div class="logout-btn">
                    <a href="admindash.php">🔙 Back to Admin Dashboard</a>
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
                        echo "Total Archived Courses ".$course['COUNT(id)'];
                    ?>
                </div>
                <div style=" display: inline-block;
  padding: 10px 20px;
  width:fit-content;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;
  margin-top: 1%;">
                Course List
            </div>
            <table>
                <thead>
                    <th width="10%" class="snoid">#</th>
                    <th width="35%">Courses Name</th>
                    <th width="25%">Actions</th>
                </thead>

                <tbody>
                    <?php
                    foreach($datacourse as $values){
                    echo '
                    <tr>
                        <td class="snoid">'.$values['id'].'</td>
                        <td>'.$values['name'].'</td>
                        <td><div class="actions"><a href="unarchive.php?type=course&id='.$values['id'].'">Unarchive</a>      <a href="edit.php?type=course&id='.$values['id'].'">Edit</a></div></td>
                    </tr>';
                }
                    ?>
                </tbody>
            </table>


            <div style=" display: inline-block;
  padding: 10px 20px;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  margin-top: 10px;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;">
                    <?php
                        echo "Total Archived Staff ".$staff['COUNT(staff_id)'];
                    ?>
                </div>
                <div style=" display: inline-block;
  padding: 10px 20px;
  width:fit-content;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;
  margin-top: 1%;">
                Staff List
            </div>
            <table>
                <thead>
                    <th width="10%" class="snoid">#</th>
                    <th>Staff Name</th>
                    <th>Date Joined</th>
                    <th>Courses</th>
                    <th width="25%">Actions</th>
                </thead>

                <tbody>
                    <?php
                    foreach($datastaff as $values){
                        
                    echo '
                    <tr>
                        <td class="snoid">'.$values['staff_id'].'</td>
                        <td>'.$values['first_name'].' '.$values['middle_name'].' '.$values['last_name'].'</td>
                        <td>'.$values['enroll_date'].'</td>';
                        $c= $pdo->query("SELECT * FROM course WHERE id ='".$values['course_id']."'");
                        $rc = $c->rowCount();
                        if($rc > 0){
                        foreach($c as $respectivecourse){
                       echo '<td>'.$respectivecourse['name'].'</td>';
                        }}
                        else{
                            echo '<td></td>';
                        }
                        
                        echo '<td><div class="actions"><a href="unarchive.php?type=staff&id='.$values['staff_id'].'">Unarchive</a>      <a href="edit.php?type=staff&id='.$values['staff_id'].'">Edit</a></div></td>
                    </tr>';
                }
                    ?>
                </tbody>
            </table>


            <div style=" display: inline-block;
  padding: 10px 20px;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  margin-top: 10px;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;">
                    <?php
                        echo "Total Archived Student ".$student['COUNT(student_id)'];
                    ?>
                </div>
                <div style=" display: inline-block;
  padding: 10px 20px;
  width:fit-content;
  border-radius: 10px;
  border: 2px solid #000;
  font-family: Helvetica;
  text-align: center;
  text-decoration: none;
  color: #000;
  line-height: 0.5;
  font-weight: bold;
  margin-top: 1%;">
                Student List
            </div>
            <table>
                <thead>
                    <th width="10%" class="snoid">#</th>
                    <th width="35%">Student Name</th>
                    <th>Courses</th>
                    <th width="25%">Actions</th>
                </thead>

                <tbody>
                    <?php
                    foreach($datastudent as $values){
                    echo '
                    <tr>
                        <td class="snoid">'.$values['student_id'].'</td>
                        <td>'.$values['first_name'].' '.$values['middle_name'].' '.$values['last_name'].'</td>';
                        $c= $pdo->query("SELECT * FROM course WHERE id ='".$values['course_id']."'");
                        foreach($c as $respectivecourse){
                       echo '<td>'.$respectivecourse['name'].'</td>';
                        }
                        echo '<td><div class="actions"><a href="unarchive.php?type=student&id='.$values['student_id'].'">Unarchive</a>      <a href="edit.php?type=student&id='.$values['student_id'].'">Edit</a></div></td>
                    </tr>';
                }
                    ?>
                </tbody>
            </table>
            
        </div>
</body>
</html>
<?php
}
else{
	header("Location: admin-login.php");
}
?>