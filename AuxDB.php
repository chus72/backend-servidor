<?php
// Autor: Jesus Valladolid Rebollar
// Proyecto: iBarco (Lexcode I)
// 
// AuxDB.php
require_once("IAuxDB.php");
class AuxDB implements IAuxDB
{
// esta clase es específica para trabajar con MySQL

// variable privada para guardar la cadena de conexión
private $strcon;

// Conecta con el servidor
function conectar() {
	$this->strcon =  mysqli_connect("82.223.113.25", "qpe642", "iBarco0","qpe642")	
		or die("Error de aplicación: No conectó con la base de datos");
	// se asigna el conjunto de caracteres
	mysqli_set_charset($this->strcon, "latin1");

}

// Desconecta con el servidor
function desconectar() {

	mysqli_close($this->strcon);
}

// Ejecuta una sentencia SQL contenida en $strSQL.
// $result retorna las filas de la consulta
function ejecutarSQL($strSQL) {

	$result = mysqli_query($this->strcon, $strSQL);
	// Muestra el detalle del mensaje de error MySQL
	// esto no se deber�a dejar en una aplicaci�n en producci�n
	if (!$result) {
		$msg  = 'Consulta inválida: ' . mysql_error() . "\n";
		$msg .= 'SQL: ' . $strSQL;
		die($msg);
	}
	return $result;
}

// retorna la siguiente fila de una resultado SQL
function siguienteFila($rst) {
	return mysqli_fetch_assoc($rst);
}

// cantidad de filas que tiene una consulta
function cantidadFilas($rst) {
	return mysqli_num_rows($rst);
}

function liberarRecursos($rst) {
	mysqli_free_result($rst);
}
}
?>