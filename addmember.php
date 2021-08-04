<?php
include('connect.php');
if (isset($_GET['username'])) {
    $username=$_GET['username'];
    $password=$_GET['password'];
    $Contect1=$_GET['Contect1'];
    $sex=$_GET['sex'];
    $status=$_GET['status'];
    $Contect2=$_GET['Contect2'];
    $sql=("INSERT INTO `member` (`id_user`, `username`, `password`, `contect`, `status`) VALUES (NULL, '".$username."', '".$password."', '".$Contect1."</br>".$sex."</br>".$Contect2."', '".$status."');");
    if (mysqli_query($con, $sql)) {
            if($_SESSION["Status"]=="owner"){
            Header("Location: admin_employee.php");
            }
          }
      else {
        echo ("Error: " . $sql . "<br>" . mysqli_error($con));
      }
    }
else {
    echo("None");
}