<?php
$PAGESIZE=50;///cantidad de resgistros que saldran en una pagina, cuado  se tiene paging..

$url=explode('/',$_SERVER['REQUEST_URI']);

function searchmyproducts($arrprod,$idprod){
	foreach($arrprod as $v)
		if($v['idproducto']==$idprod)
			return true;
	return false;
}

//incluida
function verificarSession(){
	if(isset($_COOKIE['datos_usr']['USERID']))
	{
		conectar();
		$query	=	"SELECT * from usersession WHERE userid=".$_COOKIE['datos_usr']['USERID'];
		$result= mysql_query($query) or die($query.mysql_error());
		$_row=mysql_fetch_array($result);
		
		if(strcmp($_row["login_session"], $_COOKIE['datos_usr']["login_session"])!=0){
			//echo "<script>document.location='/resources/php/properties_releaseSess.php?forSession=true';<script>";
			//header ("Location: //".$_SERVER['SERVER_NAME'].'/resources/php/properties_releaseSess.php?forSession=true');	
			//		echo "<script>document.location='sesionInvalid.php';<script>";
		}
	}
}

//incluida
function AOREIAHead($validapage=true){
	//verificarSession();
	/*if($_GET['procode'])
		setcookie('procode',$_GET['procode'],0,'/');
		
	if($validapage==true && $_COOKIE['datos_usr']["idstatus"]==5)
	{
		echo "<script>document.location='homeunblocked.php';</script>";
		return;
	}*/
	?>
        
    	<title>America's Online REIA for real estate investing </title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Language" content="EN-US">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<meta http-equiv="cache-control" content="no-cache">
    	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
		<meta name="keywords" content="Real Estate Investing, america, online, real estate, investor, association, courses, meeting, events, classifieds, resources, newsletter, coaching, testimonials" />
    	<meta name="description" content="We are dedicated to providing a real estate investing platform for investors nationwide. The club was designed to help provide education about real estate investing. The online accessibility fits everyone's schedule to learn real estate investing. The material presented on our website has been designed to complement and supplement local reias whenever possible." />
    	<meta name="DC.Title" content="America's Online Real Estate Investors Association">
    	<meta name="DC.Subject" content="Real estate investing and learn real estate investing">
    	<meta name="DC.Description" content="Change your life. Make $$$ in Real Estate. No credit, no money, no risk">
    	<meta name="rating" content="General">
    	<meta name="robots" content="all">
    	<meta name="revisit-after" content="2 days">
    	<meta name="category" content="Real Estate Investing">
    	<meta name="author" content="Dave Dinkel">
        <meta name="copyright" content="America's Online REIA - 2013">
    	<meta name="expires" content="never">
    	<meta name="generator" content="Microsoft FrontPage 5.0">
        <link rel="stylesheet" type="text/css" href="//test.aoreia.com/resources/css/css.css"/> 
        <link rel="stylesheet" type="text/css" href="//test.aoreia.com/resources/css/menu.css"/> 
        
		<!--<script type="text/javascript" language="javascript" src="includes/jquery.js"></script>-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="//test.aoreia.com/resources/js/jquery-migrate-1.0.0.js"></script>
        <script type="text/javascript" language="javascript" src="//test.aoreia.com/resources/js/validationRegister.js"></script>
        <script type="text/javascript" language="javascript" src="//test.aoreia.com/resources/js/cookies.js"></script>
        <script type="text/javascript" language="javascript" src="//test.aoreia.com/resources/js/jquery.upload-1.0.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="//test.aoreia.com/resources/js/menu.js"></script> 
        <script type="text/javascript" language="javascript" src="//test.aoreia.com/resources/js/functionGlobal.js"></script> 
        
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <link rel="shortcut icon" type="image/ico" href="//test.aoreia.com/favicon.png">
       
<?php
}

//incluida
function AOREIAHeader($showmenu=true){ 
	if (  !isset($_COOKIE['datos_usr']['USERID']) ) 
	{
		$table='';
		if(strpos($_SERVER['PHP_SELF'], '/aofiles/') !== false)  $table='aofiles';
		if(strpos($_SERVER['PHP_SELF'], '/articles/') !== false)  $table='articles';
		if(strpos($_SERVER['PHP_SELF'], '/audios/') !== false)  $table='audios';
		if(strpos($_SERVER['PHP_SELF'], '/ebooks/') !== false)  $table='ebooks';
		if(strpos($_SERVER['PHP_SELF'], '/ebook/') !== false)  $table='ebooks';
		if(strpos($_SERVER['PHP_SELF'], '/meeting/') !== false)  $table='meeting';
		if(strpos($_SERVER['PHP_SELF'], '/videos/') !== false)  $table='videos';
		if(strpos($_SERVER['PHP_SELF'], '/weekly_insight/') !== false)  $table='weekly_insight';
		if(strpos($_SERVER['PHP_SELF'], '/whitesheet/') !== false)  $table='white_sheet';
		if(strpos($_SERVER['PHP_SELF'], '/recentdeals/') !== false)  $table='recentdeals';
		if( $table<>'')//$_SERVER['PHP_SELF']=='/articles/2013/05/28/222.php' &&
		{
			$_SERVERRT='localhost';
			$_USERRT='remoto';
			$_PASSRT='ma1057pa!';
			$_DBRT='aoreia';
			$conexion2 = mysql_connect($_SERVERRT, $_USERRT, $_PASSRT) or die("Could not connect: " . mysql_error());
			mysql_select_db($_DBRT,$conexion2) or die("Could not bd select: " . mysql_error());
			$query="SELECT `idproducto` FROM `$table` 
					WHERE `pathurl`='".substr($_SERVER['PHP_SELF'],1)."'";
			$resulhead=mysql_query($query)  or die($query.mysql_error());
			$rowhead=mysql_fetch_assoc($resulhead);
			if($rowhead[idproducto]<>1)
			{
				echo "<script> document.location.href='http://test.aoreia.com';</script>";
				//return;
			}
		}
	}
	
?>
		<!-- HEADER -->
        <header>
			<div class="box1 ">
				<div class="box3 bgwhite">
                    <div class="clear10">&nbsp;</div>
                    <a href="http://test.aoreia.com/index.php" ><img border="0" src="//test.aoreia.com/resources/img/Real-Estate-Investing-logo_aoreia.png"></a>
	    		</div>
    		</div>
            
			<div class="box2 "> 
                <div class="box6 ">
                    <img border="0" src="//test.aoreia.com/resources/img/Real-Estate-Investing-americas.png">
                </div>
                <div class="box6 ">
                   <a href="http://test.aoreia.com/welcome_video.php" >
                   <img border="0" src="//test.aoreia.com/resources/img/Real-Estate-Investing-slogan4.png">
                   </a>
                </div>
            </div>    
            
			<div class="box1 ">
				<?php 
				if($_COOKIE['datos_usr']['NAME']<>''){
				?>	
                    <div class="box4 bgblue1 lefttext textdarkblue textbold textsize14">
                        <div class="clear5">&nbsp;</div>
                        Welcome, <br/>
                        <a href="https://test.aoreia.com/my_settings.php" title="Click to my settings" class="aorange " >
                        <?php 
							$arr1=explode(' ',strtolower($_COOKIE['datos_usr']['NAME'])); 
							$arr2=explode(' ',strtolower($_COOKIE['datos_usr']['SURNAME']));
							echo ucwords($arr1[0].' '.$arr2[0]); ?>
                        </a>
                        <div class="clear5">&nbsp;</div>
                        <span class="textsize12">Member # <?php echo $_COOKIE['datos_usr']['USERID'] ?></span>
                    </div>
                    <div class="box4 ">
                        <a href="http://test.aoreia.com/properties_releaseSess.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-log_out.png"></a>
                    </div>
				<?php 
				}else{
				?>	
                    <div class="box4 ">
                        <a href="http://test.aoreia.com/login.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-log_in.png"></a>
                    </div>
                    <div class="box4 "> 
                        <a href="http://test.aoreia.com/store.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-sign_up.png"></a>
                    </div>
				<?php 
				}
				?>	

       			<div class="box5" style="background-color: #0a94d6; position:relative;">
                    <input type="text" id="searchText" style="border: medium none;border-radius: 5px 5px 5px 5px;box-shadow: none;left: 0;padding: 6px;position: absolute;top: 33px;" >
                    <a href="javascript:doSearch()" style="position:absolute; right:0px;"><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-boton-search.png"></a>
	     		</div>
                <script>
					function doSearch(){
						var s = $('#searchText').val();
						$('#searchText').val('');
						if(s.length > 0)
							document.location = 'http://test.aoreia.com/search.php?p=1&s='+s+'&t=2&c=1';
						else
							document.location = 'http://test.aoreia.com/search.php';
					}
				</script>
    		</div>
		</header>
        <!-- END HEADER -->
		<?php if ($showmenu){ ($_COOKIE['datos_usr']['NAME']<>'')? AOREIAMenuUser(): AOREIAMenu(); }?>
        
<?php	
} 

//incluida
function AOREIAFooter(){?>
		<!-- FOOTER -->
		<div class="clear5">&nbsp;</div>
		<footer>
			<div class="box4 footerDiv">
              	<a href="<?php echo ($_COOKIE['datos_usr']['NAME']<>'')? 'http://test.aoreia.com/my_affiliatelinks.php': 'http://test.aoreia.com/affiliate.php' ?>" >
                <img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-affiliate.png"></a>
     		</div>
			<div class="box4 footerDiv">
			    <a href="http://test.aoreia.com/prefervendors.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-prefer-vendors.png"></a>
     		</div>
			<div class="box7 footerDiv">
            	<a href="https://twitter.com/AOREIA" target="_blank" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-t.png"></a>
     		</div>
			<div class="box7 footerDiv">
            	<a href="http://www.linkedin.com/pub/americas-online-reia-llc/6a/933/928"  target="_blank"  ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-g.png"></a>
     		</div>
			<div class="box7 footerDiv">
            	<a href="http://www.facebook.com/pages/Americas-Online-REIA-LLC/122993624562827?skip_nax_wizard=true" target="_blank" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-f.png"></a>
     		</div>
			<div class="box4 footerDiv">
            	<a href="http://test.aoreia.com/contactus.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-contact_us.png"></a>
     		</div>
			<div class="box4 footerDiv">
            	<a href="http://test.aoreia.com/aboutus.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-about_us.png"></a>
     		</div>
			<div class="box4 footerDiv">
            	<a href="http://test.aoreia.com/sponsors.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-sponsors.png"></a>
     		</div>
			<div class="box4 footerDiv"> 
            	<a href="http://test.aoreia.com/legal.php" ><img border="0" src="//test.aoreia.com/resources/img/tiles/Real-Estate-Investing-legal.png"></a>
     		</div>
      	</footer>
        <!-- END FOOTER display:none-->
		<div class="clear5">&nbsp;</div>
<?php include_once("resources/php/analyticstracking.php") ?>
<?php
}
//incluida
function AOREIAMenu() {  
?>
		<!-- MENU -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody textsize16">
        	<center>
            <nav id="menu">  
                <ul>  
                    <li id="menu-home">
                        <a href="http://test.aoreia.com/index.php" title="America's Online REIA Home">Home</a>
                    </li>
                    <li id="menu-membership">
                        <a href="http://test.aoreia.com/membership.php" title="America's Online REIA Membership">Membership</a>
                    </li>  
                    <li id="menu-meetings">
                        <a href="http://test.aoreia.com/meeting.php?p=1" title="America's Online REIA Meeting">Meeting</a>
                    </li> 
                    <li id="menu-courses">
                        <a href="http://test.aoreia.com/courses.php" title="America's Online REIA Courses">Courses</a>
                    </li> 
                    <li id="menu-events">
                        <a href="http://test.aoreia.com/events.php" title="America's Online REIA Events">Events</a>
                    </li>  
                    <li id="menu-classifieds">
                        <a href="http://test.aoreia.com/classifieds.php" title="America's Online REIA Classifieds">Classifieds</a>
                    </li> 
                    <li id="menu-resources">
                        <a href="http://test.aoreia.com/resources.php" title="America's Online REIA Resources">Resources</a>
                    </li> 
                    <li id="menu-newsletter">
                        <a href="http://test.aoreia.com/weekly_insight.php?p=1" title="America's Online REIA Weekly Insight Newsletters">Newsletters</a>
                    </li>  
                    <li id="menu-q&a"> 
                        <a href="http://test.aoreia.com/q&a.php" title="America's Online REIA Frequent Asked Questions">FAQ</a>
                    </li> 
                    <li id="menu-store"> 
                        <a href="http://test.aoreia.com/store.php" title="America's Online REIA Store">Store</a>
                    </li>
                    <li id="menu-coaching"> 
                        <a href="http://test.aoreia.com/underconstruction.php" title="America's Online REIA Coaching">Coaching</a>
                    </li> 
                    <li id="menu-testimonials"> 
                        <a href="http://test.aoreia.com/testimonials.php" title="America's Online REIA Testimonials">Testimonials</a>
                    </li> 
                    
                </ul>  
            </nav> 
            </center>
     	</div>
        <!-- END MENU -->
<?php
}
//incluida
function AOREIAMenuUser() {	
?>
		<!-- MENU -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody textsize16">
        	<center>
            <nav id="menu">  
                <ul>  
                    <li id="menu-home">
                        <a href="http://test.aoreia.com/homeinside.php"  title="America's Online REIA Home">Home</a>
                    </li>
                    <li id="menu-myaccount">
                        <a href="#"  title="America's Online REIA My Account">My Account</a>
						<ul>  
                            <li><a href="https://test.aoreia.com/my_settings.php">My Settings</a></li>    
							<li class="last"><a href="http://test.aoreia.com/my_products.php">My Products</a></li>  
                        </ul>                        
                    </li>
                    <li id="menu-my_classifieds">
                        <a href="#" title="America's Online REIA Classifieds" >Classifieds</a>
						<ul>  
                            <li><a href="http://test.aoreia.com/my_classifieds.php">My Classifieds</a></li>    
                            <li class="last"><a href="http://test.aoreia.com/classifieds.php">Classifieds</a></li>    
                        </ul>                        
                    </li>
                    <li id="menu-q&a">
                        <a href="#" title="America's Online REIA My Frequent Asked Questions" >FAQ </a>
						<ul>  
                            <li><a href="http://test.aoreia.com/my_qa.php" title="America's Online REIA My Frequent Asked Questions" >My FAQ </a></li>    
                            <li class="last"><a href="http://test.aoreia.com/q&a.php" title="America's Online REIA Frequent Asked Questions">FAQ</a></li>    
                        </ul>                        
                    </li>
                    <li id="menu-newsletter">
                        <a href="http://test.aoreia.com/weekly_insight.php" title="America's Online REIA Weekly Insight Newsletters" >Newsletters</a>
                    </li>                
                    <li id="menu-articles"> 
                        <a href="http://test.aoreia.com/articles.php" title="America's Online REIA Articles" >Articles</a>
                    </li>
                    <li id="menu-audios"> 
                        <a href="http://test.aoreia.com/audios.php" title="America's Online REIA Audios" >Audios</a>
                    </li>
                    <li id="menu-videos"> 
                        <a href="http://test.aoreia.com/videos.php" title="America's Online REIA Videos" >Videos</a>
                    </li>
                    <li id="menu-files"> 
                        <a href="http://test.aoreia.com/aofiles.php" title="America's Online REIA Files" >Files</a>
                    </li>
                    <li id="menu-ebooks"> 
                        <a href="http://test.aoreia.com/ebooks.php" title="America's Online REIA Ebooks" >Ebooks</a>
                    </li>
                    <li id="menu-white_sheet"> 
                        <a href="http://test.aoreia.com/white_sheet.php" title="America's Online REIA Reports" >Reports</a>
                    </li>
                    <li id="menu-meetings">
                        <a href="http://test.aoreia.com/meeting.php"  title="America's Online REIA Meetings">Meetings</a>
                    </li>
                    <li id="menu-monthly_meeting">
                        <a href="http://test.aoreia.com/monthly_meeting.php" target="_blank" title="America's Online REIA Monthly Meeting" >M. Meeting</a>
                    </li> 
                </ul>  
            </nav> 
            </center>
     	</div>
        <!-- END MENU -->
<?php
}
function securityQuestion($questio,$answer){
	$question=array(
	"What was the name of your elementary / primary school?",
	"What is the name of the company of your first job?",
	"What is your spouse&#039;s mother&#039;s maiden name?",
	"To what city did you go on your honeymoon? ",
	"Who was your childhood hero? ",
	"What month and day is your anniversary? (e.g., January 2)",
	"What is your grandmother&#039;s first name?",
	"What is your mother&#039;s middle name? ",
	"What was the make and model of your first car?",
	"In what city and country do you want to retire? ",
	"What year did you graduate from High School?"
	);
	?>
    <tr>
    	<td>
        	<label class="required" ><span class="textred">*</span> Security Question</label>
    	</td>
        <td>
            <select class="text-input jqx-input inputroundform " id="questionuser"  name="questionuser" style="width:320px;">
                <?php foreach($question as  $index)
                {
                    echo ($questio==$index)?'<option selected="selected" value="'.$index.'">'.$index.'</option>':'<option value="'.$index.'">'.$index.'</option>';
                }
                ?>
             </select>
       </td>
    </tr>
    <tr>
    	<td>
        	<label class="required" ><span class="textred">*</span> Your answer</label>
    	</td>
        <td>
        	<input class="text-input jqx-input inputroundform " size="43" value="<?php echo $answer;?>" name="answeruser" id="answeruser" type="text" />
       </td>
    </tr>
    
	<?php
}







function rememberUser (){
	global $url;
	if(isset($_COOKIE['ximausa_login_remember']) && !isset($_COOKIE['datos_usr']['USERID']) && ($url[1]!='overview') && ($url[1]!='result'))
	{
		conectar();
		$query	='SELECT email,pass from ximausrs WHERE userid=(select userid from usr_access where id_usr_access="'.$_COOKIE['ximausa_login_remember'].'")';
		$result= mysql_query($query) or die($query.mysql_error());
		$data=mysql_fetch_assoc($result);
		return array( $data['email'], $data['pass']);
	}
}
function formantDate($date,$Months) {
	$date=explode('-',$date);
	$date=$Months[$date[1]-1].' '.$date[2].', '.$date[0];
	return $date;
}
function formantDateNumber($date){
	$date=(substr($date,0,4)).'/'.(substr($date,-4,-2)).'/'.(substr($date,-2));
	return $date;
}
function formantPhone($number)	{
		$aux1=explode('-',$number);
		if(strlen($aux1[0])>5)
		{
			$respuesta->cod=substr($number,-strlen($number),3);
			$respuesta->num=substr($number,3-strlen($number),7);
			if(strlen($number)>10)
				$respuesta->ext=substr($number,10-strlen($number));
		}
		else if(strlen($aux1[1])>6)
		{
			$respuesta->cod=$aux1[0];
			$respuesta->num=$aux1[1];
			$respuesta->ext=$aux1[2];
		}
		else
		{
			$respuesta->cod=$aux1[0];
			$respuesta->num=$aux1[1].$aux1[2];
			$respuesta->ext=$aux1[3];			
		}
		return 	$respuesta;
	
}
function myProducts(){
	conectar();
	$sql="SELECT homefinder, buyerspro, leadsgenerator, residential, platinum, professional, professional_esp FROM permission where userid=".$_COOKIE['datos_usr']['USERID'].";";
	$respuesta=mysql_query($sql);
	if(mysql_num_rows($respuesta)>0)
	{
		echo '<li id="menu-my-products"> <a href="myProducts.php" title="RealtyTask Products">My Products</a>';
		/*$status=mysql_fetch_assoc($respuesta);
		if($status['professional'] || $status['professional_esp'])
			{
				$boton[3]='<li><a href=" //professional.realtytask.com" >RealtyTask Professional</a></li>';
			}
			else if($status['platinum'])
			{
				$boton[2]='<li><a href=" //platinum.realtytask.com" >RealtyTask Platinum</a></li>';
			}
		else if($status['residential'])
			{
				$boton[1]='<li><a href="//residential.realtytask.com" >RealtyTask Residential</a></li>';
			}
		$boton[7]=($status['homefinder'])?'<li><a href="#" >Coming Soon</a></li>':null;
		$boton[6]=($status['buyerspro'])?'<li><a href="//buyerspro.realtytask.com" >Buyer`s Pro</a></li>':null;
		$boton[8]=($status['leadsgenerator'])?'<li><a href="//leads.realtytask.com" >Leads Generator</a></li>':null;
		echo $boton[1].$boton[2].$boton[3].$boton[7].$boton[6].$boton[8];*/
		echo "</li>";
	}
}
function myAccount($ocultarOpciones,$userStatus){
		conectar();
	$sql='SELECT * FROM `xima`.`usr_registertype` where userid='.$_COOKIE['datos_usr']['USERID'].' order by idrtyp DESC;';
	$resul=mysql_query($sql);
	while ($data=mysql_fetch_array($resul))
	{
		switch($data['idrtyp']){
					case (1):
					$sql="SELECT homefinder, buyerspro, leadsgenerator, residential, platinum, professional, professional_esp FROM permission where userid=".$_COOKIE['datos_usr']['USERID'].";";
					$respuesta=mysql_query($sql);
					if(mysql_num_rows($respuesta)>0)
					{
						$products=mysql_fetch_assoc($respuesta);
					}
					$submenu='
                        <li><a href="/settings/personalData.php">Personal Data</a></li>
                        <li><a href="/settings/profileData.php">Profile Data</a></li>
                        <li><a href="/settings/creditCard.php">Credit Card</a></li>
                        <li><a href="/settings/changePassword.php">Password Data</a></li>
                        <li><a href="/settings/tickets.php">My Tickets</a></li>';
					if($userStatus==6)
					{
						$submenu.='
                        <li><a href="/settings/unfreezeAcount.php">Unfreeze</a></li>';
					}
					else if($ocultarOpciones)
					{
						$submenu.='
                        <li><a href="/settings/active.php">Active Products</a></li>
						';
					}
					else
					{
						$submenu.='
                        <li><a href="/settings/freezeAccount.php">Freeze</a></li>
                        <li><a href="/settings/cancelAccount.php">Cancel</a></li> 
						<li><a href="/settings/upgradeAccountTem.php">Upgrade</a></li>
						<!--<li><a href="/settings/downgradeAccount.php">Downgrade</a></li>//-->
                       <!-- 
                        <li><a href="/settings/#">Default State/County</a></li>//-->
						';
					}
					if($products['residential'] || $products['professional'] || $products['platinum']|| $products['professional_esp'])
					{
						if($products['professional'] || $products['platinum']|| $products['professional_esp'])
						{
							$menu4='
                       				<li><a href="/settings/myContracts.php">Contracts</a></li>
							'.$menu4;
						}
						$menu4='
                       				<li><a href="/settings/myDocuments.php">Documents</a></li>
						'.$menu4;
					}
					break;
					case (2):
						$submenu='
                        <li><a href="/settings/personalData.php">Personal Data</a></li>
                        <li><a href="/settings/profileData.php">Profile Data</a></li>
                        <li><a href="/settings/changePassword.php">Password Data</a></li>
                        <li><a href="#">Cancel Account</a></li>
						';
						$menu2='
							<li id="menu-my-partner"><a href="#">My Affiliate</a>
								<ul>
						';		
						if(	$_COOKIE['datos_usr']['USERID']<>113 && $_COOKIE['datos_usr']['USERID']<>116 && $_COOKIE['datos_usr']['USERID']<>611 && $_COOKIE['datos_usr']['USERID']<>1790 && 
							$_COOKIE['datos_usr']['USERID']<>621  )//&& $_COOKIE['datos_usr']['USERID']<>20
						{
							$menu2.='
									<li><a href="/settings/affMarketing.php">Affiliate Commission</a></li>';
						
						}
						$menu2.='
									<li><a href="/settings/affMarketingReferrals.php">Affiliate Referrals</a></li>
									<li><a href="/settings/banners.php">Banners</a></li>
								</ul>
							</li>
						';
					break;
					case (3):
						$submenu='
                        <li><a href="/settings/personalData.php">Personal Data</a></li>
                        <li><a href="/settings/profileData.php">Profile Data</a></li>
                        <li><a href="/settings/changePassword.php">Password Data</a></li>
                        <li><a href="#">Cancel Account</a></li>
						';
						$menu3='
							<li id="menu-my-advertise"><a href="/settings/myAdvertise.php">My Advertising</a>
							</li>
						';
					break;
					case (4):
						$submenu='
                        <li><a href="/settings/personalData.php">Personal Data</a></li>
                        <li><a href="/settings/profileData.php">Profile Data</a></li>
                        <li><a href="/settings/changePassword.php">Password Data</a></li>
						';
					break;
					case (5):
						$submenu='
                        <li><a href="/settings/personalData.php">Personal Data</a></li>
                        <li><a href="/settings/profileData.php">Profile Data</a></li>
                        <li><a href="/settings/changePassword.php">Password Data</a></li>
                        <li><a href="#">Cancel Account</a></li>
						';
						$menu4='
                       				<li><a href="/settings/reportsHomeFax.php">Reports</a></li>
						';
					break;
			}
	}
	$menu4=($menu4)?'<li id="menu-my-advertise"><a href="#">My Documents</a><ul>'.$menu4.'</ul></li>':'';
	$submenu.='</ul></li> ';
	echo $submenu.$menu2.$menu3.$menu4;
}



function AOREIAHeadHttps(){
	if($_GET['procode'])
		setcookie('procode',$_GET['procode'],0,'/');
	?><head>
        <meta charset="utf-8">
    	<title>Realty Task Home</title>
        <link rel="stylesheet" type="text/css" href="/resources/css/css.css"/> 
        <link rel="stylesheet" type="text/css" href="/resources/css/chosen.css"/> 
        <link rel="stylesheet" type="text/css" href="/resources/css/menu.css"/> 
        <link rel="stylesheet" type="text/css" href="/resources/css/advertising.css"/> 
        <link rel="stylesheet" type="text/css" href="/resources/css/jquery.cleditor.css"/> 
        
        <!-- JQuery -->
        <script type="text/javascript" language="javascript" src="/includes/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="/includes/jquery.carouFredSel-4.3.3-packed.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/validationRegister.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/tabPanel.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/cookies.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/jquery.upload-1.0.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/ubicacion.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/jquery.cleditor.min.js"></script>
		<script type="text/javascript" language="javascript" src="/resources/js/flowplayer-3.2.6.min.js"></script>
        <script type="text/javascript" language="javascript" src="/resources/js/menu.js"></script> 
        <script type="text/javascript" language="javascript" src="/resources/js/functionGlobal.js"></script> 
        
        <!--[if lt IE 9]>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <link rel="shortcut icon" type="image/ico" href="/favicon.png">
    </head>
<?php
}

function AOREIAHeaderHttps(){
	global $url;?>
	
	<header>
    	<!--RealtyTask Advertising Top-->
        <div id="advertisingTop">
        	<a href="/company/contactUs.php?mensaje=true">
        		<img src="/resources/img/advertise/S111.png" />
            </a>
        </div>
        
        <!--RealtyTask Logo, Newsletters & Social Media-->
        <div id="reifax">
        	<!--RealtyTask Logo-->
            <div id="logo">
            	<a href=""><img src="/resources/img/logo-realtytask-home.png"></a>
            </div>
        	
            <!--RealtyTask Social Media-->
        	<div id="socialmedia">
            	<ul>
                    <li>
                    	<span class="bluetext"><span style="font-weight:bold;">Call Today:</span> 1 (888) 349 5368</span> 
                    </li>
                    <li>
                    	<div id="followus"> 
                            <span class="bluetext" style="float:left; font-weight:bold;">Follow Us:</span>
                            <a href="//www.facebook.com/RealtyTask" class="facebook">&nbsp;</a>
                            <!-- <a href="#" class="linkedin">&nbsp;</a> //-->
                            <a href="//twitter.com/RealtyTask" class="twitter">&nbsp;</a>
                            <!--<a href="//www.youtube.com/user/map2equity" class="youtube">&nbsp;</a>//-->
                        </div>
                   	</li>
                    <li>
                    	<a href="//messenger.providesupport.com/messenger/ximausa.html" id="liveChatButtom" target="_blank" class="buttonblue">Live Chat</a> 
                        <?php
							if(isset($_COOKIE['datos_usr']))
							{
								$sql='SELECT count(id_msg) cant FROM customerservices c left join customerservice_msg msg ON msg.id_ticket=c.idcs and status_msg_system=1 where useridclient='.$_COOKIE['datos_usr']['USERID'];
								$aux=mysql_query($sql);
								$msg=mysql_fetch_assoc($aux);
                    			echo '<a href="/settings/tickets.php" id="botonTickets" class="'.(($msg['cant']>0)? 'buttonred' :'buttonblue').'">Tickets</a> ';
							}
						?>
                    </li>
                </ul>
            </div>
            <!--RealtyTask Newsletters Suscription-->
            <?php
				if(isset($_COOKIE['datos_usr']['USERID']))
				{
					
					?>
                	<div class="bluetext" id="user">
                    	<div>
                        	<label> Welcome, <?php echo  $_COOKIE['datos_usr']['NAME'].' '. $_COOKIE['datos_usr']['SURNAME']?></label>
                        </div>
                        <div>
                        	<label> Account Executive: <?php echo $_COOKIE['datos_usr']['USERID'] ?></label>
                        </div>
                        <div>
                        	<label>
                            <a class="buttongreen bigButton" href="/resources/php/properties_releaseSess.php">Log Out</a>
							
                            <?php 
							if(!isset($_COOKIE['suspended'])){
								if($url[1]=='settings'){
									echo '<a class="buttonblack bigButton" style="margin-left:20px;" href="#">My Settings</a>';
								}
								else{
									echo '<a class="buttonblue bigButton" style="margin-left:20px;" href="/settings/myProducts.php">My Settings</a>';
								}
							}; ?>
                            </label>
                        </div>
                    </div>
                
			<?php
				}
				else
				{?>
                
                    <div id="login">
                   		<form id="loginForm" method="post" action="/resources/php/properties_validacion.php">
                            <table class="content" border="0" cellpadding="0" cellspacing="5">
                                <tr>
                                    <td>
                                        <label title="Login Email Submit" class="bluetext">E-mail</label>
                                    </td>
                                    <td>
                                        <input type="email" name="loginEmail" id="loginEmail">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label title="Login Password Submit" class="bluetext">Password</label>
                                    </td>
                                    <td>
                                        <input type="password" name="loginPass" id="loginPass">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right"> 
                                      <div class="disclaimer"><a style="float:left; margin-left:15px; margin-top:3px; font-size:10px;" class="underline blacktext" href="/register/forgotPassword.php">Forgot Password?</a><a href="#"  id="loginbutton" class="buttonblue">Log In</a>
                                      <!-- &nbsp; Or &nbsp; <a href="/register/communityRegister.php" style="margin-right:29px;" class="buttongreen">Register</a> //-->
                                      </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>  
			<?php }?>
            
        </div>  
            
                <?php $tem=explode('/',$_SERVER['REQUEST_URI']);($tem[1]=='settings')? AOREIAMenuUser() :AOREIAMenu(); ?>
    </header>
<?php	
}

//PAGING
                                function check_integer($which) {
                                    if(isset($_REQUEST[$which])){
                                        if (intval($_REQUEST[$which])>0) {
                                            //check the paging variable was set or not, 
                                            //if yes then return its number:
                                            //for example: ?page=5, then it will return 5 (integer)
                                            return intval($_REQUEST[$which]);
                                        } else {
                                            return false;
                                        }
                                    }
                                    return false;
                                }//end of check_integer()
                            
                                function get_current_page() {
                                    if(($var=check_integer('page'))) {
                                        //return value of 'page', in support to above method
                                        return $var;
                                    } else {
                                        //return 1, if it wasnt set before, page=1
                                        return 1;
                                    }
                                }//end of method get_current_page()
                            
                                function doPages($page_size=3, $thepage, $query_string, $total=0) {
                                    global $PAGE;
                                    //per page count
                                    $index_limit = 10;
                            
                                    //set the query string to blank, then later attach it with $query_string
                                    $query='';
                                    
                                    if(strlen($query_string)>0){
                                        $query = "&amp;".$query_string;
                                    }
                                    
                                    //get the current page number example: 3, 4 etc: see above method description
                                    $current = get_current_page();
                                    
                                    $total_pages=ceil($total/$page_size);
                                    $start=max($current-intval($index_limit/2), 1);
                                    $end=$start+$index_limit-1;
                            
                                    echo '<div class="paging">';
                             
                                    if($current==1) {
                                        echo '<span class="prn">&lt; Previous</span>&nbsp;';
                                    } else {
                                        $i = $current-1;
                                        echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
                                        echo '<span class="prn">...</span>&nbsp;';
                                    }
                            
                                    if($start > 1) {
                                        $i = 1;
                                        echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
                                    }
                            
                                    for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
                                        if($i==$current) {
                                            echo '<span>'.$i.'</span>&nbsp;';
                                        } else {
                                            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
                                        }
                                    }
                            
                                    if($total_pages > $end){
                                        $i = $total_pages;
                                        echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
                                    }
                            
                                    if($current < $total_pages) {
                                        $i = $current+1;
                                        echo '<span class="prn">...</span>&nbsp;';
                                        echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
                                    } else {
                                        echo '<span class="prn">Next &gt;</span>&nbsp;';
                                    }
                                    
                                    //if nothing passed to method or zero, then dont print result, else print the total count below:
                                    if ($total != 0){
                                        //prints the total result count just below the paging
										$ini=(1+(($PAGE-1)*$page_size));
										$fin=(((1+(($PAGE-1)*$page_size))+$page_size)-1);
										$fin=($fin>$total)?$total:$fin;//<br/><div class="clear"></div>
                                        echo '&nbsp;&nbsp;<span id="total_count"> ( Displaying '.$ini.' - '.$fin.' of '.$total.' total ) </span></div>';
                                    }
                                    
                                }//end of method doPages()

?>