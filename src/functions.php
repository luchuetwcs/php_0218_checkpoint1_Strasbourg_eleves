<?php


$pdo = new PDO(DSN, USER, PASS);


class contact
{
    private $querySelect = 'SELECT CONCAT(lastname, " ", firstname) as fullname, civility FROM contact JOIN civility civ ON civ.id = contact.civility_id';

    public function getQuery(){
        return $this->$querySelect;
    }

}