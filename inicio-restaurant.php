<?php
    require('fpdf/fpdf.php');
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

    //Mostrar los avisos del usuario
    $avisos="SELECT * FROM avisos WHERE id_restaurante=".$id_restaurante;
    $resultAviso=$conectar->query($avisos);
    /*$rowAviso = $resultAviso->fetch_array();
    $encargado = $rowAviso["encargado"];
    $direccion = $rowAviso["direccion"];
    $correo = $rowAviso["correo"];*/ 
    
    if (isset($_POST['generarCertificado'])) {
      generarpdf();
    }
     function generarpdf(){
        
        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage(L);
        $pdf->Image('img/icon.jpg',10,10,40);
        $pdf->Image('img/letras.jpg',88,10,100);
        $pdf->Image('img/food.png',228,10,40);
        $pdf->SetFont('Helvetica','I',40);
        $pdf->MultiCell(0,110,utf8_decode('CERTIFICADO DE DONADOR'),0,'C',0);
        $pdf->SetFont('Helvetica','B',50);
        //$pdf->MultiCell(0,10,utf8_decode('[NOMBRE]'),0,'C',0);
        $pdf->SetFont('Helvetica','B',25);
        $pdf->MultiCell(0,30,utf8_decode('Este restaurante ayuda a la comunidad donando comida a los mas necesitados.'),0,'C',0);
        $pdf->SetXY(2,100);          // Primero establece Donde estará la esquina superior izquierda donde estará tu celda 
        $pdf->SetFont('Helvetica','B',50);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco) 
        $pdf->SetFillColor(255, 133, 56); // establece el color del fondo de la celda (en este caso es AZUL 
        $pdf->Cell(275, 20, $_SESSION['nombre'], 1, 0, 'C', True); 
        $pdf->Output('certificado.pdf','D');//'result.pdf','');
      }
                
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
                  <td><h2 id="nombre"><?php echo $nombre ?></h2></td>
                </tr>
                <tr>
                    <th scope="row">Encargado:</th>
                    <td id="encargado"><?php echo $encargado ?></td>
                </tr>
                <tr>
                  <th scope="row">Dirección:</th>
                  <td id="dirección"><?php echo$direccion ?></td>
                </tr>
                <tr>
                  <th scope="row">Correo:</th>
                  <td id="correo"><?php echo $correo ?></td>
                </tr>
              </tbody>
            </table>
            <form action="" method="POST">
              <button type="submit" name="generarCertificado" class="btn btn-secundary">Certificado</button>
            </form>
            <br>
      </div>

      <div class="col">
          <div class="aviso-control border">
            <h3>Mis Avisos</h3>
            <a href="aviso.php" class="btn btn-primary">Nuevo Aviso</a>
          </div>
          <?php
            if($resultAviso->num_rows != 0){
                while($row = $resultAviso->fetch_array()){
                    
                    
                    if($row['id_asociacion'] == null){                 
                        $status = "En espera";
                        $nombreAsoci = '';
                    }
                    else{
                        $status = "Tomado";
                        $asociacion="SELECT asociacion FROM asociaciones WHERE id_asociacion=".$row['id_asociacion'];
                        $resulAsoci=$conectar->query($asociacion);
                        $asociacion = $resulAsoci->fetch_array();
                        $nombreAsoci = ' por '.$asociacion["asociacion"];
                    }   
                    echo    '<div class="card">
                              <div class="card-header">Aviso de comida - '.$status.' '.$nombreAsoci.'</div>
                              <div class="card-body">
                                <p class="card-text">'.$row["informacion"].'</p>
                                 <form method="POST">
                          			<input type="hidden" name="id-aviso-quitar" value="'.$row['id_aviso'].'">
                          			<button type="submit" class="btn btn-primary">Quitar Aviso</button>
                        		</form>';                                
                              if($status == "Tomado"){
                                echo'
                                <form method="POST">
                          			<input type="hidden" name="id-aviso-mostrar" value="'.$row['id_aviso'].'">
                          			<button type="submit" class="btn btn-link">Mostrar de nuevo</button>
                        		</form>

                                ';
                              }
                   echo      '  </div>
                          </div>';
                }
            }else{
                echo "<h3>Aún no tiene avisos</h3>";
            }?>

          <?php
          if(isset($_POST['id-aviso-mostrar'])){
              
              $agregar="UPDATE avisos SET id_asociacion = null WHERE avisos.id_aviso = ".$_POST['id-aviso-mostrar'].";";
               if($conectar->query($agregar)){
                  echo "<script>alert('¡Se ha mostrado el aviso!');
                        self.location = 'inicio-restaurant.php';
                        </script>";
               }

             }
              if(isset($_POST['id-aviso-quitar'])){
              
              $agregar="DELETE FROM avisos WHERE avisos.id_aviso =".$_POST['id-aviso-quitar'].";";
               if($conectar->query($agregar)){
                  echo "<script>alert('¡Se ha quitado el aviso!');
                        self.location = 'inicio-restaurant.php';
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
