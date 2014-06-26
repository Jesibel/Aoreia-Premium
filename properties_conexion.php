<?php
//echo "aqui";
//Conexion Constants 
$_SERVERRT='199.193.115.209';
$_USERRT='remoto';
$_PASSRT='ma1057pa!';
$_DBRT='aoreia';

function conectar(){
	global $_SERVERRT,$_USERRT,$_PASSRT,$_DBRT;
	$conexion = mysql_connect($_SERVERRT, $_USERRT, $_PASSRT) or die("Could not connect: " . mysql_error());

	mysql_select_db($_DBRT) or die("Could not bd select: " . mysql_error());
}
?>