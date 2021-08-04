
<?php
    include('connect.php');
    $sql="DELETE FROM `stock` WHERE `id_stock`=".$_GET['ID'].";";
    
    if (mysqli_query($con, $sql)) {
        Header("Location: admin_stock.php");


      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>