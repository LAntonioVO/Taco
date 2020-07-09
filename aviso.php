<?php
//Inicial a la bd
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

    $nombre = $_SESSION['nombre'];
    
    //Datos del restaurante
    $restaurant="SELECT * FROM restaurantes WHERE id_restaurante=".$id_restaurante;
    $result1=$conectar->query($restaurant);
    $row = $result1->fetch_array();
    $encargado = $row["encargado"];
    $direccion = $row["direccion"];
    $correo = $row["correo"];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Nuevo Aviso</title>
</head>
<body>
    <div class="stickyBienvenida">
        <label>Nuevo aviso</label>
    </div>
    <div class="container mitad">
        <form action="lanzar-aviso.php" method="POST">
        
            <div class="form-group">
                <label for="restaurante">Restaurante</label>
                <input type="text" id="txt-restaurante" name="restaurante" class="form-control" value="<?php echo $nombre; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="txt-direccion" name="direccion" class="form-control" value="<?php echo$direccion ?>" readonly>
            </div>
            <div class="form-group">
                <label for="correo">Correo de contacto</label>
                <input type="text" id="txt-correo" name="correo" class="form-control" value="<?php echo$correo ?>" readonly>
            </div>
            <div class="form-group">
                <label for="informacion">Información de aviso (Tipo de comida, fecha de caducidad, etc)</label>
                <textarea type="text" style="height: 100px;" id="txt-info" name="informacion" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Lanzar Aviso</button>
            <a href="inicio-restaurant.php" class="btn btn-secudnary">Volver</a> 
        </form>
    </div>
</body>
</html>
