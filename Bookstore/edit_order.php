<?php
    require 'manager_access.php';
    include_once('databaseconnection.php');

    if(isset($_POST['edit']))
    {
        $ID = $_POST['orderID'];
        $sql = "SELECT OrderListID, cost, State, DATE_FORMAT(Date_Time, '%M %D %Y') AS date
                FROM orderlist
                WHERE OrderListID = '$ID'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);

        $orderNum = $rows['OrderListID'];
        $cost = $rows['cost'];
        $date = $rows['date'];
        $state = $rows['State'];
    }

    if(isset($_POST['apply']))
    {
        $state = $_POST['state'];
        $ID = $_POST['orderID'];

        $sql = "UPDATE orderlist
                SET State = '$state'
                WHERE OrderListID = '$ID';";
        mysqli_query($con, $sql);

        header('Location: order_management.php');
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
        <title>Edit Order | Pick-a-book</title>
        <?php include'head.php';?>
    </head>
    <body id="edit_users" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <h3 style="text-align: left; padding:10px; margin:0;">Order Management</h3>
                <form method="POST" action="edit_order.php">
                    <table align="center">
                        <input type="hidden" name="orderID" value="<?php echo $ID ?>">
                        <tr>
                            <td style="text-align: center;">Order#</td>
                            <td style="padding:5px;"><?php echo $orderNum?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Cost</td>
                            <td style="padding:5px;"><?php echo $cost?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Order Date</td>
                            <td style="padding:5px;"><?php echo $date?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">State</td>
                            <td style="padding:5px;"><input type="text" name="state" value="<?php echo $state?>"></td>
                        </tr>
                    </table>
                    <p style="text-align: center;"><input type="submit" name="apply" value="Apply changes"/></p>
                </form>
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
