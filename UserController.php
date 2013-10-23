<?php
session_start();
include_once ("User.php");
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

function deleteUser() {
    if (isset($_POST["user_id"])) {
        $oUs = new User();
        $oUs -> setId($_POST["user_id"]);
        if ($oUs -> searchById()) {
            $r = $oUs -> delete();
            if ($r == 1) {
                header("Location:/user");
            } else {
                $error = "Error! No se pudo ejecutar la operación.";
                header("Location: error.php?e=" . $error);
            }
        } else {
            $error = "Error! No existe el usuario.";
            header("Location: error.php?e=" . $error);
        }
    }
}

function updateUser() {
    if (isset($_POST["user_id"])) {
        $oUs = new User();
        $oUs -> setId($_POST["user_id"]);
        if ($oUs -> searchById()) {

            $oUs -> setUsername($_POST["username"]);
            $ous -> setPassword($_POST["password"]);
            $oUs -> setFacebookId($_POST["fb_id"]);
            $oUs -> setTwitterId($_POST["tw_id"]);
            $oUs -> setType($_POST["type"]);
            $oUs -> setStatus($_POST["status"]);
            $oUs -> setEmail($_POST["email"]);

            $r = $oUs -> update();

            if ($r == 1) {
                header("Location:user/perfil");
            } else {
                $error = "Error! No se pudo ejecutar la operación.";
                header("Location: error.php?e=" . $error);
            }
        }
    }
}
?>
