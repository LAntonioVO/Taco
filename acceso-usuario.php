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

    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];
    
    $verificar_restaurant="SELECT * FROM restaurantes WHERE correo='$correo' and contrasena='$contrasena'";
    $result1=$conectar->query($verificar_restaurant);
    
    $verificar_asociacion="SELECT * FROM asociaciones WHERE correo='$correo' and contrasena='$contrasena'";
    $result2=$conectar->query($verificar_asociacion);

    if($result1->num_rows == 1) {
 
       $row = $result1->fetch_array();
       $_SESSION['id_restaurante'] = $row['id_restaurante'];
       $_SESSION['nombre'] = $row['nombre'];
        echo "<script> alert('¡Te has logueado como restaurante!');
               self.location = 'inicio-restaurant.php';
              </script>";
    }
    else if($result2->num_rows == 1) {
       $row = $result2->fetch_array();
       $_SESSION['id_asociacion'] = $row['id_asociacion'];
       $_SESSION['asociacion'] = $row['asociacion'];
       
     echo "<script> alert('¡Te has logueado como asociacion!');
       self.location = 'inicio-asociacion.php';
      </script>";
    }else{
        echo "<script> alert('Usuario o contraseña no válidos!');
               self.location = 'login.html';
              </script>";
    }

?>
