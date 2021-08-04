<?php
include("connect.php");
if(isset($_POST['Username'])){
$username = $_POST['Username'];
$password = $_POST['Password']; 

$_SESSION['username']= $username;
$sql="SELECT * FROM member 
WHERE  username='".$username."' 
AND  password='".$password."' ";
$result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        $_SESSION["ID"] = $row["id_user"];
        $_SESSION["Status"] = $row["status"];
        if($_SESSION["Status"]=="staff"){
            Header("Location: staff1.php");
            }
 
        if ($_SESSION["Status"]=="owner"){
            Header("Location: admin.php");
            }
 
    }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
 
}else{
 
 
             Header("Location: index.php");
        }
?>