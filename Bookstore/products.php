<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    session_start();
    include_once('databaseconnection.php');

    if(isset($_POST['cart']))
    {
        $username = $_SESSION['user'];
        $ISBN = $_POST['ISBN'];

        $sql = "SELECT BookID, Cost, MemberID
                FROM book B, storage S, member M
                WHERE B.ISBN = '$ISBN' AND B.StorageID = S.StorageID AND Username = '$username';";
        $result = mysqli_query($con, $sql);

        $rows = mysqli_fetch_assoc($result);
        $bookID = $rows['BookID'];
        $cost = $rows['Cost'];
        $userID = $rows['MemberID'];

        $sql = "INSERT INTO shoppingcart(CustomerID, BookID, Quantity, Cost) VALUES('$userID', '$bookID', '1', '$cost');";
        mysqli_query($con, $sql);
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Our Products | Pick-a-book</title>
        <?php include'head.php'; ?>
        <style type="text/css">

        th{
            padding: 5px;
            font-weight: bold;
            text-align: center;
            margin: 10px;
        }

        td{
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
    <body id="products" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">Products</h3>
                <table align="center">
                    <tr>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        $query = "SELECT B.BookID, B.Name, B.Publisher, B.ISBN, S.Cost, A.FirstName, A.LastName
                                  FROM book B, storage S, author A, writes W
                                  WHERE B.BookID = W.BookID AND A.AuthorID = W.AuthorID AND B.StorageID = S.StorageID;";
                        $result=mysqli_query($con,$query);
                        //display the data
                        while ($rows = mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td>". $rows['Name'] . "</td>";
                            echo "<td>". $rows['FirstName'] . " " . $rows['LastName'] . "</td>";
                            echo "<td>$". $rows['Cost'] . "</td>";
                            echo'<form action="details.php" method="POST" target="_blank">';
                            echo'<input type="hidden" name="bookID" value='.$rows['BookID'].'>';
                            echo'<td><input type ="submit" name="details" value="Details"/></td>';
                            echo'</form>';

                            if(isset($_SESSION['user']) && $_SESSION['class'] == 1)
                            {
                                echo'<form action="products.php" method="POST">';
                                echo'<input type="hidden" name="ISBN" value='.$rows['ISBN'].'>';
                                echo'<td><input type="submit" name="cart" value="Add to Cart"/></td>';
                                echo'</form>';
                            }
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
