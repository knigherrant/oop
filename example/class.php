<?php 
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

function __autoload($url){
	$url=str_replace("_","/",$url);
	k($url);

	    require("$url.php");   
}
	$abc=new ola_abc;
	$abc->demo();






 
?>