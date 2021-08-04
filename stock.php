<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <?php 
    include('connect.php');
    ?>
    <script>
        
    </script>
</head>
<body>  
    <div class="container-fluid">
        <div class='row'>
            <div class='col-2'>
            <center><img src="https://www.allaboutfin.com/image/noProfile.jpg" style="width:50%;border-radius: 180px;"></img>
                <h1><?php echo($_SESSION['username']); ?></h1></center>
                    <a href="staff1.php" class='list-group-item list-group-item-action'>หน้าร้าน</a>
                    <a href="history.php" class='list-group-item list-group-item-action'>ประวัติการขาย</a>
                    <a href="stock.php" class='list-group-item list-group-item-action active' >สต็อกสินค้า</a>
                    <a href="employee.php" class='list-group-item list-group-item-action '>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>
            </div>            
                   
            <div class='col'>
                
            <p>รายการสต็อกสินค้า</p>
                <table class='table table-striped' style='width :16.66666667%;'>
                    <tr><th>รายการ</th><th>จำนวน</th><th>ประเภท</th><th>update</th></tr>
                <?php
                    $sql="SELECT * FROM `stock`";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<form method='GET' action='updatestock.php')");
                        echo("<tr><td><input type='text'value='".$row['item']."' name='item' id='item' readonly></td><td ><input type='number' name='qly' id='qly' min='0'value='".$row['qly']."'></td><td>".$row['type']."</td><td><input type='submit' class='btn btn-outline-secondary' value='อัพเดท'></td></tr>");
                        echo("</form>");
                    }
                ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>