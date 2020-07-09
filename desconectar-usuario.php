<?php
    session_start();
    
    if($_SESSION){
        session_destroy();
        echo "<script> alert('¡Se ha cerrado sesión!');
        self.location = 'login.html';
        </script>";    
    }else{
        echo "<script> alert('¡Porfavor inicie sesión!');
        iniciar.location = 'login.html';
        </script>";
    }_


?>
