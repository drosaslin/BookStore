<?php
    require 'admin_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['edit']))
    {
        $ID = $_POST['ID'];

        $sql = "SELECT *
                FROM member
                WHERE MemberID = '$ID'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);

        $first = $rows['FirstName'];
        $last = $rows['LastName'];
        $username = $rows['Username'];
        $password = $rows['Member_pwd'];
        $email = $rows['Email'];
        $birthday = $rows['Birthday'];
        $gender = $rows['Gender'];
        $phone = $rows['PhoneNo'];
        $class = $rows['Class'];
    }

    if(isset($_POST['apply']))
    {
        $ID = $_POST['ID'];
        $first = $_POST['first'];
        $last = $_POST['last'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $class = $_POST['class'];

        $sql = "UPDATE member
                SET FirstName = '$first', LastName = '$last', Username = '$username', Member_pwd = '$password', Email = '$email',
                    Birthday = '$birthday', Gender = '$gender', Class = '$class',  PhoneNo = '$phone'
                WHERE MemberID = '$ID'";
        mysqli_query($con, $sql);

        header('Location: userlist.php');
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Edit Users | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="edit_users" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <form method="POST" action="edit_user_info.php">
                    <table align="center">
                        <input type = "hidden" name="ID" value="<?php echo $ID ?>">
                        <tr>
                            <td style="text-align: center;">First Name</td>
                            <td style="padding:5px;"><input type="text" name="first" value="<?php echo $first?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Last Name</td>
                            <td style="padding:5px;"><input type="text" name="last" value="<?php echo $last?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Username</td>
                            <td style="padding:5px;"><input type="text" name="username" value="<?php echo $username?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Password</td>
                            <td style="padding:5px;"><input type="password" name="password" value="<?php echo $password?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Gender</td>
                            <td style="padding:5px;"><input type="text" name="gender" value="<?php echo $gender?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Email</td>
                            <td style="padding:5px;"><input type="text" name="email" value="<?php echo $email?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Phone Number</td>
                            <td style="padding:5px;"><input type="text" name="phone" value="<?php echo $phone?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Birthday</td>
                            <td style="padding:5px;"><input type="date" name="birthday" value="<?php echo $birthday?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Class</td>
                            <td style="padding:5px;"><input type="text" name="class" value="<?php echo $class?>"></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" name="apply" value="Apply changes"/></p>
                </form>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
<script>
    $('document').ready(function(){
        $('[data-login-button], [data-logout-button]').click(function(){
        $('[data-login-form], [data-login-user]').toggleClass('state-hidden');
        $('[data-header]').toggleClass('state-logged-in');
        });
    });
</script>
