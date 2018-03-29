<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Checkpoint1</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		form {
			text-align: center;
		}

		table{
			text-align: center;
		}
</style>
</head>
<body>




<?php 

	// Création des erreurs :

	$errors = [];

	if(!array_key_exists('prenom', $_POST) || $_POST['prenom'] == ''){
		$errors['prenom'] = "Vous n'avez pas renseigné votre prenom";
	}elseif (strlen($_POST['prenom']) < 3)  {
		$errors['prenom'] = "Le prénom que vous avez renseigné est trop court (3 lettres minimum)";
	}

	if(!array_key_exists('nom', $_POST) || $_POST['nom'] == ''){
		$errors['nom'] = "Vous n'avez pas renseigné votre nom";
	}elseif (strlen($_POST['nom']) < 3)  {
		$errors['nom'] = "Le nom que vous avez renseigné est trop court (3 lettres minimum";
	}

	if(!preg_match('/^[1-2]{1}$/', $_POST['civilité'])) {
		$errors['civilité']= "Vous avez saisi une mauvaise civilité";
	}


	 ?>

  <?php 

  // Affichage des erreurs :


 // if (isset($_POST['prenom']) || isset($_POST['nom']) || isset($_POST['email']) || isset($_POST['tel']) || isset($_POST['message'])) 

  echo "<br>";

  if (isset($_POST['prenom']))
  {
  	$ShowErrors = implode("<br>", $errors);
  	echo $ShowErrors;
  }

   ?>


<?php if (empty($errors)): ?>
	<div class="alert alert-success">
		Votre message nous a bien été envoyé;
	</div>
<?php endif; ?>




<form method="POST">

<label for="nom">Votre nom</label><br>
<input type="text" name="nom" id="nom"  value="<?php echo (!empty($errors)) ? $_POST['nom'] : ""; ?>"><br><br>

<label for="prenom">Votre prenom</label><br>
<input type="text" name="prenom" id="prenom"  value="<?php echo (!empty($errors)) ? $_POST['prenom'] : ""; ?>"><br><br>

<label for="civilité">Votre civilité Monsieur(1) ou Madame(2)</label><br>
<input type="text" name="civilité" id="civilité"  value="<?php echo (!empty($errors)) ? $_POST['civilité'] : ""; ?>"><br><br>



<input type="submit" class="btn btn-primary"><br><br>


</form>

<?php 

include'define.php';
include'src/functions.php';

	$bdd = mysqli_connect(server, user, pass, db);

	if (isset($_POST['nom'])) 
	{
		$name = $_POST['nom'];
	}

	if (isset($_POST['prenom'])) 
	{
		$firstname = $_POST['prenom'];
	}

	if (isset($_POST['civilité'])) 
	{
		$civilité = $_POST['civilité'];
	}
	

	if (isset($_POST['nom']) && (isset($_POST['prenom'])) && (isset($_POST['civilité'])) ) {

		mysqli_query($bdd, "INSERT INTO contact (lastname, firstname, civility_id) VALUES ('$name', '$firstname', $civilité)");

	}



	$resultat = mysqli_query($bdd, 'SELECT lastname, firstname, civility FROM contact INNER JOIN civility ON civility.id = contact.civility_id ORDER BY lastname;');

	echo "<div class=\"col-md-offset-3 col-md-6\"><table class=\"table\"><tr><th>nom et prénom</th><th>civilité</th></tr>";

	while ($donnees = mysqli_fetch_assoc($resultat)) 
	{
		echo "<tr><td>". fullname($donnees['lastname'], $donnees['firstname']). "<td>".$donnees["civility"]."</td></tr>";
	}
		echo "</table></div>";


?>

</div>


</body>
</html>