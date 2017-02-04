<?php
class k9Extentions implements ArrayAccess{
    
    protected $_name = null;
    protected $_k9 = null;
    
    function __construct() {
       $this->_name = strtolower(str_replace('k9','', get_class($this)));
       $this->_k9 = k9::getInstance();
    }
    
    function getName(){
        return $this->_name;
    }
    
    public function offsetExists ($offset){ 
        return isset ( $this->_k9 [$offset] );
    }
    public function offsetGet ($offset){ 
        return $this->_k9[$offset];
    }
    public function offsetSet ($offset, $value){ 
        $this->_k9 [$offset] = $value;
    }
    public function offsetUnset ($offset){ 
        unset ( $this->_k9 [$offset] );
    }
}

?>