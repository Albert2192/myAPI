<?php
include "./router.php";
// ##################################################

# VARIABLES GLOBALES (DESARROLLO)
$localPathIndex = '/myAPI';
$localPath = '/myAPI/';

# VARIABLES GLOBALES (PRODUCCIÓN)
//$localPathIndex = '/';
//$localPath = '';

# PAGINA DE INICIO
/* get($localPathIndex, 'index.php'); */

# SECCIONES GET
/* get($localPath.'login', 'login.php');
get($localPath.'registro', 'registro.php');
get($localPath.'recuperar', 'recuperar.php');
get($localPath.'restablecer/$token', 'restablecer.php');
get($localPath.'perfil', 'perfil.php');
get($localPath.'remates/$remate', 'remate.php');
get($localPath.'remates/$remate/$lote', 'lote.php');
get($localPath.'tablas-ofertas/$remate', 'tablas-ofertas.php');
get($localPath.'tablas-comprados/$remate', 'tablas-comprados.php');
get($localPath.'ventas-online', 'ventas-online.php');
get($localPath.'perfil-data', 'inc/perfil-data.php');
get($localPath.'crontab', 'crontab/EnvioCorreoCadaXmin.php'); */

# SECCIONES GET DATA
/* get($localPath.'index-data', 'inc/index-data.php');
post($localPath.'remates-data', 'inc/remates-data.php');
get($localPath.'remates-data-tabla', 'inc/remates-data.php');
get($localPath.'ventas-online-data', 'inc/ventas-online-data.php');
get($localPath.'tablas-ofertas-data', 'inc/tablas-ofertas-data.php');
get($localPath.'tablas-comprados-data', 'inc/tablas-comprados-data.php');
get($localPath.'time-server', 'inc/time-server.php');

post($localPath.'puja-data', 'inc/puja-data.php'); */

#SECCIONES PARA AVAL DE CORREOS
/* get($localPath.'avalado/$idrecibido', 'inc/avalado-data.php');
get($localPath.'noavalado/$idrecibido', 'inc/avalado-no-data.php');
get($localPath.'correcto', 'correcto.php');
get($localPath.'rechazado', 'rechazado.php');
get($localPath.'error', 'error.php');
get($localPath.'caducado', 'caducado.php'); */

#SECCIONES POST DATA
/* post($localPath.'login-data', 'inc/login-data.php');
post($localPath.'perfil-data', 'inc/perfil-data.php');
post($localPath.'registro-data', 'inc/registro-data.php');
post($localPath.'recuperar-data', 'inc/recuperar-data.php');
any($localPath.'restablecer-data', 'inc/restablecer-data.php');
any($localPath.'tablas-ofertas-data', 'inc/tablas-ofertas-data.php');
any($localPath.'tablas-comprados-data', 'inc/tablas-comprados-data.php');
post($localPath.'session', 'inc/session.php');

get($localPath.'listados', 'inc/listados.php');
post($localPath.'listados', 'inc/listados.php'); */


/* SECCIONES GET */
get($localPath.'clientes/$id_cliente', 'inc/clientes-data.php');
get($localPath.'clientes', 'inc/clientes-data.php');

# PAGINA 404 (Páginas que no existen redirecciona a 404.php)
any('error/404', '404.php');


