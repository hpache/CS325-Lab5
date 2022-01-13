<!-- 
  File: Lab5_hpache22.php
  Name: Henry Pacheco Cachon
  Class: CS325, January 2022
  Lab: 05
  Due: 12 January 2022
-->

<?php


session_start(); // ready to go!



function check_submissions(){

  date_default_timezone_set('America/New_York');

  if (preg_match("/[a-zA-Z0-9]+/", $_POST["comment"]) && preg_match("/[a-zA-Z0-9]+/", $_POST["name"])){
    $date = date("m/d/y h:i a", time());
    $entry_string = $_POST["comment"] . "|" . $_POST["name"] . "|" . $date . "\n";

    if (isset($_SESSION["entries"])){
      array_push($_SESSION["entries"], $entry_string);
    }
    else{
      $_SESSION["entries"] = array($entry_string);
    }
    session_write_close();
  }

  else{
    return "<p class='error'>" . "No valid comment to post" . "</p>";
  }

}

function write_comments(){

  $comments = array();
  $names = array();
  $date_time = array();
  $output = array();

  $current_entries = $_SESSION["entries"];

  

  while ($line = array_pop($current_entries)){
    $submissions_array = preg_split("/\|/",$line);
    
    array_push($comments, $submissions_array[0]);
    array_push($names, $submissions_array[1]);
    array_push($date_time, $submissions_array[2]);

  }

  $output["comments"] = $comments;
  $output["names"] = $names;
  $output["date-time"] = $date_time;

  return $output;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title> User Comments </title>
      <link href="comments.css" type="text/css" rel="stylesheet"/>
  </head>


  <body>

    <?php

    if (isset($_POST["name"]) && isset($_POST["comment"])){ ?>

      <?= check_submissions() ?>

    <?php
    }
    ?>

    <?php

      if (isset($_SESSION["entries"])){
        $entry_array = write_comments();
        $comments = $entry_array["comments"];
        $names = $entry_array["names"];
        $date_time = $entry_array["date-time"];

        while (empty($comments) == FALSE){ ?>
          <div class="comment-box">
            <p class="comment"> <?= array_pop($comments) ?> </p> 
            <p class="name"> <?= array_pop($names) ?> </p>
            <p class="date-time"> <?= array_pop($date_time) ?> </p>
          </div>
        
        <?php
        }
      }
        ?>

  </body>

  <form action="Lab5_hpache22.php" method="post">
    <fieldset class="submit-box">

      <legend> Add a comment </legend>

      <label> Name </label>
      <br>
      <input type = "text" name="name" id="name" placeholder="Enter name"/> 
      <br>
      <label> Comment </label>
      <br>
      <textarea name="comment" id="comment" placeholder="Write a comment"></textarea>
      <br>
      <input type = "submit"  name = "Submit"/>
      <input type = "reset" name = "reset" />
    </fieldset>
  </form>
  
</html>