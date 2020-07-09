<?php
    $host = 'localhost';
    $user = 'admin';
    $pass = 'adminmysqli';
    $datb = 'id9670846_tacobd';
    $conectar = new mysqli($host, $user, $pass, $datb);
    if($conectar->connect_error){
        echo"No se puede conectar";
    }

    
    
    session_start();

    if(!$_SESSION){
        echo "<script> alert('¡Debe de iniciar sesión!');
                self.location = 'login.html';
                </script>";
    }

    $id_restaurante = $_SESSION['id_restaurante'];
    $informacion=$_POST['informacion'];

    $insertar="INSERT INTO avisos (id_restaurante,informacion)  VALUES('$id_restaurante','$informacion')";

        if($conectar->query($insertar) == TRUE){
            echo "<script> alert('¡Se ha lanzado el aviso!');
                   self.location = 'inicio-restaurant.php';
                  </script>";
        }else{
           echo "<script> alert('Ocurrió un error intentelo de nuevo');
                   self.location = 'aviso.php';
                  </script>";
        }

?>
