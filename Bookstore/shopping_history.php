<?php
    require 'access.php';
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
        <title>User Record | Pick-a-book</title>
        <?php include'head.php'; ?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">User Record</h3>
                <table align="center">
                    <tr>
                        <th style="text-align: center; padding-right: 10px; font-weight:bold;">Name</th>
                        <th style="padding:5px;font-weight:bold;">Quantity</th>
                        <th style="padding:5px;font-weight:bold;">Price</th>
                        <th style="padding:5px;font-weight:bold;">Date</th>
                    </tr>

                    <?php
                        $username = $_SESSION['user'];
                        $sql = "SELECT B.Name, O.Quantity, O.Cost, DATE_FORMAT(OL.Date_Time, '%M %D %Y') AS date
                                FROM book B, orderitem O, orderlist OL
                                WHERE B.BookID = O.BookID  AND OL.OrderListID = O.OrderListID AND OL.MemberID = (SELECT MemberID
                                                                                                                 FROM member
                                                                                                                 WHERE Username = '$username');";
                        $result = mysqli_query($con, $sql);
                        //display the data
                        while ($rows = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td>". $rows['Name'] . "</td>";
                            echo '<td style="text-align:center;">'. $rows['Quantity'] . "</td>";
                            echo "<td>$". $rows['Cost'] . "</td>";
                            echo "<td>". $rows['date'] . "</td>";
                            echo "</tr>";
                        }
                     ?>
                </table>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
