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
?>