<?php namespace bootstrap\services;

use eftec\bladeone\BladeOne;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    public static function send(string $title, string $view, string $to, array $viewArguments = []) : string {
        
        $blade = new BladeOne('../resources/views');        
        $body = $blade->run($view, $viewArguments);
        
        $mail = new PHPMailer(false);
        $mail->isSMTP();
		$mail->SMTPAuth = true;	
		$mail->Host = mail_config['host'];
		$mail->Port = mail_config['port'];
		$mail->Username = mail_config['username'];
		$mail->Password = mail_config['password'];
		$mail->setFrom(mail_config['from-address'], mail_config['name']);
		$mail->Subject = $title;
		$mail->msgHTML($body);
		$mail->addAddress($to);
	        
		$response = $mail->Send();
		if(!$response || $response == null) {
	        return 'Mail error: '.$mail->ErrorInfo; 
		}

    }
}