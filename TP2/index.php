<?php

/*
* Metodos http
* POST    : signin: recibe email, clave, nombre, apellido, teléfono y tipo (user, admin) y lo guarda en un archivo.
* POST    : login: recibe email y clave y chequea que existan, si es así retorna un JWT de lo contrario informa el error (si el email o la clave están equivocados).
* GET     : detalle: Muestra todos los datos del usuario actual.
* GET     : lista: Si el usuario es admin muestra todos los usuarios, si es user solo los del tipo user.
*/

require_once './clases/persona.php';  // Verificará si el archivo ya ha sido incluido.
require_once './clases/response.php'; // Clase respuesta.
include_once './clases/datos.php';

include 'jwtHeader.php';
use \Firebase\JWT\JWT;  // requerimiento de la libreria 

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']  : '';  //No se bien como funciona

/* echo $metodo;
var_dump($_SERVER); */

$response = new Response();

switch ($method) {
    case 'GET':
        switch ($path) {
            case '/detalle':
                #  Muestra todos los datos del usuario actual.
                $archivo = 'file/personas.txt';
                $personasDesearializadas = Datos::leer($archivo);
                foreach ($personasDesearializadas as $perona) {
                    echo $perona->BuscarUnaTodo("maria") . "\n";
                    if($perona->clave == "maria"){
                        $personasUsuario = $perona;
                        break;
                    }            
                }
                $rta = $personasUsuario;
                $response->data = $rta;
                echo json_encode($response);
                break;
            case '/lista':
                    # Si el usuario es admin muestra todos los usuarios
                    $archivo = 'file/personas.txt';
                    $personasDesearializadas = Datos::leer($archivo);
                    foreach ($personasDesearializadas as $perona) {
                        echo $perona->BuscarUnaTodo("") . "\n";    
                    }
                    $rta = $personasDesearializadas;
                    $response->data = $rta;
                    echo json_encode($response);
                    break;
            default:
                $response->data = 'Path no soportado en GET';
                $response->status = 'fail';
                echo json_encode($response);
                break;
        }
    break;    
    case 'POST':
        switch ($path) {
            case '/signin': #Recibe email, clave, nombre, apellido, teléfono y tipo (user, admin) y lo guarda en un archivo.
                $email = $_POST['email'] ?? null;
                $clave = $_POST['clave'] ?? null;
                $nombre = $_POST['nombre'] ?? null;
                $apellido = $_POST['apellido'] ?? null;
                $telefono = $_POST['telefono'] ?? null;
                $tipo = $_POST['tipo'] ?? null;

                if (isset($email) && isset($clave) && isset($nombre) && isset($apellido) && isset($telefono) && isset($tipo)) {
                        $personas = array();
                        $archivo = 'file/personas.txt';
                        $persona = new Persona($email,$clave,$nombre, $apellido, $telefono, $tipo);
                        //var_dump($persona);
                        //die();
                        array_push($personas,$persona);
                        $rta = Datos::guardarDatos($archivo,$personas);
                        $response->data = $rta;
                        echo json_encode($response);

                } else {
                        $response->data = 'Faltan datos';
                        $response->status = 'fail';
                        echo json_encode($response);
                }             
                break;
            case '/login':
                # recibe email y clave y chequea que existan, si es así retorna un JWT de lo contrario informa el error 
                $headers = getallheaders(); //Leeo toda mi cabecera
                $miToken = $headers["mi_token"] ?? 'No mando Token'; // Si se genero el Token aca lo obtengo de la cabecera
                try {
                    $decoded = JWT::decode($miToken, $key, array('HS256'));
                    //print_r($decoded); 
                    $rta = $decoded;
                    $response->data = $rta;
                    echo json_encode($response);
                } catch (\Throwable $th) {
                    $response->data = 'Error - Correo o Clave incorrectos';
                    $response->status = 'fail';
                    echo $th->getMessage() . " Error JWT";
                }
                break;
            default:
                $response->data = 'Path no soportado en POST';
                $response->status = 'fail';
                echo json_encode($response);
                break;
        }
    break;        
    default:
        $response->data = 'Metodo no soportado';
        $response->status = 'fail';
        echo json_encode($response);
        break;
}