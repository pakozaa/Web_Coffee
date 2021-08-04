<?php
include('connect.php');
if (isset($_GET['name'])) {
    $name=$_GET['name'];
    $type=$_GET['type'];
    $price=$_GET['price'];
    $sql="INSERT INTO `order` (`id_order`, `item_name`, `item_type`, `item_price`) VALUES (NULL, '".$name."', '".$type."', '".$price."');";
    
    if (mysqli_query($con, $sql)) {
        if($_SESSION["Status"]=="owner"){
        Header("Location: admin.php");
        }
        if($_SESSION["Status"]=="staff"){
            
        Header("Location: staff1.php");
        }

      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
      
} else {
    echo("None");
}