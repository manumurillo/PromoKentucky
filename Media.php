<?php
error_reporting(E_ALL);
include_once("AccesoDatos.php");
class Media{
private $id_user = '';
private $name = '';
private $type = '';
private $date_upload = '';
private $description = '';


   
	//Set y Get para cada una de las variables
	public function setIdUser($id_user){
		$this->id_user = $id_user;
	}
   
    public function getIdUser(){
		return $this->id_user;
	}
	public function setName($name){
		$this->name = $name;
	}
   
    public function getName(){
		return $this->name;
	}
	public function setType($type){
		$this->type = $type;
	}
   
    public function getType(){
		return $this->type;
	}
	public function setDateUpload($date_upload){
		$this->date_upload = $date_upload;
	}
   
    public function getDateUpload(){
		return $this->date_upload;
	}
	public function setDescription($description){
		$this->description = $description;
	}
   
    public function getDescription(){
		return $this->description;
	}
	
	
	/*Busca todos*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$aFila=null;
	$aLineaM=null;
	$j=0;
	$oMedia=null;
	$arrMedia = null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT id_user, name, type, date_upload, description
				FROM jb_media
				ORDER BY id_user";
			$aFila = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($aFila){
				foreach($aFila as $aLineaM){
					$oMedia = new Jb_Media();
					$oMedia->setIdUser($aLineaM[0]);
					$oMedia->setName($aLineaM[1]);
					$oMedia->setType($aLineaM[2]);
					$oMedia->setDate_upload($aLineaM[3]);
					$oMedia->setDescription($aLineaM[4]);
            		$arrMedia[$j] = $oMedia;
					$j=$j+1;
				}
			} 
		}
		return $arrMedia;
	}


	/*Busca media especifico*/
	function buscarId($buscar){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$sQuery="";
	$aFila=null;
	$aLineaM=null;
	$j=0;
	$oMedia=null;
	$arrMedia = null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT id_user, name, type, date_upload, description
				FROM jb_media
				WHERE id_user = ".$this->id_user."
				ORDER BY id_user";
			$aFila = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($aFila){
				foreach($aFila as $aLineaM){
					$oMedia = new Jb_Media();
					$oMedia->setIdUser($aLineaM[0]);
					$oMedia->setName($aLineaM[1]);
					$oMedia->setType($aLineaM[2]);
					$oMedia->setDate_upload($aLineaM[3]);
					$oMedia->setDescription($aLineaM[4]);
            		$arrMedia[$j] = $oMedia;
					$j=$j+1;
				}
			} 
		}
		return $arrMedia;
	}
	
	
	/*Insertar media*/
	function insertar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->id_user=="")
				throw new Exception("Media->insertar(): error de codificaci&oacute;n, faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "INSERT INTO jb_media (id_user, name, type, date_upload, description) 
					VALUES ('".$this->id_user."', '".$this->name."', '".$this->type."', '".$this->date_upload."', '".$this->description."')";
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();	
			} 
		}
		return $nAfectados;
	}
	
	/*Modificar media*/
	function modificar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->id_user=="")
			throw new Exception("Media->modificar(): error de codificaci&oacute;n, faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "UPDATE jb_media
					SET name='".$this->name."', 
					type= '".$this->type."' , 
					date_upload= '".$this->date_upload."' , 
					description= '".$this->description."' 
					WHERE id_user = ".$this->id_user;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			} 
		}
		return $nAfectados;
	}
	
	/*Borrar media*/
	function borrar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=null;
		if ($this->id_user=="")
			exit("Media->borrar(): error de codificaci&oacute;n, faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "DELETE FROM jb_media WHERE id_user = ".$this->id_user;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			} 
		}
		return $nAfectados;
	}
	
 }
?>