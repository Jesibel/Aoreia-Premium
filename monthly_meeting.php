<?php
if(!isset($_COOKIE['datos_usr']['USERID'])){
	echo "<script> document.location.href='index.php';</script>";
	return;
}
require_once('resources/template/template.php');
require_once("properties_conexion.php");
conectar();

$query=" SELECT count(*) cant FROM `usr_cobros` WHERE `userid`=".$_COOKIE['datos_usr']['USERID'];
$resul=mysql_query($query)  or die($query.mysql_error());
$row=mysql_fetch_assoc($resul);
if($row[cant]==1){
	echo "<script> document.location.href='index.php';</script>";
	return;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
    <!-- Head of Website -->
    <?php AOREIAHead();?>
    </head>
    <body>
   	<?php
	if(!isset($_GET['r'])){
		echo "<script language=\"JavaScript\"> document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&height=\"+screen.height; </script>";
	}
	else {     
		if(isset($_GET['width']) && isset($_GET['height'])) {
	?>
            <!-- Header of Website --> 
            <!--<center><img width="975px" height="20px" src="http://www.realtytask.com/AOREIA/resources/img/topREIA.jpg"></center>-->
            <br/>
            <iframe scrolling="no" src="https://www2.gotomeeting.com/register/749823698" frameborder="0" 
            height="<?php echo ($_GET['height']-180) ?>" width="<?php echo ($_GET['width']-50) ?>"></iframe>
	<?php
		}
	}
	?> 
    </body>
</html>
