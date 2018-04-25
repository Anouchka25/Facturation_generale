<?php
require_once 'connexion.php';

// Vérification de la validité des informations
	$email = isset($_POST['email']) ? $_POST['email'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;
	$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;

  // Hachage du mot de passe
  $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "SELECT COUNT(*) AS countemail from membres where email = :email";
	try {
		$stmt = $base->prepare($sql);
		//$stmt = $DB->prepare($dpt);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if ($result[0]["countemail"] > 0) {
			//echo "Vous êtes déjà inscrit une fois avec cet email";
			echo "<script type=\"text/javascript\">
					alert(\"Vous êtes déjà inscrit une fois avec cet email\")
					document.location.href = 'inscription2.php';
				 </script>";
		} else {
			$sql = "INSERT INTO membres (email, pseudo, password) VALUES (:email, :pseudo, :password)";

			$stmt = $base->prepare($sql);
			$stmt->bindValue(":email", $email, PDO::PARAM_STR);
			$stmt->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
			$stmt->bindValue(":password", $pass_hache, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->rowCount();
			echo "<script type=\"text/javascript\">
					alert(\"Vous avez reçu un email avec vos identifiants ! Se connecter ? \")
					document.location.href = 'seconnecter.php';
				 </script>";
		  }

			if ($result > 0) {

				$lastID = $base->lastInsertId();
				$message = '<html><head>
				        <meta charset="utf-8" />
                <title>Accus&eacute; r&eacute;ception de votre demande</title>
                </head>
                <body>';
				$message .= '<h3>Bonjour Monsieur/Madame!</h3>';// Contenu du message
        $message .='E-mail : ' . $email . ' <br/>';
        $message .='Pseudo : ' . $pseudo . ' <br/>';
        $message .='Mot de passe : ' . $password . ' <br/>';
				$message .='<br/><br/>
											<p>Cordialement <br/>
				               L\'&eacute;quipe<br/><a href="http://facturation.allkers.com">www.facturation.allkers.com</a></p>';  // Contenu du message
				$message .= "</body></html>";

        $to      = $email ;
        $subject = 'Nouvel inscrit facturation';
        $headers = 'From: contact@allkers.com' . "\r\n" .
     'Reply-To: contact@allkers.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
		 // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     // En-têtes additionnels
     $headers .= 'A: Facturation <contact@allkers.com>' . "\r\n";
		 $headers .= 'From: Facturation <contact@allkers.com>' . "\r\n";
		 $headers .= 'Bcc: Facturation <contact@allkers.com>' . "\r\n";

     mail($to, $subject, $message, $headers);
	 } else {
	 				$msg = "Impossible de créer une demande";
	 				$msgType = "danger";}
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}

?>
