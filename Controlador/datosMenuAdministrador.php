<?php

require '../DAO/datosMenuAdministradorDAO.php';



$correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : "";
$telefonoCelular = isset($_REQUEST['telefonoCelular']) ? $_REQUEST['telefonoCelular'] : "";
$contrasena = isset($_REQUEST['contrasena']) ? $_REQUEST['contrasena'] : "";
$confirmarContrasena = isset($_REQUEST['confirmarContrasena']) ? $_REQUEST['confirmarContrasena'] : "";
$type = isset($_REQUEST['type'])? $_REQUEST['type'] : "";


$dao= new datosMenuAdministradorDAO();

$patronValTelefono = "/^[0-9]{10}$/";
$patronValTelefonoInfo = "El telefono celular solo recibe números, Tiene que tener una longuitud de 10 números, Sin espacios";

$patronValContrasena = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";
$patronValContrasenaInfo = "La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.NO puede tener otros símbolos Ejemplo: w3Unpocodet0d0";


switch ($type) {
    case "buscarAdministradorCorreo":
        $dao->buscarAdministradorCorreo($correo);
        break;
    case "modificarAdministrador":

        if (!preg_match($patronValTelefono, $telefonoCelular)) {
            echo (json_encode(['res' => 'False', "msj" => $patronValTelefonoInfo]));
            break;
        }

        if (!preg_match($patronValContrasena, $contrasena)) {
            echo (json_encode(['res' => 'False', "msj" => $patronValContrasenaInfo]));
            break;
        }

        if ($contrasena!==$confirmarContrasena) {
            echo (json_encode(['res' => 'False', "msj" => "Las contraseñas no coinciden"]));
            break;
        }

        $dao->modificarAdministrador($correo,$telefonoCelular,$contrasena);
        break;
}


