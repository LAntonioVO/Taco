<?php
	$host = 'localhost';
    $user = 'admin';
    $pass = 'adminmysqli';
    $datb = 'id9670846_tacobd';
    $conectar = new mysqli($host, $user, $pass, $datb);
    if($conectar->connect_error){
        echo"No se puede conectar";
    }

    if(!isset($_SESSION)){
        session_start();
    }

    
?>