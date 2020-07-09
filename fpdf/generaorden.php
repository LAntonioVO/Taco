<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	if ( isset( $_GET[ 'tiposesion' ] ) && isset( $_GET[ 'nsesion' ] ) && isset( $_GET[ 'hora' ] ) && isset( $_GET[ 'fecha' ] ) && isset( $_GET[ 'participante' ] ) ) {
		$tiposesion = $_GET[ 'tiposesion' ];
		$nsesion = $_GET[ 'nsesion' ];
		$hora = $_GET[ 'hora' ];
		$participantes = $_GET[ 'participante' ];
		$fecha = $_GET[ 'fecha' ];
		require_once( "fpdf/fpdf.php" );
		class PDF extends FPDF {


			//Cabecera de página
			function Header() {
				$this->Image( 'images/logoitesa.png', 30, 15, 40 );
				$this->SetFont( 'Arial', 'B', 13 );
				$this->SetXY( 75, 20 );
				$this->MultiCell( 110, 5, utf8_decode( 'Instituto Tecnológico Superior del Oriente del Estado de Hidalgo' ), 0, 'R', 0 );
				$this->Line( 35, 35, 180, 35 );

			}

			function Footer() {
				global $nsesion;
				global $tiposesion;
				$this->Line( 35, 270, 190, 270 );
				$this->SetFont( 'Arial', 'I', 10 );
				$this->SetXY( 40, 270 );
				$this->Cell( 0, 10, 'Acta de la ' . utf8_decode( $nsesion ) . ' ' . utf8_decode( $tiposesion ) . ' de ' . date( "Y" ) . ' del ' . utf8_decode( "comité académico" ) . "                   " . $this->PageNo() . " de " . '{nb}', 0, 0, 'L' );

			}
		}

		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont( 'Arial', 'B', 10 );
		$pdf->SetXY( 30, 40 );
		$addr = strtr( $tiposesion, "áéíóú", "ÁÉÍÓÚ" );
		$pdf->MultiCell( 160, 5, strtoupper( utf8_decode( "ACTA DE LA " . strtoupper( $nsesion ) . ' ' . $addr . " de " . date( "Y" ) . " del comitÉ acadÉmico del instituto tecnolÓgico superior del oriente del estado de hidalgo (itesa)" ) ), 0, "C", 0 );

		$pdf->SetFont( 'Arial', 'B', 9 );
		$pdf->Ln( 4 );
		$pdf->SetX( 30 );
		$cadena = "";
		$conta = 0;
		for ( $i = 0; $i < sizeof( $participantes ); $i++ ) {
			if ( $participantes[ $i ] == "Mtro J. Arturo Vega Torres" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Director Académico; ";
			} else if ( $participantes[ $i ] == "MAN. Jazmín Juárez González" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Subdirectora de Innovación y Desarrollo Académico; ";
			} else if ( $participantes[ $i ] == " Mtro Gerardo Valentín Carrera Hernández" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Subdirector de Planeación y Evaluación; ";
			} else if ( $participantes[ $i ] == "Ing. Román Ortega Hernández" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería en Sistemas Computacionales; ";
				$carreras[ $conta ] = 2;
				$conta++;
			} else if ( $participantes[ $i ] == "Ing. Miguel Negrete Ibarra" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería en Electromecánica; ";
				$carreras[ $conta ] = 3;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtro, en E. Erick Avendaño Vazquez" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería Civil";
				$carreras[ $conta ] = 5;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtra. Yazmín Chavarría Moctezuma" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefa de División de Ingeniería en Industrias Alimentarias; ";
				$carreras[ $conta ] = 4;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtro. Enrique Moreno Vargaz" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Licenciatura en Administración; ";
				$carreras[ $conta ] = 6;
				$conta++;
			} else if ( $participantes[ $i ] == "Ing. María del Refugio Barrientos Ramirez" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería en Mecatrónica; ";
				$carreras[ $conta ] = 7;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtra. Martha Angélica Cano Figueroa" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefa de División de Ingeniería en Gestión Empresarial; ";
				$carreras[ $conta ] = 8;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtra. en C. María Guadalupe Hernández Ortega" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería en Logística; ";
				$carreras[ $conta ] = 9;
				$conta++;
			} else if ( $participantes[ $i ] == "Mtro. en C. Oscar González Hernández" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Jefe de División de Ingeniería en Sistemas Automotrices; ";
				$carreras[ $conta ] = 10;
				$conta++;
			} else if ( $participantes[ $i ] == "Ing. Heriberto Dany Osorio Ortiz" ) {
				$cadena = $cadena . $participantes[ $i ] . ", Encargado del Departamento de Servicios Escolares";
			}

		}

		$pdf->MultiCell( 160, 5, utf8_decode( "En la ciudad de Apan Hidalgo siendo las " . $hora . " horas del dÍa " . $fecha . ", en la sala de juntas de la Dirección General del Instituto Tecnológico Superior del Oriente del Estado de Hidalgo (ITESA), se reunieron los directivos siguientes: " . $cadena . "." ), 0, "J", 0 );
		$pdf->Ln( 4 );
		$pdf->SetX( 30 );
		$pdf->MultiCell( 160, 5, utf8_decode( "Con el fin de llevar a cabo la " . $nsesion . " Sesión Ordinaria de " . date( "Y" ) . ", del Comité Académico del Instituto Tecnológico Superior del Oriente del Estado de Hidalgo, ITESA, con fundamento en el Artículo 4.6, de los Lineamientos para la Operación del Comité Académico Versión 1.0, Planes de Estudio 2009-2010, esta sesión fue convocada con la oportunidad requerida para llevarse a cabo conforme lo siguiente:" ), 0, "J", 0 );

		$pdf->Ln( 4 );
		$pdf->SetX( 30 );
		$pdf->MultiCell( 160, 5, utf8_decode( "ORDEN DEL DÍA" ), 0, "C", 0 );

		$pdf->Ln( 3 );
		$pdf->SetX( 30 );
		$pdf->MultiCell( 160, 5, utf8_decode( "1. Lista de asistencia y declaración del Quórum Legal." ), 0, "J", 0 );
		$pdf->Ln( 2 );
		$pdf->SetX( 30 );
		$pdf->MultiCell( 160, 5, utf8_decode( "2. Presentación y, en su caso, aprobación del Orden del Día" ), 0, "J", 0 );

		if ( $tiposesion == "Sesión ordinaria" ) {
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "3. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería en Sistemas Computacionales" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "4. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería Electromecánica" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "5. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería en Industrias Alimentarias" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "6. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería Civil" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "7. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Licenciatura en Administración" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "8. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería en Gestión Empresarial" ), 0, "J", 0 );
			$pdf->AddPage();
			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "9. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería Mecatrónica" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "10. Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de       Ingeniería en Logística" ), 0, "J", 0 );
			$pdf->Ln( 2 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "11. Asuntos Generales" ), 0, "J", 0 );

			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "DESARROLLO DE LA SESIÓN" ), 0, "C", 0 );

			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO 1: Lista de asistencia y declaración del Quórum Legal." ), 0, "J", 0 );
			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "El Mtro. J. Arturo Vega Torres, comenta que según el registro de esistencia existe quórum para sesionar, por lo que, los acuerdos que emanen del Comité Académico tendrán validez." ), 0, "J", 0 );


			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO 2: Presentación y, en su caso, aprobación del Orden del Día." ), 0, "J", 0 );
			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "El Mtro. J. Arturo Vega Torres, somete a la consideración del Comité Académico el Orden del Día, el cual es aprobado por unanimidad." ), 0, "J", 0 );

			$cont = 3;
			require_once( "conect/conect.php" );
			for ( $i = 0; $i < sizeof( $carreras ); $i++ ) {

				$consulta = "SELECT Ncord, esp_Nombre, esp_ClaveInterna FROM ceespecialidades WHERE esp_ID='$carreras[$i]'";
				$res = consultar( $consulta );
				$r = mysqli_fetch_array( $res );
				verifica();
				verifica2();
				$pdf->Ln( 10 );
				$pdf->SetX( 30 );

				$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO " . $cont . ": Presentación y, en su caso, emisión de recomendaciones de estudiantes del Programa Educativo de " ) . $r[ 'esp_Nombre' ], 0, "J", 0 );
				$clave = $r[ 'esp_ClaveInterna' ];
				$articulo = "";
				if ( $r[ 'Ncord' ] == "Mtra. Yazmín Chavarría Moctezuma" || $r[ 'Ncord' ] == "Ing. María del Refugio Barrientos Ramirez" || $r[ 'Ncord' ] == "Mtra. Martha Angélica Cano Figueroa" || $r[ 'Ncord' ] == "Mtra. en C. María Guadalupe Hernández Ortega" ) {
					$articulo = "La ";
				} else {
					$articulo = "El ";
				}
				verifica();
				$pdf->Ln( 5 );
				$pdf->SetX( 30 );
				$pdf->MultiCell( 160, 5, $articulo . " " . $r[ 'Ncord' ] . utf8_decode( ", presenta los casos de los (las) estudiantes que a continuación" ) . " se indican; los cuales se analizaron, evaluaron y emitieron las recomendaciones correspondientes:", 0, "J", 0 );
				$cont++;

				$consulta2 = "SELECT alu_Nombre, alu_ApePaterno, alu_ApeMaterno FROM cealumnos a, peticiones p WHERE p.Matrialumno=a.alu_NumControl AND '$clave'=p.Especialidad AND p.Estado_Peticion=3";

				$res2 = consultar( $consulta2 );

				verifica();
				$cont2 = 1;
				$pdf->Ln( 5 );
				$pdf->SetFont( 'Arial', 'B', 8 );
				while ( $r2 = mysqli_fetch_array( $res2 ) ) {

					verifica();
					$pdf->SetX( 30 );
					$pdf->MultiCell( 160, 5, utf8_decode( $cont2 . ". " . $r2[ 'alu_Nombre' ] . " " . $r2[ 'alu_ApePaterno' ] . " " . $r2[ 'alu_ApeMaterno' ] ), 0, "J", 0 );
					$cont2++;
				}
				$pdf->SetFont( 'Arial', 'B', 9 );



			}
			verifica2();
			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO " . $cont . ": Asuntos Generales." ), 0, "J", 0 );
			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "El Mtro. J. Arturo Vega Torres, pregunta a los integrantes del Comité Académico si existe algún asunto general que tratar, de no ser así, y una vez agotados los puntos del orden del día, les agradece su presencia, declarándose concluida la " . $nsesion . " Sesión Ordinaria de " . date( "Y" ) . ", del Comité Académico del Instituto Tecnológico Superior del Oriente del Estado de Hidalgo, ITESA, siendo las " . $hora . " horas, firmando de conformidad los que en ella intervinieron." ), 0, "J", 0 );

			firmas();




		} else {
			
			$ordenes=explode ("\n",$_GET['orden']); 
			for($i=0;$i<sizeof($ordenes);$i++){
				$pdf->Ln(2);
				$pdf->SetX(30);
				verifica();
				$pdf->MultiCell( 160, 5, $i+3 .". ". utf8_decode($ordenes[$i]), 0, "J", 0 );	
			}
			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			verifica();
			$pdf->MultiCell( 160, 5, utf8_decode( "DESARROLLO DE LA SESIÓN" ), 0, "C", 0 );

			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			verifica();
			$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO 1: Lista de asistencia y declaración del Quórum Legal." ), 0, "J", 0 );
			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "El Mtro. J. Arturo Vega Torres, comenta que según el registro de esistencia existe quórum para sesionar, por lo que, los acuerdos que emanen del Comité Académico tendrán validez." ), 0, "J", 0 );


			$pdf->Ln( 10 );
			$pdf->SetX( 30 );
			verifica2();
			$pdf->MultiCell( 160, 5, utf8_decode( "PUNTO NÚMERO 2: Presentación y, en su caso, aprobación del Orden del Día." ), 0, "J", 0 );
			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode( "El Mtro. J. Arturo Vega Torres, somete a la consideración del Comité Académico el Orden del Día, el cual es aprobado por unanimidad." ), 0, "J", 0 );

			$pdf->Ln( 5 );
			$pdf->SetX( 30 );
			$pdf->MultiCell( 160, 5, utf8_decode($_GET['recomendacion']), 0, "J", 0 );
			
			firmas();
			
		}
	} else {
		header( "Location:gactas.php" );
	}
	$pdf->Output();



	function verifica() {
		global $pdf;
		if ( $pdf->getY() > 240 ) {
			$pdf->AddPage();
			$pdf->SetXY( 30, 40 );
		} else if ( $pdf->getY() < 40 ) {
			$pdf->SetY( 40 );
		}

	}


	function verifica2() {
		global $pdf;
		if ( $pdf->getY() > 200 ) {
			$pdf->AddPage();
			$pdf->SetXY( 30, 40 );
		}
	}
	

	function firmas() {
		global $pdf;
		global $participantes;
		global $nsesion;
		global $tiposesion;
		$pdf->AddPage();
		$pdf->SetXY( 30, 40 );
		$pdf->MultiCell( 160, 5, utf8_decode( "Las presentes firmas corresponden al Acta de la " . $nsesion . " " . $tiposesion . " de " . date( "Y" ) . ", del Comité Académico del Instituto Tecnológico Superior del Oriente del Estado de Hidalgo. " ), 0, "J", 0 );

		$fila = 60;
		$columna = 35;


		for ( $i = 0; $i < sizeof( $participantes ); $i++ ) {
			$nombre = "";
			$cargo = "";
			
			
			
			
			if ( $participantes[ $i ] == "Mtro J. Arturo Vega Torres" ) {
				$nombre = "Mtro J. Arturo Vega Torres";
				$cargo = "Presidente del Comité Académico";
			} else if ( $participantes[ $i ] == "MAN. Jazmín Juárez González" ) {
				$nombre = "MAN. Jazmín Juárez González";
				$cargo = "Subdirección de Innovación y Desarrollo Académico";
			} else if ( $participantes[ $i ] == " Mtro Gerardo Valentín Carrera Hernández" ) {
				$nombre = "Mtro. Gerardo Valentín Carrera Hernández";
				$cargo = "Subdirector de Planeación y Evaluación";
			} else if ( $participantes[ $i ] == "Ing. Román Ortega Hernández" ) {
				$nombre = "Ing. Román Ortega Hernández";
				$cargo = "Jefe de División de Ingeniería en Sistemas Computacionales";
			} else if ( $participantes[ $i ] == "Ing. Miguel Negrete Ibarra" ) {
				$nombre = "Ing. Miguel Negrete Ibarra";
				$cargo = "Jefe de División de Ingeniería en Electromecánica";
			} else if ( $participantes[ $i ] == "Mtro, en E. Erick Avendaño Vazquez" ) {
				$nombre = "Mtro, en E. Erick Avendaño Vazquez";
				$cargo = "Jefe de División de Ingeniería Civil";
			} else if ( $participantes[ $i ] == "M. Yazmín Chavarría Moctezuma" ) {
				$nombre = "Mtra. Yazmín Chavarría Moctezuma";
				$cargo = "Jefa de División de Ingeniería en Industrias Alimentarias";
			} else if ( $participantes[ $i ] == "Mtro. Enrique Moreno Vargaz" ) {
				$nombre = "Mtro. Enrique Moreno Vargaz";
				$cargo = "Jefe de División de Licenciatura en Administración";
			} else if ( $participantes[ $i ] == "Ing. María del Refugio Barrientos Ramirez" ) {
				$nombre = "Ing. María del Refugio Barrientos Ramirez";
				$cargo = "Jefa de División de Ingeniería en Mecatrónica";
			} else if ( $participantes[ $i ] == "Mtra. Martha Angélica Cano Figueroa" ) {
				$nombre = "M. Martha Angélica Cano Figueroa";
				$cargo = "Jefa de División de Ingeniería en Gestión Empresarial";
			} else if ( $participantes[ $i ] == "Mtra. en C. María Guadalupe Hernández Ortega" ) {
				$nombre = "Mtro. en C. María Guadalupe Hernández Ortega";
				$cargo = "Jefa de División de Ingeniería en Logística";
			} else if ( $participantes[ $i ] == "Mtro. en C. Oscar González Hernández" ) {
				$nombre = "Mtro. en C. Oscar González Hernández";
				$cargo = "Jefe de División de Ingeniería en Sistemas Automotrices";
			} else if ( $participantes[ $i ] == "Ing. Heriberto Dany Osorio Ortiz" ) {
				$nombre = "Ing. Heriberto Dany Osorio Ortiz";
				$cargo = "Jefe del Departamento de Servicios Escolares";
			}
			if ( $nombre != "" ) {
				
				$pdf->SetXY( $columna - 10, $fila );
				$pdf->MultiCell( 80, 5, utf8_decode( $nombre ), 0, "C", 0 );
				$fila = $fila + 5;
				$pdf->SetXY( $columna, $fila );
				$pdf->MultiCell( 60, 5, utf8_decode( $cargo ), 0, "C", 0 );
				$fila = $fila + 15;
				$pdf->SetXY( $columna, $fila );
				$pdf->Line( $columna, $fila + 8, $columna + 60, $fila + 8 );
				$fila -= 20;
				$columna += 80;
				if ( $columna > 125 ) {
					$columna = 35;
					$fila += 35;
				}
				
				$pdf->SetY($fila);
				if($pdf->getY() > 254 ) {
					$pdf->AddPage();
					$fila = 60;
					$columna = 35;
				}
			}
			
		}
	}

	?>
</body>

</html>