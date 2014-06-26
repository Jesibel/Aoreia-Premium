<?php
	if(@session_start() == false){session_destroy();session_start();}
	//Validacion de usuario
	//conecto con la base de datos y selecciono la base de datos
	include("properties_conexion.php");
	conectar();
	$sess_id=session_id();
	
	
	
	if(isset($_POST['userid'])){
		$userid=$_POST['userid'];
		
		//sentencia SQL para buscar el usuario con los datos especificados
		$ssql = "select * from ximausrs where userid=$userid";
	}else{
		$email=$_POST['loginEmail'];
		$clave=$_POST['loginPass'];
		//$remember=$_POST['check']=="true" ? true:false;

		/*if($_POST['loginEmail2']<>'')
		{
			$email=$_POST['loginEmail2'];
			$clave=$_POST['loginPass2'];
		}*/
		
		$source='';
		/*if($_GET['e']<>'')
		{
			$email=base64_decode($_GET['e']);
			$clave=base64_decode($_GET['p']);
			$source=$_GET['s'];
		}*/	
		
		
		$email=mysql_real_escape_string(strtolower($email));
		$clave=mysql_real_escape_string($clave);
	

		//sentencia SQL para buscar el usuario con los datos especificados
		 $sql = "select u.NAME, u.SURNAME, u.USERID, u.idusertype,u.idstatus,u.questionuser, s.first_login, blacklist from ximausrs u,usersession s where s.userid=u.userid AND u.email='$email' and u.pass='$clave'";
	}
	$system='NEW';
	
	//echo $sql;
	//ejecucion de la sentencia
	$rss = mysql_query($sql) or die($sql." ".mysql_error());
	$_filas=mysql_num_rows($rss);
	if ($_filas!=0) 
	{			
		/*else{
			setcookie('ximausa_login_name',$email,time()-(60*60*24*30));
			setcookie('ximausa_login_pass',$clave,time()-(60*60*24*30));
		}*/
		
		//$_datos_usr=$rss->fetch_assoc();
		 
		$_datos_usr=mysql_fetch_assoc($rss);	
		//$_SESSION['datos_usr']=$_datos_usr;
		
		mysql_free_result($rss);
		
		//almacenar datos de usuario en session global
		/*if($remember){
			$cod=md5($_SERVER['REMOTE_ADDR'].time());
			setcookie('ximausa_login_remember',$cod,time()+(60*60*24*30),'/','aoreia.com');
			mysql_query('insert into usr_access values ("'.$cod.'",'.$_datos_usr['USERID'].')');
		}
		else
		{
			/*if($_COOKIE['ximausa_login_remember'])
			{
				setcookie('ximausa_login_remember',false,time()-3600,'/','aoreia.com');
				unset($_COOKIE['ximausa_login_remember']);
			}*/
		}
		// se verifica pregunta secreta
		/*if($_datos_usr['questionuser']=='')
		{
			setcookie('datos_usr[requireQuestionuser]',true,0,'/','aoreia.com');
		}*/
		
		/***************
		*	producto asignado
		***************/
		
				
		//Generar la cookie del usuario
		setcookie('datos_usr[NAME]',$_datos_usr['NAME'],0,'/','localhost');
		setcookie('datos_usr[SURNAME]',$_datos_usr['SURNAME'],0,'/','localhost');
		setcookie('datos_usr[USERID]',$_datos_usr['USERID'],0,'/','localhost');
		setcookie('datos_usr[idusertype]',$_datos_usr['idusertype'],0,'/','localhost');
		setcookie('datos_usr[idstatus]',$_datos_usr['idstatus'],0,'/','localhost');
		setcookie('login',true,0,'/','aoreia.com');
		//mysql_free_result($result);
		
				//Validación de Session
				$_hora=time();	
				setcookie('datos_usr[login_session]',$sess_id,0,'/','localhost');
				setcookie('datos_usr[login_dt]',$_hora,0,'/','localhost');

				
				
				//User Session
				$ssql = "Update usersession set first_login=true, login_session='$sess_id',login_dt=$_hora where userid=".$_datos_usr["USERID"];
				
				$rss = mysql_query($ssql) or die(mysql_error());
				
				//$ssql = "UPDATE `registerexternal_pag` SET `userid` = ".$_datos_usr["USERID"]." WHERE id_registerexternal=".$_COOKIE['id_session_register']."; ";				
				//mysql_query($ssql) or die(mysql_error());
		$sql='SELECT * FROM usr_cobros as c join usr_productobase as p  on c.idproductobase=p.idproductobase where c.userid='.$_datos_usr["USERID"];
		$res=mysql_query($sql);
		$active=true;
		$statusActive=array(1,2,3);
		while($data=mysql_fetch_assoc($res))
		{
			if(in_array($data['idstatus'] ,$statusActive)){
				setcookie('addon['.$data['idproducto'].']',1,0,'/','localhost');
			}
			else{
				$active=false;
				setcookie('addon['.$data['idproducto'].']',0,0,'/','localhost');
			}
		}

		//if($_POST['easyReturn']){
		//	echo json_encode(array('success' => true));
		//}
		//else{
			//if(isset($_POST['fromstore']) && $_POST['fromstore']== 'true')
			//	echo "<script> document.location.href='store.php';</script>";
			//else 
			//{
				if($source==9453)
					echo "<script> document.location.href='my_classifieds.php';</script>";			
				elseif($source==9455)
					echo "<script> document.location.href='my_affiliatelinks.php';</script>";			
				else
				{
					if($_datos_usr['idstatus']==5 && $_datos_usr['USERID']==20)
						echo "<script> document.location.href='homeunblocked.php';</script>";			
					else
					
						echo json_encode(array('success' =>true,'error' => 'yes..!!')); 
										
					//echo "<script> window.location.href='homeinside.php';</script>";			
				}	
			//}
		//}
		
	//}else{  
		//si no existe el usuario/contraseña
		unset($_COOKIE['datos_usr']);
		/*if($_POST['returnForm'])
		{
			echo "<a id='redirect' href='resources/php/errorlogin.php' target='_parent'></a>
					<script> document.getElementById('redirect').click();</script>";
		}
		else if($_POST['easyReturn']){
			echo json_encode(array('success' => false));
		}
		else
		{
			//include('errorlogin.php');
			//echo "<script>document.location.href='login.php?e=1';</script>";
		}*/
	//}
		
	
?>