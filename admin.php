<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php     include('connect.php');    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
            <center><img src="https://www.allaboutfin.com/image/noProfile.jpg" style="width:50%;border-radius: 180px;"></img>
                <h1><?php echo($_SESSION['Status']); ?></h1></center>
                <div class='list-group'>
     
                    <a href="admin.php" class='list-group-item list-group-item-action active'>หน้าร้าน</a>
                    <a href="admin_history.php" class='list-group-item list-group-item-action'>ประวัติการขาย</a>
                    <a href="admin_stock.php" class='list-group-item list-group-item-action'>สต็อกสินค้า</a>
                    <a href="admin_employee.php" class='list-group-item list-group-item-action'>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>

                </div>
            </div>
            <div class='col'>
                
            <?php
                    $sql="SELECT * FROM `menu`";
                    $result = mysqli_query($con,$sql);
                    $hot="ร้อน";
                    $ice="เย็น";
                    $frappe="ปั่น";
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<div style='width:25%;border-style: ridge;  border-radius: 10px; display: inline-block;'>");
                        echo("<center>");
                        echo("
                        <p>".$row['item_name']."</p>
                                <div>
                                    <img src=".$row['item_img']." style='width:60%; height: 19  0px;  border-radius: 10px; ' >
                                    
                                </div>
                                </br>   
                            ");
                        echo("<div stylt='float:left;'>");
                        if($row['item_type_hot']==1){
                            
                            echo("<a href='pushOrder.php?ID=".$row['id_item']."&name=".$row['item_name']."&price=".$row['item_price_hot']."&type=".$hot."' class='btn btn-outline-secondary'>ร้อน ".$row['item_price_hot'].".-</a>");
                            
                        }
                        
                        if($row['item_type_ice']==1){
                            
                            echo("<a href='pushOrder.php?ID=".$row['id_item']."&name=".$row['item_name']."&price=".$row['item_price_ice']."&type=".$ice."' class='btn btn-outline-secondary'>เย็น ".$row['item_price_ice'].".-</a>");                    
                        
                        }
                        
                        if($row['item_type_frappe']==1){
                            
                            echo("<a href='pushOrder.php?ID=".$row['id_item']."&name=".$row['item_name']."&price=".$row['item_price_frappe']."&type=".$frappe."' class='btn btn-outline-secondary'>ปั่น ".$row['item_price_frappe'].".-</a>");
                            
                        
                        }
                        
                        echo("</div>");
                        echo("</br>");
                        echo("</center>");
                        echo("</div>");
                    }
                ?>  
            </div>
            <div class='col-2'>
                <div class='row'>
                    <div style="height:85vh;">
                                              
                        <table style="width:100%;" class='table table-striped' >
                        <tr  align='center' >
                            <th>รายการ</th>
                            <th>ชื่อ</th>
                            <th>ประเภท</th>
                            <th>ราคา</th>
                            <th>ยกเลิก</th>  
                        </tr>
                        <?php
                        $sql="SELECT * FROM `order`";
                        $result = mysqli_query($con,$sql);
                        
                        $item="";
                        if(mysqli_num_rows($result)>=1){
                            $i=0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i=$i+1;
                                $id=$row['id_order'];
                                $item .="เมนู  ".$row['item_name'];
                            
                                $item .="&emsp;";
                                $item .=$row['item_type'];
                                $item .="&emsp;";
                                $item .=$row['item_price']." บาท";
                                $item .="</br>";
                                echo("<tr align='center' ><td style=' text-align:center;'>".$i."</td><td>".$row['item_name']."</td><td style=' text-align:center;'>".$row['item_type']."</td><td>".$row['item_price'].".-</td><td>
                                <a href='cancelRowOrder.php?ID=".$id."' class='btn btn-danger'>ยกเลิก</a></td></tr>");
                            }
                        }
                        else{
                            echo("<tr align='center'><td colspan='5' style=' text-align:center;'>ไม่มีรายการสินค้า</td></tr>");
                        }
                        ?>
                        </table>            
                    </div>      
                <div>
                <div class='row'>
                    <div>                    
                        <table style='width:100%;'>
                        <tr><td colspan="3" style=" text-align:center;" >ราคารวม</td><td>
                            <?php 
                            $sql="SELECT SUM(`item_price`) FROM `order`;";
                            $result=mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($result); 
                            $sum = $row['SUM(`item_price`)'];
                            echo($sum)
                        
                        ?>
                        </td><td>บาท</td></tr>
                        <tr ><th colspan="5" ><center>
                            <?php $conftxt="คุณต้องการบันทักออเดอร์ใช่หรือไม่ ?";
                            if($sum != 0){
                            echo("<a href='addorder.php?textlist=".$item."&sum=".$sum."'class='btn btn-success' style='background-color: #04AA6D;'>ยืนยันออเดอร์</a>");
                            }
                            else{
                            echo("<a href='#?textlist=".$item."&sum=".$sum."'class='btn btn-success' style='background-color: #04AA6D;'>ยืนยันออเดอร์</a>");    
                            }
                        ?>
                        <a href="deleteAllOrder.php" class='btn btn-danger' onclick='return confirm("ต้องการยกเลิกออเดอร์ทั้งหมด ?")'>ยกเลิกออเดอร์</a></center></th></tr>
                        </table>
                    </div>      
                </div>
            </div>      
        </div>
        <div class='row'>
            <div class='footer'>
                
            </div>
        </div>
    </div>  
    
</body>
</html>