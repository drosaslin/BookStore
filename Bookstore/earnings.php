<?php
    require 'admin_access.php';
    include_once('databaseconnection.php');

    $username = $_SESSION['user'];
    $sql = "SELECT COUNT(BookID) AS Total, BookID
            FROM orderitem
            GROUP BY BookID
            ORDER BY Total DESC
            LIMIT 3;";
    $result = mysqli_query($con, $sql);
    for($n = 0; $rows = mysqli_fetch_assoc($result); $n++)
    {
        $bookID = $rows['BookID'];
        $sql = "SELECT Name FROM book WHERE BookID = '$bookID';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        if($n == 0) $top1 = $row['Name'];
        if($n == 1) $top2 = $row['Name'];
        if($n == 2) $top3 = $row['Name'];
    }

    echo "<h2>".$top1.$top2.$top3."</h2>";

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Earnings | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <center><h1>Records</h1></center>
                <table align="center">
                    <tr>
                        <td style="text-align: center;">Top 3 Books</td>
                        <td style="padding:5px;"><?php echo $first ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Most Popular Category</td>
                        <td style="padding:5px;"><?php echo $last ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Total Earnings</td>
                        <td style="padding:5px;"><?php echo $username ?></td>
                    </tr>
                </table>
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
