<?php
/*************************************************************/
/* AccesoDatos.php
 * Clase que encapsula el acceso a la base de datos
 *************************************************************/
 error_reporting(E_ALL);
 class AccesoDatos{
 private $nConexion=0;

	private $ip="localhost";
	private $usuario="sersubs_kentucky";
	private $password="WJTLP01XU9IMKEN";
	private $db="sersubs-kentucky";
	
	/*Realiza la conexion a la base de datos*/
    public function conectar(){
		$bRet = true;
		$this->nConexion = mysql_connect($this->ip,$this->usuario,$this->password);
		if (!$this->nConexion){
			$bRet = false;
			throw new Exception("Error en conexi&oacute;n"); 
		} 
		if (!mysql_select_db($this->db,$this->nConexion)){ 
			$bRet = false;
			throw new Exception("Error en conexi&oacute;n a la base de datos"); 
		} 
		return $bRet;
	}
 
	/*Realiza la desconexion de la base de datos*/
    public function desconectar(){
	$bRet = false;
		
		if ($this->nConexion){
			$bRet = mysql_close($this->nConexion);
		}
		return $bRet;
	}
	 
	/*Ejecuta en la base de datos la consulta que recibi� por par�metro.
	  Regresa
	        Falso si no hubo datos
			Un arreglo bidimensional de n filas y tantas columnas como
			campos se hayan solicitado en la consulta*/
    public function ejecutarConsulta($psConsulta){
	$aFila = false;
	$aDatos = false;
	$result = null;
	$i=0;
	    if ($psConsulta == ""){
			throw new Exception("Error de codificaci&oacute;n, falta indicar la consulta");
		}
		if (!$this->nConexion){
			throw new Exception("Error de codificaci&oacute;n, falta conectar la base");
		}
		try{
			$result = mysql_query($psConsulta,$this->nConexion);
		} catch(Exception $e){
			$result = false;
			throw new Exception($e->getMessage());
		}
		if (!$result){
		    throw new Exception('Consulta con error: ' . mysql_error());
        }
		$aFila = mysql_fetch_row($result); //la propia funci�n regresa false o arreglo
		while ($aFila){
			$aDatos[$i]=$aFila;
			$i=$i+1;
			$aFila = mysql_fetch_row($result);
		}
		return $aDatos;
	}
	 
	/*Ejecuta en la base de datos el comando que recibió por parámetro
		Regresa
	        -1 si hubo error al ejecutar el comando
			0 en adelante para indicar el numero de registros afectados por el comando*/
    public function ejecutarComando($psComando){
	$nAfectados = -1;
	$bResult = false;
		if ($psComando == ""){
		    throw new Exception("Error de codificaci&oacute;n, falta indicar el comando");
		}
		if (!$this->nConexion){
		    throw new Exception("Error de codificaci&oacute;n, falta conectar la base");
		}
		try{
			$bResult = mysql_query($psComando,$this->nConexion);
		} catch(Exception $e){
			$bResult = false;
			throw new Exception($e->getMessage());
		}
		if ($bResult){
		    $nAfectados = mysql_affected_rows();
        }
		else {
		    throw new Exception('Comando con error: '.mysql_error());
        }
		return $nAfectados;
	}
}
?>