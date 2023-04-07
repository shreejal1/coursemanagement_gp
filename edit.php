<?php
require('database.php');

if(isset($_SESSION['user']) && $_SESSION['user'] === "admin"){
    if(isset($_GET['type'])){

        $type = $_GET['type'];
        $id = $_GET['id'];

        if($type == "staff"){
            $staffq = $pdo->query("SELECT * FROM staff WHERE staff_id = '$id'");
            $staffd = $staffq->fetch();
            if(isset($_POST['submit'])){
            $fname = strtoupper($_POST['fname']);
            if(isset($_POST['mname'])){
                $mname = strtoupper($_POST['mname']);
            }
            else{
                $mname = '';
            }
            $lname = strtoupper($_POST['lname']);
            $gender = strtoupper($_POST['gender']);
            $email = strtoupper($_POST['email']);
            $contact = $_POST['phone'];
            $dob = $_POST['dob'];
            $addr = strtoupper($_POST['address']);
            $hd = $_POST['en-date'];
    
            $ins = $pdo->prepare('UPDATE staff SET first_name = :fname, middle_name = :mname, last_name = :lname, gender = :gender, email = :email, contact = :phone, date_of_birth = :dob, address = :addr, enroll_date = :hd WHERE staff_id = :sid');
            $cons = ['sid' => $id,
                    'fname' => $fname,
                    'mname' => $mname,
                    'lname' => $lname,
                    'gender' => $gender,
                    'email' => $email,
                    'phone' => $contact,
                    'dob' => $dob,
                    'addr' => $addr,
                    'hd' => $hd
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
        <title>STAFF Edit</title>
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
                    <h1 style="top: 5%; position: fixed; font-family: helvetica;">STAFF EDIT FORM</h1>
                </div>
                <div class="dash-centre">
                    <form action="" method="POST" style="font-family: helvetica; align-items: start; margin-left: 7%; margin-right: 7%">
                        <label for="name">Full Name</label>
                        <div>
                        <input type="text" placeholder="First Name" name="fname" value="<?php echo $staffd['first_name']; ?>" required>
                        <input type="text" placeholder="Middle Name" name="mname" value="<?php echo $staffd['middle_name']; ?>">
                        <input type="text" placeholder="Last Name" name="lname" value="<?php echo $staffd['last_name']; ?>" required>
                        </div>
                        <div>
                        <label for="gender" style="font-family: helvetica;">Gender</label>
                        <?php
                            if($staffd['gender'] == "M"){
                                echo '<input type="radio" name="gender" value="male" checked>Male</input>
                        <input type="radio" name="gender" value="female">Female</input>';
                            }
                            else{
                                echo '<input type="radio" name="gender" value="male">Male</input>
                        <input type="radio" name="gender" value="female" checked>Female</input>';
                            }
                        ?>
                        
                        </div><br>
                        <div style="display: flex; flex-direction: row; justify-content: space-evenly;">
                        <div>
                            <label for="email">Email</label><br>
                        <input type="text" placeholder="test@example.com" name="email" value="<?php echo $staffd['email']; ?>" required>
                        </div>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                        <div>
                            <label for="phone">Phone Number</label><br>
                        <input type="number" placeholder="9800000000" name="phone" value="<?php echo $staffd['contact']; ?>"required>
                        </div>
                        <div style="margin-left: 20px">
                        <label for="dob">Birth Date</label><br>
                        <input type="date" placeholder="DD/MM/YYYY" name="dob" value="<?php echo $staffd['date_of_birth']; ?>"required>
                        </div>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                        <div>
                            <label for="address">Address</label><br>
                        <input type="text" placeholder="test@example.com" name="address" value="<?php echo $staffd['address']; ?>" required>
                        </div>
                        <div style="margin-left: 20px">
                        <label for="en-date">Hired Date</label><br>
                        <input type="date" placeholder="DD/MM/YYYY" name="en-date" value="<?php echo $staffd['enroll_date']; ?>" required>
                        </div>
                        </div>
                        
                        
                        <button type="submit" name="submit" id="student-add" style="margin: auto; display: block;">Update Staff Details</button>
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
}
else if($type = "student"){

    $staffq = $pdo->query("SELECT * FROM student WHERE student_id = '$id'");
    $staffd = $staffq->fetch();
    if(isset($_POST['submit'])){
    $fname = strtoupper($_POST['fname']);
    if(isset($_POST['mname'])){
        $mname = strtoupper($_POST['mname']);
    }
    else{
        $mname = '';
    }
    $lname = strtoupper($_POST['lname']);
    $course = strtoupper($_POST['course']);
    $gender = strtoupper($_POST['gender']);
    $email = strtoupper($_POST['email']);
    $contact = $_POST['phone'];
    $dob = $_POST['dob'];
    $addr = strtoupper($_POST['address']);
    $hd = $_POST['en-date'];

    $ins = $pdo->prepare('UPDATE student SET first_name = :fname, middle_name = :mname, last_name = :lname, gender = :gender, course_id = :course, email = :email, contact = :phone, date_of_birth = :dob, address = :addr, enroll_date = :hd WHERE student_id = :sid');
    $cons = ['sid' => $id,
            'fname' => $fname,
            'mname' => $mname,
            'lname' => $lname,
            'gender' => $gender,
            'course' => $course,
            'email' => $email,
            'phone' => $contact,
            'dob' => $dob,
            'addr' => $addr,
            'hd' => $hd
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
<title>Student Edit</title>
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
            <h1 style="top: 5%; position: fixed; font-family: helvetica;">STUDENT EDIT FORM</h1>
        </div>
        <div class="dash-centre">
            <form action="" method="POST" style="font-family: helvetica; align-items: start; margin-left: 7%; margin-right: 7%">
                <label for="name">Full Name</label>
                <div>
                <input type="text" placeholder="First Name" name="fname" value="<?php echo $staffd['first_name']; ?>" required>
                <input type="text" placeholder="Middle Name" name="mname" value="<?php echo $staffd['middle_name']; ?>">
                <input type="text" placeholder="Last Name" name="lname" value="<?php echo $staffd['last_name']; ?>" required>
                </div>
                <div>
                <label for="gender" style="font-family: helvetica;">Gender</label>
                <?php
                    if($staffd['gender'] == "M"){
                        echo '<input type="radio" name="gender" value="male" checked>Male</input>
                <input type="radio" name="gender" value="female">Female</input>';
                    }
                    else{
                        echo '<input type="radio" name="gender" value="male">Male</input>
                <input type="radio" name="gender" value="female" checked>Female</input>';
                    }
                ?>
                
                </div><br>
                <div>
                    <label for="course">Select a course:</label>
                    <select id="course" name="course" required>
                    <?php
                    $sql = "SELECT id, name FROM course WHERE status = 'ACTIVE' AND id = '".$staffd["course_id"]."'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                      }
                    ?>
                    
                    <?php
                    $sql = "SELECT id, name FROM course WHERE status = 'ACTIVE' AND id != '".$staffd["course_id"]."'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                      }
                    ?>
                    </select>
                    </div><br>
                <div style="display: flex; flex-direction: row; justify-content: space-evenly;">
                <div>
                    <label for="email">Email</label><br>
                <input type="text" placeholder="test@example.com" name="email" value="<?php echo $staffd['email']; ?>" required>
                </div>
                </div>
                <div style="display: flex; flex-direction: row;">
                <div>
                    <label for="phone">Phone Number</label><br>
                <input type="number" placeholder="9800000000" name="phone" value="<?php echo $staffd['contact']; ?>"required>
                </div>
                <div style="margin-left: 20px">
                <label for="dob">Birth Date</label><br>
                <input type="date" placeholder="DD/MM/YYYY" name="dob" value="<?php echo $staffd['date_of_birth']; ?>"required>
                </div>
                </div>
                <div style="display: flex; flex-direction: row;">
                <div>
                    <label for="address">Address</label><br>
                <input type="text" placeholder="test@example.com" name="address" value="<?php echo $staffd['address']; ?>" required>
                </div>
                <div style="margin-left: 20px">
                <label for="en-date">Enroll Date</label><br>
                <input type="date" placeholder="DD/MM/YYYY" name="en-date" value="<?php echo $staffd['enroll_date']; ?>" required>
                </div>
                </div>
                
                
                <button type="submit" name="submit" id="student-add" style="margin: auto; display: block;">Update Student Details</button>
                <div class="logout-btn">
                <a href="admindash.php">🔙 Back to Admin Dashboard</a>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
<?php


}
else if($type = "course"){


}




}}
else{
    header("Location: admin-login.php");
    exit();
}

?>