<?php
/*if( !isset($_COOKIE['datos_usr']['USERID'])){
	echo "<script> document.location.href='index.php';</script>";
	return;
}*/
require_once('resources/template/template.php');
require_once("properties_conexion.php");
conectar();

$query="SELECT initialdate
		FROM tilemonthlymeeting t
		WHERE date(initialdate)='".date('Y-m-d')."' and time('".date('H:i:s')."') between time(initialdate) and time(enddate)";
$resul=mysql_query($query)  or die($query.mysql_error());
$row=mysql_fetch_assoc($resul);

$tilemm="resources/image/tiles/Real-Estate-Investing-monthly_meeting.png";
if($row['initialdate']<>'')
	$tilemm="resources/image/tiles/Real-Estate-Investing-monthly_meeting_live.gif";



/*$query=" SELECT count(*) cant FROM `usr_cobros` WHERE `userid`=".$_COOKIE['datos_usr']['USERID'];
$resul=mysql_query($query)  or die($query.mysql_error());
$row=mysql_fetch_assoc($resul);

$tilemmhr="my_products.php";
if($row['cant']>1)
	$tilemmhr="monthly_meeting.php";*/


?>
<!DOCTYPE HTML>
<html>
<head> 
    <?php AOREIAHead();?>
</head>
<body style="background:#D1ECF4;">

<div class="clear5">&nbsp;</div>
<div class="containermainfull" id="idcontainermainfull" style="margin:0 auto; text-align:center; width:1250px;  ">
	<div class="clear5">&nbsp;</div>
	<div class="containermain" style="float:left; ">
        <?//php AOREIAHeader(false);?>

		<!-- BAR ORANGE --> 
		<div class="clear5">&nbsp;</div>
		
        <!--div class="contentbody bgorange1 textbold textsize18 textwhite"><center>HOME </center></div-->
        <!-- END BAR ORANGE -->
           
		<!-- CONTENT BODY -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody">
            <div class="boxbodyfull " >
				<div class="boxtiles  ">
            		<a href="https://www.aoreia.com/my_settings.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-my_settings.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="weekly_insight.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-weekly_insight.png"></a>
	     		</div>
				<div class="boxtiles ">
            		<a href="classifieds.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-classifieds.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="<?php echo $tilemmhr;?>" ><img border="0" src="<?php echo $tilemm;?>"></a>
	     		</div>
				<div class="boxtiles ">
            		<a href="my_classifieds.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-my_classifieds.png"></a>
	     		</div>
                <!--<div class="boxtiles  ">
            		<a href="white_sheet.php" ><img border="0" src="resources/img/tiles/Real-Estate-Investing-white_sheet.png"></a>
	     		</div> -->
				<div class="boxtiles ">
            		<a href="recentdeals.php"><img border="0" src="resources/image/tiles/Real-Estate-Investing-recent-deals.png"></a>
	     		</div>                
				<div class="boxtiles  ">
            		<a href="videos.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-videos.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="meeting.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-meetings_archives.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="my_products.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-my_products.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="articles.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-articles.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="audios.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-audios.png"></a>
	     		</div>
				<div class="boxtiles ">
            		<a href="videohelp.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-video-help.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="my_qa.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-my_qa.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="aofiles.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-files.png"></a>
	     		</div>
				<div class="boxtiles  ">
            		<a href="ebooks.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-ebooks.png"></a>
	     		</div> 
				<div class="boxtiles ">
            		<a href="q&a.php" ><img border="0" src="resources/image/tiles/Real-Estate-Investing-Q&A.png"></a>
	     		</div>
     		</div>
            
            
     	</div>
        <!-- END CONTENT BODY -->

		<?//php AOREIAFooter();?>
        <!-- Advertising Classifieds footer Block-->
		<div class="clear5">&nbsp;</div>
        <!--div class="contentbody" id="idboxclassadvertisefooter">
            <?//php include('classadvertise.php') ?> 
        </div-->
        <!-- END Advertising Classifieds footer Block-->
        <div class="clear5">&nbsp;</div>
        
	</div>
    
	<!-- Advertising Classifieds Right Block-->
	<!--div class="boxrightside" id="idboxclassadvertiseright">
		<?//php include('classadvertise.php') ?>
	</div-->
	<!-- END Advertising Classifieds Right Block-->
	
    <div class="clear5">&nbsp;</div>
     
</div>
</body>
</html>
<script type="text/javascript">
//	menuClick('menu-home');
</script>
<?//php require_once('classfooterhideshow.php') ?>