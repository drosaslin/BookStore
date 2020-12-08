<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Book Management | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <center><h1>New Book</h1></center>
                <form method="post" action="bookmanagement.php">
                    <table align="center">
                        <tr>
                            <td style="text-align: center;">Name</td>
                            <td style="padding:5px;"><input type="text" size=20 name="name"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">ISBN</td>
                            <td style="padding:5px;"><input type="text" size=20 name="ISBN"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Author</td>
                            <td style="padding:5px;"><input type="text" size=20 name="author"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Publisher</td>
                            <td style="padding:5px;"><input type="text" size=20 name="publisher"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Category</td>
                            <td style="padding:5px;"><input type="text" size=20 name="category"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Description</td>
                            <td style="padding:5px;"><input type="text" size=20 name="description"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Quantity</td>
                            <td style="padding:5px;"><input type="text" size=20 name="quantity"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Cost</td>
                            <td style="padding:5px;"><input type="text" size=20 name="cost"/></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" name="add" value="Add"/></p>
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
