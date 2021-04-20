<?php


class GenerarDir {
    
    var $dir;
    
    public function GenerarDir(){
        
        $this->dir = md5(uniqid($_SERVER['PHP_SELF'],true));
        
        
    }
    
    
    
    function getDir() {
        return $this->dir;
    }

    function setDir($dir) {
        $this->dir = $dir;
    }


    
}



?>