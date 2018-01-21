<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
$item_total = 0;
if(isset($_SESSION['cart_item'])){
    foreach ($_SESSION["cart_item"] as $item){
        $item_total += ($item["price"]*$item["quantity"]);
        $_SESSION['total_price'] = $item_total;
    }
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <title>NTU Online Shop</title>
</head>
<body id="page-top">
    <nav class="navbar" style="left: 0; right: 0;background-color: rgb(8,58,129)">
            <div class="topnav" id="myTopnav">
                <a class="page-scroll" href="index.php#index" style="letter-spacing: 3px; font-size: 20px"><img src="img/ntubaelogo.png" height="20px"></a>
                <?php
                if(isset($_SESSION['valid_user']))
                {
                    echo "\n<div class=\"dropdown\">\n";
                    echo '<button class="dropbtn">Hello, '.$_SESSION['valid_user'].'</button>';
                    echo "\n<div class=\"dropdown-content\">
                            \n<a href=\"account.php\">My Account</a>";
                            if($_SESSION['valid_user'] == "Grace" || $_SESSION['valid_user'] == "Joshua")
                            {
                                echo "\n<a href=\"update.php\">Update Price</a>";
                            } else {
                                echo "\n<a href=\"history.php\">Order History</a>";
                            }
                    echo "\n<a href=\"login.php?action=empty\">Log Out</a>
                        \n</div>
                    \n</div>";
                } else {
                    echo "<a href=\"login.php\">Login/Sign up</a>";
                }
                
                ?>
                <a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> $ 
                    <?php 
                        if(isset($_SESSION['total_price']))
                        {
                            $total_price = number_format($_SESSION['total_price'], 2, '.', ' ');
                            echo $total_price;
                        }else
                        {
                            echo "0.00";
                        }
                    ?></a>
                <div class="dropdown">
                    <button class="dropbtn"><a href="#shop" class="page-scroll" style="padding: 0;">Shop  <i class="fa fa-caret-down"></i></a></button>
                    <div class="dropdown-content">
                        <a href="accessories.php">Accessories</a>
                        <a href="apparels.php">Apparels</a>
                    </div>
                </div>
                <a class="page-scroll" href="#about">About Us</a>
                <a class="page-scroll" href="#index">Home</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a> 
            </div>
        </nav>

    <section id="index">
        <div class="index">
            <div class="container">
                <div class="intro-text">
                    <div class="col1">&nbsp;</div>
                    <div class="col10 roundback" style="padding-top: 350px; text-align: center; color: white; ">
                        <a class="page-scroll round-button" href="#shop">View Collection</a>
                    </div>
                    <div class="col1">&nbsp;</div>
                    <div class="col12" style="padding-top: 100px;">&nbsp;</div>
                </div>
                
                <ul class="slideshow">
                    <li>
                        <span>&nbsp;</span>
                    </li>
                    <li>
                        <span>&nbsp;</span>
                    </li>
                    <li>
                        <span>&nbsp;</span>
                    </li>
                    <li>
                        <span>&nbsp;</span>
                    </li>
                </ul>
            </div>
        </div>
        
    </section>
    <section id="shop" style="padding-top: 100px;">
        <div class="container">
            <div class="col12">
                <p align="center" style="font-weight: 700; font-size: 5vw; text-align: middle; letter-spacing: 10px;">YEAR ROUND</p><br>
                	<hr width="25%" style="text-align:center;margin-left: auto; margin-right:auto">
                	<p align="center" style="font-size: 20px; letter-spacing: 7px;"><br>Must Have Items<br><br><br><br></p>
            </div>
            <div class="bg">
                <img src="img/app.jpg" height="100%" alt="">
                <a href="apparels.php">
                    <div class="overlay">
                        <div class="item">
                            Apparels
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg">
                <img src="img/acc.jpg" height="100%" alt="">
                <a href="accessories.php">
                    <div class="overlay">
                        <div class="item">
                            Accesories
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg">
                <img src="img/grap.jpg" height="100%" alt="">
                <a href="#">
                    <div class="overlay">
                        <div class="item">
                            Graphic Tee
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg">
                <img src="img/hood.jpg" height="100%" alt="">
                <a href="#">
                    <div class="overlay">
                        <div class="item">
                            Hoodies
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <p align="center" style="font-weight: 700; font-size: 5vw; text-align: middle; ">About Us</p><br><hr width="25%" style="text-align:center;margin-left: auto; margin-right:auto"><br><br><br><br>
            <div class="col6">
                <img src="img/about.jpg" width="100%" alt="" style="float: left; padding: 10px;">
            </div>
            <div class="col6">
                <p style=" text-align: justify; font-size: 20px ">N T U B A E was initially a small project where a group of passionate and driven individuals decided to create a local campus store that sells Nanyang Technological University's (NTU) merchandises.<br><br>
				Due to popular demand, the online website was created to increase accessibility and convenience of purchasing anywhere, anytime.<br>
				N T U B A E aims to enhance NTU's image and promote the NTU brand in Singapore.<br>
                </p>
            </div>

        </div>
    </section>
    <footer style="padding-top: 100px">
        <div class="footer" style="background-color: #083A81; width: 100%;">
            <div class="col4" style="color: #fff; padding: 20px; text-align: center;">STAY CONNECTED<br><br>
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
            <div class="col4" style="color: #fff; padding: 20px; text-align: center;">BE OUR FRIEND<br><br>
                <input type="text" placeholder="Email Address" class="emailaddress"><br><br>
                <button type="button" class="button">Subscribe Now</button>
            </div>
            <div class="col4" style="color: #fff; padding: 20px; text-align: center;">NEED ASSISTANCE ?<br><br>6786-4532<br>contactus@ntubae.com</div>
            <div class="col12" style="color: #fff; padding: 20px; text-align: center;">&copy; 2 0 1 7 N T U B A E. Proudly created by Chanel & Joshua</div>
            <div style="clear: both"></div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/navbar.js"></script>

</body>

</html>
