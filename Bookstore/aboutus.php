<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
    require 'access.php';
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>About Us | Pick-a-book</title>
        <?php include'head.php'; ?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <p><u><strong>Group Leader</strong></u></p>
                <img src="images/leader.jpg" style="max-width:30%;"/>
                <p>Génesis Yau Lamboglia</p>
            </section>

            <section class="box_text">
                <p><u><strong>Group Member</strong></u></p>
                <p>David Rosas</p>
                <p>David Leung</p>
                <p>Franta Fang</p>
                <p>Edward Fan</p>
                <p>Robbie Huang</p>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
