<?php
define("DSN", "mysql:host=localhost;dbname=checkpoint1");
define("USER", "wilder");
define("PASS", "willphp");
$bdd = new PDO(DSN, USER, PASS);

$errors = [];

if (!array_key_exists('lastname', $_POST) || $_POST['lastname'] == '') {
    $errors['lastname'] = "Vous n'avez pas renseigné de nom";
}

if (!array_key_exists('firstname', $_POST) || $_POST['firstname'] == '') {
    $errors['firstname'] = "Vous n'avez pas renseigné de prénom";
}

session_start();

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $_POST;
    header('Location: /../public/index.php');
} else {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $civility = $_POST['civility'];
    $bdd->exec("INSERT INTO contact (firstname, lastname, civility_id) VALUES ('$firstname', '$lastname', $civility)");
    header('Location: /../public/index.php');
}
