<?php
include('connect.php');
if (isset($_GET['item'])) {
    $item=$_GET['item'];
    $url=$_GET['url'];
    $hot=$_GET['hot'];
    $hot_price=$_GET['hot_price'];
    $ice=$_GET['ice'];
    $ice_price=$_GET['ice_price'];
    $frappe=$_GET['frappe'];
    $frappe_price=$_GET['frappe_price'];
    
    $type=$_GET['type'];
    $sql="INSERT INTO `menu` (`id_item`, `item_img`, `item_name`, `item_type_hot`, `item_type_ice`, `item_type_frappe`, `item_price_hot`, `item_price_ice`, `item_price_frappe`) VALUES (NULL, '".$url."', '".$item."', '".$hot."', '".$ice."', '".$frappe."', '".$hot_price."', '".$ice_price."', '".$frappe_price."');";
    
    if (mysqli_query($con, $sql)) {
        
        $sql="DELETE FROM `order`";
        if (mysqli_query($con, $sql)) {
          if($_SESSION["Status"]=="owner"){
            Header("Location: admin.php");
            }
          } else {
            echo ("Error: " . $sql . "<br>" . mysqli_error($con));
        }
      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
      
} else {
    echo("None");
}