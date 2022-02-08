<?php

namespace App\Models;

use App\Utils\Database;
use \PDO;

class Scores {

    public $id;
    public $nbSeconds;
    public $date;
    
    public function getId()
    {
        return $this->id;
    }

    public function getNbSeconds()
    {
        return $this->nbSeconds;
    }

    public function setNbSeconds($nbSeconds)
    {
        return $this->nbSeconds = $nbSeconds;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        return $this->date = $date;
    }

    public static function findAll(){
        $pdo = Database::getPDO();


        $sql = "SELECT * FROM `scores` ";

        $pdoStatement = $pdo->query($sql);

        $allScores = $pdoStatement->fetchAll(PDO::FETCH_CLASS,Scores::class);

        return $allScores;
    }

    public static function findTopTen(){
        $pdo = Database::getPDO();


        $sql = "SELECT * FROM `scores` ORDER BY `nbSeconds` DESC LIMIT 10";

        $pdoStatement = $pdo->query($sql);

        $topTen = $pdoStatement->fetchAll(PDO::FETCH_CLASS,Scores::class);

        return $topTen;
    }

    public static function bestScore(){
        $pdo = Database::getPDO();


        $sql = "SELECT * FROM `scores` ORDER BY `nbSeconds` DESC LIMIT 1";

        $pdoStatement = $pdo->query($sql);

        $bestScore = $pdoStatement->fetchObject(Scores::class);

        return $bestScore;
    }

    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `scores` 
                (nbSeconds, date)
            VALUES (    
            :nbSeconds,
            :date
        )";

        // Execution de la requête d'insertion (exec, pas query)
        $insertedRows = $pdo->prepare($sql);

        // On execute notre requete preparée en liant les variables aux :
        $insertedRows->execute([
            ':nbSeconds' => $this->getNbSeconds(),
            ':date' => $this->getDate(),
        ]);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    
    }
}