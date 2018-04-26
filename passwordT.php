<?php require_once 'connexion.php'; ?>

<?
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$password1 = isset($_POST['password1']) ? $_POST['password1'] : NULL;
$password2 = isset($_POST['password2']) ? $_POST['password2'] : NULL;

if($password1==$password2){
// Hachage du mot de passe
$pass_hache = password_hash($_POST['password1'], PASSWORD_DEFAULT);

$req = $base->prepare("UPDATE membres SET password= :password WHERE pseudo=:pseudo ");

$result=$req->execute(array(
                ':pseudo'=>$_POST['pseudo'],
                ':password'=>$pass_hache
                ));
                $message = '<html><head>
                        <meta charset="utf-8" />
                        <title>Accus&eacute; r&eacute;ception de votre demande</title>
                        </head>
                        <body>';
                $message .= 'Bonjour Monsieur/Madame,<br/>';// Contenu du message
                $message .='Pseudo : ' . $pseudo . ' <br/>';
                $message .='Mot de passe : ' . $password1 . ' <br/>';
                $message .='<br/><br/>
                              <p>Cordialement <br/>
                               L\'&eacute;quipe<br/><a href="http://facturation.allkers.com">www.facturation.allkers.com</a></p>';  // Contenu du message
                $message .= "</body></html>";

                $to      = $email ;
                $subject = 'Nouveau mot de passe';
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
?>
<script type="text/javascript">
     alert("Votre mot de passe a bien été mis à jour");
     document.location.href = 'seconnecter.php';
</script>
<?
}else { ?>
  <script type="text/javascript">
       alert("Les 2 mots de passe ne sont pas identiques, réessayez !");
       document.location.href = 'mpoublieT.php';
  </script>
  <?
}
?>
