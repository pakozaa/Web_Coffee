
<?php
    include('connect.php');
    $sql="DELETE FROM `history` WHERE `id_order_history`=".$_GET['ID'].";";
    
    if (mysqli_query($con, $sql)) {
      if($_SESSION["Status"]=="staff"){
        Header("Location: history.php");
      }
      if($_SESSION["Status"]=="owner"){
        
        Header("Location: admin_history.php");

      }

      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>