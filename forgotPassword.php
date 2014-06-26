<?php 
	require_once('resources/template/template.php');
	require_once('properties_conexion.php');
	conectar();
?>
<!DOCTYPE HTML>
<html>
<style type="text/css">
#trPassword,#transwer, #trquestion,#trsupport,#trnewpass,#trtext,#trretype,#trbtn{
	display:none;
}
</style>

<!-- Head of ReiFax Website -->
<?php AOREIAHead();?>

<body style="background:#D1ECF4;">

<div class="clear5">&nbsp;</div>
<div class="containermainfull" id="idcontainermainfull" style="margin:0 auto; text-align:center; width:1250px;  ">
	<div class="clear5">&nbsp;</div>
	<div class="container" style="float:left; ">
    <!-- Header of ReiFax Website -->
    <?//php AOREIAHeader();?>
	
    <!-- YOU ARE HERE -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody textdarkblue textbold textsize14" style="text-align:left">
			&nbsp;&nbsp;You are here: <a href="index.php"><span class="underline">Home</span></a> 
            /<a href="login.php"><span class="underline">Login</span></a> 
			/<span class="textorange"> Forgot Password</span>   
     	</div>
        <!-- CONTENT BODY -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody">
            <div class="boxleftside" style="margin-left:200px;">
                <div class="boxleftcontent bgwhite">
               		<div class="clear10">&nbsp;</div>
					<div class="centertext">  
                    	<span class=" textbold textdarkblue textsize16">Forgot Password - Please fill out the form below</span>
                    </div>                    
                    <div class="clear10">&nbsp;</div>
					<center>
					<div>
						<!--Form-->
                        <form onSubmit="return false;" id="comunityRegister">
                    <table align="center">
                        	<tr id="trEmail">
                            	<td align="right">
                                	<label class="required">E-mail Address</label>
                                </td>
                                <td>
                                	<input class="fieldRequired" type="text" name="txtEmail">
                              </td>
                                <td>
                                    <a href="javascript:void(0)" id="go" class="buttongreen">Go</a>
                                </td>
                            </tr>
                            <tr id="trquestion">
                                <td>
                                </td>
                                <td>
                                    <label id="questionuser" style="font-size:12px"></label>
                                </td>
                                <td>
                                </td>
                            </tr>
                        	<tr id="transwer">
                            	<td align="right">
                                	<label class="required">Your answer</label>
                                </td>
                                <td>
                                	<input class="" type="text" value="" name="answeruser">
                                </td>
                                <td>
                                </td>
                            </tr>
                        	<tr id="trsupport">
                                <td colspan="3">
                                	<label style=" font-size:12px; color:#F00">For your enhanced security and privacy, we have created a secret <br>
                               	    security question. Please call our customer service for help. Thank you</label>
                                </td>
                            </tr>
                            <tr id="trnewpass">
                            	<td align="right">
                                	<label class="required">New Password</label>
                                </td>
                                <td>
                                	<input class="fieldRequired" type="password" value="" id="password" name="txtPassword">
                                </td>
                                <td>
                                </td>
                              </tr>
                            <tr id="trtext">
                            	<td colspan="3">
                                	<span class="noteRegister" id="passwordNote" style="font-size:09px">Must be at least 5 characters and contain a letter and a number</span>
                                </td>
                              </tr>
                              <tr id="trretype">
                            	<td align="right">
                                	<label class="required">Re-type Password</label>
                                </td>
                                <td>
                                	<input class="fieldRequired" type="password" id="re-password" name="txtPassword2">
                                </td>
                                <td>
                                </td>
                              </tr>
                              <tr id="trbtn">
                                    <td colspan="3" align="center">
                                     <div class="centertext">
                                                    <a href="javascript:void(0)" id="next" class="buttonblue bigButton">Next</a>
                                     </div>
                                    </td>
                               </tr>
                          </table>
                          <div class="clear"></div>
                     </form>
					</div>
              		</center>
                    <div class="clear10">&nbsp;</div>
                    <div class="lockScreen" id="lockScreen"></div>
                    <div class="MsglockScreen bold" id="MsglockScreen" style="display:none; color:#FF0000; font-size:12px" align="center">
                    	Processing...
                    </div>
                </div>
     		</div>
            
			<?//php require_once('resources/php/advertiser.php') ?>
            
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
<script language="javascript">
 menuClick('menu-login');
 $(document).ready(function (){
	/*inicio de validaciones*/
	validationRegister();
	$('.numberPhone input').unbind('blur');
	$('#next').bind('click',funciones.proccess)
	$('#go').bind('click',funciones.findUser);
	$('input[name=txtEmail]').bind('focus',funciones.initAll);
	correcto=true;
});
var funciones={
	initAll:function (){
			$('#go').fadeIn(200);
			$('#trPassword,#trquestion,#transwer,#trsupport,#trnewpass,#trtext,#trretype,#trbtn').hide();
		},
	findUser:function ()
		{
			if($('input[name=txtEmail]').val()=='')
				return false;
			$('#go').fadeOut(200);
			$.ajax({
				type	:'POST',
				data 	:'option=findData&email='+$('input[name=txtEmail]').val(),
				dataType:'json',
				url		:'resources/php/funcionesForgotPassword.php',
				success	: function (respuesta)
						{
							if(respuesta.success)
							{
								switch(respuesta.estado){
									case (1):
										$('#questionuser').html(respuesta.questionuser);
										$('#transwer input').addClass('fieldRequired');
										$('#trPassword,#trquestion,#transwer,#trnewpass,#trtext,#trretype,#trbtn').show();
										$('#MsglockScreen').hide();
									break;
									case (8):
										$('#trsupport').show();
									break;
									case (3):
										$('#MsglockScreen').html('Email not registered');
										$('#MsglockScreen').show();
										$('#go').fadeIn('FAST');
										
									break;
									default:
										$('#trPassword').show();
									}
							}
						}
				
				})
	},
	proccess:function ()
	{
		$('.fieldRequired').each(function (){
			$(this).trigger('blur');
			})
		if(correcto)
		{
			$('.lockScreen').fadeTo(100,0.5);
			$('.MsglockScreen').fadeIn();
			$.ajax({
				type	:'POST',
				data 	:'option=proccess&email='+$('input[name=txtEmail]').val()+'&answeruser='+$('input[name=answeruser]').val()+'&pass='+$('input[name=txtPassword]').val(),
				dataType:'json',
				url		:'resources/php/funcionesForgotPassword.php',
				success	: function (respuesta)
							{
								if(respuesta.success)
								{
									if(respuesta.estado==4){
										$('.MsglockScreen').html('Operation successfully');
										location.href='login.php';
									}
									else{
										$('.MsglockScreen').html('Invalid data');
									}
									$('.lockScreen, .MsglockScreen').delay(3000).fadeOut(250,function (){$('.MsglockScreen').html(' Processing...');});
									
								}
							}
					})
			}
		}
	}
	
</script>
<?//php require_once('classfooterhideshow.php') ?>