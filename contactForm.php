<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;                          
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // ssl or tsl as required
    $mail->Host = "smtp.stackmail.com"; //eg: smtp.gmail.com for gmail
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);

    $mail->Username = "trianglebuzzvelocity@gmail.com"; //Enter email
    $mail->Password = "@Triangle123";
    $mail->SetFrom("trianglebuzzvelocity@gmail.com"); //Enter email
    $mail->AddAddress("info@.com.np");
	$mail->addReplyTo($_POST['email']);
    $mail->Subject = "Contact Form Submit";
    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="2">';
    $message .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
    $message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
    $message .= "<tr><td><strong>Service Type:</strong> </td><td>" . strip_tags($_POST['service_type']) . "</td></tr>";
    $message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";
	$mail->Body= $message;

	if(!$mail->send()) {
        $_SESSION["error"] = "Application cannot be submitted!";
        if($_POST['form_no'] == "form_home"){
            header("Location:/");
        }else if($_POST['form_no'] == "form_about"){
            header("Location:/about");
        }else if($_POST['form_no'] == "form_services"){
            header("Location:/services");
        }else if($_POST['form_no'] == "form_works"){
            header("Location:/works");
        }else if($_POST['form_no'] == "form_contact"){
            header("Location:/contact");
        }else{
            header("Location:/");
        }
        exit();
	} else {
        $_SESSION["success"] = "Thank you for your application.";
        if($_POST['form_no'] == "form_home"){
            header("Location:/");
        }else if($_POST['form_no'] == "form_about"){
            header("Location:/about");
        }else if($_POST['form_no'] == "form_services"){
            header("Location:/services");
        }else if($_POST['form_no'] == "form_works"){
            header("Location:/works");
        }else if($_POST['form_no'] == "form_contact"){
            header("Location:/contact");
        }else{
            header("Location:/");
        }
        exit();
	}
?>