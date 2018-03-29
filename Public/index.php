<?php


include 'connect.php';

$bdd=mysqli_connect(SERVER, USER, PASS, DB);


?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>checkpoint</title>
	    <link rel="stylesheet" href="style.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
    <body>
	    <div class="container">

	    	<form class="form_contact" action="index.php" method="post">
           		<h2>AJOUTER UN CONTACT</h2>
	            <div class="nom def-marge">
	                <label for="nom">Nom</label>
	                <input type="text" id="nom" name="nom" size="30" placeholder="votre nom">
	            </div>
	            <div class="error">
                <p>
                    <?php
                    	
						if ($_SERVER["REQUEST_METHOD"]==='POST') {

							if(!isset($_POST['nom']) || empty($_POST['nom']))
							    {
							      $error['nom'] = "Vous n'avez votre saisi le nom";

							      echo $error['nom'];
							    }
							}
                    ?>
                    <br>
                </p>
           		</div>

	            <div class="prenom def-marge">
	                <label for="prenom">Prénom</label>
	                <input type="text" id="prenom" name="prenom" size="30" placeholder="votre nom">
	            </div>
	            <div class="error">
                <p>
                    <?php
                    	
						if ($_SERVER["REQUEST_METHOD"]==='POST') {

							if(!isset($_POST['prenom']) || empty($_POST['prenom']))
							    {
							      $error['prenom'] = "Vous n'avez pas saisi le prenom";

							      echo $error['prenom'];
							    }

						}
                    ?>
                    <br>
                </p>
           		</div>

	            <div class="civilite def-marge">
	                <label for="civilite">Civilité</label><br />
	                <select name="civilite" id="civilite">
	                    <option value="default" id="default"></option>
	                    <option value="mme">Mme.</option>
	                    <option value="m">M.</option>
	                </select>
            	</div>
    

	            <div class="button">
	                <button type="submit">POSTER</button>
	            </div>
	        	</form>


	        <table class="table table-bordered">

	        	<thead>

	          		<tr>
	            		<th>NOM prénom</th>
	            		<th>Civility</th>
	          		</tr>

	        	</thead>

	        	<tbody>

	        	<?php

	        		if ($_SERVER["REQUEST_METHOD"]==='POST') {

						if(empty($error))
					        {
					          $nom = strtoupper($_POST['nom']);
					          $prenom = ucfirst($_POST['prenom']);

					          mysqli_query($bdd, "INSERT INTO contact (lastname, lastname)    VALUES ('$nom', '$prenom')");
					        }
					}

	        	?>


	          	<?php
	          	$resultat = mysqli_query($bdd, "SELECT CONCAT(lastname,' ', firstname) AS NOM_prenom, civility.civility FROM contact LEFT JOIN civility ON contact.civility_id = civility.id ORDER BY NOM_prenom;");

					while($donnees = mysqli_fetch_assoc ($resultat))

					{
						echo "<tr><td>".$donnees['NOM_prenom']."</td>";
						echo "<td>".$donnees['civility']."</td></tr>";}
					;
	          	?>

	        	</tbody>
	        </table>
	    </div>
    </body>
</html>