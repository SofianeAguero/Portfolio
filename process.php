<?php
	$name = $_POST["name"];
	$email = $_POST["email"];
	$message = $_POST["message"];
	 
	$EmailTo = "azi.sofiane@hotmail.fr";
	$Subject = "Nouveau message reçu";
	 
	// prepare email body text
	
	$Body .= "Nom: ";
	$Body .= $name;
	$Body .= "\n";
	 
	$Body .= "Email: ";
	$Body .= $email;
	$Body .= "\n";
	 
	$Body .= "Message: ";
	$Body .= $message;
	$Body .= "\n";
	 
	
	// send email
	$success = mail($EmailTo, $Subject, $Body, "De:".$email);
	 
	// redirect to success page
	if ($success){
	   echo "envoyé";
	}else{
	    echo "invalid";
	} 
?>