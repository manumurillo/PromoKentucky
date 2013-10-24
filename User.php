<?php
error_reporting(E_ALL);
include_once ("config/AccesoDatos.php");
class User {
    private $id = '';
    private $username = '';
    private $first_name = '';
    private $last_name = '';
    private $name = '';
    private $birthday = '';
    private $gender = '';
    private $email = '';
    private $date_register = '';
    private $qty_votes = 0;
    private $place = '';

 /*
     * Setter methods
     */
    public function setId($id) {
    $this -> id = $id;
    }

    public function setUsername($username) {
    $this -> username = $username;
    }

    public function setFirstName($first_name) {
    $this -> first_name = $first_name;
    }

    public function setLastName($last_name) {
    $this -> last_name = $last_name;
    }

    public function setName($name) {
    $this -> name = $name;
    }

    public function setBirthday($birthday) {
    $this -> birthday = $birthday;
    }

    public function setGender($gender) {
    $this -> gender = $gender;
    }

    public function setEmail($email) {
    $this -> email = $email;
    }

    public function setDateRegister($date_register) {
    $this -> date_register = $date_register;
    }

    public function setQtyVotes($qty_votes) {
        $this -> qty_votes = $qty_votes;
    }
    
    public function setPlace($place) {
        $this -> place = $place;
    }
    
    /*
     * Getter methods
     */
    public function getId() {
        return $this -> id;
    }

    public function getUsername() {
        return $this -> username;
    }

    public function getFirstName() {
        return $this -> first_name;
    }

    public function getLastName() {
        return $this -> last_name;
    }
    
    public function getName() {
        return $this -> name;
    }

    public function getBirthday() {
        return $this -> birthday;
    }

    public function getGender() {
        return $this -> gender;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function getDateRegister() {
        return $this -> date_register;
    }
    
    public function getQtyVotes() {
        return $this -> qty_votes;
    }
    
    public function getPlace() {
        return $this -> place;
    }

     /*
     * public function searchById
     *
     * Busca a un usuario mediante su id.
     * 
     * @return boolean $band false; si no existe el usuario
     * @return boolean $band true; si existe el usuario
     *
     */
    function searchById($id) {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = null;
        $band = false;
        if ($id == "")
            throw new Exception("User->searchById(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "SELECT id, username, first_name, last_name, name, birthday, gender, email, date_register, qty_votes, place
                    FROM jb_user 
                    WHERE id LIKE '" . $id . "'";
                $result = $oAccesoDatos -> ejecutarConsulta($query);
                $oAccesoDatos -> desconectar();
                if ($result) {
                    $this -> id = $result[0][0];
                    $this -> username = $result[0][1];
                    $this -> first_name = $result[0][2];
                    $this -> last_name = $result[0][3];
                    $this -> name = $result[0][4];
                    $this -> birthday = $result[0][5];
                    $this -> gender = $result[0][6];
                    $this -> email = $result[0][7];
                    $this -> date_register = $result[0][8];
                    $this -> qty_votes = $result[0][9];
                     $this -> place = $result[0][10];
                    $band = true;
                }
            }
        }
        return $band;
    }

    /*
     * public function insert
     *
     * Inserta un usuario mediante el uso del API de Facebook.
     * Los datos los obtiene después de la autorización del Usuario a la aplicación.
     * La contraseña no es requerida.
     *
     * @return $result int; regresa el valor de filas afectadas en la base de datos.
     *
     */
    function insert() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = -1;
        if ($this -> id == "" OR 
            $this -> username == "" OR 
            $this -> last_name == "" OR 
            $this -> first_name == "" OR 
            $this -> name == "" OR 
            $this -> birthday == "" OR 
            $this -> gender == "" OR 
            $this -> email == "" OR 
            $this -> date_register == "")
            throw new Exception("User->insert(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "INSERT INTO jb_user (id, username, first_name, last_name, name, birthday, gender, email, date_register, qty_votes, place) 
					VALUES ('" . $this -> id . "', 
					        '" . $this -> username . "', 
					        '" . $this -> first_name . "',
					        '" . $this -> last_name . "',
					        '" . $this -> name . "',
					        '" . $this -> birthday . "',
					        '" . $this -> gender . "',
					        '" . $this -> email . "',
                             " . $this -> qty_votes . ",
                            '" . $this -> date_register . "',
                            '" . $this -> place . "')";

                $result = $oAccesoDatos -> ejecutarComando($query);
                $oAccesoDatos -> desconectar();
            }
        }
        return $result;
    }


    /*
     * public function update
     *
     * @return $result int; regresa el valor de filas afectadas en la base de datos.
     *
     */
    function update() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = -1;
        if ($this -> id == "")
            throw new Exception("User->update(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "UPDATE jb_user 
					SET username = '" . $this -> username . "', 
					  first_name = '" . $this -> first_name . "' , 
					   last_name = '" . $this -> last_name . "' , 
					        name = '" . $this -> name . "',
					    birthday = '" . $this -> birthday . "',
			              gender = '" . $this -> gender . "',
					       email = '" . $this -> email . "',
					       place = '" . $this -> place . "'
					    WHERE id LIKE '" . $this -> id . "'";
                $result = $oAccesoDatos -> ejecutarComando($query);
                $oAccesoDatos -> desconectar();
            }
        }
        return $result;
    }
    
    /*
     * public function updateVote
     *
     * @return $result int; regresa el valor de filas afectadas en la base de datos.
     *
     */
    function updateVote() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = -1;
        $result1 = null;
        if ($this -> id == "")
            throw new Exception("User->updateVote(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query1 = "SELECT qty_votes
                            FROM jb_user
                            WHERE LIKE = ". $this -> id . "'";
                $result1 = $oAccesoDatos -> ejecutarConsulta($query1);
                if($result1){
                    $voto = $result['qty_votes'];
                    $voto++;
                    $this->qty_votes = $voto;
                    
                    $query = "UPDATE jb_user 
                        SET qty_votes = " . $this -> qty_votes . "
                            WHERE id LIKE '" . $this -> id . "'";
                    $result = $oAccesoDatos -> ejecutarComando($query);
                    $oAccesoDatos -> desconectar(); 
                }     
            }
        }
        return $result;
    }

    /*
     * public function delete
     *
     * Elimina un usuario especificando su id
     * @return $result int; regresa el valor de filas afectadas en la base de datos.
     */
    function delete() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = null;
        if ($this -> id == "")
            exit("User->delete(): error de codificaci&oacute;n, faltan datos");
        else {
            if ($oAccesoDatos -> conectar()) {
                $query = "DELETE FROM jb_user WHERE id = '" . $this -> id . "'";
                $result = $oAccesoDatos -> ejecutarComando($query);
                $oAccesoDatos -> desconectar();
            }
        }
        return $result;
    }

    /*
     * public function searchAll
     *
     * Busca a todos los usuarios registrados en la base de datos.
     *
     * @return $arrUsuarios array; el registro de los usuarios obtenidos de la base de datos.
     */
    function searchAll() {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = null;
        $fila = null;
        $j = 0;
        $oUsu = null;
        $arrUsuarios = null;
        if ($oAccesoDatos -> conectar()) {
            $query = "SELECT id, username, first_name, last_name, name, birthday, gender, email, date_register, qty_votes, place
				FROM jb_user";
            $result = $oAccesoDatos -> ejecutarConsulta($query);
            $oAccesoDatos -> desconectar();
            if ($result) {
                foreach ($result as $fila) {
                    $oUsu = new User();

                    $oUsu -> setId($fila[0]);
                    $oUsu -> setUsername($fila[1]);
                    $oUsu -> setFirstName($fila[2]);
                    $oUsu -> setLastName($fila[3]);
                    $oUsu -> setName($fila[4]);
                    $oUsu -> setBirthday($fila[5]);
                    $oUsu -> setGender($fila[6]);
                    $oUsu -> setEmail($fila[7]);
                    $oUsu -> setDateRegister($fila[8]);
                    $oUsu -> setQtyVotes($fila[9]);
                    $oUsu -> setPlace($fila[10]);
                    
                    $arrUsuarios[$j] = $oUsu;
                    $j = $j + 1;
                }
            }
        }
        return $arrUsuarios;
    }

    /*
     * public function searchUserByName
     *
     * Busca usuarios mediante su nombre.
     * Esta función será llamada mediante una función de ajax.
     *
     * @param string $name - nombre de usuario.
     * @return array $usuarios - usuarios encontrados.
     *
     */
    function searchUserByName($name) {
        $oAccesoDatos = new AccesoDatos();
        $query = "";
        $result = null;
        $arrUsuarios = null;
        $fila = null;
        $j = 0;
        if ($oAccesoDatos -> conectar()) {
            $query = "SELECT id, username, first_name, last_name, name, birthday, gender, email, date_register, qty_votes, place
                FROM jb_user
                WHERE name LIKE '%".$name."%'";
            $result = $oAccesoDatos -> ejecutarConsulta($query);
            $oAccesoDatos -> desconectar();
            if ($result) {
                foreach ($result as $fila) {
                    $oUsu = new User();

                    $oUsu -> setId($fila[0]);
                    $oUsu -> setUsername($fila[1]);
                    $oUsu -> setFirstName($fila[2]);
                    $oUsu -> setLastName($fila[3]);
                    $oUsu -> setName($fila[4]);
                    $oUsu -> setBirthday($fila[5]);
                    $oUsu -> setGender($fila[6]);
                    $oUsu -> setEmail($fila[7]);
                    $oUsu -> setDateRegister($fila[8]);
                    $oUsu -> setQtyVotes($fila[9]);
                    $oUsu -> setPlace($fila[10]);
                    
                    $arrUsuarios[$j] = $oUsu;
                    $j = $j + 1;
                }
            }
        }
        return $arrUsuarios;
    }
}
?>
