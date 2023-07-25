<?php
require_once "mysql.php";


function url()
{
    $host = $_SERVER['HTTP_HOST'];
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://$_SERVER[HTTP_HOST]" : "http://$_SERVER[HTTP_HOST]/myapi");
    return $url;
}

/* FUNCION QUE HACE MAYUSCULA O CAPITALIZE SEGUN EL TIPO */
function textMayus($palabra = "", $tipo = "")
{
    if ($tipo == "mayus") {
        $tipo = MB_CASE_UPPER;
    } else if ($tipo == "title") {
        $tipo = MB_CASE_TITLE;
    } else {
        $tipo = MB_CASE_LOWER;
    }
    $resultado = mb_convert_case("$palabra", $tipo, "UTF-8");
    return $resultado;
}

/* CLASE ENCARGADA DE GENERAR EL PASSWORD CON EL HASH */
class Password
{
    const SALT = 'asdfasdfadf';
    public static function hash($password)
    {
        return hash('sha256', self::SALT . $password);
    }
    public static function verify($password, $hash)
    {
        return ($hash == self::hash($password));
    }
}

function obfuscate_email($email)
{
    $em   = explode("@", $email);
    $name = implode('@', array_slice($em, 0, count($em) - 1));
    $len  = floor(strlen($name) / 2);
    return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
}
