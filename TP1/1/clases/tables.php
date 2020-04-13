<?php
class Tables {
    private $allPaises;
    public function __construct(){
        $cl = new Paises();
        $this->allPaises = $cl->getTodos();
    }

    public function getRegions(){
        $regions = array();
        $has;
        foreach ($this->allPaises as $c) {
            $has = false;
            foreach ($regions as $r) { 
                if($r == $c->region){  $has = true; } 
            }
            if($has == false && $c->region){ 
                $regions[] = $c->region; 
            }
        
        }
        return $regions;
    }
    
    public function getSubRegions(){
        $subRegions = array();
        $has;
        foreach ($this->allPaises as $c) {
            // Continentes
            $has = false;
            foreach ($subRegions as $sr) { if($sr == $c->subregion){  $has = true; } }
            if($has == false && $c->subregion){ $subRegions[] = $c->subregion; }
        }
        return $subRegions;
    }

    public function getLanguages(){
        $languages = array();   
        $has;
        foreach ($this->allPaises as $c) {
            $has = false;
            foreach ($c->languages as $cLan) {
                foreach ($languages as $l) { 
                    if($l == $cLan->name){  $has = true; } 
                }
                if($has == false && $cLan->name){ $languages[] = $cLan->name;} 
            }
        }
        return $languages;
    }
    
    public function getCapitals(){
        $capitals = array();
        $has;
        foreach ($this->allPaises as $c) {
            // Continentes
            $has = false;
            foreach ($capitals as $r) { 
                if($r == $c->capital){  $has = true; } 
            }
            if($has == false && $c->capital){ 
                $capitals[] = $c->capital; 
            }
        }
        return $capitals;
    }

}


?>