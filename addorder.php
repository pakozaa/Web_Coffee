<?php
include('connect.php');
if (isset($_GET['textlist'])) {
    $textlist=$_GET['textlist'];
    $sum=$_GET['sum'];
    $date= date("Y-m-d h:i:sa");
    $sql="INSERT INTO `history` (`id_order_history`, `list`, `total`, `staff`,`datetime`) VALUES (NULL, '".$textlist."', '".$sum."', '".$_SESSION['username']."','".$date."');";
    
    if (mysqli_query($con, $sql)) {
        
        $sql="DELETE FROM `order`";
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
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
      
} else {
    echo("None");
}