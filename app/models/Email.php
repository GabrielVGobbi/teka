<?php 
	

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	


class Email extends Model {

	public function enviarEmail($Parametros){

		if(isset($Parametros)){

			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->SMTPDebug = 0;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'p3plcpnl0703.prod.phx3.secureserver.net';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = 'suporte@landsolucoes.com.br';                     // SMTP username
				$mail->Password   = 'GGv27080@';                               // SMTP password
				$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
				$mail->Port       = 465;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom('oi@stephanivarella.com', 'AdminStyle');
				$mail->addAddress('gabriel.gobbi15@gmail.com', $Parametros['nome']);   
				$mail->addAddress('oi@stephanivarella.com', $Parametros['nome']);     


				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Novo Cliente Cadastrado';
				$mail->Body    = 'Novo cliente se cadastrou no sistema'.

					' 
						Nome '.$Parametros['cli_nome'].'<br>
						Data de Nascimento '.$Parametros['cli_nascimento'].'<br>
						Email '.$Parametros['cli_email'].'<br>
						Endereço '.$Parametros['rua'].'<br>
						Etapas Solicitadas: <br> 
							- Coloração + Closet <br>
							- Mala Inteligente <br>
						

					';
				$mail->send();

				

			} catch (Exception $e) {
				error_log(print_r("Message could not be sent. Mailer Error: {$mail->ErrorInfo}",1));
			}
		} else {
			echo 'erro';
		}
	}
}
