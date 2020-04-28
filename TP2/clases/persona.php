<?php
//include_once'./datos.php';

class Persona{
    
    public $email;
    public $clave;
    public $nombre;
    public $apellido;
    public $telefono;
    public $tipo;

    public function __construct($email,$clave,$nombre,$apellido,$telefono,$tipo){

        $this->email = $email;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
    }
        
    
    public function BuscarUnaTodo($dato){
        
        $rta = "";
        if ($dato == "") {
            $rta = $this->nombre . ' ' . $this->apellido . ' ' . $this->email . ' ' . $this->clave . ' ' . $this->tipo . ' ' . $this->telefono;
        }else{
            if($dato == $this->clave ){
                $rta = $this->nombre . ' ' . $this->apellido . ' ' . $this->email . ' ' . $this->clave . ' ' . $this->tipo . ' ' . $this->telefono;
            }
        }
        return $rta;
    }
}