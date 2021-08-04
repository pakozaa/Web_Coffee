
<?php
    include('connect.php');
    $item=$_GET['item'];
    $sql="DELETE FROM `menu` WHERE `item_name`='".$_GET['item']."'";
    
    if (mysqli_query($con, $sql)) {
      if($_SESSION["Status"]=="staff"){
        Header("Location: history.php");
      }
      if($_SESSION["Status"]=="owner"){
        
        Header("Location: admin_stock.php");

      }

      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>