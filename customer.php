<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        
    <link rel="stylesheet" href="layout2.css">
    <?php 
    include('connect.php');
    ?>
    <script>
        
    </script>
</head>
<body style="background-color: #f1f1f1;">
    <div class="container">
        <div class="left">
            <center><img src="https://www.allaboutfin.com/image/noProfile.jpg" style="width:100%;border-radius: 180px;"></img></center>
            <h1><?php echo($_SESSION['username']); ?></h1>
            <ul>
            <li><a href="staff.php">หน้าร้าน</a></li>
            <li><a href="history.php">ประวัติการขาย</a></li>
            <li><a href="stock.php">สต็อกสินค้า</a></li>
            <li><a href="customer.php">สมาชิค</a></li>
            <li><a href="employee.php">พนักงาน</a></li>
            <li><a href="#">ออกจากระบบ</a></li>
            </ul>
        </div>
        <div class="header"></div>
        <div class="main">
            <?php
            $sql="SELECT * FROM `member` WHERE `status`='customer'";
            $result = mysqli_query($con,$sql);
            echo("<table style=''>");
            echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>USER_ID</th><th style='width:20%;'>Position</th><th>Contect</th></tr>");
            while ($row = mysqli_fetch_array($result)) {
                echo("<tr style='vertical-align: top; border-bottom: 1px solid #ddd;'>");            
                echo("<td >".$row['username']."</td>");
                echo("<td>".$row['status']."</td>");
                echo("<td>".$row['contect']."</td>");
                echo("</tr>");                        
            }
            echo("<table>");
            ?>
        </div>
        <div class="right">
        </div>
        <div class="footer"></div>
    </div>
</body>
</html>