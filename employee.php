<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        
    <?php 
    include('connect.php');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <center><img src="https://www.allaboutfin.com/image/noProfile.jpg" style="width:50%;border-radius: 180px;"></img>
                <h1><?php echo($_SESSION['username']); ?></h1></center>
                <div class='list-group'>
     
                    <a href="staff1.php" class='list-group-item list-group-item-action'>หน้าร้าน</a>
                    <a href="history.php" class='list-group-item list-group-item-action'>ประวัติการขาย</a>
                    <a href="stock.php" class='list-group-item list-group-item-action'>สต็อกสินค้า</a>
                    <a href="employee.php" class='list-group-item list-group-item-action active'>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>

                </div>
        </div>
        
        <div class='col'>
        <p>รายชื่อพนักงาน</p>
        <?php
         $sql="SELECT * FROM `member` WHERE `status`='staff'";
         $result = mysqli_query($con,$sql);
         echo("<table class='table table-striped'>");
         echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>USER_ID</th><th style='width:10%;'>Position</th><th>Contect</th><th style='width:10%;'>sales</th></tr>");
         while ($row = mysqli_fetch_array($result)) {
            echo("<tr style='vertical-align: top; border-bottom: 1px solid #ddd;'>");            
            echo("<td >".$row['username']."</td>");
            echo("<td>".$row['status']."</td>");
            echo("<td>".$row['contect']."</td>");
            $sql1="SELECT SUM(`total`) FROM `history` WHERE `staff`='".$row['username']."'";
            $result1=mysqli_query($con,$sql1);
            $row1 = mysqli_fetch_assoc($result1); 
            $sum = $row1['SUM(`total`)'];

            echo("<td>".$sum."</td>");
            echo("</tr>");                        
         }
         echo("</table>");
        ?>
        </div>
        <div class='col'>
        <p>รายชื่อผู้จัดการ</p>
        <?php
         $sql="SELECT * FROM `member` WHERE `status`='owner'";
         $result = mysqli_query($con,$sql);
         echo("<table  class='table table-striped'>");
         echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>USER_ID</th><th style='width:10%;'>Position</th><th>Contect</th><th style='width:10%;'>sales</th></tr>");
         while ($row = mysqli_fetch_array($result)) {
            echo("<tr style='vertical-align: top; border-bottom: 1px solid #ddd;'>");            
            echo("<td >".$row['username']."</td>");
            echo("<td>".$row['status']."</td>");
            echo("<td>".$row['contect']."</td>");
            $sql1="SELECT SUM(`total`) FROM `history` WHERE `staff`='".$row['username']."'";
            $result1=mysqli_query($con,$sql1);
            $row1 = mysqli_fetch_assoc($result1); 
            $sum = $row1['SUM(`total`)'];

            echo("<td>".$sum."</td>");
            echo("</tr>");                        
         }
         echo("</table>");
        ?>
        </div>
        
    </div>    
    <div class='row'>
        <div class='col'>
                <center><p>Copyright 2021 by Pakodev</p></center>
        </div>
    </div>
</div>
</body>
</html>
