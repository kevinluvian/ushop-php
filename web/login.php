<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include "dbcontroller.php";

    if(!empty($_GET["action"])){
        switch($_GET["action"]){
            case "login":
            if(isset($_POST['loginemail']) && isset($_POST['loginpassword']))
            {
                $useremail = $_POST['loginemail'];
                $password = $_POST['loginpassword'];

                $password = md5($password);

                $result = $db -> query("SELECT * FROM customeraccount WHERE email = '$useremail' and password='$password'");

                if($result->num_rows >0)
                {
                    $row = $result -> fetch_assoc();
                    $_SESSION['valid_user'] = $row['name'];
                    $_SESSION['condition'] = "valid";
                    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
                }else{
                	echo "<div id=\"successcart\" style=\"background-color: #c21807\">\n";
					echo "<span class=\"caption\">Invalid Username/Password</span>";
					echo "</div>\n";
                }
            }
            break;
            case "register":
            $name = $_POST['regname'];
            $email = $_POST['regemail'];
            $password = $_POST['regpassword'];
            $password2 = $_POST['regconpassword'];
            $telephone = $_POST['regtelephone'];

            if(!get_magic_quotes_gpc())
            {
                $name = addslashes($name);
                $email = addslashes($email);
                $password = addslashes($password);
                $telephone = addslashes($telephone);

            }

            if ($password != $password2) {
            echo "Sorry passwords do not match";
            exit;
            }

            $password = md5($password);
            $result = $db -> query("INSERT INTO customeraccount (name, email, password, telephone) VALUES ('$name','$email','$password','$telephone')");

            $_SESSION['valid_user']= stripcslashes($name);

            if(!$result)
               echo " wrong";
            else
                    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

            break;

            case "empty":
            unset($_SESSION['valid_user']);
            unset($_SESSION['total_price']);
            unset($_SESSION['cart_item']);
            break;


        }
    }
       
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
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
                    <button class="dropbtn">Shop  <i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="accessories.php">Accessories</a>
                        <a href="apparels.php">Apparels</a>
                    </div>
                </div>
                <a class="page-scroll" href="index.php#about">About Us</a>
                <a class="page-scroll" href="index.php#index">Home</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a> 
            </div>
        </nav>

    <section id="book">
        <div class="container" style="padding-bottom: 100px; padding-top: 50px;">
            <div class="col12">
            </div>
            <div>
                <div class="row">
                    <div class="col6" style="border-right: 0.5px; border-right-color: black; border-right-style: solid; line-height: 200%; height: 500px; padding:20px;">
                        <div class="col4"></div>
                        <div class="col8"><p align="center" style="font-weight: 700; font-size: 30px; text-align: middle; ">Login</p><br><br><br></div>
                        <form action="login.php?action=login" method="POST">
                        <div class="col4"></div>
                        <div class="col8"> Email *</div>
                        <div class="col4"></div>
                        <div class="col8"><input type="email" required class="form-input" name="loginemail"></div>
                        <div class="col4"></div>
                        <div class="col8">Password *</div>
                        <div class="col4"></div>
                        <div class="col8"><input type="password" required class="form-input" name="loginpassword"></div>

                        <div class="col4"></div>
                        <div class="col8" style="padding-top: 20px">
                            <input type=submit name="submit" value="Submit"  onclick="myalert()">
                            <input type=reset name="reset" value="Reset" style="margin-left: 30px">
                        </div>
                    </form>
                    </div>
                    <div class="col6" style="line-height: 150%;  padding:20px;">
                        <div class="col8"><p align="center" style="font-weight: 700; font-size: 30px; text-align: middle; ">Sign Up</p></div>
                        <div class="col4"></div>
                        <br>
                        <form action="login.php?action=register" method="POST">
                        <div class="col12">Name *</div>
                        <div class="col8"><input type="text" required class="form-input" name="regname" id="regname" onblur="chkName()"></div>
                        <div class="col4"><span id="notif1"></span><span><i class="" aria-hidden="true" id="sname"></i></span></div>
                        <div class="col12">Email *</div>
                        <div class="col8"><input type="email" required class="form-input" name="regemail" id="regemail" onblur="chkEmail()"></div>
                        <div class="col4"><span id="notif2"></span><span><i class="" aria-hidden="true" id="semail"></i></span></div>
                        <div class="col12">Password *</div>
                        <div class="col8"><input type="password" required class="form-input" name="regpassword" id="regpassword" onblur="chkPass()"></div>
                        <div class="col4"><span id="notif3"></span><span><i class="" aria-hidden="true" id="spassword"></i></span></div>
                        <div class="col12">Confirm Password *</div>
                        <div class="col8"><input type="password" required class="form-input" name="regconpassword" id="regconpassword" onblur="chkSame()"></div>
                        <div class="col4"><span id="notif4"></span><span><i class="" aria-hidden="true" id="spassword2"></i></span></div>
                        <div class="col12">Telephone *</div>
                        <div class="col8"><input type="text" required class="form-input" name="regtelephone" id="regtelephone" onblur="chkTelp()"></div>
                        <div class="col4"><span id="notif5"></span><span><i class="" aria-hidden="true" id="stelephone"></i></span></div>

                        <div class="col8" style="padding-top: 20px">
                            <input type="submit" name="submit" value="Submit" onclick="myregister()">
                            <input type=reset name="reset" value="Reset" style="margin-left: 30px;">
                        </div>
                        <div class="col4">
                        </div>
                    </form>
                        
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div style="clear: both;"></div>
    </section>

    
    <footer>
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
    <script src="js/validation.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/filter.js"></script>


</body>

</html>
