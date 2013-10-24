<?php
session_start();
include_once ("User.php");
include_once ("Voters.php");
include_once ("Media.php");
$error = "";

function insertUserFromFacebook($id, $username, $first_name, $last_name, $name, $birthday, $gender, $email, $date_register, $qty_votes, $place) {
    $oUs = new User();

    if ($oUs -> searchById($id)) {
        //Redireccionar a las galerias
        //$error = "Ya está registrado el perfil en nuestra base de datos";
        //header("Location: error?e=" . $error);
    } else {
        $oUs -> setId($id);
        $oUs -> setUsername($username);
        $oUs -> setFirstName($first_name);
        $oUs -> setLastName($last_name);
        $oUs -> setName($name);
        $oUs -> setBirthday($birthday);
        $oUs -> setGender($gender);
        $oUs -> setEmail($email);
        $oUs -> setQtyVotes($qty_votes);
        $oUs -> setPlace($place);
        
        $r = $oUs -> insertFromFacebook();
        if ($r == 1) {
            header("Location:sendPhoto");
        } else {
            $error = "No se registró el perfil del usuario, inténtalo de nuevo más tarde";
            header("Location: error?e=" . $error);
        }
    }
}

function voterRegister($id_user, $id_voter){
    if()
    
}
?>
