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
class a extends ArrayObject{
	
	function __load(){
		return 'x';
	}
	
}


$a = new a();
$a['knight'] = 'dasdsda';
k($a['knight']);


 
?>