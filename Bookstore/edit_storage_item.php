<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    $username = $_SESSION['user'];
    $ID = $_POST['StorageID'];
    $query = "SELECT Name, ISBN, Quantity, Cost, DATE_FORMAT(Date_Time, '%M %D %Y') AS date
              FROM storage S, book B
              WHERE S.StorageID = '$ID' AND S.StorageID = B.StorageID";
    $result = mysqli_query($con,$query);
    $rows = mysqli_fetch_assoc($result);

    $name = $rows['Name'];
    $ISBN = $rows['ISBN'];
    $quantity = $rows['Quantity'];
    $cost = $rows['Cost'];
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
                <h3 style="text-align: left; padding:10px; margin:0;">Storage Management</h3>
                <table align="center">
                    <tr>
                         <form method="POST" action="storagemanagement.php">
                             <table align="center">
                                 <input type="hidden" name="storageID" value="<?php echo $ID ?>">
                                 <tr>
                                     <td style="text-align: center;">Name</td>
                                     <td style="padding:5px;"><?php echo $name?></td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: center;">ISBN</td>
                                     <td style="padding:5px;"><?php echo $ISBN?></td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: center;">Quantity</td>
                                     <td style="padding:5px;"><input type="text" name="quantity" size=1 value="<?php echo $quantity?>"></td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: center;">Price</td>
                                     <td style="padding:5px;"><input type="text" name="price" size=1 value="<?php echo $cost?>"></td>
                                 </tr>
                             </table>
                             <p style="text-align: center;"><input type="submit" name="apply" value="Apply changes"/></p>
                         </form>
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
