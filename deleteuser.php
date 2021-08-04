
<?php
    include('connect.php');
    $sql="DELETE FROM `member` WHERE `id_user`=".$_GET['ID'].";";
    
    if (mysqli_query($con, $sql)) {
        Header("Location: admin_employee.php");


      } else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>