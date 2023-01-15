
<?php
require_once("../../constants.php");
session_start();
?>
<html>
<head>
<title>Questioner</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!--Get your own code at fontawesome.com-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
   
    .header {
        
    height: 58px;
        display: flex;
    flex-direction: row;
background-color: black;
padding: 3px;
text-align: center;
font-size: 28px;
color: white;
position: absolute;
width: 100%;
top: 0;
left: 0;
padding-top: 10px;
}
</style>
</head>
<body>

<div class="header">
    <div style="padding-left: 10px;width: 20%;" ><i class='fas fa-user-alt' style='font-size: 34px;color:white;margin-right: 10px;'></i><span><?php echo $_SESSION[ProfessorName] ?></span></div>

<div style="width: 80%;"><span class="home-btn" style="cursor: pointer;"><i class="fa fa-angle-double-left" style="font-size:34px;color:red"></i>QUESTIONER <i class="fa fa-angle-double-right" style="font-size:34px;color:red"></i></span></div>
    
<div style="width: 10%;cursor: pointer;"><span><a href="logout.php">Logout</a></span></div>
    </div>

<br>





</body>
<script>
 $(".home-btn").click(function(){
            document.location.href = "./dashboard.php";
           
        })
</script>
</html>

