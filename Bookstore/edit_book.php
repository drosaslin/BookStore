<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    $ISBN = $_POST['ISBN'];
    $sql = "SELECT Name, ISBN, Publisher, Category, Description, FirstName, LastName
            FROM book B, author A, writes W
            WHERE B.ISBN = '$ISBN' AND B.BookID = W.BookID AND A.AuthorID = W.AuthorID";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($result);

    $name = $rows['Name'];
    $ISBN = $rows['ISBN'];
    $publisher = $rows['Publisher'];
    $category = $rows['Category'];
    $description = $rows['Description'];
    $authorFirst = $rows['FirstName'];
    $authorLast = $rows['LastName'];
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
                <center><h1>Book Management</h1></center>
                <form method="post" action="bookmanagement.php">
                    <table align="center">
                        <input type="hidden" name="ISBN" value="<?php echo $ISBN ?>">
                        <tr>
                            <td style="text-align: center;">Name</td>
                            <td style="padding:5px;"><input type="text" size=20 name="name" value="<?php echo $name ?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">ISBN</td>
                            <td style="padding:5px;"><input type="text" size=20 name="newISBN" value="<?php echo $ISBN ?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Author</td>
                            <td style="padding:5px;"><input type="text" size=20 name="author" value="<?php echo $authorFirst." ".$authorLast ?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Publisher</td>
                            <td style="padding:5px;"><input type="text" size=20 name="publisher" value="<?php echo $publisher ?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Category</td>
                            <td style="padding:5px;"><input type="text" size=20 name="category" value="<?php echo $category ?>"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Description</td>
                            <td style="padding:5px;"><input type="text" size=20 name="description" value="<?php echo $description ?>"></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" name="change" value="Make Changes"></p>
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
