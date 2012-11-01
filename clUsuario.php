<?php

require_once "AuxDB.php";

// clase Usuario

class Usuario {
	
	private $UsuarioID;
	private $Email;
	private $Password;
	
	// Funciones de la clase Usuario
	function getUsuarioID() {
		return $this->UsuarioID;
	}
	function getEmail(){
		return $this->Email;
	}
	function getPassword() {
		return $this->Password;
	}
	
	function __Construct($Usu, $Ema, $Pas){
		
	 // Es el contructor del objeto Usuario
	$this->UsuarioID = $Usu;
	$this->Email = $Ema;
	$this->Password=$Pas;
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

	function leerUsuario($usuID) {
		$db = new AuxDB();
		$db->conectar();
		$sql = "SELECT * FROM Usuarios WHERE Usuario = '" . $usuID . "'";
		
		$rst = $db->ejecutarSQL($sql);
		$db->desconectar();
		
		$fila = $db->siguienteFila($rst);
		$this->UsuarioID = $usuID;
		$this->Email = $fila['Mail'];
		$this->Password = $fila['Password'];
	}
	
	// valida el Usuario.
	// correcto : retorna el nombre del usuario
	// formato falla : retorna 'error'
	// existe : retorna 'existe'
	function validarUsuario($usuario) {
		// miramos si el formato de $usuario es el correcto
		$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ ";
		$caracterKO = 0;
		if(strlen($usuario) < 5){
			return 'error';
		}
		else {
			for ($i=0; $i<strlen($usuario); $i++){
			    if (strpos($permitidos, substr($usuario,$i,1))===false) {
	 		   	  $caracterKO = 1;
	 		   	}
			}
		}
		if ($caracterKO == 1 || strlen($usuario) <= 4){
			return 'error';
		}
		// formato correcto
		// miramos si existe en la tabla Usuarios
		$db = new AuxDB();
		$db->conectar();

		$sql = "SELECT Usuario  from Usuarios where Usuario = '$usuario'";
		
		$res = $db->ejecutarSQL($sql);
		
		$fila = $db->siguienteFila($res);

		$db->desconectar();
		if ($fila) {
			return 'existe';
		}
		else {
			return $usuario;
		}
	}

	// Valida el Password del usuario
	// Correcto 		  : retorna el password del usuario
	// Falla longitud     : retorna error
	// Falla caracteres   : retorna carac
	// Falla pass1!=pass2 : retorna dif
	function validarPassword($pass1, $pass2) {
		//NO tiene minimo de 5 caracteres o mas de 12 caracteres
		if(strlen($pass1) < 5 || strlen($pass1) > 12)
			return 'long';
		// SI longitud, NO VALIDO numeros y letras
		else if(!preg_match("/^[0-9a-zA-Z]+$/", $pass1))
			return 'carac';
		// SI rellenado, SI password valido
			//NO coinciden
		if($pass1 != $pass2)
			return 'dif';
		else
			return $pass2;

	}


	// Valida el Email del usuario
	// Correcto 		  : retorna el email del usuario
	// Falla longitud     : retorna error
	function validarEmail($email, $email2){
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
  	 	if (!$mail_correcto) {
      		 return 'error'; 
		}
      	// miro que ya no exista el mail en la BDD
      	$db = new AuxDB();
      	$db->conectar();
		$sql = "SELECT Usuario FROM Usuarios  WHERE Mail = '$email2'";
		$rst = $db->ejecutarSQL($sql);

		if ($db->cantidadFilas($rst)>0){
			return 'existe';
		} else {
			$sql1 = "SELECT * FROM _temp where mail = '$email2'";
			$rst1 = $db->ejecutarSQL($sql1);
			if ($db->cantidadFilas($rst1)>0){
				return 'existe';
			} 
			else {
				if($email == $email2) {
					return $email2;
				} 
				else {
					return 'dif';
				}
			}
			
		}
	}


	// Inserta el usuario en la tabla _temp a la espera de ser validado
	function insertarUsuarioTemp() {
		$db=new AuxDB();
		$db->conectar();

		$clave = $this->generar_txtAct(20,false);
		global $url;
		$url = "activar.php?id=" . $clave;
		
		$sql="INSERT INTO _temp(usuario, mail, password,fechaAlta,txtActivacion)";
		$sql.=" VALUES ('" . mysql_escape_string($this->UsuarioID) . "', '";
		$sql.= mysql_escape_string($this->Email) . "', '";
		$sql.= md5(mysql_escape_string($this->Password)) ."','";
		$sql.= mysql_escape_string(CURDATE)."','";
		$sql.= mysql_escape_string($clave)."')";
		
		$db->ejecutarSQL($sql);
		$ret=0;
		if ($db) { //insercion correcta
			$ret=1;
		}
		$db->desconectar();
		return $ret;
	} 
}
?>