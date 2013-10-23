<?php
session_start();
include_once ("User.php");
include_once ("UserProfile.php");
include_once ("Util.php");
$error = "";

/*
 if (isset($_SESSION["user_id"])) {
 $oUser -> setId($_REQUEST["user_id"]);
 $oUser -> searchById();
 } else {
 $error = "Error 401: No autorizado";
 header("Location: error.php?e=" . $error . "code=401");
 }

 $ope = 0;

 if (isset($_REQUEST["ope"]) && !empty($_REQUEST["ope"]))
 $sOpe = $_REQUEST["ope"];
 else {
 $error = "Error 404: No no encontrado <br> No se especificó la operación.";
 header("Location: error.php?e=" . $error);
 }

 switch ($ope) {
 case "insert" :
 insertUser();
 break;
 case "delete" :
 deleteUser();
 case "update" :
 updatetUser();
 break;
 default :
 header("Location: /user");
 break;
 }
 */
function insertUserFromWebsite($username, $password, $type, $status, $email, $first_name, $last_name, $birthday, $gender) {
    $oUs = new User();
    $oUserP = new UserProfile();

    $oUs -> setId(generateId());
    $oUs -> setUsername($username);
    $oUs -> setSalt(generateSalt());
    $oUs -> setPassword(generateHashPassword($oUs -> getSalt(), $password));
    $oUs -> setType($type);
    $oUs -> setStatus($status);
    $oUs -> setEmail($email);

    $r = $oUs -> insertFromWebsite();
    if ($r == 1) {
        $oUserP -> setId($oUs -> getId());
        $oUserP -> setFirstName($first_name);
        $oUserP -> setLastName($last_name);
        $oUserP -> setBirthday($birthday);
        $oUserP -> setGender($gender);

        $r2 = $oUserP -> insert();
        if ($r2 == 1) {
            header("Location: ok");
        } else {
            $error = "Error! No se insertó el perfil de usuario.";
            header("Location: error.php?e=" . $error);
        }
    } else {
        $error = "Error! No se insertó el usuario.";
        header("Location: error.php?e=" . $error);
    }
}

function insertUserFromFacebook($id, $username, $type, $status, $email, $first_name, $last_name, $about_me, $url_img, $birthday, $gender) {
    $oUs = new User();
    $oUserP = new UserProfile();

    if ($oUs -> searchByFacebookId($id)) {
        $error = "Ya está registrado el perfil en nuestra base de datos";
        header("Location: error?e=" . $error);
    } else if ($oUs -> checkEmail($email)) {
        $error = "Ya está registrado el email en nuestra base de datos";
        header("Location: error?e=" . $error);
    } else if ($oUs -> checkUsername($username)) {
        $error = "Ya está registrado el nombre de usuario en nuestra base de datos";
        header("Location: error?e=" . $error);
    } else {
        $oUs -> setId(generateId());
        $oUs -> setUsername($username);
        $oUs -> setSalt(generateSalt());
        $oUs -> setFacebookId($id);
        $oUs -> setType($type);
        $oUs -> setStatus($status);
        $oUs -> setEmail($email);

        $r = $oUs -> insertFromFacebook();
        if ($r == 1) {
            $oUserP -> setId($oUs -> getId());
            $oUserP -> setFirstName($first_name);
            $oUserP -> setLastName($last_name);
            $oUserP -> setAboutMe($about_me);
            $oUserP -> setUrlImg($url_img);
            $oUserP -> setBirthday($birthday);
            $oUserP -> setGender($gender);

            $r2 = $oUserP -> insert();
            if ($r2 == 1) {
                header("Location:ok");
            } else {
                $error = "No se registró el perfil del usuario";
                header("Location: error?e=" . $error);
            }
        } else {
            $error = "No se insertó el usuario.";
            header("Location: error?e=" . $error);
        }
    }
}

function insertUserFromTwitter($id, $username, $type, $status, $first_name, $last_name, $about_me, $url_img, $email) {
    $oUs = new User();
    $oUserP = new UserProfile();

    if ($oUs -> searchByTwitterId($id)) {
        $error = "Ya está registrado el perfil en nuestra base de datos";
        header("Location: error?e=" . $error);
    }
    else if ($oUs -> checkUsername($username)) {
        $error = "Ya está registrado el nombre de usuario en nuestra base de datos";
        header("Location: error?e=" . $error);
    } else {
        $oUs -> setId(generateId());
        $oUs -> setUsername($username);
        $oUs -> setSalt(generateSalt());
        $oUs -> setTwitterId($id);
        $oUs -> setType($type);
        $oUs -> setStatus($status);
        $oUs -> setEmail($email);

        $r = $oUs -> insertFromTwitter();
        if ($r == 1) {
            $oUserP -> setId($oUs -> getId());
            $oUserP -> setFirstName($first_name);
            $oUserP -> setLastName($last_name);
            $oUserP -> setAboutMe($about_me);
            $oUserP -> setUrlImg($url_img);

            $r2 = $oUserP -> insert();
            if ($r2 == 1) {
                header("Location:ok");
            } else {
                $error = "No se registró el perfil del usuario";
                header("Location: error?e=" . $error);
            }
        } else {
            $error = "No se insertó el usuario.";
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
