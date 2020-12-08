<?php
include_once ("databaseconnection.php");

if ($_POST["pw"]==$_POST["pwa"] && $_POST["pw"]!="" && $_POST["username"]!=""){
    if (!$con){
        die('Error connecting to server :'.mysql_error());
    }
    $result=mysqli_query($con, "SELECT username FROM member WHERE username='$_POST[username]'");
    if (mysqli_num_rows($result) == 0){
        $first = mysqli_real_escape_string($con, $_POST['first_name']);
        $last = mysqli_real_escape_string($con, $_POST['last_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['pw']);
        $bday = mysqli_real_escape_string($con, $_POST['birthday']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $phone = mysqli_real_escape_string($con, $_POST['phone_no']);

        $sql="INSERT INTO member (FirstName, LastName, Username, Member_pwd, Email, Birthday, Gender, Class, PhoneNo)
              VALUES('$first','$last','$username','$password','$email','$bday','$gender','1','$phone');";

        mysqli_query($con,$sql);
            //die('Error :'.mysqli_error());
        echo "You are registered. Congrats !!!";
        echo "<a href='login.php'>Go back to login page</a>";
    }
    else{
        echo "Username Already exists !";
        echo "<a href='login.php'>Go back to login page</a>";
    }
    mysqli_close($con);
}
else{
    if ($_POST["pw"]!=$_POST["pwa"]) echo "Password mismatch <br />";
    else echo "Invalid Username <br />";
    echo "<a href='login.php'>Go back to login page</a>";
}
?>
