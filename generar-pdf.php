<?php
//define('FPDF_FONTPATH','/home/www/font/');
require('fpdf/fpdf.php');
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
$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco) 
$pdf->SetFillColor(255, 133, 56); // establece el color del fondo de la celda (en este caso es AZUL 
$pdf->Cell(275, 20, 'LETRERkjsñalkdsjñlakjfasñkldO', 1, 0, 'C', True); 
$pdf->Output();//'result.pdf','');
?> 