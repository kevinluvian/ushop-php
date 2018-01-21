<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require_once("dbcontroller.php");
    $db_handle = new DBController();
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
                <a class="page-scroll" href="index.php#about">About Us</a>
                <a class="page-scroll" href="index.php#index">Home</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a> 
            </div>
        </nav>

    <div class="container" style="text-align: center; padding-top: 70px;">
        Personal Details<br>
        <?php
            $name = addslashes($_SESSION['valid_user']);
            $sql = $db -> query("SELECT * FROM customeraccount WHERE name = '$name' ");
            if($sql -> num_rows > 0)
            {
                $row = $sql -> fetch_assoc();
            }
        ?>
        <table border="0">
            <tr>
                <td colspan="2">Account</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <?php echo $row['email'] ?>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>***</td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2">Address</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $row['name'] ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $row['email'] ?></td>
            </tr>
            <tr>
                <td>Telephone:</td>
                <td><?php echo $row['telephone'] ?></td>
            </tr>
        </table>
    </div>
    <footer>
    	<div style="background-color: #083A81; width: 100%;">
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
