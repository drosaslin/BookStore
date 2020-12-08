<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['delete']))
    {
        $state = $_POST['state'];
        $bookID = $_POST['bookID'];
        $orderID = $_POST['orderID'];

        $sql = "UPDATE orderlist
                SET cost = cost - (SELECT SUM(Cost * Quantity) FROM orderitem WHERE BookID = '$bookID' AND OrderListID = '$orderID')
                WHERE OrderListID = '$orderID'";
        mysqli_query($con, $sql);

        $sql = "DELETE FROM orderitem WHERE BookID = '$bookID' AND OrderListID = '$orderID'";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['setQuantity']))
    {
        $state = $_POST['state'];
        $bookID = $_POST['bookID'];
        $orderID = $_POST['orderID'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT Quantity, SUM(Cost * Quantity) AS totalCost
                FROM orderitem
                WHERE BookID = '$bookID' AND OrderListID = '$orderID';";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);
        $oldCost = $rows['totalCost'];
        $oldQuantity = $rows['Quantity'];
        $difference = $quantity - $oldQuantity;

        $sql = "UPDATE storage, book
                SET Quantity = Quantity + '$difference'
                WHERE BookID = '$bookID' AND storage.StorageID = book.StorageID;";
        mysqli_query($con, $sql);

        $sql = "UPDATE orderitem
                SET Quantity = '$quantity'
                WHERE OrderListID = '$orderID' AND BookID = '$bookID';";
        mysqli_query($con, $sql);

        $sql = "UPDATE orderlist
                SET cost = cost + (SELECT SUM(Cost * Quantity) FROM orderitem WHERE BookID = '$bookID' AND OrderListID = '$orderID') - '$oldCost';";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['orderDetails']))
        $state = $_POST['state'];
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
                        <th>Book Name</th>
                        <th>Cost</th>
                        <th>Quantity</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <?php
                            $username = $_SESSION['user'];
                            $orderID = $_POST['orderID'];
                            $query = "SELECT B.Name, O.Cost, O.Quantity, O.BookID
                                      FROM book B, orderitem O
                                      WHERE OrderListID = '$orderID' AND B.BookID = O.BookID
                                      ORDER BY Name;";
                            $result = mysqli_query($con,$query);
                            //display the data
                            while ($rows = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td>". $rows['Name'] . "</td>";
                                echo "<td>$". $rows['Cost'] . "</td>";
                                echo "<td>". $rows['Quantity'] . "</td>";

                                if($state == 'Processing')
                                {
                                    echo'<form action="edit_order_details.php" method="POST">';
                                    echo'<input type="hidden" name="state" value='.$state.'>';
                                    echo'<input type="hidden" name="bookID" value='.$rows['BookID'].'>';
                                    echo'<input type="hidden" name="orderID" value='.$orderID.'>';
                                    echo '<td><input type="text" name="quantity" size=1></td>';
                                    echo '<td><input type="submit" name="setQuantity" value="Set Quantity"></td>';
                                    echo'<td><input type ="submit" name="delete" value="Delete"/></td>';
                                    echo'</form>';
                                    echo "</tr>";
                                }
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
