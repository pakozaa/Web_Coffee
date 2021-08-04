<?php
include('connect.php');
if (isset($_GET['item'])) {
    $item=$_GET['item'];
    $qly=$_GET['qly'];
    
    $type=$_GET['type'];
    $sql="INSERT INTO `stock` (`id_stock`,`item`,`qly`,`type`) VALUES (NULL, '".$item."', '".$qly."','".$type."');";
    
    if (mysqli_query($con, $sql)) {
        
        $sql="DELETE FROM `order`";
        if (mysqli_query($con, $sql)) {
          if($_SESSION["Status"]=="owner"){
            Header("Location: admin_stock.php");
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