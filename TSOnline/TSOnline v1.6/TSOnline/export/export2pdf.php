<?php

require('fpdf/fpdf.php');


class PDF extends FPDF {
	function Header(){
		$this->SetMargins(1.5,1.5,1.5);
	    $this->SetXY(1.5,1.5);
	    $this->SetFont('Arial','B',20);
		$this->Cell(0,0.45,'TOYOTA','0',0,'L');
		$this->Ln();

		$this->SetXY(0,1.5);
	    $this->Cell(19,0.45,'TMMIN','0',0,'R');
	    $this->Ln();	

	    // line
		$this->SetLineWidth(0.05);
		$this->Line(1.5,2.1,19,2.1);

		$this->SetX(1.5);
		$this->SetFont('Arial','B',8);
	    $this->Cell(0,1,'PT.TOYOTA MOTOR MANUFACTURING INDONESIA','0',0,'L');
	    $this->Ln();

	    // Address
		$this->SetFont('Arial','',7);
		$this->Cell(0,0.3,'Head Office, Jl.Laks.Yos Sudarso,Sunter II','0',0,'L');
		$this->Ln();
		$this->Cell(0,0.3,'Jakarta 14330 - Indonesia','0',0,'L');
		$this->Ln();
		$this->Cell(0,0.3,'Phone: +62-021-651-5551 (Hunting)','0',0,'L');
		$this->Ln();
		$this->Cell(0,0.3,'Facsimile: +62-021-651-5327','0',0,'L');
		$this->Ln();
	}

	// Page footer
	function Footer(){
	    $this->SetY(-1.5);
		$this->SetFont('Arial','',8);
		$this->Cell(0,1,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	// table
	function TableAttach(){
		$tsno = explode(",", $_GET['ts']);
		$rev = explode(",", $_GET['rev']);
		$model = explode(",", $_GET['model']);
		$part = explode(",", $_GET['part']);

		// Column widths
	    $w = array(1, 4, 4, 5, 3);
	    // Header
	    $header = array('NO', 'TS No', 'Model', 'Related Part No.', 'Remarks');
	    $this->SetFont('Arial','B',10);

	    for($i=0;$i<count($header);$i++){	    	
	        $this->Cell($w[$i],1,$header[$i],1,0,'C');
	    }
	    $this->Ln();

	    $this->SetFont('Arial','',10);
	    $this->Cell($w[0],0.6,'1','LR',0,'C');
	    $this->Cell($w[1],0.6,'See attachment','LR',0,'C');
	    $this->Cell($w[2],0.6,$model[1],'LR',0,'C');
	    $this->Cell($w[3],0.6,$part[1],'LR',0,'C');
	    $this->Cell($w[4],0.6,'Renewal','LR',0,'C');
	    $this->Ln();

	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}

	function Table(){

		$tsno = explode(",", $_GET['ts']);
		$rev = explode(",", $_GET['rev']);
		$model = explode(",", $_GET['model']);
		$part = explode(",", $_GET['part']);

	    // Column widths
	    $w = array(1, 4, 4, 5, 3);
	    // Header
	    $header = array('NO', 'TS No', 'Model', 'Related Part No.', 'Remarks');
	    $this->SetFont('Arial','B',10);

	    for($i=0;$i<count($header);$i++){	    	
	        $this->Cell($w[$i],1,$header[$i],1,0,'C');
	    }
	    $this->Ln();

	    for($i=1;$i<count($tsno);$i++){
		    if(!empty($tsno[$i])){
			    $this->SetFont('Arial','',10);
			    $this->Cell($w[0],0.6,$i,'LR',0,'C');
			    $this->Cell($w[1],0.6,$tsno[$i]." rev.".$rev[$i],'LR',0,'L');
			    $this->Cell($w[2],0.6,$model[$i],'LR',0,'C');
			    $this->Cell($w[3],0.6,$part[$i],'LR',0,'C');
			    $this->Cell($w[4],0.6,'Renewal','LR',0,'C');
			    $this->Ln();
			}
		}
	    
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}

}

// Instanciation of inherited class
$pdf = new PDF('P','cm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(1.5,1.5,1.5);
	

// letter no + date
$pdf->Ln(0.5);
$pdf->SetFont('Arial','',10);
$pdf->SetX(14);
$pdf->Cell(0,0.45,'No: ',0,'L');
$pdf->Ln();
$pdf->SetX(14);

$dated = 0;
$datem = 0;
$datey = 0;
if(empty($_GET['day'])){
	$dated = date('d');
	$datem = date('M', mktime(0, 0, 0, date('m'), 10)); 
	$datey = date('Y');
}else{
	$dated = $_GET['day'];
	$datem = $_GET['month'];
	$datey = $_GET['year'];
}
$pdf->Cell(0,0.45,"Jakarta, $dated-$datem-$datey",0,'L');
$pdf->Ln(1.5);

//to
$pdf->SetFont('Arial','',10);
$pdf->Write(0.3,"To: PT. $_GET[supplier]");
$pdf->Ln(1.5);

//subject
$pdf->SetFont('Arial','',10);
$pdf->Write(0.3,'Subject: Toyota Engineering Standard');
$pdf->Ln(1);

//intro
$pdf->Write(0.5,'Dear Sir,');
$pdf->Ln();
$pdf->Write(0.45,'First, we appreciate your TMMIN Project kind support.');
$pdf->Ln();
$pdf->Write(0.45,'We have the pleasure of sending you herewith the below mentioned document.');
$pdf->Ln(1);
$pdf->Write(0.5,'Contents are:');
$pdf->Ln();

//table
$tsno = explode(",", $_GET['ts']);
if(count($tsno) <= 5){
	$pdf->Table();
	$pdf->Ln(1);
}else{
	$pdf->TableAttach();
	$pdf->Ln(1);
}

$pdf->Write(0.3,'Thank you very much.');
$pdf->Ln(5);

// sign
$pdf->Write(0.45,'Sincerely yours,');
$pdf->Ln();
$pdf->Write(0.45,'Engineering Division');
$pdf->Ln();
$pdf->Write(0.45,'Engineering Administration Dept.');
$pdf->Ln(2);

$pdf->SetFont('Arial','BU',10);
$pdf->Write(0.45,'Nurhanna F. Kamaruddin');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Write(0.45,'Department Head');
$pdf->Ln();

// new page
if(count($tsno) > 5){
	$pdf->AddPage();

	$pdf->SetMargins(1.5,1.5,1.5);
	$pdf->Ln(0.5);
	
	$pdf->Table();
	$pdf->Ln(1);
}


$pdf->Output();

?>
