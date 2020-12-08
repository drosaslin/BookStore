<?php
    session_start();
    include_once('databaseconnection.php');

    if($_POST['username'] != "" && $_POST['pw'] != "")
    {
        if (!$con){
            die('Error connecting to server :'.mysql_error());
        }

        $username = $_POST['username'];
        $password = $_POST['pw'];
        $sql = "SELECT Username, Member_pwd, Class
                FROM member
                WHERE Username='$username' AND Member_pwd='$password'";
        $result=mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0){
            echo "Wrong Login. Go back and try again.";
            echo "<br/><a href='login.php'>Go back to login page</a>";
        }
        else{
            $rows = mysqli_fetch_assoc($result);
            $_SESSION['access']=1;
            $_SESSION['class']=$rows['Class'];
            $_SESSION['user']=$_POST['username'];
            header('Location: logged.php');
        }
    }
    else {
        echo "Wrong Login. Go back and try again.";
        echo "<br/><a href='login.php'>Go back to login page</a>";
    }

    mysqli_close($con);
?>
