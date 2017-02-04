<?php
class k9Loader{ 
    static $import = array();
    public static function import($key, $path = null){
        if(!isset(self::$import[$key])){
            $success = false;
            $path = (!empty($path))? $path : dirname (__FILE__) . DIRECTORY_SEPARATOR ;
            $key = str_replace('.', DIRECTORY_SEPARATOR, $key);
            if(is_file($path . $key . '.php')) $success = (bool) require_once ($path . $key . '.php');
            self::$import[$key] = $success;
        }
    }
}

k9Loader::import('function');
k9Loader::import('extentions');
k9Loader::import('path');

class k9Helper implements ArrayAccess{
    
    protected $_k9 = array();
    
    public function addHelper($lib){
        $name = $lib->getName();
        if(!$this->_k9[$name]) $this->_k9[$name] = $lib;
        return $this->_k9[$name];
    }
    function getHelper($name){
        if(!$this->_k9[$name]){
            $class = 'k9' . ucfirst ($name);
            if(!class_exists($class)){
                $path = $this['path']->findPath($name.'.php','knights');
                if(is_file($path)) require_once $path;
                else return false;
                $this->addHelper(new $class() );
            }
        }
        return $this->_k9 [$name];
    }
    public function offsetExists ($offset){
        return isset ( $this->_k9 [$offset] );
    }
    public function offsetGet ($offset){
        return $this->getHelper ( $offset );
    }
    public function offsetSet ($offset, $value){
        $this->_k9 [$offset] = $value;
    }
    public function offsetUnset ($offset){
        unset ( $this->_k9 [$offset] );
    }
}
class k9 extends k9Helper{
    
    protected static $instance = null;
    
    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new k9();
            self::$instance->addHelper(new k9Path());
            $path = dirname(__FILE__);
            self::$instance['path']->addpath($path,'root');
            self::$instance['path']->addpath($path.'/knights','knights');
            self::$instance['path']->addpath($path.'/css','css');
            self::$instance['path']->addpath($path.'/js','js');
        }
        return self::$instance;
    }
    
    public static function _($key){
        return self::$instance[$key];
    }
    
    
}


$k9 = k9::getInstance();

k($k9['content']->kecho());


k(k9::_('content')->kecho());

//k($k9['facebook']);



?>