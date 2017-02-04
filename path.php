<?php
class k9Buffer implements ArrayAccess{
    protected $_name = null;
    function __construct() {
       $this->_name = strtolower(str_replace('k9','', get_class($this)));
    }
    function getName(){
        return $this->_name;
    }
    public function offsetExists ($offset){ }
    public function offsetGet ($offset){  }
    public function offsetSet ($offset, $value){  }
    public function offsetUnset ($offset){  }
}

class k9Path extends k9Buffer{
    
    static $paths = null;
   
    public static function addpath($newpath = array(), $type = 'knights'){
        if(!isset(self::$paths[$type]))  self::$paths[$type] = array();
        $paths = & self::$paths [$type];
        settype($newpath, 'array');
        foreach ($newpath as $path){
            if(!in_array($path, $paths) && $path){
                array_unshift($paths, trim ($path ) );
            }
        }
        return $paths;
    }

    public function findPath($file, $type = 'knights') {
        if(strpos($file, '::')) list($type , $file) = explode('::', $file);
        if(!isset(self::$paths[$type])) self::$paths [$type] = array ();
        $paths = & self::$paths[$type];
        return self::find($paths,$file);
    }
    
    public static function find($paths,$file){
        if(!is_array($paths) || !($paths instanceof Iterator)) settype ($paths, 'array');
        foreach ($paths as $path){
            $fullname = $path . '/' . $file;
            if (strpos($path, '://') === false) {
                $path = realpath($path);
                $fullname = realpath($fullname);
            }
            if (file_exists($fullname) && substr($fullname, 0, strlen($path)) == $path)  return $fullname;
        }
        return false;
    }
}
?>