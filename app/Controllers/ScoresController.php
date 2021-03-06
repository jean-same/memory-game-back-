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

        if($topTen) {
            http_response_code(200);
            $this->sendJSON($topTen);
        } else {
            http_response_code(400);
            echo json_encode([
                "message" => "aucun score"
            ]);
        }


    }

    public function bestScore (){
        $bestScore = Scores::bestScore();

        if($bestScore) {
            http_response_code(200);
            $this->sendJSON($bestScore);
        } else {
            http_response_code(400);
            echo json_encode([
                "message" => "aucun score"
            ]);
        }
    }

    public function addScore() {

        $data = json_decode(file_get_contents("php://input"));
        
        if($data->nbSeconds !== "" && is_int($data->nbSeconds)) {
            
            $scoreToInsert = new Scores;

            $scoreToInsert->setNbSeconds($data->nbSeconds);
            $scoreToInsert->setDate(date("Y-m-d H:i:s"));
            $scoreToInsert->insert();

            http_response_code(201);
            echo json_encode([
                "message" => "score ajouté avec succès"
            ]);
        } else {
            http_response_code(422);
        }
       
    }
    
}