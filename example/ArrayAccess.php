<?php 
error_reporting(E_ALL);
function k($str){
	if($str){
		echo "<pre>";
		print_r($str);
		echo "</pre>";
	}else{
		echo "<pre>";
		var_dump($str);
		echo "</pre>";
	}
}


class load implements ArrayAccess{
    
    protected $_lib = array();


    public function addLib($lib){
        $name = $lib->getName();
        if(!$this->_lib[$name]){
            $this->_lib[$name] = $lib;
        }
        return $this->_lib[$name];
    }
    
    function getLib($name){
        
        if(!$this->_lib[$name]){
            $class = 'Knight' . ucfirst ($name);
            
            if(!class_exists($class)){
                k($this['path']);
                $path = $this['path']->findPath($name.'.php','knight');
                
                if(is_file($path)){
                    require_once $path;
                }else{
                    return false;
                }
                $this->addLib(new $class() );
            }
        }
        $this->_lib [$name];
    }


    public function offsetExists ($offset){
        
    }
    public function offsetGet ($offset){
        
    }
    public function offsetSet ($offset, $value){
        
    }
    public function offsetUnset ($offset){
        
    }
}




$a = new load();

k($a);

k($a->getLib('aa'));


 
?>