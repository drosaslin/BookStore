<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Sign Up | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <center><h1>Sign Up</h1></center>
                <form method="post" action="signup.php">
                    <table align="center">
                        <tr>
                            <td style="text-align: center;">First Name</td>
                            <td style="padding:5px;"><input type="text" name="first_name"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Last Name</td>
                            <td style="padding:5px;"><input type="text" name="last_name"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Username</td>
                            <td style="padding:5px;"><input type="text" name="username"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Password</td>
                            <td style="padding:5px;"><input type="password" name="pw"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Password Again</td>
                            <td style="padding:5px;"><input type="password" name="pwa"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Gender</td>
                            <td style="padding:5px;"><input type="text" name="gender"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Email</td>
                            <td style="padding:5px;"><input type="text" name="email"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Phone Number</td>
                            <td style="padding:5px;"><input type="text" name="phone_no"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Birthday</td>
                            <td style="padding:5px;"><input type="date" name="birthday"/></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" value="Submit"/></p>
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
