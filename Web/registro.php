<?php
include('funciones/funciones.php');
   // error_reporting(E_ALL);
    //ini_set("display_errors", 1);

//Comprobacion de datos
//variables valores por defecto
$condiciones = "";
$name = "";
$nameValue = "";
$username = "";
$usernameValue = "";
$password1 = "";
$password2 = "";
$passwordValue = "";
$email1 = "";
$emailValue = "";
$existusername = "";
$existEmail = "";

$existeU = 0;
$existeE = 0;


//Validacion de datos enviados
if(isset($_POST['send'])){
	
	if(empty($_POST['condiciones']))
		$condiciones = "error";
	
	if(!validateName($_POST['name']))
		$name = "error";
	//if(!validateUsername($_POST['username']))
	//	$username = "error";
	if(!validateExistUsername($_POST['username']))
		$existusername = "error";
	if(!validatePassword1($_POST['password1']))
		$password1 = "error";
	if(!validatePassword2($_POST['password1'], $_POST['password2']))
		$password2 = "error";
	if(!validateEmail($_POST['email']))
		$email1 = "error";
	if(!validateExistMail($_POST['email']))
		$existEmail = "error";
	if(!validateEmail2($_POST['email'], $_POST['email2']))
		$email2 = "error";	
	//Guardamos valores para que no tenga que reescribirlos
	$nameValue = $_POST['name'];
	$usernameValue = $_POST['email'];
	$emailValue = $_POST['email'];
	$passwordValue = $_POST['password2'];
	
	
	//Comprobamos si todo ha ido bien
	//if($name != "error" && $username != "error" && $password1 != "error" && $password2 != "error" && $email1 != "error"){	
	if($name != "error" && $email2 != "error" && $password1 != "error" && $password2 != "error" && $email1 != "error" && $condiciones != "error"){	
		//if($existusername == "error"){
		//	$existeU = 1;	
		//}
		if($existEmail == "error"){
			$existeE = 1;	
		}
		if (!$existeU && !$existeE){
			$status = 1;
		}
	}
		
		
}


?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Formulario de registro en iBarco</title>
    <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>
<body>
	<div class="wrapper">	
		<div class="section">
			<?php if(!isset($status)): ?>

  	<div class="contenido">	
    			<span style="color:#77933C; font-size:14px;"><B>Regístrate</B></span> y crea tu usuario para sacar más provecho a la aplicación.
               
<form id="formulario" name="formulario" action="registro.php" method="post">
<div id="cajaregistro">
<table align="left" width="98%" cellspacing="2" cellpadding="2" border="0">

<tr>
<td  class="campoReg" colspan="2"><span class="etiquetacampoInicio">Nombre de usuario</span><?php if ($name == "error"): echo "<span style=color:red>"; else: echo "<span style=color:#A0A0A4;>"; endif; ?>&nbsp;&nbsp;&nbsp;(Mínimo 5 caracteres)</span>
  <br /><input tabindex="1" name="name" id="name" type="text"  size="84" maxlength="84" class="textinicio <?php echo $name ?>" value="<?php echo $nameValue ?>" /><br />
  </td>
</tr>

<tr>
<td class="campoReg">
	<span class="etiquetacampoInicio">correo-e</span>
					<?php 
						if ($email1 == "error" || $existEmail == "error"): 
							if ($existEmail == "error"):
								echo "<span style=color:red>&nbsp;&nbsp;&nbsp;(El correo-e " . $emailValue . " ya existe)"; 
							else:
								echo "<span style=color:red>&nbsp;&nbsp;&nbsp;(Escribe un correo-e válido por favor)";
							endif; 
						else:
							echo "<span style=color:#A0A0A4;>&nbsp;&nbsp;&nbsp;(Escribe un correo-e válido por favor)</span>";
						endif; ?>
             <br />	<input tabindex="2" name="email" id="email" type="text"  size="39" maxlength="39" class="textinicio <?php echo $email1 ?>" value="<?php echo $emailValue ?>" /></td>
<td class="campoReg"><span class="etiquetacampoInicio">Repetir correo-e</span>
<?php if ($email2 == "error"): echo "<span style=color:red>"; else: echo "<span style=color:#A0A0A4;>"; endif; ?>&nbsp;&nbsp;&nbsp;(Debe ser igual al anterior)</span><br /><input tabindex="3" name="email2" id="email2" type="text"  size="39" maxlength="39" class="textinicio <?php echo $email2 ?>" value="" /></td>
</tr>


<tr>
<td class="campoReg"><span class="etiquetacampoInicio">Contraseña</span><?php if ($password1 == "error"): echo "<span style=color:red>"; else: echo "<span style=color:#A0A0A4;>"; endif; ?>&nbsp;&nbsp;&nbsp;(5 - 12 caracteres, letras y números)</span><br /><input tabindex="3" name="password1" id="password1" type="password"  size="20" maxlength="12" class="textinicio <?php echo $password1 ?>" value="" /></td>

<td class="campoReg"><span class="etiquetacampoInicio">Repetir Contraseña</span><?php if ($password2 == "error"): echo "<span style=color:red>"; else: echo "<span style=color:#A0A0A4;>"; endif; ?>&nbsp;&nbsp;&nbsp;(Debe ser igual a la anterior)</span><br /><input tabindex="4" name="password2" id="password2" type="password"  size="20" maxlength="12" class="textinicio <?php echo $password2 ?>" value="" /></td>
</tr>

<tr>
<td align="left" colspan="2"><input type="checkbox" name="condiciones" id="condiciones" <?php if(isset($_POST["condiciones"])) {echo "checked";} ?>/><a href="/index.php?option=com_content&view=article&id=74" target="_new" class="enlaceCondiciones">
<?php if ($condiciones == "error"): echo "<span style=color:red>"; else: echo "<span style=color:#003580;>"; endif; ?>He le&iacute;do y acepto las condiciones Pol&iacute;tica de Privacidad</span></a></td>
</tr>


<tr>
<td align="left"><br /><a href="index.html" class="enlaceregistro">Volver</a></td>

<td align="right"><br /><input tabindex="6" name="send" id="send" type="submit" class="botonacceso" value="Registrar" /></td>
</tr>

</table>
</div>

</form>
</div>
			<?php else: ?>
				<?php 
					if(insertarReg($nameValue, $usernameValue, md5($passwordValue), $emailValue)):?>
               <div class="contenido">
               			
                    <div id="cajaregistrocorrecto">
                   <span style="color:#77933C; font-size:14px;"><B>Te has registrado correctamente.</B></span>
						<div class="respuesta_insert">
						<p>Gracias por registrarte en <span style="color:#77933C; font-size:14px;"><B>iBarco.</B></span></p>
						<p>Te hemos enviado un correo a <span style="color:#77933C"><?php echo $emailValue; ?></span> para que confirmes el alta. Si no lo recibes comprueba la bandeja de correo no deseado.</p>
						<p>Gracias.</p>
						
						<span style="text-align:right"><a href="index.html" class="enlaceregistro">Ir al formulario de acceso</a></span>
                           
            </div>
						</div>
                       
						</div>
						<?php mailActivacion($emailValue, $nameValue, $url); ?>

						<!-- 
						<div style="font-color: red">
						<ul>
								<li>Name: <?php $nameValue; ?></li>
								<li>Username: <?php $usernameValue; ?></li>
								<li>Password: <?php $passwordValue; ?></li>
								<li>Email: <?php $emailValue; ?></li>
						</ul> -->
				<?php else: ?>
						<?php if ($respuesta == 1) ?>
						<span style="font-color: red">No se ha podido insertar el registro en nuestra base de datos</span>
				<!--<h1>¡Formulario enviado con éxito!</h1>-->
				<?php endif; ?>
			<?php endif; ?>
		</div>
        </div>
	</div>
</body>
</html>
