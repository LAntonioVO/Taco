<?php
    $host = 'localhost';
    $user = 'admin';
    $pass = 'adminmysqli';
    $datb = 'id9670846_tacobd';

    


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';




    $conectar = new mysqli($host, $user, $pass, $datb);
    if($conectar->connect_error){
        echo"No se puede conectar";
    }

    $asociacion=$_POST['nombreasociacion'];
    $informacion=$_POST['informacion'];
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $verificar_asociacion="SELECT correo FROM asociaciones WHERE correo='$correo'";
    $result1=$conectar->query($verificar_asociacion);    
    
    $verificar_restaurant="SELECT correo FROM restaurantes WHERE correo='$correo'";
    $result2=$conectar->query($verificar_restaurant);
    if($result1->num_rows == 0 && $result2->num_rows == 0){
        $insertar="INSERT INTO asociaciones (asociacion,informacion,correo,contrasena)  VALUES('$asociacion',
                                        '$informacion',                                       
                                        '$correo',
                                        '$contrasena')";
        if($conectar->query($insertar) == TRUE){


            $mail = new PHPMailer;
            $mail->isSMTP(); 
            $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is deprecated
            $mail->SMTPAuth = true;
            $mail->Username = ''; // email de gmail de donde se envia
            $mail->Password = ''; // password de email
            $mail->setFrom('Echetuntaco@taco.com', 'EchateUntaco'); // From email and name
            $mail->addAddress($correo, $asociacion); // to email and name
            $mail->Subject = 'REGISTRADO';
            $mail->msgHTML("Te has logueado en Echate un taco"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
            // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

            if(!$mail->send()){
                echo "Mailer Error: " . $mail->ErrorInfo;
            }else{
                echo "Message sent!";
            }


            echo "<script> alert('¡Te has registrado! Ahora puedes ingresar');
                   self.location = 'login.html';
                  </script>";
        }else{
           echo "<script> alert('Ocurrió un error intentelo de nuevo');
                   self.location = 'reg-asoci.html';
                  </script>";
        }
    }else{
           echo "<script> alert('Este correo ya se ha registrado');
                   self.location = 'reg-asoci.html';
                  </script>";
    }
?>
