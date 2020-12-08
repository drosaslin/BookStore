<?php
    require 'access.php';
    include_once('databaseconnection.php');
    $username = $_SESSION['user'];

    if(isset($_POST['delete']))
    {
        $bookID = $_POST['bookID'];
        $sql = "DELETE FROM shoppingcart
                WHERE BookID = '$bookID' AND CustomerID = (SELECT MemberID FROM member WHERE Username = '$username')";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['setQuantity']))
    {
        $bookID = $_POST['bookID'];
        $amount = $_POST['quantity'];

        $sql = "UPDATE shoppingcart
                SET Quantity = '$amount'
                WHERE BookID = '$bookID'";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['checkout']))
    {
        $sql = "SELECT MemberID
                FROM member
                WHERE Username = '$username'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);
        $userID = $rows['MemberID'];

        $sql = "INSERT INTO orderlist(MemberID, cost, State)
                VALUES('$userID', (SELECT SUM(Cost * Quantity) FROM shoppingcart WHERE CustomerID = '$userID'), 'Processing');";
        mysqli_query($con, $sql);

        $sql = "SELECT BookID, Cost, Quantity
                FROM shoppingcart
                WHERE CustomerID = '$userID'";
        $result = mysqli_query($con, $sql);

        while($rows = mysqli_fetch_assoc($result))
        {
            $bookID = $rows['BookID'];
            $cost = $rows['Cost'];
            $quantity = $rows['Quantity'];

            $sql = "INSERT INTO orderitem(BookID, Cost, Quantity, OrderListID)
                    VALUES('$bookID', '$cost', '$quantity', (SELECT OrderListID
                                                             FROM orderlist
                                                             WHERE MemberID = '$userID'
                                                             ORDER BY OrderListID DESC
                                                             LIMIT 1));";
            mysqli_query($con, $sql);

            $sql = "UPDATE storage S, book B
                    SET Quantity = Quantity - '$quantity'
                    WHERE B.BookID = '$bookID' AND S.StorageID = B.StorageID";

            mysqli_query($con, $sql);
        }

        $sql = "DELETE FROM shoppingcart WHERE CustomerID = '$userID'";
        mysqli_query($con, $sql);

        header('Location: trace_list.php');
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
        <title>Shopping Cart | Pick-a-book</title>
        <?php include'head.php'; ?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">Shopping Cart</h3>
                <table align="center">
                    <tr>
                        <th style="text-align: center; padding-right: 10px; font-weight:bold;">Name</td>
                        <th style="padding:5px;font-weight:bold;">Quantity</td>
                        <th style="padding:5px;font-weight:bold;">Price</td>
                    </tr>
                    <?php
                        $username = $_SESSION['user'];
                        $query = "SELECT B.BookID, B.Name, SC.Quantity, SC.Cost
                                  FROM book AS B, shoppingcart AS SC
                                  WHERE B.BookID = SC.BookID AND SC.CustomerID = (SELECT MemberID FROM member WHERE Username = '$username');";
                        $result=mysqli_query($con, $query);
                        //display the data
                        while ($rows = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td>". $rows['Name'] . "</td>";
                            echo '<td style="text-align:center;">' . $rows['Quantity'] . "</td>";
                            echo "<td>$". $rows['Cost'] . "</td>";
                            echo '<form action="shoppingcart.php" method="POST">';
                            echo '<input type="hidden" name="bookID" value='.$rows['BookID'].'>';
                            echo '<td><input type="text" name="quantity" size=1></td>';
                            echo '<td><input type="submit" name="setQuantity" value="Set Quantity"></td>';
                            echo '</form>';
                            echo '<form action="shoppingcart.php" method="POST">';
                            echo '<input type="hidden" name="bookID" value='.$rows['BookID'].'>';
                            echo '<td><input type="submit" name="delete" value="Delete"></td>';
                            echo '</form>';
                            echo "</tr>";
                        }
                     ?>
                </table>
                <form action="shoppingcart.php" method="POST">
                    <input type="submit" name="checkout" value="Check Out">
                </form>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
