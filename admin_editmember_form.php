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
     
                <a href="admin.php" class='list-group-item list-group-item-action'>หน้าร้าน</a>
                    <a href="admin_history.php" class='list-group-item list-group-item-action'>ประวัติการขาย</a>
                    <a href="admin_stock.php" class='list-group-item list-group-item-action ' >สต็อกสินค้า</a>
                    <a href="admin_employee.php" class='list-group-item list-group-item-action active'>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>

                </div>
        </div>
        <div class='col'>
            <?php  
                $sql="SELECT * FROM `member` WHERE `id_user`=".$_GET['ID']."";
                $result = mysqli_query($con,$sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo(" <form action='edituser.php' method='GET'>");
                    echo("<label> username : </label></br>");
                    echo("<input readonly class='form-control-plaintext' type='hidden'value='".$row['id_user']."' name='id'>");
                    echo("<input type='text' placeholder='username' name='username' value='".$row['username']."'class='form-control'></br>");
                    echo("<label> password : </label></br>");
                    echo("<input type='text' placeholder='username' name='password' value='".$row['password']."'class='form-control'></br>");
                    echo("<label> username : </label></br>");
                    echo("<input type='text' placeholder='username' name='contect' value='".$row['contect']."'class='form-control'></br>");
                    echo("<label> username : </label></br>");
                    echo("<input type='text' placeholder='username' name='status' value='".$row['status']."'class='form-control'></br>");
                    echo("<button style='float:left;' type='submit'   class='btn btn-warning value='Submit'>Submit</button>");
                    echo("<a   style='float:right;' href='admin_employee.php' class='btn btn-danger')'>Cancel</a>");
                    echo("</form>");

                }
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
