<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $userEmail = $_POST['Email']; //grabbing the user input for the email
    $userPass = $_POST['Password']; //grabbing the user input for the password


    $con = mysqli_connect("192.168.8.6","root","!!Break@@4444","inventory");//mysqli("localhost","username of database","password of database","database name") establishing a connection
    $inputCheck = mysqli_query($con,"SELECT * FROM `user_list` WHERE `USER_ID`='$userEmail' && `USER_PASS`='$userPass'"); //query to grab and compare the user input and the data in the database

    $outPut = mysqli_num_rows($inputCheck); //listing the results hit in the database after the comparison

    if($outPut==1)
    {

        $_SESSION['log'] = 1;
        header("location: data_entry/dashboard.php");
        $sql = "INSERT INTO user_log(USER_ID) VALUES ('$userEmail')";
        $query = mysqli_query($con,$sql);

        $_SESSION['log_id'] = $userEmail;

        $row = mysqli_fetch_array($inputCheck,MYSQLI_ASSOC);
        $rowCheck = $row['ROLE'];
       // unset($_SESSION['errorLog']);

        if($rowCheck == 'Hardware')
        {
            unset($_SESSION['deptRow']);
            $_SESSION['deptRow'] = 'hardSes';
            $_SESSION['newDir'] = 1;

        }elseif($rowCheck == 'Network')
        {
            unset($_SESSION['deptRow']);
			header("location:../dashboard_N.php");
            $_SESSION['deptRow'] = 'netSes';
            $_SESSION['newDir'] = 2;

        }elseif ($rowCheck == 'Admin'){
            unset($_SESSION['deptRow']);
            $_SESSION['deptRow'] = 'adminSes';
            $_SESSION['newDir'] = 3;
        }
    }

    else
    {
        echo "please fill proper details";
         die(header("location:../index.php?loginFailed=1"));


    }
} else
    {
        echo 'no user details entered';
    }
?>
