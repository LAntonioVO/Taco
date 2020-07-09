<?php
    $host = 'localhost';
    $user = 'admin';
    $pass = 'adminmysqli';
    $datb = 'id9670846_tacobd';


    $conectar = new mysqli($host, $user, $pass, $datb);
    if($conectar->connect_error){
        echo"No se puede conectar";
    }else{
        echo"Conectado";
    }
    

    $restaurante=$_POST['nombrerestaurante'];
    $encargado=$_POST['personaencargada'];
    $direccion=$_POST['direccion'];
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $verificar_asociacion="SELECT correo FROM asociaciones WHERE correo='$correo'";
    $result1=$conectar->query($verificar_asociacion);    
    
    $verificar_restaurant="SELECT correo FROM restaurantes WHERE correo='$correo'";
    $result2=$conectar->query($verificar_restaurant);

    if($result1->num_rows == 0 && $result2->num_rows == 0){
        $insertar="INSERT INTO restaurantes (nombre,encargado,direccion,correo,contrasena)  VALUES('$restaurante',
                                        '$encargado',   
                                        '$direccion',                                    
                                        '$correo',
                                        '$contrasena')";
        
        if($conectar->query($insertar) == TRUE){

            echo "<script> alert('¡Te has registrado! Ahora puedes ingresar');
                   self.location = 'login.html';
                  </script>";
        }else{
           echo "<script> alert('Ocurrió un error intentelo de nuevo');
                   self.location = 'reg-restaurant.html';
                  </script>";
        }
    }else{
           echo "<script> alert('Este correo ya se ha registrado');
                   self.location = 'reg-restaurant.html';
                  </script>";
    }
?>
