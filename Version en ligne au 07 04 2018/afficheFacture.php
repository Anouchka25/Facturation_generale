<?session_start();


if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

 include('i_afficheFacture.php');
?>

<?php
}
else {
include('v_afficheFacture.php');
?>
<?php } ?>
