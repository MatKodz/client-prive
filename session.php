<?php
if (isset($_COOKIE['user'])) $email = $_COOKIE['user'];
if( (isset($_POST['identifier']) && $_POST['identifier']!= "") && (isset($_POST['pass']) && $_POST['pass']!= "") )
{ // connexion à la BDD et vérification du login / mdp si les champs sont remplis
include("../client-bo/connect-bdd.php");

  $requete = "SELECT CUS_id FROM customer_list WHERE CUS_email = ? and CUS_password = MD5(?)";

  $sth = $conn->prepare($requete);

  if ($sth->execute(array($_POST['identifier'], $_POST['pass']))) {

    $resultat = $sth->fetchAll();

    if($resultat) {
      session_start();
      $_SESSION['identifiant']= $_POST['identifier'];
      $_SESSION['id']= $resultat[0]['CUS_id'];
      header("Location: ./member/");
      exit();
    }

else { $msg = "Aucun utilisateur  / mot de passe correspondant";}

  }



}

else if ( (isset($_POST['identifier']) && empty($_POST['identifier'])) or (isset($_POST['pass']) && empty($_POST['pass']) ) ) {
  $msg = "Identifiant et mot de passe sont obligatoires";
}

?>
<!DOCTYPE html>
<html>
<head>
  <style>
  form { width: 50%; margin: 5% auto; background: #fafafa; padding: 5%; line-height: 2em;}
  body { font-family: Avenir, sans-serif;}
  label { width: 50%;}
  div.champ { border-bottom: 1px solid lightgrey; padding: 2% 0; margin: 2% 0;}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta charset="utf-8">
</head>
<body>

<form name="connect-session" method="post" action="">
<h2>Accès espace Membre</h2>
<div class="champ"><label for="identifiant">Identifiant :</label><input type="text" name="identifier" id="identifiant" value="<?php if (isset($_POST['identifier'])) echo $_POST['identifier']; else if (isset($email)) echo $email; ?>"></div>
<div class="champ"><label for="passd">Mot de passe :</label><input type="password" name="pass" id="passd"></div>
<?php if(isset($msg)) echo '<div class="alert alert-danger">' . $msg . '</div>'; ?>
<div style="text-align: center; padding: 4% 0;"><input type="submit" value="Se connecter" class="btn btn-success mx-3"> <input type="reset" value="Recommencer" class="btn btn-light"></div>
</form>


</body>
</html>
