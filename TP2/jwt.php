<?php
include 'jwtHeader.php';   

use \Firebase\JWT\JWT;  // requerimiento de la libreria

//Generamos el Payload-CargaDatos
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,               //vencimiento del token
    "nbf" => 1357000000,
    "email" => "mariana@gmail.com",
    "clave" => "mariana"
);

//Generar el Token
 $jwt = JWT::encode($payload, $key);  

//Leo el toquen
echo $jwt; 

/* Token Generado lo guardo

/*
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZXhhbXBsZS5vcmciLCJhdWQiOiJodHRwOi8vZXhhbXBsZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZW1haWwiOiJtYXJpYW5hQGdtYWlsLmNvbSIsImNsYXZlIjoibWFyaWFuYSJ9.LlHyr2QGq7zvXGImcg4oWcv5bJX19e0KZblcY4yB3aQ
*/