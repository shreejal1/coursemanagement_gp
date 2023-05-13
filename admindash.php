<?php
require('database.php');
//checking the status of logged in user and his role
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    //selecting total number of courses
    $crs = $pdo->query("SELECT COUNT(id) FROM course WHERE status = 'ACTIVE'");
    $course = $crs->fetch();
    //selecting total number of staffs
    $stf = $pdo->query("SELECT COUNT(staff_id) FROM staff WHERE status = 'ACTIVE'");
    $staff = $stf->fetch();
    //selecting total number of students
    $std = $pdo->query("SELECT COUNT(student_id) FROM student WHERE status = 'ACTIVE'");
    $student = $std->fetch();

    //selecting all the active courses
    $datacourse = $pdo->query("SELECT * FROM course WHERE status = 'ACTIVE'");
    //selecting all the active staffs
    $datastaff = $pdo->query("SELECT * FROM staff WHERE status = 'ACTIVE'");
    //selecting all the active students
    $datastudent = $pdo->query("SELECT * FROM student WHERE status = 'ACTIVE'");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
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
                    <a href="archived.php">Archived</a>
                    <a href="student-reg.php">Add Student</a>
                    <a href="staff-reg.php">Add Staff</a>
                    <a href="courseadd.php">Add Course</a>
                    <a onclick="return clicklogout()" href="logout.php">Log out</a>
                    <!-- defining a function to alert users about logout -->
                    <script>
function clicklogout() {
  var result = confirm("Are you sure to log out?");
  if (result == true) {
    return true;
  } else {
    return false;
  }
}
</script>
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
                        echo "Total Courses ".$course['COUNT(id)'];
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
                        <td><div class="actions"><a href="edit.php?type=course&id='.$values['id'].'">Edit</a>       <a onClick="return clickfunction()" href="delete.php?type=course&id='.$values['id'].'">Delete</a></div></td>
                    </tr>';
                }
                    ?>
                </tbody>
            </table>
            <!-- alerting user that if he is sure to delete -->
            <script>
function clickfunction() {
  var result = confirm("Are you sure to delete?");
  if (result == true) {
    return true;
  } else {
    return false;
  }
}
</script>


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
                        echo "Total Staff ".$staff['COUNT(staff_id)'];
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
                        //selecting the course where the staff is enrolled
                        $c= $pdo->query("SELECT * FROM course WHERE id ='".$values['course_id']."' AND status='ACTIVE'");
                        $rc = $c->rowCount();
                        if($rc > 0){
                            //extracting with foreach loop
                        foreach($c as $respectivecourse){
                       echo '<td>'.$respectivecourse['name'].'</td>';
                        }}
                        else{
                            echo '<td>(not assigned)</td>';
                        }
                        echo '<td><div class="actions"><a href="edit.php?type=staff&id='.$values['staff_id'].'">Edit</a>       <a onClick="return clickfunction()" href="delete.php?type=staff&id='.$values['staff_id'].'">Delete</a></div></td>
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
                        echo "Total Student ".$student['COUNT(student_id)'];
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
                        //selecting the course where student is enrolled
                        $c= $pdo->query("SELECT * FROM course WHERE id ='".$values['course_id']."' AND status='ACTIVE'");
                        $rc = $c->rowCount();
                        if($rc > 0){
                        foreach($c as $respectivecourse){
                       echo '<td>'.$respectivecourse['name'].'</td>';
                        }}
                        else{
                            echo '<td>(not assigned)</td>';
                        }
                        echo '<td><div class="actions"><a href="edit.php?type=student&id='.$values['student_id'].'">Edit</a>       <a onClick="return clickfunction()" href="delete.php?type=student&id='.$values['student_id'].'">Delete</a></div></td>
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