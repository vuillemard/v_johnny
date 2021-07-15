<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css" media="all" />
    <title>Formulaire</title>
  </head>
<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'messages.php';
require 'Connexion.php';

try{
$pdo = (new Connexion())->getPDO();
} catch (Excetpion $e) {
  echo "ERREUR: <br>".$e->getMessage();
}


if (isset($_POST['pseudo']) and isset($_POST['message'])) {
  $pseudo = $_POST['pseudo'];
  $message = $_POST['message'];

  $sth = $pdo->prepare("INSERT INTO contact (pseudo,messages) VALUES ('$pseudo','$message')");
  $sth->execute();
}
$query = $pdo->query("SELECT pseudo,messages FROM contact");

?>
<h1 class="titre">Livre d'or</h1>
  <div class="center">
    <div class="col-md-6 mt-5">
      <form action="index.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1"></label>
          <input type="text" class="form-control" name="pseudo" placeholder="pseudo" >
        </div>
        <div class="form-group">
          <label for="exampleInputText"></label>
          <input type="text" class="form-control" name="message" placeholder="message" >
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
    </div>
 
</div>


<h2 class="titre2">Vos messages</h2>
<div class="col-md-7 mt-5">

<div class="center">

<?php

while ($entry = $query->fetchArray(SQLITE3_ASSOC))
{
  echo '<p>'.'Pseudo: '.' <strong>'.$entry['pseudo'].'</strong>'.'<br>'.'Message: '.$entry['messages'].'</p>'.'<br>';}?></div>
}

