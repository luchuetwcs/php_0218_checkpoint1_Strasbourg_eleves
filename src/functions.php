<?php
/**
 * La classe functions permet de créer un "fullname" à partir d'un nom et d'un prénom.
 */
class functions
{
    private $firstname = '';
    private $lastname = '';

    public function __construct($firstname, $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function fullname($firstname, $lastname)
    {
        return strtoupper($lastname).' '.ucfirst($firstname);
    }
}
