<?php

require 'connect.php';
require 'function.php';
$bdd = mysqli_connect(SERVER, USER, PASS, DB);


if($_SERVER["REQUEST_METHOD"] === 'POST') {

  if(!isset($_POST['']) || empty($_POST['lastname']))
  {
    $errors['lastname'] = "You don't put your Last name";
  }

  if(!isset($_POST['firstname']) || empty($_POST['firstname']))
  {
    $errors['firstname'] = "You don't put your First name";
  }

  if(!isset($_POST['civility']) || empty($_POST['civility']))
  {
    $errors['firstname'] = "You don't choise your civility";
  }
  if(empty($errors)){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $civility = $_POST['civility'];

    mysqli_query($bdd,"INSERT INTO civility (civility) VALUES ('$civility')" );
    mysqli_query($bdd,"INSERT INTO contact (lastname,firstname) VALUES ('$lastname','$firstname')");
  }


}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
      <body>
        <div class="container">
          <h1>Contact Us</h1>
          <form action="index.php" method="post">
            <div class="form-group">
              <label for="">Civility</label>
              <select name="civility" class="form-control" id="inputcivility">
                <option value="civility1">M.</option>
                <option value="civility2">Mme.<option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Last name</label>
            <input type="text" name="lastname" class="form-control" placeholder="Last name">
            </div>
            <div class="form-group">
              <label for="">First name</label>
            <input type="text" name="firstname" class="form-control" placeholder="First name">
            </div>
            <div class="form-group">
               <button type="submit" name="button" class="btn btn-primary">Sign in</button>
            </div>
          </form>

          <table class="table table-bordered">
        <thead>
          <tr>
            <th>Civility</th>
            <th>Last name</th>
            <th>First name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $resultat = mysqli_query($bdd,'SELECT contact.lastname,contact.firstname,civility.civility FROM contact INNER JOIN civility ON contact.civility_id = civility.id');
          while($donnees = mysqli_fetch_assoc($resultat))
          {
              echo "<tr><td>".$donnees['civility']."</td>";
              echo "<td>".$donnees['lastname']."</td>";
              echo "<td>".$donnees['firstname']."</td></tr>";          }
            ?>
        </tbody>
      </table>


      </body>
</html>
