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
    $id_asociacion = $_SESSION['id_asociacion'];
    $asociacion = $_SESSION['asociacion'];
    echo "<script>alert(".$_SESSION['asociacion'].");</script>";
    //Datos del restaurante
    $asoci="SELECT * FROM asociaciones WHERE id_asociacion=".$id_asociacion;
    $result1=$conectar->query($asoci);
    $row = $result1->fetch_array();
    $informacion = $row["informacion"];
    $correo = $row["correo"];

    //Mostrar los avisos no tomados
    $misavisos="SELECT * FROM avisos WHERE id_asociacion =".$id_asociacion;
    $resultmisavisos=$conectar->query($misavisos);

    $todosavisos="SELECT * FROM avisos WHERE id_asociacion is null";
    $resultavisos=$conectar->query($todosavisos);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Principal</title>
</head>
<body>
  <div class="stickyBienvenida">
    <label>Bienvenido</label>
    <a id="boton-salir" href="desconectar-usuario.php" class="btn btn-primary">Salir</a>
  </div>

  <div class="container">
    <div class="row mx-auto">
      <div class="col border">
          <table class="table">
            <tbody>
              <tr>
                <th scope="row">Nombre:</th>
                <td><h2 id="nombre"><?php echo $asociacion ?></h2></td>
              </tr>
              <tr>
                  <th scope="row">Info:</th>
                  <td id="encargado"><?php echo $informacion ?></td>
              </tr>
              <tr>
                <th scope="row">Correo:</th>
                <td id="correo"><?php echo $correo ?></td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="col">
        <div class="aviso-control border">
          <h3>Mis Avisos Atendidos</h3>
          <?php
             if($resultmisavisos->num_rows != 0){
                while($row = $resultmisavisos->fetch_array()){
                    $restaurant="SELECT nombre,direccion,correo FROM restaurantes WHERE id_restaurante=".$row['id_restaurante'];
                        $resulRestaurant=$conectar->query($restaurant);
                        $restaurante = $resulRestaurant->fetch_array();

                  echo '
                  <div class="card">
                      <div class="card-header">Aviso de comida</div>
                      <div class="card-body">
                      
                          <table class="table">
                              <tbody>
                                <tr>
                                  <th scope="row">Nombre:</th>
                                  <td id="nombre">'.$restaurante['nombre'].'</td>
                                </tr>
                                <tr>
                                  <th scope="row">Dirección:</th>
                                  <td id="dirección">'.$restaurante['direccion'].'</td>  
                                  <td> 
                                    <form method="get" action="ruta.html" target="_blank">
                                      <input type="hidden" name="ruta" value="'.$restaurante['direccion'].'">
                                      <button type="submit" class="btn btn-secondary">Ver ruta</button>
                                    </form> 
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Correo:</th>
                                  <td id="correo">'.$restaurante['correo'].'</td>
                                </tr>
                              </tbody>
                            </table>
                            
                        <p class="card-text">'.$row["informacion"].'</p>
                        
                         <form method="POST">
                          <input type="hidden" name="id-aviso-quitar" value="'.$row['id_aviso'].'">
                          <button type="submit" class="btn btn-primary">Desatender Aviso</button>
                        </form>

                        

                      </div>
                    </div>                   
                    <br>
                      ';
                  }
             }else{
                echo "<br><h3>Aún no tiene avisos tomados</h3>";
            }?>

        </div>
      </div>
    </div>
    
    <div class="row mx-auto">
      <div class="col border aviso-control">
        <h3>Todos los avisos de los restaurantes</h3> <br>

        <?php
             if($resultavisos->num_rows != 0){
                while($rowa = $resultavisos->fetch_array()){
                    $restaurant="SELECT nombre,direccion,correo FROM restaurantes WHERE id_restaurante=".$rowa['id_restaurante'];
                        $resulRestaurant=$conectar->query($restaurant);
                        $restaurante = $resulRestaurant->fetch_array();

                  echo '
                  <div class="card">
                      <div class="card-header">Aviso de comida</div>
                      <div class="card-body">
                          <table class="table">
                              <tbody>
                                <tr>
                                  <th scope="row">Nombre:</th>
                                  <td id="nombre">'.$restaurante['nombre'].'</td>
                                </tr>
                                <tr>
                                  <th scope="row">Dirección:</th>
                                  <td id="dirección">'.$restaurante['direccion'].'</td>
                                </tr>
                                <tr>
                                  <th scope="row">Correo:</th>
                                  <td id="correo">'.$restaurante['correo'].'</td>
                                </tr>
                              </tbody>
                            </table>
                            
                        <p class="card-text">'.$rowa["informacion"].'</p>
                        <form method="POST">
                          <input type="hidden" name="id-aviso-tomar" value="'.$rowa['id_aviso'].'">
                          <button type="submit" class="btn btn-primary">Atender Aviso</button>
                        </form>
                      </div>
                    </div>                   
                    <br>
                      ';
                  }
             }else{
                echo "<br><h3>Aún no hay avisos</h3>";
            }?>

            <?php
             if(isset($_POST['id-aviso-tomar'])){
              
              $agregar="UPDATE avisos SET id_asociacion = '".$id_asociacion."' WHERE avisos.id_aviso = ".$_POST['id-aviso-tomar'].";";
               if($conectar->query($agregar)){
                  echo "<script>alert('¡Se ha tomado el aviso!');
                        self.location = 'inicio-asociacion.php';
                        </script>";
               }

             }
              if(isset($_POST['id-aviso-quitar'])){
              
              $agregar="UPDATE avisos SET id_asociacion = null WHERE avisos.id_aviso = ".$_POST['id-aviso-quitar'].";";
               if($conectar->query($agregar)){
                  echo "<script>alert('¡Se ha quitado el aviso!');
                        self.location = 'inicio-asociacion.php';
                        </script>";
               }

            }
    ?>
      </div>
    </div>
  </div>
  <footer class="blog-footer">
    <p>Diseñado con amor desde México  </p>
    <p><a href="#">Volver arriba</a></p>
  </footer>
</body>
</html>