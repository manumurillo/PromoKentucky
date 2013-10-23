<?php
error_reporting(E_ALL);
include_once ("config/AccesoDatos.php");
include_once ("assets/Util.php");
class Voters {
    private $id_user = '';
    private $id_voter = '';
    private $vote_date = '';

    /*
     * Setter methods
     */
    public function setIdUser($id_user) {
        $this -> id_user = $id_user;
    }
    
    public function setIdVoter($id_voter){
        $this-> id_voter=$id_voter;
    }
    
    public function setVoteDate($vote_date){
        $this -> vote_date = $vote_date;
    }
    
    
    /*
     * Getter methods
     */
    public function getIdUser() {
        return $this -> id_user;
    }
    
    public function getIdVoter(){
        return $this-> id_voter;
    }
    
    public function getVoteDate(){
        return $this -> vote_date;
    }
    
    /*
     * function voteRegister
     * 
     * Registra el id del usuario que ha votado, el id del usuario al que votó y la fecha en que lo hizo.
     * 
     * @return int $resultado el número de filas acfectadas.
     *  
     */
     function voteRegister(){
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = -1;
        if ($this -> id_user == "" OR 
            $this -> id_voter == "" OR 
            $this -> vote_date == "" )
            throw new Exception("User->voteRegister(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "INSERT INTO jb_voters (id_user, id_voter, vote_date) 
                    VALUES ('" . $this -> id_user . "', 
                            '" . $this -> id_voter . "', 
                            'NOW()')";
                $result = $oAccesoDatos -> ejecutarComando($query);
                $oAccesoDatos -> desconectar();
            }
        }
        return $result;         
     }
     
     
     /*
     * public function searchById
     *
     * Obtiene los registros de un votante específico.
     * 
     * @return boolean $band false; si no existe el usuario
     * @return boolean $band true; si existe el usuario
     *
     */
     function searchVotes() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = null;
        $fila = null;
        $j = 0;
        $oVoter = null;
        $arrVotes = null;
        if ($this -> id_user == "" OR 
            $this -> id_voter == "")
            throw new Exception("User->voteRegister(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "SELECT id_user, id_voter, vote_date
                    FROM jb_voters
                    WHERE id_user LIKE '". $this->id_user."'
                    AND id_voter LIKE '". $this->id_voter."'
                    ORDER BY vote_date ASC";
                $result = $oAccesoDatos -> ejecutarConsulta($query);
                $oAccesoDatos -> desconectar();
                if ($result) {
                    foreach ($result as $fila) {
                        $oVoter = new Voters();
    
                        $oVoter -> setIdUser($fila[0]);
                        $oVoter -> setIdVoter($fila[1]);
                        $oVoter -> setVoteDate($fila[2]);
                        $arrVotes[$j] = $oVoter;
                        $j = $j + 1;
                    }
                }
            }
        }
        return $arrVotes;
    }
     
    

}


?>