<?php
include('connect.php');

if(isset($_GET['item'])){
    $item = $_GET['item'];
    $qly = $_GET['qly']; 
    $sql="UPDATE `stock` SET `qly`='".$qly."' WHERE `item` = '".$item.  "'";
    $result = mysqli_query($con,$sql);
    if($result){
        if($_SESSION["Status"]=="staff"){
        Header("Location: stock.php");
        }
        if($_SESSION["Status"]=="owner"){
            Header("Location: admin_stock.php");
            }
    }
    else{
        echo "<script>";
                        echo "alert(\"อัพเดทไม่สำเร็จ\");"; 
                        echo "window.history.back()";
                    echo "</script>";
    }

}
else{
    echo "<script>";
    echo "alert(\"ข้อมูลไม่เข้า\");"; 
    echo "window.history.back()";
    echo "</script>"; 
}

?>