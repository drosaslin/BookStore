<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['delete']))
    {
        $delete = $_POST['StorageID'];
        $sql = "DELETE FROM storage where StorageID = '$delete'";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['apply']))
    {
        $ID = $_POST['storageID'];
        $quantity = $_POST['quantity'];
        $cost = $_POST['price'];

        $sql = "UPDATE storage
                SET Quantity = '$quantity', Cost = '$cost'
                WHERE StorageID = '$ID'";
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
        <title>Storage Management | Pick-a-book</title>
        <?php include'head.php'; ?>
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

        .box_text{
          width: 90%;
        }

    </style>
    </head>
    <body id="storage-management" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">Storage Management</h3>
                <table align="center">
                    <tr>
                        <th>Storage ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Added on</th>
                        <th>Added by</th>
                        <th>Options</th>
                    </tr>
                    <?php
                      $query = "SELECT Name, ISBN, StorageID, Quantity, Cost, FirstName, LastName, DATE_FORMAT(Date_Time, '%c/%d/%Y %k:%i') AS date
                                FROM member, (SELECT BookID, ISBN, StorageID, Name  FROM book) AS B
                                NATURAL JOIN
                                (SELECT StorageID, Quantity, Cost, Date_Time, ManagerID FROM storage) AS S
                                WHERE B.StorageID = S.StorageID AND ManagerID = MemberID
                                ORDER BY Date_Time;";
                      $result=  mysqli_query($con,$query);
                        //display the data
                      while ($rows = mysqli_fetch_assoc($result))
                      {
                          echo "<tr>";
                          echo "<td>". $rows['StorageID'] ."</td>";
                          echo "<td>". $rows['Name'] ."</td>";
                          echo "<td>". $rows['Quantity'] ."</td>";
                          echo "<td>$". $rows['Cost'] . "</td>";
                          echo "<td>". $rows['date'] . "</td>";
                          echo "<td>". $rows['FirstName'] . " " .$rows['LastName']. "</td>";
                          $ID = $rows['StorageID'];

                          echo '<form action="bookmanagement.php" method="post">';
                          echo '<input type = "hidden" name="StorageID" value="'.$ID.'">';
                          echo '<td><input name = "delete" type = "submit" value = "Delete">';
                          echo "</form>";
                          echo '<form action="edit_storage_item.php" method="post">';
                          echo '<input type = "hidden" name="StorageID" value="'.$ID.'">';
                          echo '<td><input name = "edit" type = "submit" value = "Edit">';
                          echo "</tr></form>";
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
