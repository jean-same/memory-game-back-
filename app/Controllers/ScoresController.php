<?php

namespace App\Controllers;

use App\Models\Scores;

class ScoresController extends CoreController {

    public function allScores (){
        $scores = Scores::findAll();

        $this->sendJSON($scores);
    }

    public function topTen (){
        $topTen = Scores::findTopTen();

        $this->sendJSON($topTen);
    }

    public function bestScore (){
        $topTen = Scores::bestScore();

        $this->sendJSON($topTen);
    }

    public function addScore() {
        $data = $_POST['nbSeconds'] ;
        var_dump($data);
    }
    
}