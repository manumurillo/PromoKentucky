<?php
function generateId(){
	$id = generateNumericKey(9);
	$id .= "_".generateAlphaNumericKey(2);
	return $id;
}

function generateSalt(){
	$salt = uniqid('',true);
	return $salt; 
}

function generateHashPassword($salt,$password){
    $passwordHash = md5($salt.$password);
	return $passwordHash;
}

function generateNumericKey($longitud){
	$key='';
	$pattern = '1234567890';
	$max=strlen($pattern)-1;
	
	for($i=0;$i<$longitud;$i++)
		$key.=$pattern{mt_rand(0,$max)};
	return $key;
}

function generateAlphaNumericKey($longitud){
	$key='';
	$pattern = 'abcdefghijklmnopqrstuvwxyz';
	$max=strlen($pattern)-1;
	
	for($i=0;$i<$longitud;$i++)
		$key.=$pattern{mt_rand(0,$max)};
	return $key;
}
?>