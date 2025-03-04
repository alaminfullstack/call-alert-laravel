<?php 

function e7061($e){
	$ed = base64_decode($e);
	$n = openssl_decrypt("$ed","AES-256-CBC","7818427408389848",0,"7818427408389848");
	return $n;
}