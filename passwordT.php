<?php require_once 'connexion.php'; ?>

<?
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$password1 = isset($_POST['password1']) ? $_POST['password1'] : NULL;
$password2 = isset($_POST['password2']) ? $_POST['password2'] : NULL;

if($password1==$password2){
// Hachage du mot de passe
$pass_hache = password_hash($_POST['password1'], PASSWORD_DEFAULT);

$req = $base->prepare("UPDATE membres SET password= :password WHERE pseudo=:pseudo ");

$result=$req->execute(array(
                ':pseudo'=>$_POST['pseudo'],
                ':password'=>$_POST['password1']
                ));
//header('Location: listefactures.php');

//$pass_hache = password_hash($result['password'], PASSWORD_DEFAULT);
?>
<script type="text/javascript">
     alert("Votre mot de passe a bien été mis à jour");
     document.location.href = 'index.php';
</script>
<?
}else { ?>
  <script type="text/javascript">
       alert("Mauvais pseudo ou mot de passe, Réessayez ?");
       document.location.href = 'password.php';
  </script>
  <?
}
?>
