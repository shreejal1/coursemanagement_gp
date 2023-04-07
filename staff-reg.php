<?php
require 'database.php';
if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    if(isset($_POST['submit'])){
        // $mods = $_POST['modules'];
        // foreach($mods as $mod){
        //     echo $mod;
        //     echo '<br>';
        // }

        $s_id = strtoupper($_POST['stID']);
        $fname = strtoupper($_POST['fname']);
        if(isset($_POST['mname'])){
            $mname = strtoupper($_POST['mname']);
        }
        else{
            $mname = '';
        }
        $lname = strtoupper($_POST['lname']);
        $gender = strtoupper($_POST['gender']);
        $course = strtoupper($_POST['course']);
        $email = strtoupper($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $contact = $_POST['phone'];
        $dob = $_POST['dob'];
        $addr = strtoupper($_POST['address']);
        $hd = $_POST['en-date'];

        $ins = $pdo->prepare('INSERT INTO `staff`(`staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `course_id`, `email`, `password`, `contact`, `date_of_birth`, `address`, `enroll_date`, `status`) VALUES (:sid,:fname,:mname,:lname,:gender,:course,:email,:password,:phone,:dob,:addr,:hd,:status)');
        $cons = ['sid' => $s_id,
                'fname' => $fname,
                'mname' => $mname,
                'lname' => $lname,
                'gender' => $gender,
                'course' => $course,
                'email' => $email,
                'password' => $password,
                'phone' => $contact,
                'dob' => $dob,
                'addr' => $addr,
                'hd' => $hd,
                'status' => "ACTIVE"
    ];
    $inst = $ins->execute($cons);
    if($inst){
        $rowC = $ins->rowCount();
        if($rowC <= 0){
            echo "Failed, try again";
        }
        else{
            echo "Upload Successful";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    else{
        echo "Failed, try again";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>STAFF Registration</title>
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
                <h1 style="top: 5%; position: fixed; font-family: helvetica;">STAFF REGISTRATION FORM</h1>
            </div>
            <div class="dash-centre">
                <form action="" method="POST" style="font-family: helvetica; align-items: start; margin-left: 7%; margin-right: 7%">
                    <label for="name">Full Name</label>
                    <div>
                    <input type="text" placeholder="First Name" name="fname" required>
                    <input type="text" placeholder="Middle Name" name="mname">
                    <input type="text" placeholder="Last Name" name="lname" required>
                    </div>
                    <label for="stID">Staff ID</label>
                    <input type="text" name="stID" required>
                    <div>
                    <label for="gender" style="font-family: helvetica;">Gender</label>
                    <input type="radio" name="gender" value="male" checked>Male</input>
                    <input type="radio" name="gender" value="female">Female</input>
                    </div><br>
                    <div>
                    <label for="course">Select a course:(once set cannot be modified)</label>
                    <select id="course" name="course" required>
                    <option value="">--Select a course--</option>
                    <?php
                    $sql = "SELECT id, name FROM course WHERE status = 'ACTIVE'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                      }
                    ?>
                    </select>

                    <div id="moduleCheckboxes">
                      <label>Select modules:</label>
                    </div>
                    </div><br>
                    <div style="display: flex; flex-direction: row; justify-content: space-evenly;">
                    <div>
                        <label for="email">Email</label><br>
                    <input type="text" placeholder="test@example.com" name="email" required>
                    </div>
                    <div style="margin-left: 20px">
                    <label for="password">Password</label><br>
                    <input type="password" placeholder="********" name="password" required>
                    </div>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="phone">Phone Number</label><br>
                    <input type="number" placeholder="9800000000" name="phone" required>
                    </div>
                    <div style="margin-left: 20px">
                    <label for="dob">Birth Date</label><br>
                    <input type="date" placeholder="DD/MM/YYYY" name="dob" required>
                    </div>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                    <div>
                        <label for="address">Address</label><br>
                    <input type="text" placeholder="test@example.com" name="address" required>
                    </div>
                    <div style="margin-left: 20px">
                    <label for="en-date">Hired Date</label><br>
                    <input type="date" placeholder="DD/MM/YYYY" name="en-date" required>
                    </div>
                    </div>
                    
                    
                    <button type="submit" name="submit" id="student-add" style="margin: auto; display: block;">Add Staff</button>
                    <div class="logout-btn">
                    <a href="admindash.php">🔙 Back to Admin Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
        <script src="./course-module.js"></script>
        
    </body>
</html>
<?php
}else{
	header("Location: admin-login.php");
}
?>