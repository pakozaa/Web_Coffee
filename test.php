<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include('connect.php');
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
?>
</head>
<body>
<table width="80%" class="table table-striped table-bordered table-hover">
						
						<thead>
							<tr class="info">
							<th>UserID</th>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Username</th>
							</tr>
						</thead>
					
						<tbody>
							<?php
								while($crow = mysqli_fetch_array($nquery)){
							?>
							<tr>
								<td><?php echo $crow['datetime']; ?></td>
								<td><?php echo $crow['list']; ?></td>
								<td><?php echo $crow['staff']; ?></td>
								<td><?php echo $crow['total']; ?></td>
							</tr>
							<?php
									}
							?>
						</tbody>
					</table>
					<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
</body>
</html>