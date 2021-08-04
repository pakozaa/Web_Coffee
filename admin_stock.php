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
                    <a href="admin.php" class='list-group-item list-group-item-action'>หน้าร้าน</a>
                    <a href="admin_history.php" class='list-group-item list-group-item-action'>ประวัติการขาย</a>
                    <a href="admin_stock.php" class='list-group-item list-group-item-action active' >สต็อกสินค้า</a>
                    <a href="admin_employee.php" class='list-group-item list-group-item-action '>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>
            </div>            
                   
            <div class='col'>
            <center>
            <p>รายการสต็อกสินค้า</p>
                <table class='table table-striped' style='width :80%;'>
                    <tr><th>รายการ</th><th>จำนวน</th><th>ประเภท</th><th>update</th><th>delete</th></tr>
                <?php
                    $sql="SELECT * FROM `stock` ORDER BY `item` ASC";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<form method='GET' action='updatestock.php')");
                        echo("<tr><td><input readonly class='form-control-plaintext' type='text'value='".$row['item']."' name='item' id='item' ></td><td ><input class='form-control' type='number' name='qly' id='qly' min='0'value='".$row['qly']."'></td><td>".$row['type']."</td><td><input type='submit' class='btn btn-outline-secondary' value='อัพเดท'></td><td><a href='deletestock.php?ID=".$row['id_stock']."' class='btn btn-danger' onclick='return confirm('ต้องการลบสต็อก ?')'>ลบ</a></td></tr>");
                        echo("</form>");
                        
                    }
                ?>
                </table>
                </center>
            </div>
            <div class='col'>
                <h1>เพิ่มข้อมูลสต็อก</h1>
                <form action='addstock.php' method='GET'>
                    <label>รายการ:</label></br>
                    <input type='text' placeholder="ชื่อรายการ" name='item' class="form-control"></br>
                    <label>จำนวน:</label></br>
                    <input type='number' placeholder="จำนวน"  name='qly'class="form-control"></br>
                    <label>ประเภท:</label></br>
                    <input type='text' placeholder='ถุง กระป๋อง etc' name='type' class="form-control">
                </br>
                    <input type='submit' value='เพิ่มข้อมูล'  style='float:right;' class='btn btn-success'  >
                </form>
                </br>
                </br>
                <hr>
                <h1>เพิ่มรายการสินค้าสำหรับขาย</h1>
                <form action='addmenu.php' method='GET'>
                    
                    <label>รูปภาพ:</label></br>
                    <input type='text' placeholder="url รูปภาพ" name='url'class="form-control"></br>
                    <label>ชื่อสินค้า:</label></br>
                    <input type='text' placeholder="ชื่อสินค้า" name='item' class="form-control"></br>
                    <div class='row'>
                    <div class='col'>
                                                
                        <input type="hidden" name="hot" value="0" />
                        <input type="checkbox" name="hot" value="1"  class="form-check-input"/>
                        <label>ร้อน</label>
                        <label>ราคา</label>
                        <input type='number' placeholder='ราคาสินค้า'name='hot_price' class="form-control" value='0'>
                    </div>
                    <div class='col'>               
                        <input type="hidden" name="ice" value="0" />
                        <input type="checkbox" name="ice" value="1"  class="form-check-input"/>
                        <label>เย็น</label>
                        <label>ราคา</label>
                        <input type='number' placeholder='ราคาสินค้า' name='ice_price'class="form-control"  value='0'>
                    </div>
                    <div class='col'>
                                       
                        <input type="hidden" name="frappe" value="0" />
                        <input type="checkbox" name="frappe" value="1"  class="form-check-input"/>
                        <label>ปั่น</label>
                        <label>ราคา</label>
                        <input type='number' placeholder='ราคาสินค้า' name='frappe_price'class="form-control"  value='0'>
                    </div>
                    </div>
                    
                    
                </br>
                    <input type='submit'   style='float:right;' value='เพิ่มสินค้า' class='btn btn-success'>
                </form>
                </br>
                </br>
                <hr>
                <h1>ลบรายการสินค้าสำหรับขาย</h1>
                <form action='deletemenu.php' action='GET'>
                    
         
                <select name='item' class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                    
                <option selected>Choose...</option>
                <?php 
                
                $sql="SELECT item_name FROM `menu`";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {

                        echo(" <option value='".$row['item_name']."'>".$row['item_name']."</option>");
                    }?>
                </select>
                </br>
                    <input type='submit' value='ลบสินค้า' style='float:right;' class='btn btn-danger' onclick='return confirm("ต้องการลบสินค้า ?")'>   
                </form>
            <div>
        </div>
    </div>
</body>
</html>