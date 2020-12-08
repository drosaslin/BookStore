<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['delete']))
    {
        $delete = $_POST['ISBN'];
        $sql = "DELETE FROM book where ISBN = $delete";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['add']))
    {
        $username = $_SESSION['user'];
        $name = $_POST['name'];
        $ISBN = $_POST['ISBN'];
        $publisher = $_POST['publisher'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $cost = $_POST['cost'];
        $author = explode(" ", $_POST['author']);
        $authorFirst = $author[0];
        $authorLast = $author[1];

        $sql = "INSERT INTO storage(Quantity, Cost, ManagerID)
                VALUES('$quantity', '$cost', (SELECT MemberID FROM member WHERE Username ='$username'));";
        mysqli_query($con, $sql);

        $sql = "INSERT INTO book(Name, ISBN, Publisher, Category, Description, StorageID)
                VALUES('$name', '$ISBN', '$publisher', '$category', '$description', (SELECT StorageID FROM storage ORDER BY StorageID DESC LIMIT 1));";
        mysqli_query($con, $sql);

        $sql = "SELECT AuthorID
                FROM author
                WHERE FirstName = '$authorFirst' AND LastName = '$authorLast'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0)
        {
            $sql = "INSERT INTO author(FirstName, LastName)
                    VALUES('$authorFirst', '$authorLast');";
            mysqli_query($con, $sql);
        }

        $sql = "INSERT INTO writes
                VALUES((SELECT BookID FROM book ORDER BY BookID DESC LIMIT 1), (SELECT AuthorID FROM author WHERE FirstName = '$authorFirst' AND LastName = '$authorLast'));";
        mysqli_query($con, $sql);
    }

    if(isset($_POST['change']))
    {
        $ISBN = $_POST['ISBN'];
        $name = $_POST['name'];
        $newISBN = $_POST['newISBN'];
        $publisher = $_POST['publisher'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $author = explode(" ", $_POST['author']);
        $authorFirst = $author[0];
        $authorLast = $author[1];

        $sql = "UPDATE book
                SET Name = '$name', ISBN = '$newISBN', Category = '$category', Publisher = '$publisher', Description = '$description'
                WHERE ISBN = '$ISBN'";
        mysqli_query($con, $sql);

        $sql = "UPDATE author
                SET FirstName = '$authorFirst', LastName = '$authorLast'
                WHERE book.ISBN = '$ISBN' AND book.BookID = writes.BookID AND author.AuthorID = writes.AuthorID";
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
        <title>Book Management | Pick-a-book</title>
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
    <body id="book-management" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">Book Management</h3>
              <form action="add_book.php" method="POST">
                  <input type="submit" name="add" value="New Book">
              </form>
                <table align="center">
                    <tr>
                        <th>Name</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Publisher</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                    <?php
                      $query = "SELECT BookID, ISBN, StorageID, Name, Publisher, Description, Category
                                FROM book
                                ORDER BY Category";
                      $result=  mysqli_query($con,$query);
                        //display the data
                      while ($rows = mysqli_fetch_assoc($result))
                      {
                          echo "<tr>";
                          echo "<td>". $rows['Name'] ."</td>";
                          echo "<td>". $rows['ISBN'] ."</td>";
                          echo "<td>". $rows['Category'] ."</td>";
                          echo "<td>". $rows['Publisher'] . "</td>";
                          echo "<td>". $rows['Description'] . "</td>";

                          $ID = $rows['ISBN'];

                          echo '<form action="bookmanagement.php" method="post">';
                          echo '<input type = "hidden" name="ISBN" value="'.$ID.'">';
                          echo '<td><input name = "delete" type = "submit" value = "Delete">';
                          echo "</form>";
                          echo '<form action="edit_book.php" method="post">';
                          echo '<input type = "hidden" name="ISBN" value="'.$ID.'">';
                          echo '<input name="edit" type="submit" value="Edit"></td>';
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
