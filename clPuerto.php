<?php

require_once "AuxDB.php";
$url = '';
$clave = '';

// clase Puerto

class Puerto {
	
	private $puerto_ID;
	private $puerto_Nombre;
	private $puerto_Latitud;
	private $puerto_Longitud;
	private $puerto_Direccion;
	private $puerto_Poblacion;
	private $puerto_CP;
	private $puerto_Provincia;
	private $puerto_Telefono;
	private $puerto_Fax;
	private $puerto_Www;
	private $puerto_Email;
	private $puerto_Calado_Min;
	private $puerto_Eslora_Max;
	private $puerto_Namarres;
	private $puerto_CanalVhf;
	private $puerto_Serv_Agua;
	private $puerto_Serv_Electricidad;
	private $puerto_Serv_Gasolina;
	private $puerto_Serv_Grua;
	private $puerto_Serv_Travelling;
	private $puerto_Serv_Rampa;
	private $puerto_Serv_Taller;
	private $puerto_Serv_MuelleEspera;
	private $puerto_Serv_Bar;
	private $puerto_Serv_Restaurante;
	private $puerto_Serv_Supermercado;
	private $puerto_Serv_Hielo;
	private $puerto_Serv_RecogidaAceites;
	private $puerto_Serv_RecogidaBasuras;
	private $puerto_Serv_AguasNegras;
	private $puerto_Serv_Farmacia;
	private $puerto_Serv_Medico;
	private $puerto_Serv_Meteo;
	private $puerto_Serv_Banco;
	private $puerto_Serv_AlquilerCoches;
	private $puerto_Otros;
	private $puerto_Descripcion;

	
	// Funciones de la clase Puerto
	function getPuertoID() {
		return $this->puerto_ID;
	}
	function getPuertoNombre(){
		return $this->puerto_Nombre;
	}
	function getPuertoLatitud() {
		return $this->puerto_Latitud;
	}
	function getPuertoLongitud() {
		return $this->puerto_Longitud;
	}
	function getPuertoDireccion() {
		return $this->puerto_Direccion;
	}
	function getPuertoPoblacion() {
		return $this->puerto_Poblacion;
	}
	function getPuertoCP() {
		return $this->puerto_CP;
	}
	function getPuertoProvincia() {
		return $this->puerto_Provincia;
	}
	function getPuertoTelefono() {
		return $this->puerto_Telefono;
	}
	function getPuertoFax() {
		return $this->puerto_Fax;
	}
	function getPuertoWww() {
		return $this->puerto_Www;
	}
	function getPuertoEmail() {
		return $this->puerto_Email;
	}
	function getPuertoCaladoMin() {
		return $this->puerto_Calado_Min;
	}
	function getPuertoEslora() {
		return $this->puerto_Eslora_Max;
	}
	function getPuertoNAmarres() {
		return $this->puerto_Namarres;
	}
	function getPuertoCanalVHF() {
		return $this->puerto_CanalVhf;
	}
	function getPuertoServ_Agua() {
		return $this->puerto_Serv_Agua;
	}
	function getPuertoServ_Electricidad() {
		return $this->puerto_Serv_Electricidad;
	}
	function getPuertoServ_Gasolina() {
		return $this->puerto_Serv_Gasolina;
	}
	function getPuertoServ_Grua() {
		return $this->puerto_Serv_Grua;
	}
	function getPuertoServ_Travelling() {
		return $this->puerto_Serv_Travelling;
	}
	function getPuertoServ_Rampa() {
		return $this->puerto_Serv_Rampa;
	}
	function getPuertoServ_Taller() {
		return $this->puerto_Serv_Taller;
	}
	function getPuertoServ_MuelleEspera() {
		return $this->puerto_Serv_MuelleEspera;
	}
	function getPuertoServ_Bar() {
		return $this->puerto_Serv_Bar;
	}
	function getPuertoServ_Restaurante() {
		return $this->puerto_Serv_Restaurante;
	}
	function getPuertoServ_Supermercado() {
		return $this->puerto_Serv_Supermercado;
	}
	function getPuertoServ_Hielo() {
		return $this->puerto_Serv_Hielo;
	}
	function getPuertoServ_RecogidaAceites() {
		return $this->puerto_Serv_RecogidaAceites;
	}
	function getPuertoServ_RecogidaBasuras() {
		return $this->puerto_Serv_RecogidaBasuras;
	}
	function getPuertoServ_AguasNegras() {
		return $this->puerto_Serv_AguasNegras;
	}
	function getPuertoServ_Farmacia() {
		return $this->puerto_Serv_Farmacia;
	}
	function getPuertoServ_Medico() {
		return $this->puerto_Serv_Medico;
	}
	function getPuertoServ_Meteo() {
		return $this->puerto_Serv_Meteo;
	}
	function getPuertoServ_Banco() {
		return $this->puerto_Serv_Banco;
	}
	function getPuertoServ_AlquilerCoche() {
		return $this->puerto_Serv_AlquilerCoches;
	}
	function getPuertoOtros() {
		return $this->puerto_Otros;
	}
	function getPuertoDescripcion() {
		return $this->puerto_Descripcion;
	}





	//Constructor objeto Puerto
	function __Construct($puertoNombre, $puertoLatitud, $puertoLongitud, $puertoDireccion, $puertoPoblacion, $puertoCP, $puertoProvincia, $puertoTelefono, $puertoFax, $puertoWww, $puertoEmail, $puertoCalado_Min, $puertoEslora_Max, $puertoNamarres, $puertoCanalVhf, $puertoServ_Agua, $puertoServ_Electricidad, $puertoServ_Gasolina, $puertoServ_Grua, $puertoServ_Travelling, $puertoServ_Rampa, $puertoServ_Taller, $puertoServ_MuelleEspera, $puertoServ_Bar, $puertoServ_Restaurante, $puertoServ_Supermercado, $puertoServ_Hielo, $puertoServ_RecogidaAceites, $puertoServ_RecogidaBasuras, $puertoServ_AguasNegras, $puertoServ_Farmacia, $puertoServ_Medico, $puertoServ_Meteo, $puertoServ_Banco, $puertoServ_AlquilerCoches, $puertoOtros, $puertoDescripcion){

		$this-> $puerto_Nombre = $puertoNombre;
		$this-> $puerto_Latitud = $puertoLatitud;
		$this-> $puerto_Longitud = $puertoLongitud;
		$this-> $puerto_Direccion = $puertoDireccion;
		$this-> $puerto_Poblacion = $puertoPoblacion;
		$this-> $puerto_CP = $puertoCP;
		$this-> $puerto_Provincia = $puertoProvincia;
		$this-> $puerto_Telefono = $puertoTelefono;
		$this-> $puerto_Fax = $puertoFax;
		$this-> $puerto_Www = $puertoWww;
		$this-> $puerto_Email = $puertoEmail;
		$this-> $puerto_Calado_Min = $puertoCalado_Min;
		$this-> $puerto_Eslora_Max = $puertoEslora_Max;
		$this-> $puerto_Namarres = $puertoNamarres;
		$this-> $puerto_CanalVhf = $puertoCanalVhf;
		$this-> $puerto_Serv_Agua = $puertoServ_Agua;
		$this-> $puerto_Serv_Electricidad = $puertoServ_Electricidad;
		$this-> $puerto_Serv_Gasolina = $puertoServ_Gasolina;
		$this-> $puerto_Serv_Grua = $puertoServ_Grua;
		$this-> $puerto_Serv_Travelling = $puertoServ_Travelling;
		$this-> $puerto_Serv_Rampa = $puertoServ_Rampa;
		$this-> $puerto_Serv_Taller = $puertoServ_Taller;
		$this-> $puerto_Serv_MuelleEspera = $puertoServ_MuelleEspera;
		$this-> $puerto_Serv_Bar = $puertoServ_Bar;
		$this-> $puerto_Serv_Restaurante = $puertoServ_Restaurante;
		$this-> $puerto_Serv_Supermercado = $puertoServ_Supermercado;
		$this-> $puerto_Serv_Hielo = $puertoServ_Hielo;
		$this-> $puerto_Serv_RecogidaAceites = $puertoServ_RecogidaAceites;
		$this-> $puerto_Serv_RecogidaBasuras = $puertoServ_RecogidaBasuras;
		$this-> $puerto_Serv_AguasNegras = $puertoServ_AguasNegras;
		$this-> $puerto_Serv_Farmacia = $puertoServ_Farmacia;
		$this-> $puerto_Serv_Medico = $puertoServ_Medico;
		$this-> $puerto_Serv_Meteo = $puertoServ_Meteo;
		$this-> $puerto_Serv_Banco = $puertoServ_Banco;
		$this-> $puerto_Serv_AlquilerCoches = $puertoServ_AlquilerCoches;
		$this-> $puerto_Otros = $puertoOtros;
		$this-> $puerto_Descripcion = $puertoDescripcion;

	}


	function leerPuerto($PuertoNombre) {
		$db = new AuxDB();
		$db->conectar();
		$sql = "SELECT * FROM Puertos WHERE nombre = '" . $PuertoNombre . "'";

		$rst = $db->ejecutarSQL($sql);
		$db->desconectar();

		$fila = $db->siguienteFila($rst);
		
		$this-> $puerto_Nombre = $PuertoNombre;
		$this-> $puerto_Latitud = $fila['latitud'];
		$this-> $puerto_Longitud = $fila['longitud'];
		$this-> $puerto_Direccion = $fila['dir_direccion'];
		$this-> $puerto_Poblacion = $fila['dir_poblacion'];
		$this-> $puerto_CP = $fila['dir_codigopostal'];
		$this-> $puerto_Provincia = $fila['dir_provincia'];
		$this-> $puerto_Telefono = $fila['telefono'];
		$this-> $puerto_Fax = $fila['fax'];
		$this-> $puerto_Www = $fila['www'];
		$this-> $puerto_Email = $fila['email'];
		$this-> $puerto_Calado_Min = $fila['calado_min'];
		$this-> $puerto_Eslora_Max = $fila['eslora_max'];
		$this-> $puerto_Namarres = $fila['namarres'];
		$this-> $puerto_CanalVhf = $fila['canalVhf'];
		$this-> $puerto_Serv_Agua = $fila['serv_agua'];
		$this-> $puerto_Serv_Electricidad = $fila['serv_electricidad'];
		$this-> $puerto_Serv_Gasolina = $fila['serv_gasolina'];
		$this-> $puerto_Serv_Grua = $fila['serv_grua'];
		$this-> $puerto_Serv_Travelling = $fila['serv_travelling'];
		$this-> $puerto_Serv_Rampa = $fila['serv_rampa'];
		$this-> $puerto_Serv_Taller = $fila['serv_taller'];
		$this-> $puerto_Serv_MuelleEspera = $fila['serv_muelleEspera'];
		$this-> $puerto_Serv_Bar = $fila['serv_bar'];
		$this-> $puerto_Serv_Restaurante = $fila['serv_restaurante'];
		$this-> $puerto_Serv_Supermercado = $fila['serv_supermercado'];
		$this-> $puerto_Serv_Hielo = $fila['serv_hielo'];
		$this-> $puerto_Serv_RecogidaAceites = $fila['serv_recogidaaceites'];
		$this-> $puerto_Serv_RecogidaBasuras = $fila['serv_recogidabasuras'];
		$this-> $puerto_Serv_AguasNegras = $fila['serv_aguasnegras'];
		$this-> $puerto_Serv_Farmacia = $fila['serv_farmacia'];
		$this-> $puerto_Serv_Medico = $fila['serv_medico'];
		$this-> $puerto_Serv_Meteo = $fila['serv_meteo'];
		$this-> $puerto_Serv_Banco = $fila['serv_banco'];
		$this-> $puerto_Serv_AlquilerCoches = $fila['serv_alquilercoches'];
		$this-> $puerto_Otros = $fila['otros'];
		$this-> $puerto_Descripcion = $fila['descripcion'];
	}


}

?>