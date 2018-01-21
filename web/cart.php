<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByName = $db_handle->runQuery("SELECT * FROM productdetails WHERE name='" . $_GET["name"] . "'");
			$itemArray = array($productByName[0]["name"]=>array(
			 'name'=>$productByName[0]["name"],
			 'id'=>$productByName[0]["id"],
			 'quantity'=>$_POST["quantity"], 
			 'price'=>$productByName[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByName[0]["name"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByName[0]["name"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								} 
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["name"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
	case "submit":

		$x = serialize($_SESSION["cart_item"]);
		$z = addslashes($_SESSION['valid_user']);
		$w = $_SESSION['total_price'];
		$namee =$_SESSION["valid_user"];
		$message = "Dear $namee,\r\n\r\n";
		$message .="Thank you for shopping with NTUBAE, we hope you had an enjoyable experience,\r\n";
		$message .="We have attached the order summary of your purchases today\r\n\r\n";
		$message .="Order Summary:\r\n\r\n";
		
		$sub = $db->query("INSERT INTO orderhistory (userid, total, des) VALUES ('$z', '$w', '$x')");	
		foreach($_SESSION["cart_item"] as $k => $v) {
			$name = str_replace(' ','',$_SESSION["cart_item"][$k]["name"]);

			$qty = $_POST[$name];

			$_SESSION["cart_item"][$k]["quantity"] = $qty;
			$quan = $_SESSION["cart_item"][$k]["quantity"];
			$name = $_SESSION["cart_item"][$k]["name"];
			$pricee = $_SESSION["cart_item"][$k]["price"];
			$sub = $quan*$pricee;
			$message .= "Product Purchase: $name, Quantity: $quan @ $ $pricee = $ $sub\r\n";
			}
		foreach ($_SESSION["cart_item"] as $item){
			    	$itemid = $item["id"];

			    	$sql = $db -> query("SELECT stock FROM productdetails WHERE id = '$itemid'");
			    	if($sql->num_rows>0)
			    	{
			    		$row = $sql-> fetch_assoc();
			    	}
			    	$count = $item["quantity"];

			    	$stock = $row["stock"] - $count;

			    	$newsql = $db ->query("UPDATE productdetails SET stock = '$stock' WHERE id = '$itemid'");


		}

		echo "<div class=\"modalDialog\" style=\"opacity: 1; pointer-events: auto;\">\n";
        echo "<div class='cartsum' style='height: 50%;'><a href='index.php' title='Close' class='close'>X</a><br><br><br><br><br><h1 align='center' style='background-color: #4BB543; color: white; padding: 20px;'>Thank you for your purchase</h1><br><br><br>\n
        <h3 align='center'>Your checkout summary will be sent to:</h3><br>\n";
        $name = $_SESSION['valid_user'];

        $sql = $db -> query("SELECT email from customeraccount WHERE name = '$name'");

        if($sql->num_rows >0){
        	$row = $sql -> fetch_assoc();
        }
		$to = "f33ee@localhost";
		$subject ="NTUBAE Order Summary";
		$totall = $_SESSION["total_price"];
		$message .="\r\nTotal Price = $";
		$message .= $totall;
		$message .="\r\n\r\n XOXO,\r\nNTUBAE";
		
		$header = 'From: f33ee@localhost'."\r\n".
		'Reply-To: f33ee@localhost'."\r\n".
		'X-Mailer: PHP/'.phpversion();
		mail($to, $subject, $message, $header, '-f33ee@localhost');
        echo "<h4 align='center'><a href=\"mailto:";
        echo $row['email'];
        echo "\">";
        echo $row['email'];
        echo "</a></h4>";
        echo "<br><br><br><a class='buttonblack' style='width: 40%; text-align: center;' href='accessories.php'>Continue Shopping >></a>";
        echo "\n</div>\n</div>\n";
		unset($_SESSION["cart_item"]);
		unset($_SESSION["total_price"]);
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
		<div class="col12">
			<p style="font-weight: 700; font-size: 30px;">Checkout Summary<br><br></p>
			<?php
			if(isset($_SESSION["cart_item"])){
			    $item_total = 0;
			?>	
			<table cellpadding="10" cellspacing="1">
			<tbody>
			<tr>
				<th style="text-align:left; font-size: 20px;"><strong>Product</strong></th>
				<th style="text-align:right; font-size: 20px;"><strong>Quantity</strong></th>
				<th style="text-align:right; font-size: 20px;"><strong>Price</strong></th>
				<th style="text-align:center; font-size: 20px;"><strong>Action</strong></th>
			</tr>	
			<form action="cart.php?action=submit" method="POST">
			<?php		
			    foreach ($_SESSION["cart_item"] as $item){
					?>
							<tr>
							<td style="text-align:left;border-bottom:#F0F0F0 1px solid;">
								<img src="<?php 
									$itemid = $item["id"];
									$sql = $db -> query ("SELECT image FROM productdetails WHERE id = '$itemid'");
									if($sql-> num_rows >0)
									{
										$row = $sql -> fetch_assoc();
									}

									echo $row["image"];
								?>" width="200px" style="vertical-align: middle;padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
								<strong><span style="font-size: 20px;"><?php echo $item["name"]; ?></span></strong></td>
							<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><input type="text" size="2" name="<?php $itm = str_replace(' ','',$item['name']); echo $itm?>" value="<?php echo $item['quantity']?>"></td>
							<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
							<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="cart.php?action=remove&name=<?php echo $item["name"]; ?>" class="btnRemoveAction"><i class="fa fa-times" aria-hidden="true"></i></a></td>
							</tr>
							<?php
					        $item_total += ($item["price"]*$item["quantity"]);
					        $_SESSION['total_price'] = $item_total;
							}
							?>
							<tr>
								<td colspan="2" align="right"  height="60px"><h2>Total:</h2></td>
								<td align="right"  height="60px"><h2><?php echo "$ ".$item_total; ?></h2></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="4"><a class="buttonblack" style="width: 30%; float: left;" href="accessories.php"><< Continue Shopping</a><input type="submit" value="Proceed to Checkout" style="width: 30%; float: right;"></td>
							</tr>

			
		</form>
			</tbody>
			</table>		
					  <?php
					}
					?>
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
