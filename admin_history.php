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
    <div class="row">
        <div class="col-2">
            <center><img src="https://www.allaboutfin.com/image/noProfile.jpg" style="width:50%;border-radius: 180px;"></img>
                <h1><?php echo($_SESSION['username']); ?></h1></center>
                <div class='list-group'>
     
                <a href="admin.php" class='list-group-item list-group-item-action '>หน้าร้าน</a>
                    <a href="admin_history.php" class='list-group-item list-group-item-action active'>ประวัติการขาย</a>
                    <a href="admin_stock.php" class='list-group-item list-group-item-action'>สต็อกสินค้า</a>
                    <a href="admin_employee.php" class='list-group-item list-group-item-action'>พนักงาน</a>
                    <a href="logout.php" class='list-group-item list-group-item-action'>ออกจากระบบ</a>

                </div>
        </div>
        
        <div class='col'>
        <p>ประวัติการขาย <?php 
        $datestart=date("Y-m-d");
        
        $dateend=date("Y-m-d 23:59:59");
        echo($datestart);?></p>
            <?php
            //SELECT * FROM `history` WHERE `datetime`> timestamp("2021-08-01 00:00:00") AND`datetime`< timestamp ("2021-08-01 23:59:59");
            //SELECT MONTH(`datetime`) AS Month, SUM(`total`) FROM history WHERE YEAR(`datetime`)='2021' GROUP BY MONTH(`datetime`);
            //$sql="SELECT * FROM `history` WHERE DATE(`datetime`)='".$datestart."'";
            //$sql="SELECT * FROM `history` ORDER BY `history`.`datetime` DESC";
            //$result = mysqli_query($con,$sql);
            $query=mysqli_query($con,"SELECT COUNT(id_order_history) FROM `history`");
            $row = mysqli_fetch_row($query);

            $rows = $row[0];

            $page_rows = 10;

            $last = ceil($rows/$page_rows);

            if($last < 1){
                $last = 1;
            }

            $pagenum = 1;

            if(isset($_GET['pn'])){
                $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
            }

            if ($pagenum < 1) {
                $pagenum = 1;
            }
            else if ($pagenum > $last) {
                $pagenum = $last;
            }

            $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

            $nquery=mysqli_query($con,"SELECT * from  history ORDER BY `datetime` DESC $limit ");

            $paginationCtrls = '';

            if($last != 1){

            if ($pagenum > 1) {
            $previous = $pagenum - 1;
                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

                for($i = $pagenum-4; $i < $pagenum; $i++){
                    if($i > 0){
                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                    }
            }
            }

            $paginationCtrls .= ''.$pagenum.' &nbsp; ';

            for($i = $pagenum+1; $i <= $last; $i++){
                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                if($i >= $pagenum+4){
                    break;
                }
            }

            if ($pagenum != $last) {
            $next = $pagenum + 1;
            $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">Next</a> ';
            }
            }
            echo("<table  class='table table-striped'>");
            echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>วันที่</th><th>รายการ</th><th style='width:20%;'>พนักงาน</th><th style='width:10%;'>ราคา</th></tr>");
            while ($row = mysqli_fetch_array($nquery)) {
                echo("<tr style='vertical-align: top; border-bottom: 1px solid #ddd;'>");            
                echo("<td >".$row['datetime']."</td>");                 
                echo("<td>".$row['list']."</td>");
                echo("<td>".$row['staff']."</td>");
                echo("<td>".$row['total']."  บาท</td>");
                echo("<td><a href='cancelRowHistoryOrder.php?ID=".$row['id_order_history']."' class='btn btn-danger'>ยกเลิก</a></td>");

                echo("</tr>");                        
            }
            echo("</table>");
            ?>
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
        </div>
        <div class='col'>
            <div class='row'>
                <?php 
                $year=date("Y");
                ?>
                <p>สรุปยอดขายรายเดือน ปี</p>
                <table class="table table-striped">
                <tr>
                    <th width="20%">#</th>
                    <th>สรุปยอดขายรายเดือน ปี<?php echo($year) ?></th>
                </tr>
                
                    
                    <?php 
                    $sql="SELECT MONTH(`datetime`) AS Month, SUM(`total`) FROM history WHERE YEAR(`datetime`)='2021' GROUP BY MONTH(`datetime`);";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<tr>");
                        echo("<td> เดือนที่ ".$row[0]."</td>");
                        echo("<td>".$row[1]." บาท </td>");  
                        echo("</tr>");
                    }
                    ?>
                    
                </table>
            </div>
            
            <div class='row'><p>ค้นหารายวัน 
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
                <input type="date" name="dateSearch" start_date  min="2021-07-01">
                <input type="submit" name="submit" value="Submit Form"><br>
            </form>
            <?php
                if(isset($_POST['submit'])) 
                { 
                    $dateSearch = $_POST['dateSearch'];
                    $sqlcount="SELECT COUNT(id_order_history) AS `count` FROM history WHERE DATE(`datetime`)='".$dateSearch."'";
                    $result= mysqli_query($con,$sqlcount);
                    $row = mysqli_fetch_array($result);
                    $count = $row['count'];
                    if($count==0){
                        echo("<table  class='table table-striped'>");
                        echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>วันที่</th><th>รายการ</th><th style='width:20%;'>พนักงาน</th><th style='width:10%;'>ราคา</th></tr>");
                        echo("<tr><td colspan='4'>ไม่มีข้อมูล</td></tr>");
                        echo("</tr>");
                        echo("</table>");
                    }
                    else{    
                    $sql="SELECT * FROM `history` WHERE DATE(`datetime`)='".$dateSearch."'";
                    $result = mysqli_query($con,$sql);
                    
                    echo("<table  class='table table-striped'>");
                    echo("<tr style='border-bottom: 1px solid #ddd;'><th style='width:20%;'>วันที่</th><th>รายการ</th><th style='width:20%;'>พนักงาน</th><th style='width:10%;'>ราคา</th></tr>");
                    while ($row = mysqli_fetch_array($result)) {
                        echo("<tr style='vertical-align: top; border-bottom: 1px solid #ddd;'>");            
                        echo("<td >".$row['datetime']."</td>");                 
                        echo("<td>".$row['list']."</td>");
                        echo("<td>".$row['staff']."</td>");
                        echo("<td>".$row['total']."  บาท</td>");

                        echo("</tr>");                        
                    }
                    echo("</table>");
                }
                }
                ?>
                    
        </p></div>

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