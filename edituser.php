
<?php
    include('connect.php');
    
    $sql="UPDATE `member` SET `username`='".$_GET['username']."',`password`='".$_GET['password']."',`contect`='".$_GET['contect']."',`status`='".$_GET['status']."' WHERE `id_user`=".$_GET['id'].";";
    
    if (mysqli_query($con, $sql)) {
        Header("Location: admin_employee.php");
      } else {  
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    
?>