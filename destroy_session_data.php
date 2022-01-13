<!-- 
  File: destroy_session_data.php
  Name: Henry Pacheco Cachon
  Class: CS325, January 2022
  Lab: 05
  Due: 12 January 2022

  For debugging purposes
-->

<?php

  session_start();

  $lines = $_SESSION["entries"];
  var_dump($_SESSION);
  foreach($lines as $line){
    echo $line . "\n";
  }

  
  session_write_close();
    

?>