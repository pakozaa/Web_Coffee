<?php
    include('connect.php');
    $sql="DELETE FROM `order`";
    
    if (mysqli_query($con, $sql)) {
      if($_SESSION["Status"]=="staff"){
        Header("Location: staff1.php");
      }
      if($_SESSION["Status"]=="owner"){
        Header("Location: admin.php");
      }
      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>