<?php

class Datos{
    public $archivo;
    
    public static function leer($archivo){
         
        $file = fopen($archivo,'r');
        $rta = fread($file,filesize($archivo));
        fclose($file);

        $personasDesearializadas = unserialize($rta);
        return $personasDesearializadas;
    }

    public static function guardarDatos($archivo,$datos){
        $file = fopen($archivo,'a');
        $rta = fwrite($file,serialize($datos));
        fclose($file);
        return $rta;
    }
}
