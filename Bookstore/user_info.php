<?php
    require 'access.php';
    include_once('databaseconnection.php');

    $username = $_SESSION['user'];
    $sql = "SELECT *
            FROM member
            WHERE Username = '$username';";
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
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>User Information | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <center><h1>User Information</h1></center>
                <form method="POST" action="edit_info.php">
                    <table align="center">
                        <tr>
                            <input type = "hidden" name="first" value="<?php echo $first ?>">
                            <td style="text-align: center;">First Name</td>
                            <td style="padding:5px;"><?php echo $first ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="last" value="<?php echo $last ?>">
                            <td style="text-align: center;">Last Name</td>
                            <td style="padding:5px;"><?php echo $last ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Username</td>
                            <td style="padding:5px;"><?php echo $username ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="password" value="<?php echo $password ?>">
                            <td style="text-align: center;">Password</td>
                            <td style="padding:5px;"><?php echo $password ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="gender" value="<?php echo $gender ?>">
                            <td style="text-align: center;">Gender</td>
                            <td style="padding:5px;"><?php echo $gender ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="email" value="<?php echo $email ?>">
                            <td style="text-align: center;">Email</td>
                            <td style="padding:5px;"><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="phone" value="<?php echo $phone ?>">
                            <td style="text-align: center;">Phone Number</td>
                            <td style="padding:5px;"><?php echo $phone ?></td>
                        </tr>
                        <tr>
                            <input type = "hidden" name="birthday" value="<?php echo $birthday ?>">
                            <td style="text-align: center;">Birthday</td>
                            <td style="padding:5px;"><?php echo $birthday ?></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" name="edit" value="Edit"></p>
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
