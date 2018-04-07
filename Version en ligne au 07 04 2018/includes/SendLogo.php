<form method="post" action="receptionLogo.php" enctype="multipart/form-data">
  <label for="logo">Logo du fichier (JPG, PNG ou GIF | max. 15 Ko) :</label>
  <input type="hidden" name="MAX_FILE_SIZE" value="12345" />
  <input type="file" name="logo" id="logo" />
  <input type="submit" value="Envoyer" />
</form>
