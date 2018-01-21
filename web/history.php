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
<html>
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
    
	<div class="container" style="padding-top: 200px; padding-bottom: 200px;">
		<div class="col12" style="padding-bottom: 200px;">
			<?php
			if(isset($_SESSION["cart_item"])){
			$item_total = 0;}
			?>	
			<table cellpadding="10" cellspacing="1">
			<tbody>
			<tr>
				<th style="text-align:left;"><strong>Order ID</strong></th>
				<th style="text-align:left;"><strong>Product Purchased</strong></th>
				<th style="text-align:center;"><strong>Price</strong></th>
				<th style="text-align:center;"><strong>Date</strong></th>
			</tr>
			<?php

									$sql = $db -> query ("SELECT * FROM orderhistory WHERE id = '$i'");
									while($sql-> num_rows >0)
									{
										$row = $sql -> fetch_assoc();
					?>
					<form action="update.php?id=<?php echo $row['id']?>" method="POST">
							<tr>

							
							<td style="text-align:left;border-bottom:#F0F0F0 1px solid; padding-bottom: 20px; padding-top: 20px;">
								<img src="<?php echo $row["image"];?>" width="150px" style="vertical-align: middle;">
								<strong><span><?php echo $row["name"]; ?></span></strong></td>
							<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><input type="text" size="2" name="proprice" value="<?php echo $row['price']?>"></td>
							<td style="border-bottom:#F0F0F0 1px solid;"><input type="submit" value="Update" style="margin-left: 30%;"></td>
							</tr>
							</form>
							<?php } ?>
			</tbody>
			</table>
				</div>
				<div style="clear: both;"></div>
	</div>


    <footer style="padding-top: 200px">
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
    <script src="js/filter.js"></script>
</body>
</html>
