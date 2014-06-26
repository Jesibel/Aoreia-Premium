<?php
if(!isset($_COOKIE['datos_usr']['USERID']) ){
	echo "<script> document.location.href='index.php';</script>";
	return;
} 

if($_COOKIE[customerRegister])
{
	//prinf_r($_COOKIE['customerRegister']);
		foreach($_COOKIE[customerRegister] AS $key =>$value)
		{
			setcookie("customerRegister[$key]",false,time()-3600,'/');
		}
	unset($_COOKIE['customerRegister']);
}
require_once('resources/template/template.php');
require_once('properties_conexion.php');
conectar();

$titlebuy=($_COOKIE['datos_usr'] && !$_COOKIE['suspended'])?'Add Now':'Buy Now';
$urlBuy=($_COOKIE['datos_usr'] && !$_COOKIE['suspended'])?'http://www.reifax.com/settings/upgradeAccountTem.php':'http://www.reifax.com/register/customerRegister.php';

$query='SELECT p.idproducto,p.name,pb.precio2,pb.precio,p.descshort ,p.selected ,p.view
		FROM usr_producto p 
		INNER JOIN usr_productobase pb ON (p.idproducto=pb.idproducto)
		WHERE p.idproducto not in (select idproducto from usr_cobros c 
        INNER JOIN usr_productobase pbu ON pbu.idproductobase=c.idproductobase
        where c.userid='.$_COOKIE['datos_usr']['USERID'].'

    )   and pb.activo=1 AND p.selected=1';
$resul=mysql_query($query)  or die($query.mysql_error());
$arrprod=array();

while($row=mysql_fetch_assoc($resul)) 
{
	$sele=($row['view']==1)?'false':'true';
	$arrprod[]=array(	"selected"=>$sele,"annual"=>0,"idproducto"=>$row['idproducto'],"name"=>$row['name'],
						"view"=>$row['view'],"precio"=>$row['precio'],"precio2"=>$row['precio2'],"descshort"=>$row['descshort']);
}

$query='SELECT p.idproducto,p.name,pb.precio2,pb.precio,p.descshort ,p.selected ,p.view, f.name frecuency, c.idproductobase
			FROM usr_cobros c
				INNER JOIN usr_productobase pb ON pb.idproductobase=c.idproductobase 
				INNER JOIN usr_producto p  ON p.idproducto=pb.idproducto
				INNER JOIN frecuency f   ON  f.idfrecuency=c.idfrecuency
			WHERE c.userid='.$_COOKIE['datos_usr']['USERID'];//.' AND c.idstatus=3';
$resul=mysql_query($query)  or die($query.mysql_error());
$arrprodA=array();
while($row=mysql_fetch_assoc($resul)) 
{
	$row['selected']=($row['view']==1)?'false':'true';
	$row['annual']=0;
	$arrprodA[]=$row;
}



?>
<!DOCTYPE HTML>
<html>
<head>
    <?php AOREIAHead();?>
</head>
<body>

<div class="clear5">&nbsp;</div>
<div class="containermainfull" id="idcontainermainfull" style="margin:0 auto; text-align:center; width:1250px;  ">
	<div class="clear5">&nbsp;</div>
	<div class="containermain" style="float:left; ">
        <?php AOREIAHeader();?>

		<!-- YOU ARE HERE -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody textdarkblue textbold textsize14" style="text-align:left; float: left; "> 
			&nbsp;&nbsp;You are here: <a href="index.php"><span class="underline">Home</span></a> 
			/<span class="textorange">My Products</span>   
     	</div>
           <div class="contentbody" style="float:left;text-align:right; width:120px; ">
			<a id="sendvideohelp" href="videohelp.php" style="background:url('resources/img/Real-Estate-Investing-videohelpmini.png') no-repeat scroll 0 0 transparent; height:20px; width:100px; float:right;" >&nbsp;</a>            
     	</div>
        <!-- END YOU ARE HERE -->

		<!-- CONTENT BODY -->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody">
            <div class="boxleftside " style="width: 977px;">&nbsp;
                <div class="panelresaltaazul boxleftcontent bgwhite" style="width: 977px;">&nbsp; 
					<div class="centertext">  
                    	<span id="titlesignup" class=" textbold textdarkblue textsize22">My Products</span><hr/>
                        <!--<span class=" textbold textdarkblue textsize16">Choose the product that's best for your business</span>-->
                    </div>                    
               		<div class="clear10">&nbsp;</div>
                	<center>
                        <form id="loginForm" method="post" >
						<?php
                            $iw=1;
							$productsUser='';
                            foreach($arrprodA as $res)
                            {
                                if($res['view']==0) continue;
                                $lastcol=false;
                                if(($iw%2)==0 && $iw>0)$lastcol=true;
                        ?>
                                <div class="boxproducts ">
                                    <div class="panelp">
                                        <div class="center">  
                                            <span class="textbold textorange textsize16"><?php echo $res['name'] ?></span>
                                            <div style=" border-top: 1px solid #DDDDDD" class="centertext">
                                            <div  class="clear10">&nbsp;</div>
                                                <table>
                                                    <tbody><tr>
                                                        <td width="81"><img width="107" height="85" src="resources/img/products/Real-Estate-Investing-<?php echo $res['idproducto'] ?>banner1.png"></td>
                                                        <td height="38" class="lefttext">
                                                            <label>
                                                                    <span class="textdarkblue textbold textsize14">Frequency :<?php echo $res['frecuency']; ?> </span>
                                                            </label>
                                                            <br>
														 <label>
                                                                    <span class="textdarkblue textbold textsize12">
                                                                    Price: 
																	<?php 
																		if($res['idproducto']==3)
																		{
																			echo '<a class="textdarkblue textbold" href="contactus.php">ASK</a>';
																		}
																		else
																			echo ($res['precio']==0)?'FREE':(($res['frecuency']=='Monthly')?'$ '.$res['precio']:'$ '.number_format($res['precio']*10,2)); ?> </span>
                                                            </label>                                                            
                                                            <br>
                                                        </td> 
                                                    </tr>
                                                </tbody></table>
                                                <div class="clear5">&nbsp;</div>
                                                <?php 
												if($res['idproducto']<>1)//validacion de smith el free no se quita
												{ ?>
                                                <a href="#textprods" data-idproducto="<?php echo $res['idproducto'] ?>"  data-idproductobase="<?php echo $res['idproductobase'] ?>" class="buttonred deleteProduct" name="<?php echo $res['idproducto'] ?>&1">Cancel</a>
                                                <?php 
												}
												else echo "&nbsp;";
												?>
                                            </div>
                                        </div>
                                        <div class="clear10">&nbsp;</div>
                                  </div>
                                </div>
						<?php 
                                //echo ($lastcol==true)?'<div class="clear">&nbsp;</div><div class="clear">&nbsp;</div>':''; 
                                $iw++;
                            }
                        ?>
                        </form> 
                    </center>
               		<div class="clear10">&nbsp;</div>
                </div>

     		</div><div class="boxleftside " style="width: 700px;">&nbsp;
                <div class="panelresaltaazul boxleftcontent bgwhite" style="width: 680px;">&nbsp; 
					<div class="centertext">  
                    	<span id="titlesignup" class=" textbold textdarkblue textsize22">Add Products</span><hr/>
                        <!--<span class=" textbold textdarkblue textsize16">Choose the product that's best for your business</span>-->
                    </div>                    
               		<div class="clear10">&nbsp;</div>
               		<div class="clear10">&nbsp;</div>
                	<center>
                        <form id="loginForm" method="post" >
						<?php
                            $iw=1;
							if(count($arrprod)<1){
								echo '<center><h2>No products available</h2></center>';
							}
                            foreach($arrprod as $res)
                            {
                                if($res['view']==0) continue;
                                $lastcol=false;
                                if(($iw%2)==0 && $iw>0)$lastcol=true;
                        ?>
                                <div class="boxproducts ">
                                    <div class="panelp">
                                        <div class="center">  
                                            <span class="textbold textorange textsize16"><?php echo $res['name'] ?></span>
                                            <div style=" border-top: 1px solid #DDDDDD" class="centertext">
                                            <div  class="clear10">&nbsp;</div>
                                                <table>
                                                    <tbody><tr>
                                                        <td width="81"><img width="107" height="85" src="resources/img/products/Real-Estate-Investing-<?php echo $res['idproducto'] ?>banner1.png"></td>
                                                        <td height="38" class="lefttext">
                                                            <label>
                                                                <input type="radio" value="1" checked="true" id="rbp<?php echo $res['idproducto'] ?>" name="rbp<?php echo $res['idproducto'] ?>">
                                                                    <span class="textred textbold textsize14">$ <?php echo number_format($res['precio'],2); ?> Monthly</span>
                                                            </label>
                                                            <br>
														 <label>
                                                                <input type="radio" value="2" id="rbp<?php echo $res['idproducto'] ?>" name="rbp<?php echo $res['idproducto'] ?>">
                                                                    <span class="textdarkblue textbold textsize12">$ <?php echo number_format($res['precio']*10,2); ?> Annually</span>
                                                            </label>                                                            
                                                            <br>
                                                        </td> 
                                                    </tr>
                                                </tbody></table>
                                                <div class="clear5">&nbsp;</div>
                                                <table>
                                                	<tr>
                                                    	<td>
	                                                        <!--<a href="membership.php" class="buttonblue">&nbsp;More details&nbsp;</a>-->
                                                            <a href="membership.php"  style="background:url('resources/img/Real-Estate-Investing-bt_more_details.png') no-repeat scroll 0 0 transparent; height:30px; width:145px; float:right;" >&nbsp;</a>
                                                        </td>
                                                        <td>
                                                            <!--<a href="#textprods" rel="<?php echo $res['idproducto'] ?>" class="buttonorange " name="<?php echo $res['idproducto'] ?>&1">&nbsp;Add to cart&nbsp;</a>-->
                                                            <a href="#textprods" rel="<?php echo $res['idproducto'] ?>" name="<?php echo $res['idproducto'] ?>&1" style="background:url('resources/img/Real-Estate-Investing-bt_add_to_cart.png') no-repeat scroll 0 0 transparent; height:30px; width:145px; float:right;" class="buttonoranget">&nbsp;</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clear10">&nbsp;</div>
                                  </div>
                                </div>
						<?php 
                                echo ($lastcol==true)?'<div class="clear">&nbsp;</div><div class="clear">&nbsp;</div>':''; 
                                $iw++;
                            }
                        ?>
                        </form> 
                    </center>
               		<div class="clear10">&nbsp;</div>
                </div>

     		</div>
             
            <div class="boxrightside " style="padding: 2px;width:295px">&nbsp;
                        <div class="panelresaltaazul" style=" width:280px">
                           <center>  
								<div class="clear10">&nbsp;</div>
								<div class="clear10">&nbsp;</div>
                                <span class="textbold textdarkblue textsize22"> Shopping Cart</span><hr/>
                                <div class="centertext">
                                    <div name="divinvoice"></div>
                                    <div class="clear10">&nbsp;</div>
                                    <div name="divinvoicetotal"></div>
                                    <div class="clear">&nbsp;</div>
                                    <a  rel="7" style="background:url('resources/img/Real-Estate-Investing-bt_proceed_cheackout.png') no-repeat scroll 0 0 transparent; height:30px; width:230px; float:right;"  href="#textprods" onClick="procedeCkeckout()">&nbsp;</a>
                                </div>
                            	<div class="clear10">&nbsp;</div>
                            </center> 
                        </div>    

            </div> 
            
     	</div>
        <!-- END CONTENT BODY -->

		<?php AOREIAFooter();?>
        <!-- Advertising Classifieds footer Block-->
		<div class="clear5">&nbsp;</div>
        <div class="contentbody" id="idboxclassadvertisefooter">
            <?php include('classadvertise.php') ?> 
        </div>
        <!-- END Advertising Classifieds footer Block-->
        <div class="clear5">&nbsp;</div>
        
	</div>
    
	<!-- Advertising Classifieds Right Block-->
	<div class="boxrightside" id="idboxclassadvertiseright">
		<?php include('classadvertise.php') ?>
	</div>
	<!-- END Advertising Classifieds Right Block-->
	
    <div class="clear5">&nbsp;</div>
     
</div>
    <div id="winConfirmDelete">
    	<div>
            <center>
             <strong>sure you want to remove the product from your account?</strong>
            </center>
                <div class="clear10"> </div>
            <center>
                <a class="buttonblack" id="cancelDelete" href="#">cancel</a>
                <a class="buttonred" id="confirmDelete" href="#">Confirm</a>
            </center>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
	menuClick('menu-myaccount');
<?php
	echo 'var prods='.json_encode($arrprod).';';
	echo 'var u="'.$_COOKIE['datos_usr']['USERID'].'";';
?>
var totalpayment=pruductBDelete=pruductDelete=0;
$('input[type="radio"]').change(function (){
	linkload ();
});
$(document).ready(function(e) {
    $('#winConfirmDelete').windowFloat({
		   width	: 350,
		   height 	: 100
	})
	$('.deleteProduct').on('click',function (e){
		e.preventDefault();
		$('#winConfirmDelete').showWin();
		pruductDelete=$(this).attr('data-idproducto');
		pruductBDelete=$(this).attr('data-idproductobase');
	});
	$('#cancelDelete').on('click',function (e){
		e.preventDefault();
		$('#winConfirmDelete').hideWin();
	});
	$('#confirmDelete').on('click',function (e){
		$('#winConfirmDelete').hideWin();
		$.loadMask.show();
		$.ajax({
			url:'resources/php/funcionesMyProducts.php',
			data:{
				action:'delete',
				id:pruductDelete,
				idb:pruductBDelete
				},
			dataType:"json",
			type:'POST',
			success: function(res){
				if(res.success){
					$.loadMask.hide();
					$.Msg.alert.show({title:'Product successfully removed',close:function (){
							window.location.reload();
						}});
				}
			}
		});
		
	});
	
});


function linkload ()
{
	$(".buttonoranget").each(function (index){
		if($("input[name=rbp"+$(this).attr('rel')+"]:checked").val())
		{
			var rb= $("input[name=rbp"+$(this).attr('rel')+"]:checked").val();
		}
		var complemento=$(this).attr('rel')+'&'+rb;
		$(this).attr('name',complemento);
	 });
}
linkload ();


$(" .buttonoranget").click(function (){
	var p=$(this).attr('name').split('&')[0];
	var f=$(this).attr('name').split('&')[1];
	selectItem(p,'true',f);			
});

function deleteItem(imgp){
	selectItem($(imgp).attr('rel'),'false',1);			
}
				
function selectItem(pr,check,fr){
	if(pr==1 || pr==2 || pr==3)
	{
		prods[0].selected='false';
	}

	for (var i=0; i<prods.length; i++){
		if(prods[i].idproducto==pr)
		{
			if(pr==2)
			{
				prods[0].selected='true';
			}
			prods[i].selected=check;
			prods[i].annual=(fr==1)?0:1;
		}
	}	
	refreshInvoice()
}

function refreshInvoice(){
	var vis,dis,imgdel,precio,aux=0;total=0;
	var cadhtml='<table >';
	for (var i=0; i<prods.length; i++){
		if(prods[i].selected=='true' )
		{
			if(prods[i].precio==0)
			{
				precio='FREE';
				imgdel='&nbsp;&nbsp;';
			}
			else
			{
				aux=prods[i].precio*1;
				if(prods[i].annual==1)aux=aux*10;
				if(prods[i].annual==1 && prods[i].precio2>0)aux=prods[i].precio2*1;
				if(prods[i].idproducto==3)aux=prods[i].precio*1;
				
				total+=aux;
				precio='$ '+aux.toFixed(2);
				imgdel='<a  href="#textprods"  title="Delete item" onClick="deleteItem(this)" rel="'+prods[i].idproducto+'">'+
						'<img src="resources/img/Real-Estate-Investing-trash.png" border="0" height="20px" /></a>';
			}
			
			//cadhtml+='<tr id="fact'+prods[i].idproducto+'" name="fact'+prods[i].idproducto+'" style="visibility: '+vis+'; display: '+dis+';">';
			cadhtml+='<tr>';
			cadhtml+='	<td style="text-align:left" width="170px">'+
						'<span class="textdarkblue textbold textsize12">'+prods[i].name+'</span></td>';
			cadhtml+='	<td style="text-align:right" width="80px"><span class="textred textbold textsize12">'+precio+'</span></td>';
			cadhtml+='	<td style="text-align:right" width="20px">'+imgdel+'</td>';
			cadhtml+='</tr>';
		}
	}	
	cadhtml+='</table >';

	$('div[name=divinvoice]').html(cadhtml);

	totalpayment=total;
	cadhtml='<table >'+
			'	<tr>'+
         	'		<td style="text-align:right" width="165px"><span class="textdarkblue textbold textsize12">Total payment</span></td>'+
         	'		<td style="text-align:right" width="70px"><span class="textred textbold textsize12">$ '+addCommas(total.toFixed(2))+'</span></td>'+
         	'		<td style="text-align:right" width="20px">&nbsp;&nbsp;</td>'+
         	'	</tr>'+
         	'</table>';
	$('div[name=divinvoicetotal]').html(cadhtml);	
}
refreshInvoice();

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

$('#loginbutton2').bind('click',function (e){
	e.preventDefault()
	$('#loginForm3').trigger('submit');
});

function procedeCkeckout()
{
	if(totalpayment==0)return;		

	location.href='proccesAddProduct.php?from=windows&a='+	
				'&d='+RtBase64Register.encode( totalpayment.toString() )+
				'&e='+RtBase64Register.encode( getprod());

}

$('#closebutton').bind('click',function (e){
	$('#ventanalogueo').fadeOut('slow');
	$('.lockScreen').fadeOut('fast');
});

</script>
<?php require_once('classfooterhideshow.php') ?>