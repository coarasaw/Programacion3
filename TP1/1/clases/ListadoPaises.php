<?php
use NNV\RestCountries;

class Paises implements IListaPaises{
    
    private $restCountries;
    public function __construct(){
        $this->restCountries = new RestCountries;
    }

    public function getTodos(){
        $countries = $this->restCountries->all();
        return $countries;
    }

    public function getNombre($name){
        return $this->restCountries->byName($name);
    }

    
    public function getRegion($region){
        $list = [];
        foreach ($this->restCountries->all() as $c) {
            if($c->region == $region){
                $list[] = $c;
            } 
        }
        return $list;
    }
    public function getSubRegion($subregion){
        $list = [];
        foreach ($this->restCountries->all() as $c) {
            if($c->subregion == $subregion){
                $list[] = $c;
            }
        }
        return $list;
    }
    public function getCapital($capital){
        $list = [];
        foreach ($this->restCountries->all() as $c) {
            if($c->capital == $capital){
                $list[] = $c;
            }
        }
        return $list;
    }
    
    public function getLanguages($language){
        $list = [];
        foreach ($this->restCountries->all() as $c) {
            foreach ($c->languages as $cLan) {
                if($cLan->name == $language){
                    $list[] = $c;
                }
            }
        }
        return $list;
    }
}


?>