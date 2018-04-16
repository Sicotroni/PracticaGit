<?php

require_once '../lib/nusoap.php';

$servicio = new soap_server();
$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("miservicioweb", $ns);


if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents("php://input");
}

function misOfertas() {

    $cn = mysqli_connect("localhost", "root", "", "mitienda");
    $resultados = $cn->query('SELECT * FROM productos where oferta="1"');
    $arrResultados = array();
    while ($producto = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        array_push($arrResultados, $producto);
    }
    $cn = null;
    return json_encode($arrResultados);
}

$servicio->schemaTargetNamespace = $ns;

$servicio->register("misOfertas", array(), array('return' => 'xsd:string'), $ns);

$servicio->service($HTTP_RAW_POST_DATA);



