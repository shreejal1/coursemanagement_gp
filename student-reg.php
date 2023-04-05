<?php
require 'database.php';
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Registration</title>
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
            <div class="stu_nav" style="justify-content: center">
                <h1 style="top: 5%; position: fixed; font-family: helvetica;">STUDENT REGISTRATION FORM</h1>
            </div>
            <div class="dash-centre">
                <form action="" method="POST" style="font-family: helvetica; align-items: start; margin-left: 7%; margin-right: 7%">
                    <label for="name">Full Name</label>
                    <div>
                    <input type="text" placeholder="First Name" name="fname">
                    <input type="text" placeholder="Middle Name" name="mname">
                    <input type="text" placeholder="Last Name" name="lname">
                    </div>
                    <label for="stID">Student ID</label>
                    <input type="text" name="stID">
                    <div>
                    <label for="gender" style="font-family: helvetica;">Gender</label>
                    <input type="radio" name="male" value="male">Male</input>
                    <input type="radio" name="male" value="female">Female</input>
                    </div><br>
                    <div>
                    <label for="course">Select a course:</label>
                    <select id="course" name="course">
                    <option value="">--Select a course--</option>
                    <?php
                    $sql = "SELECT id, name FROM course";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                      }
                    ?>
                    </select>
                    </div><br>
                    <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="email">Email</label><br>
                    <input type="text" placeholder="test@example.com" name="email">
                    </div>
                    <div style="margin-left: 20px">
                    <label for="password">Password</label><br>
                    <input type="password" placeholder="********" name="password">
                    </div>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="phone">Phone Number</label><br>
                    <input type="number" placeholder="9800000000" name="phone">
                    </div>
                    <div style="margin-left: 20px">
                    <label for="dob">Birth Date</label><br>
                    <input type="date" placeholder="DD/MM/YYYY" name="dob">
                    </div>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="address">Address</label><br>
                    <input type="text" placeholder="test@example.com" name="address">
                    </div>
                    <div style="margin-left: 20px">
                    <label for="en-date">Enroll Date</label><br>
                    <input type="date" placeholder="DD/MM/YYYY" name="en-date">
                    </div>
                    </div>
                    
                    
                    <button type="submit" name="submit" id="student-add" style="margin: auto; display: block;">Add Student</button>



                    
                </form>



            </div>
        </div>
        
    </body>
</html>
<?php
}else{
	header("Location: admin-login.php");
}
?>