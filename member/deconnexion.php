<?php
session_start();
if( session_status() == 2) {

  $_SESSION = array();
  session_destroy();
  echo "<h4>Vous avez été déconnecté avec succès</h4>";
}
else echo "Vous faites quoi ici";



//header("Location: ../session.php");
//exit();
?>
