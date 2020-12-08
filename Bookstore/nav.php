<?php
    if (isset($_SESSION['user']))
        $index = "logged.php";
    else
        $index = "index.php";
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=<?php echo $index;?> style="text-align:center;"><img src="images/indexlogo.png" class="icon" /></a>
            <?php
                if(isset($_SESSION['user']))
                    echo '<h4 style="text-align: center">Welcome, ' . $_SESSION['user'] . '!</h4>';
            ?>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right" style="word-spacing:3px;">
                <li><a data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" title="Date" data-content="<?=date(Y)?>&nbsp;年&nbsp;<?=date(m)?>&nbsp;月&nbsp;<?=date(d)?>&nbsp;日" role="button"><i class="fa fa-clock-o" id="big"></i></a></li>
                <li><a href="products.php"><i class="fa fa-book" id="big"></i></a></li>
                <li><a href="aboutus.php"><i class="fa fa-group" id="big"></i></a></li>
                <li><a href="login.php"><i class="fa fa-sign-in" id="big"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            if(isset($_SESSION['user']) && $_SESSION['class'] == 3)
                            {
                                echo '<li class="dropdown-header">Admin</li>';
                                echo '<li><a href="userlist.php">Manage Users</a></li>';
                                echo '<li><a href="logout.php">Log out</a></li>';
                            }

                            else if(isset($_SESSION['user']) && $_SESSION['class'] == 2)
                            {
                                echo '<li class="dropdown-header">Manager</li>';
                                echo '<li><a href="storagemanagement.php">Manage Storage</a></li>';
                                echo '<li><a href="order_management.php">Manage Orders</a></li>';
                                echo '<li><a href="bookmanagement.php">Manage Books</a></li>';
                                echo '<li><a href="logout.php">Log out</a></li>';
                            }

                            else if(isset($_SESSION['user']) && $_SESSION['class'] == 1)
                            {
                                echo '<li class="dropdown-header">Customer</li>';
                                echo '<li><a href="user_info.php">User Information</a></li>';
                                echo '<li><a href="shoppingcart.php">Shopping Cart</a></li>';
                                echo '<li><a href="trace_list.php">Trace List</a></li>';
                                echo '<li><a href="shopping_history.php">Shopping History</a></li>';
                                echo '<li><a href="logout.php">Log out</a></li>';
                            }

                            else
                                echo '<li class="dropdown-header">Guest</li>';
                        ?>
                        <li role="separator" class="divider"></li>
                        <li>
                            <div class="search_container">
                                <form action="search.php" method="POST">
                                    <input type="text" placeholder="Search Book" name="text" size=15>
                                    <a><button type="submit" name="search"><i class="fa fa-search"></i></button></a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
