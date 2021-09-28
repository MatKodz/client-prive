<?php

if( (isset($_POST['identifier']) && $_POST['identifier']!= "") && (isset($_POST['pass']) && $_POST['pass']!= "") )
{ // connexion à la BDD et vérification du login / mdp si les champs sont remplis

  try {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $mydb = "Customer_management";
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<h2 style="padding: 10px;background: green; color: white;">Connexion ok</h2>';

  $mdp = $_POST['pass'];

  $intro =  "Requête à exécuter <h3> SELECT CUS_id FROM customer_list WHERE CUS_email = 'mail@mail.fr' and CUS_password = MD5('monmotdepasse') </h3>";


  SELECT CUS_id FROM customer_list WHERE CUS_email = '' and CUS_password = MD5('fauxmotdepasse') OR 1=1 ##')



  // $requete = "SELECT CUS_id FROM customer_list WHERE CUS_email = ? and CUS_password = ?";
  // $sth = $conn->prepare($requete);
  // var_dump($sth->execute(array($_POST['identifier'],$_POST['pass'])));
  // $jeu = $sth->fetch();
  // var_dump($jeu);



    if($jeu) {
      session_start();
      $_SESSION['identifiant']= $_POST['identifier'];
      $_SESSION['id']= $jeu['CUS_id'];
      $_SESSION['requete']= $requete;
      header("Location: ./member/");
      exit();
    }

else { $msg = "Aucun utilisateur  / mot de passe correspondant";
  }
}

  catch (PDOException $e) {
      echo 'Échec lors de la connexion : ' . $e->getMessage();
  }
}

else if ( (isset($_POST['identifier']) && empty($_POST['identifier'])) or (isset($_POST['pass']) && empty($_POST['pass']) ) ) {
  $msg = "Identifiant et mot de passe sont obligatoires";
}

if (isset($requete))
$intro .=  "<hr>Requête executée<h3>" . $requete . "</h3><hr>Requête en neutralisant le mot de passe<h3>SELECT CUS_id FROM customer_list WHERE CUS_email = 'mail@mail.fr' and CUS_password = MD5('fauxmotdepasse') OR 1=1 ## '</h3>";


?>
<!DOCTYPE html>
<html>
<head>
  <style>
  form { width: 50%; margin: 5% auto; background: #fafafa; padding: 5%; line-height: 2em;}
  body { font-family: Avenir, sans-serif;}
  label { width: 50%;}
  div.champ { border-bottom: 1px solid lightgrey; padding: 2% 0; margin: 2% 0;}
  #dpass { margin: 5px;}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta charset="utf-8">
</head>
<body>


<?php if(isset($intro)) echo $intro;?>

<form name="connect-session" method="post" action="">
<h2>Accès espace Membre</h2>
<div class="champ"><label for="identifiant">Identifiant :</label><input type="text" name="identifier" id="identifiant" value="<?php if (isset($_POST['identifier'])) echo $_POST['identifier'] ?>"></div>
<div class="champ"><label for="passd">Mot de passe :</label><input type="password" name="pass" id="passd"><button type="button" id="affmdp">Voir</button></div>
<?php if(isset($msg)) echo '<div class="alert alert-danger">' . $msg . '</div>'; ?>
<div style="text-align: center; padding: 4% 0;"><input type="submit" value="Se connecter" class="btn btn-success mx-3"> <input type="reset" value="Recommencer" class="btn btn-light"></div>
<p class="alert alert-light">Injection en utilisant le mail d'utilisateur: <kbd> mail@mail.fr' ##</kbd>  + mdp non vide</p>
<p class="alert alert-light">Injection en utilisant le mot de passe : <kbd>fauxmotdepasse') OR 1=1 ## </kbd></p>
</form>

<script>
var afficher = document.getElementById("affmdp");
voir = false;
afficher.addEventListener("click", function () {
  if ( ! voir) {
      document.getElementById("passd").setAttribute("type","text");
      voir = true;
  }

  else {
    document.getElementById("passd").setAttribute("type","password");
    voir = false;}


});
</script>
</body>
</html>
