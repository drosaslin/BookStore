<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Homepage | Pick-a-book</title>
        <?php include'head.php'; ?>
    </head>
    <body id="homepage">
        <?php include'nav.php'; ?>
        <div id="header">
            <div class="inner">
                <header>
                    <img src="images/indexlogobig.png"/>
                </header>
            </div>
            <div>
                <a href="#banner" class="fa fa-chevron-circle-down fa-5x scrolly" style=" text-decoration:none; border:none;" rel=""></a>
            </div>
        </div>
        <div id="banner">
            <h1 style="font-size:48px; font-weight:300;">Welcome to <strong style="color: #fff;">Pick-a-book Bookstore</strong></h1>
            <h4 style="margin-top:30px; margin-bottom:15px; font-size:28px; font-weight:300; color:#333">Spend less. Read more.</h4>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>
<script>
    $('a').click(function(){
    $('html, body').animate({
    scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
    });
</script>