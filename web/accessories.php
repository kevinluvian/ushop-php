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

        echo "<div id=\"successcart\">\n";
        echo "<span class=\"caption\">Add succesfully to cart</span>";
        echo "</div>\n";
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
        echo "$x";
        $sub = $db->query("UPDATE orderhistory SET des = '$x' WHERE id = 1");
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

<div class="container" style="padding-top: 150px;">
    
    <div class="col12"><p style="font-weight: 700; font-size: 30px;">Accessories<br><br></p></div>
    <div class="col12">
    <div class="col12" style="text-align: right;">Categories 
    <select id="filterinput" oninput="myFunction()">
        <option value="">All</option>
        <option value="cap">Cap</option>
        <option value="mug">Mug</option>
        <option value="gift">Gift</option>
        <option value="umbrella">Umbrella</option>
    </select>
    </div>  
    <ul id="filter">
         
                    <li>
                        <div class="col12">
                        <p style="font-weight: 700; font-size: 20px;">Cap</p>
                        <hr>
                        
                         <?php
    $product_array = $db_handle->runQuery("SELECT * FROM productdetails ORDER BY id ASC");
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value) if($key >=15 && $key <19){
    ?><div class="col3">
            <a href="#store<?php echo $product_array[$key]["id"]; ?>"><img src="<?php echo $product_array[$key]["image"]; ?>" width="100%" style="padding-top: 15px;"></a>
            <div style="text-align: center;"><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
            <div style="text-align: center;"><?php echo "$".$product_array[$key]["price"]; ?></div>
        </div>
                         <?php
            }
    }
    ?>
</div>
                    </li>
                    <li>
                        <div class="col12">
                        <p style="font-weight: 700; font-size: 20px;">Mug</p>
                        <hr>
                        <?php
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value) if($key >=19 && $key <23){
    ?><div class="col3">
            <a href="#store<?php echo $product_array[$key]["id"]; ?>"><img src="<?php echo $product_array[$key]["image"]; ?>" width="100%" style="padding-top: 15px;"></a>
            <div style="text-align: center;"><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
            <div style="text-align: center;"><?php echo "$".$product_array[$key]["price"]; ?></div>
        </div>
                         <?php
            }
    }
    ?>
</div>
                    </li>
                    <li>
                        <div class="col12">
                        <p style="font-weight: 700; font-size: 20px;">Gift</p>
                        <hr>
                        <?php
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value) if($key >=23 && $key <27){
    ?><div class="col3">
            <a href="#store<?php echo $product_array[$key]["id"]; ?>"><img src="<?php echo $product_array[$key]["image"]; ?>" width="100%" style="padding-top: 15px;"></a>
            <div style="text-align: center;"><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
            <div style="text-align: center;"><?php echo "$".$product_array[$key]["price"]; ?></div>
        </div>
                         <?php
            }
    }
    ?>
</div>
                    </li>
                    <li>
                        <div class="col12">
                        <p style="font-weight: 700; font-size: 20px;">Umbrella</p>
                        <hr>
                        <?php
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value) if($key >=27 && $key <31){
    ?><div class="col3">
            <a href="#store<?php echo $product_array[$key]["id"]; ?>"><img src="<?php echo $product_array[$key]["image"]; ?>" width="100%" style="padding-top: 15px;"></a>
            <div style="text-align: center;"><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
            <div style="text-align: center;"><?php echo "$".$product_array[$key]["price"]; ?></div>
        </div>
                         <?php
            }
    }
    ?>
</div>
                    </li>
                </ul>
            </div>
            <?php
            if (!empty($product_array)) { 
                foreach($product_array as $key=>$value) if($key >=15 && $key <31){
            ?>
            <div id="store<?php echo $product_array[$key]["id"]; ?>" class="modalDialog">
                    <div>
                        <form method="post" action="accessories.php?action=add&name=<?php echo $product_array[$key]["name"]; ?>">
                        <a href="#close" title="Close" class="close">X</a>
                        <div class="col6" style="text-align: center;">
                            <img src="<?php echo $product_array[$key]["image"]; ?>" height="99%">
                        </div>
                        <div class="col6">
                            <div class="col12" style="font-size: 20px; padding-top: 90px; padding-bottom: 30px;"><p align="center"><strong><?php echo $product_array[$key]["name"]; ?></strong><br></p></div>
                            <div class="col12" style="font-size: 18px; padding-bottom: 18px;"><p align="center"><strong>$ <?php echo $product_array[$key]["price"]; ?></strong><br></p></div>
                            <div class="col12" style="font-size: 15px; padding-bottom: 40px;"><small><p align="center">(stocks available :
                                <?php 
                                $itemid = $product_array[$key]["id"]; 
                                $sql = $db -> query("SELECT stock FROM productdetails WHERE id = '$itemid'");
                                if($sql->num_rows>0)
                                {
                                    $row = $sql-> fetch_assoc();
                                }
                                echo $row['stock'];
                                ?>)
                                <br></p></small>
                            </div>
                            <div class="col12" style="font-size: 18px; padding-bottom: 35px; text-align: center;"><strong>Qty  <input type="text" name="quantity" value="1" size="2" /></strong></div>
                            <div class="col12" style="text-align: center;"><button type="submit" class="buttonblack"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add to cart</button></form></div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                                 <?php
                    }
            }
            ?>

            <div style="clear: both;">
            </div>
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
</BODY>
</HTML>