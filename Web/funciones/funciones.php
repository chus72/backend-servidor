<?php
//include("conex.php"); //funciones o clases de conexión a la base de datos
function mailActivacion($dir_correo, $usuario, $enlace){
	$dominio = "http://dominio que tendremos que dar de alta (www.ibarco.com, por ejemplo)";
	$destinatario = $dir_correo; 
	$asunto = "iBarco. Activación de usuario"; 
	$cuerpo = ' 
			<html> 
				<head> 
   				<title>iBarco - Activar usuario</title> 
				</head> 
				<body> 
					Hola ';
	$cuerpo .= $usuario;
	$cuerpo .= '<p>Gracias por adquirir y registrarte en la aplicación <b>iBarco</b>.</p>
			<p>Para completar el registro tienes que confirmar que has recibido el e-mail en el siguiente enlace:</p>
			<p style=text-align:center><a href=';
	$cuerpo .= $dominio . $enlace;
	$cuerpo .= " target=_blank>Activa tu usuario</a></p></body></html>";
	$cuerpo .= "<br><br><br>";
	$cuerpo .= "Si tu correo no te permite ejecutarlo, copia y pega en tu navegador la siguiente dirección:<br>";
	$cuerpo .= $dominio . $enlace;
	$cuerpo .= "</body></html>";
	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	//dirección del remitente 
	$headers .= "From: iBarco <nombre@ibarco.com>\r\n";  //Hay que configurar un usario de correo
	//dirección de respuesta, si queremos que sea distinta que la del remitente 
	$headers .= "Reply-To: nombre@ibarco.com\r\n"; 
	//ruta del mensaje desde origen a destino 
	//$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 	
	//direcciones que recibián copia 
	//$headers .= "Cc: otra@ibarco.com\r\n"; 
	//direcciones que recibirán copia oculta 
	//$headers .= "Bcc: otra@ibarco.com\r\n"; 
	//En localhost el envío de e-mail a veces no funciona, hay que configurar algunas cosas.
	mail($destinatario,$asunto,$cuerpo,$headers);
}

function generar_txtAct($longitud,$especiales){ 
		// Array con los valores a escojer
        $semilla = array(); 
        $semilla[] = array('a','e','i','o','u');  
        $semilla[] = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z'); 
        $semilla[] = array('0','1','2','3','4','5','6','7','8','9'); 
        $semilla[] = array('A','E','I','O','U');  
        $semilla[] = array('B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z'); 
        $semilla[] = array('0','1','2','3','4','5','6','7','8','9'); 
        // si puede contener caracteres especiales, aumentamos el array $semilla 
        if ($especiales) { $semilla[] = array('$','#','%','&','@','-','?','¿','!','¡','+','-','*'); } 
        // creamos la clave con la longitud indicada 
			    for ($bucle=0; $bucle < $longitud; $bucle++)  
			    { 
			        // seleccionamos un subarray al azar 
			        $valor = mt_rand(0, count($semilla)-1); 
			        // selecccionamos una posicion al azar dentro del subarray 
			        $posicion = mt_rand(0,count($semilla[$valor])-1); 
			        // cojemos el caracter y lo agregamos a la clave 
			        $clave .= $semilla[$valor][$posicion]; 
			        } 
			        // devolvemos la clave 
			        return $clave; 
}

//FUNCION PARA INSERTAR EL REGISTRO EN LA TABLA users_temp
function insertarReg($name_, $username_, $password1_, $email_){
		//Declaramos esta variable global, para poder usarla en toda la aplicación
		global $url;
		//LLamar a la función para generar el texto aleatorio para Activar Usuario.
		//Le pasamos como parámetro los caracteres que queremos generar y si los queremos especiales o no
		$clave = generar_txtAct(20,false);
		//Montamos la estructura del enlace con la clave.
		$url = "activar.php?id=" . $clave;
	 	$link=Conectarse(); 
				//////////$sdb = "empleopruebas";
				//////////mysql_select_db($sdb,$link); 
		
		$inserta= "insert into users_temp (nombre,usersTemp,password,email,fecAlta,txt_Activ) values ('$name_','$username_','$password1_','$email_',CURDATE(),'$clave')";
		$resultado3=mysql_query($inserta,$link) or die (mysql_error());
	
		if (!$resultado3)
    	return false;
		else
			return true;
}

//Función para validar el formato del NOMBRE
function validateName($name){
$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ ";
	$caracter1KO = 0;
	if(strlen($name) < 5):
		return false;
	else:
	for ($i=0; $i<strlen($name); $i++){ 
	      if (strpos($permitidos, substr($name,$i,1))===false){ 
	         $caracter1KO = 1;
	 			} 
	}
	endif;
	if ($caracter1KO == 1 || strlen($name) <= 4):
		return false;
	else:
		return true;
	endif;
}

//Función para validar el formato del NOMBRE DE USUARIO
function validateUsername($username){
	$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ ";
	$caracterKO = 0;
	if(strlen($username) < 5):
		return false;
	else:
	for ($i=0; $i<strlen($username); $i++){ 
	      if (strpos($permitidos, substr($username,$i,1))===false){ 
	         $caracterKO = 1;
	 			} 
	}
	endif;
	if ($caracterKO == 1 || strlen($username) <= 4):
		return false;
	else:
		return true;
	endif;
}

//Función para validar si existe el Nombre de Usuario
function validateExistUsername($username){
		$link=Conectarse();
		$consulta= "select usersTemp from users_temp where usersTemp = '$username'";
		$resultado=mysql_query($consulta,$link) or die (mysql_error());
		
		if (mysql_num_rows($resultado)>0){
			return false;
		} else {
			$consulta0= "select * from usuarios where usuario = '$username'";
			$resultado0=mysql_query($consulta0,$link) or die (mysql_error());
			if (mysql_num_rows($resultado0)>0){
			return false;
				} else {		
				return true;
			}	
		}
}

//Función para validar la contraseña
function validatePassword1($password1){
	//NO tiene minimo de 5 caracteres o mas de 12 caracteres
	if(strlen($password1) < 5 || strlen($password1) > 12)
		return false;
	// SI longitud, NO VALIDO numeros y letras
	else if(!preg_match("/^[0-9a-zA-Z]+$/", $password1))
		return false;
	// SI rellenado, SI email valido
	else
		return true;
}
//Función para validar la igualdad de las contraseñas
function validatePassword2($password1, $password2){
	//NO coinciden
	if($password1 != $password2)
		return false;
	else
		return true;
}
//Función para validar la contraseña Actual
function validatePasswordActual($password, $idUsuario){
	$clave = md5($password);
	$link2=Conectarse();
	$result2 = mysql_query("select * from usuarios where id_usuario=$idUsuario" ,$link2); 
	while($row = mysql_fetch_array($result2)){
		$claveActual = $row["password"] ;
	}
  	mysql_free_result($result2);
	mysql_close($link2); 
   
   if($clave != $claveActual){
		return false;
		//return $claveActual . " - " . $clave;
   } else {
		return true;		
		//return $claveActual . " - " . $clave;
	 }
}
//
function validatePasswordActualAdmin($password, $idAdmin){
	$clave = md5($password);
	$link2=Conectarse();
	$result2 = mysql_query("select * from admin where id_admin=$idAdmin" ,$link2); 
	while($row = mysql_fetch_array($result2)){
		$claveActual = $row["password"] ;
	}
  	mysql_free_result($result2);
	mysql_close($link2); 
   
   if($clave != $claveActual){
		return false;
		//return $claveActual . " - " . $clave;
   } else {
		return true;		
		//return $claveActual . " - " . $clave;
	 }
}




//Función para validar la igualdad de los correos
function validateEMail2($email1, $email2){
	//NO coinciden
	if($email1 != $email2)
		return false;
	else
		return true;
}


//Función para validar la dirección de correo
function validateEmail($email){
	$mail_correcto = 0;
if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
     if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
         	 //miro si tiene caracter . 
         	 if (substr_count($email,".")>= 1){ 
            	 //obtengo la terminacion del dominio 
            	 $term_dom = substr(strrchr ($email, '.'),1); 
            	 //compruebo que la terminación del dominio sea correcta 
            	 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
               	 //compruebo que lo de antes del dominio sea correcto 
               	 $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
               	 $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
               	 if ($caracter_ult != "@" && $caracter_ult != "."){ 
                  	 $mail_correcto = 1; 
               	 } 
            	 } 
         	 } 
      	 } 
   	} 
   	if ($mail_correcto) 
      	 return true; 
   	else 
      	 return false; 
} 

//Función para validar si existe la dirección de correo
function validateExistMail($mail){
		$link=Conectarse(); 
				//////////$sdb = "empleopruebas";
				//////////mysql_select_db($sdb,$link); 
		
		$consulta2= "select id_usersTemp from users_temp where email = '$mail'";
		$resultado2=mysql_query($consulta2,$link) or die (mysql_error());

		if (mysql_num_rows($resultado2)>0){
			return false;
		} else {
			$consulta21= "select * from usuarios where email = '$mail'";
			$resultado21=mysql_query($consulta21,$link) or die (mysql_error());
				if (mysql_num_rows($resultado21)>0){
					return false;
				} else {
					return true;
				}
		}
}



//Palabra aleatoria o creador de nombres aleatorios
function construir_clave($min, $max){
        $vocales = array("a", "e", "i", "o", "u");
        $consonantes = array("b", "c", "d", "f", "g", "j", "l", "m", "n", "p", "r", "s", "t");
        $random_nombre = rand($min, $max);//largo de la palabra
        $random = rand(0,1);//si empieza por vocal o consonante
		$nombre = "";
        for($j=0;$j<$random_nombre;$j++){//palabra
                switch($random){
                        case 0: $random_vocales = rand(0, count($vocales)-1); $nombre.= $vocales[$random_vocales]; $random = 1; break;
                        case 1: $random_consonantes = rand(0, count($consonantes)-1); $nombre.= $consonantes[$random_consonantes]; $random = 0; break;
                }
        }
        return $nombre;
}


//Correo de cambio de contraseña
function mailContrasenna($usuario, $clave){
	$dominio = "http://dominio que tendremos que dar de alta (www.ibarco.com, por ejemplo)";
	$destinatario = $usuario; 
	$asunto = "iBarco - Cambio de contraseña"; 
	$cuerpo = ' 
			<html> 
				<head> 
   				<title>iBarco - Cambio de contraseña</title> 
				</head> 
				<body> 
					Hola ';
	$cuerpo .= $usuario;
	$cuerpo .= '<p>Ha solictado una nueva contraseña para acceder como usaurio de <b>"iBarco"</b>.</p>
			<p>Una vez que consiga acceder, podrá restituir la misma al valor que desee.</p>';
	$cuerpo .= "Su nueva contraseña es: ";
	$cuerpo .= "<b>" . $clave . "</b>";
	$cuerpo .= "<br><br>";
	$cuerpo .= "</body></html>";
	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	//dirección del remitente 
	$headers .= "From: iBarco <nombre@ibarco.com>\r\n"; 
	//dirección de respuesta, si queremos que sea distinta que la del remitente 
	$headers .= "Reply-To: nombre@ibarco.com\r\n"; 
	//ruta del mensaje desde origen a destino 
	//$headers .= "Return-path: holahola@ibarco.com\r\n"; 	
	//direcciones que recibián copia 
	//$headers .= "Cc: maria@ibarco.com\r\n"; 
	//direcciones que recibirán copia oculta 
	//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
	//En localhost el envío de e-mail a veces no funciona, hay que configurar algunas cosas.
	mail($destinatario,$asunto,$cuerpo,$headers);
}


//Función actualizar clave
function actualizaClave($valor, $idusuario ){
		$clave = md5($valor);
		$link=Conectarse(); 
		$sql = "update usuarios set password='" .$clave."' where id_usuario='" . $idusuario . "'"; 
		mysql_query($sql ,$link); 
		
		return true;
}
function actualizaClaveAdmin($valor, $idadmin ){
		$clave = md5($valor);
		$link=Conectarse(); 
		$sql = "update admin set password='" .$clave."' where id_admin='" . $idadmin . "'"; 
		mysql_query($sql ,$link); 
		
		return true;
}

?>