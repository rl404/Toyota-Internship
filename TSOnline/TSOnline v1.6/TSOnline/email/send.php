<?php
	header('Content-type: text/plain; charset=utf-8');

	require_once("PHPMailer/PHPMailerAutoload.php");

	$mail = new PHPMailer;

	$mail->isHTML(true);

	$mail->isSMTP();                                      
	$mail->Host = 'mail-relay.toyota.co.id'; 
	$mail->SMTPAuth = false; 

	$mail->setFrom('admin-ts-ed@toyota.co.id');
	$mail->addAddress("ed_magang_01@toyota.co.id");

	if($_POST['type'] == 1){
		$mail->Subject  = 'TS New Update';

		$reqMonth = date("F",mktime(0,0,0,$_POST['reqmonth'],1,2011));

		$bodyMail = "
		Dear Mr / Mrs,<br><br>
		
		TMC has announced new TS update on $_POST[reqday]-$reqMonth-$_POST[reqyear].<br><br>";
		
		for($i=0;$i<count($_POST['tsno']);$i++){
			$tsno = $_POST['tsno'][$i];
			$rev = $_POST['rev'][$i];
			$content = $_POST['content'][$i];

			$bodyMail .= "$tsno REV.$rev $content<br>";
		}
		$bodyMail .= "<br>

			Please use this URL to access the TS Online system:
			<a href='http://intranet.toyota.co.id/TSOnline/'>TS Online Link</a><br>
			<i>*please do not reply this email.</i><br><br>

			Best Regards,<br><br><br>


			TS Online Administrator<br><br>";

	}else{
		$mail->Subject  = 'Supplier New Request';
	}	

	$mail->Body = $bodyMail;

	if(!$mail->send()) {
		echo "<script type='text/javascript'> document.location = 'tsauto.php?ok=0'; </script>";
	  	// echo 'Message was not sent.';
	  	// echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {}
	
?>