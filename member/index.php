<?php
  if (session_status() == 1) {
    session_start();
    if ( isset($_SESSION['identifiant']) && isset($_SESSION['id']) )
    {
      setcookie("user", $_SESSION['identifiant'],time() + 60 * 60 * 24 * 30,"/");


?>
<!DOCTYPE html>
<html lang="fr">
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  <meta charset="utf-8">

<!-- en-tete du document -->

  <title> Client</title>

  <meta charset="UTF-8">

  <script type="text/javascript">

  </script>

  <style>

  body {font-family: 'Avenir Next', sans-serif;}


    .col- { border-bottom: 4px solid grey; padding: 2%; margin: 2% 0; background: #fafafa;}
    .client { border: 10px solid #eee; padding: 10px; background: #fafafa;}
    .client p { margin: 2px 0; border-bottom: 1px solid #eee;}

  </style>

</head>

<body>
  <a class="btn close" aria-label="Close" href="deconnexion.php">
    Déconnexion [<span aria-hidden="true">&times;</span>]
  </a>
<div class="container">
  <?php if (isset($_SESSION['identifiant'])) echo "<h4 class=\"my-3\"> Profil : " . $_SESSION['identifiant'] . "</h4>";
   ?>
  <div class="row">
    <div class="col-sm">
    <h5>Member details</h5>
  </div>
  </div>

  <?php

  require_once("../../client-bo/connect-bdd.php");

  ?>

   <div class="row">

     <?php

  $requete_aff = "SELECT CUS_id, CUS_lastname, CUS_firstname, CUS_email, CUS_phone, CUS_address, CUS_zipcode, CUS_town, CUS_commuting, CUS_info, DATE_FORMAT(CUS_register, '%a %d-%m-%y') AS date_inscription FROM customer_list WHERE CUS_id = ?";

  $sth = $conn->prepare($requete_aff);

  $sth->execute(array($_SESSION['id']));

  $resultat = $sth->fetchAll();

  foreach($resultat as $member) {

    echo '<div class="col-sm client">';
    echo '<h4 class="bg bg-dark rounded text-white p-2">'.strtoupper($member['CUS_lastname']).' '.$member['CUS_firstname'].'</h3>';
    echo '<p><span class="badge bagde-pill badge-primary">'.$member['date_inscription'].'</span></p>';
    echo '<a href="mailto:'.$member['CUS_email'].'">'.$member['CUS_email'].'</a></p>';
    echo '<p><b>Tél: </b>'.$member['CUS_phone'].'</p>';
    echo '<p>'.$member['CUS_address'].'</p>';
    echo '<p>'.$member['CUS_zipcode'].' '.$member['CUS_town'].'</p>';
    echo '<p><b>Moyen de transport:</b> '.$member['CUS_commuting'].'</p>';
    echo '<form action="../../client-bo/modifier-client.php" method="post" name="update"><button type="submit" class="btn btn-primary my-2">Modifier</button><input type="hidden" name="idcust" value = "'.$member['CUS_id'].'"></form>';
    echo '<a href="../../client-bo/supprimer-client.php?idcust='.$member['CUS_id'].'" class="btn btn-danger my-2">Supprimer</a>';
    echo '<p><b>Info complémentaires:</b>'.$member['CUS_info'].'</p>';
    echo '</div>';
  }


  $conn = NULL;

 }
   else {
     //header("Location: ../session.php");
     echo 'rien à afficher';
     exit();
   }
 }

  ?>

  </div>
</div>



</body>

</html>
