<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Formulaire checkpoint</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>

    <?php
    
// définie des variables vides

$firstname = $lastname = $civilite = "";
$errors = array();

    
// vérifie que les conditions sont bien remplies    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["lastname"])) {
    $errors["lastname"] = "Le nom doit être renseigné";  
  } elseif (preg_match("/^[a-z ,.'-]+$/i", $_POST['lastname'])) {
    $lastname = test_input($_POST["lastname"]);
  } else {
    $errors['lastname2'] = "Le nom est invalide";
  }
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $errors["firstname"] = "Le prénom doit être renseigné";  
  } elseif (preg_match("/^[a-z ,.'-]+$/i", $_POST['firstname'])) {
    $firstname = test_input($_POST["firstname"]);
  } else {
    $errors['firstname'] = "Le prénom est invalide";
  }

    
    
  if (empty($_POST["civilite"])) {
    $errors["civilite"] = "La civilité doit être précisée";
  } else {
    $civilite = test_input($_POST["civilite"]);
  }
    
    
    
       
  if(count($errors) == 0) 
      
      
    {
      
    define("SITE_ROOT", "php_0218_checkpoint1_Strasbourg_eleves/src/");
    require 'connect.php';

      
    $pdo = new PDO(DSN, USER, PASS);
      
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $civilite = $_POST['civilite'];
   
      
      $queryInsert = "INSERT INTO contact (lastname, firstname, civility_id)
      VALUES ('$lastname', '$firstname', '$civilite')";
      
      $ajoutContenu = $pdo->exec($queryInsert);

      
       header('Location: index.php');
    }   
    }   
}

    
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }   
    
?>








<div class="container">

        <h2>Créer un nouveau contact</h2>
        <p><span class="error_champs">* Champs obligatoires.</span></p>
        <form action="form.php" method="post">
           <div class="form-group">
            <div>
                <label for="lastname">Nom :</label>
                <span class="obligatoires">*</span>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>" />
                
                <p>
                    <?php if(isset($errors['lastname'])) echo $errors['lastname']; ?>
                </p>
                <p>
                    <?php if(isset($errors['lastname2'])) echo $errors['lastname2']; ?>
                </p>
            </div>
            </div>


           <div class="form-group">
            <div>
                <label for="firstname">Prénom :</label>
                <span class="obligatoires">*</span>
                <input type="text" id="firstname" class="form-control" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>" />
                
                <p>
                    <?php if(isset($errors['firstname'])) echo $errors['firstname']; ?>
                </p>
                <p>
                    <?php if(isset($errors['firstname2'])) echo $errors['firstname2']; ?>
                </p>
            </div>
            </div>

            <div>
                <div class="form-group">
                <h3>Civilité</h3>
                <form>
                    <input type="radio" name="civilite" value="1">M.<br>
                    <input type="radio" name="civilite" value="2">Mme.<br>
                    <span class="obligatoires">*</span>
                </form>
                </div>



                <div class="button">
                    <button type="submit">Envoyer</button>
                </div>
            </div>
        </form>
        </div>
