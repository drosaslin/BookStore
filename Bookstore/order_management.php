<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['delete']))
    {
        $orderID = $_POST['orderID'];
        $sql = "SELECT BookID, Quantity FROM orderitem WHERE OrderListID = '$orderID';";

        $result = mysqli_query($con, $sql);
        while($rows = mysqli_fetch_assoc($result))
        {
            $quantity = $rows['Quantity'];
            $bookID = $rows['BookID'];

            $sql = "UPDATE storage S, book B
                    SET S.Quantity = S.Quantity + '$quantity'
                    WHERE B.BookID = '$bookID' AND S.StorageID = B.StorageID;";
            mysqli_query($con, $sql);
        }

        $sql = "DELETE FROM orderlist where OrderListID = '$orderID'";
        mysqli_query($con, $sql);
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
        <title>Order Management | Pick-a-book</title>
        <?php include'head.php';?>
        <style type="text/css">

        th{
            font-size: 16px;
            padding: 5px;
            font-weight: bold;
            text-align: center;
            margin: 10px;
        }

        td{
            font-size: 14px;
            text-align: center;
            padding: 5px 10px;
            margin: 10px;
        }

        th,td{
            border-bottom: 1px solid #ddd;
        }

        tr:hover{
            background-color: #d6d8db;
        }

        table{
            width: 90%;
        }

        input{
            margin: auto 5px;
        }

        </style>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <h3 style="text-align: left; padding:10px; margin:0;">Order Management</h3>
                <table align="center">
                    <tr>
                        <th>Order#</th>
                        <th>Username</th>
                        <th>Cost</th>
                        <th>Order Date</th>
                        <th>State</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <?php
                            $sql = "SELECT Username, OrderListID, cost, State, DATE_FORMAT(Date_Time, '%M %D %Y') AS date
                                    FROM orderlist O, member M
                                    WHERE M.MemberID = O.MemberID
                                    ORDER BY State DESC, OrderListID ASC;";
                            $result = mysqli_query($con, $sql);

                            while($rows = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td>". $rows['OrderListID'] . "</td>";
                                echo "<td>". $rows['Username'] . "</td>";
                                echo "<td>$". $rows['cost'] . "</td>";
                                echo "<td>". $rows['date'] . "</td>";
                                echo "<td>". $rows['State'] . "</td>";
                                echo'<form action="edit_order_details.php" method="POST" target="_blank">';
                                echo'<input type="hidden" name="state" value='.$rows['State'].'>';
                                echo'<input type="hidden" name="orderID" value='.$rows['OrderListID'].'>';
                                echo'<td><input type ="submit" name="orderDetails" value="Details"/></td>';
                                echo'</form>';

                                if($rows['State'] != 'Completed' && $rows['State'] != 'Sent')
                                {
                                    echo'<form action="edit_order.php" method="POST">';
                                    echo'<input type="hidden" name="orderID" value='.$rows['OrderListID'].'>';
                                    echo'<td><input type ="submit" name="edit" value="Edit"/></td>';
                                    echo'</form>';
                                    echo'<form action="order_management.php" method="POST">';
                                    echo'<input type="hidden" name="orderID" value='.$rows['OrderListID'].'>';
                                    echo'<td><input type ="submit" name="delete" value="Delete"/></td>';
                                    echo'</form>';
                                }
                                else {
                                    echo "<td></td><td></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
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
