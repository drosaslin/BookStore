<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FED084">
        <title>Book | Pick-a-book</title>
        <?php include'head.php'; ?>
    </head>
    <body id="homepage" style="padding-top:60px;">
        <?php include'nav.php'; ?>
        <div class="container" align="center" style="bottom:0; top:0; height:100%; max-height:100%;" id="fadein">
            <section class="box_text">
                <p style="text-align: center;"><img src="images/book1.jpg" style="max-width:30%;"/></p>
                <table align="center">
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">Book Name</td>
                        <td style="padding:5px;">Justice : What the right thing to do?</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">Author</td>
                        <td style="padding:5px;">Michael J.Sandel</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">Publisher</td>
                        <td style="padding:5px;">New York Times</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">Description</td>
                        <td style="padding:5px;">It is about the definition of Justice.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">Category</td>
                        <td style="padding:5px;">Philosophy</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-right: 10px;">ISBN</td>
                        <td style="padding:5px;">9780374532505</td>
                    </tr>
                </table>
                <p style="text-align: center;"><input type="submit" value="Buy"/></p>
            </section>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
<script>
    $("[data-toggle=popover]").popover();
</script>