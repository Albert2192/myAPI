<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

include ("funciones.php");

$db = DataBase::conectar();
$id = $db->clearText($id_cliente);

if(isset($id) && $id != ""){
    $db->setQuery("SELECT * FROM `clientes` WHERE id_cliente = $id;");
    $row = $db->loadObject();
}else{
    $db->setQuery("SELECT * FROM `clientes`;");
    $row = $db->loadObjectList();
}

if(empty($row)){
    echo json_encode(["status"=>"error", "row"=>[]]);
    exit;
}else{ 
    echo json_encode(["status"=>"ok", "row"=>$row]);
}