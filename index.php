<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include("connect.php")
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="layout.css">
    <title>Document</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            BEAR SO COFFEE SHOP
        <form name="loginForm"action="login.php" method="POST"  >
         <input type="text" id="Username" name="Username" class="inputtext"></input>
         <input  id="Password" name="Password" type="text" class="inputtext"></input>
         <input type="submit" value="LOG IN" class="inputsubmit"></input>
        </form>
        </div>
        <div>
            
        
        </div>
    </div>
</div>
    <footer><p>Copyright 2021 by Pakodev</p></footer>
</body>
</html>