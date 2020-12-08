<?php
    require 'admin_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['delete']))
    {
        $delete = $_POST['ID'];
        $sql = "DELETE FROM member where MemberID = '$delete'";
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
        <title>Users List | Pick-a-book</title>
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

    </style>
    </head>
    <body id="users" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
              <h3 style="text-align: left; padding:10px; margin:0;">Users List</h3>
                <table align="center">
                    <tr>
                        <th>Class</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>E-mail</th>
                        <th>Phone number</th>
                        <th>Birthday</th>
                        <th>Options</th>
                    </tr>
                    <?php
                      $query = "SELECT MemberID, FirstName, LastName, Username, Gender, Email, PhoneNo, Birthday, Class
                                FROM member
                                ORDER BY Class DESC, Username ASC";
                      $result=mysqli_query($con,$query);
                        //display the data
                      while ($rows = mysqli_fetch_assoc($result))
                      {
                          echo "<tr>";
                          if($rows['Class'] == 2)
                          {
                            echo "<td>Manager</td>";
                          }
                          else if($rows['Class'] == 1){
                            echo "<td>User</td>";
                          }
                          else{
                              echo "<td>Admin</td>";
                          }
                          echo "<td>". $rows['FirstName'] . " " . $rows['LastName'] . "</td>";
                          echo "<td>". $rows['Username'] . "</td>";
                          echo "<td>". $rows['Gender'] . "</td>";
                          echo "<td>". $rows['Email'] . "</td>";
                          echo "<td>". $rows['PhoneNo'] . "</td>";
                          echo "<td>". $rows['Birthday'] . "</td>";

                          $ID = $rows['MemberID'];

                          echo '<form action="userlist.php" method="post">';
                          echo '<input type = "hidden" name="ID" value="'.$ID.'">';
                          echo '<td><input name = "delete" type = "submit" value = "Delete">';
                          echo "</form>";
                          echo '<form action="edit_user_info.php" method="post">';
                          echo '<input type = "hidden" name="ID" value="'.$ID.'">';
                          echo '<input name ="edit" type ="submit" value ="Edit"></td>';
                          echo "</form></tr>";
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
