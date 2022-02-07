<?php

//use AltoRouter;

require __DIR__ . '/../vendor/autoload.php';

//*Je vérifie le parametre envoyé par l'utilisateur, sinon on affiche la page home par defaut
if (isset($_GET['scores'])) {
    $currentPage = $_GET['scores'];
} else {
    $currentPage = "/";
}

//* Je utilise AltoRouteur pour analyser l'URL
$altoRouter = new AltoRouter();

//* Je fournit a AltoRouter la partie de l'URL à ne pas prendre en compte pour faire la comparaison entre l'URL courante et l'url de la route
$altoRouter->setBasePath($_SERVER['BASE_URI']);

//* On declare nos 2 routes
$altoRouter->map(
    'GET',
    '/',
    [
        "method" => "allScores",
        "controller" => "App\Controllers\ScoresController"
    ],
    'scores'
);

$altoRouter->map(
    'GET',
    '/topTen',
    [
        "method" => "topTen",
        "controller" => "App\Controllers\ScoresController"
    ],
    'topTen'
);

$altoRouter->map(
    'GET',
    '/bestscore',
    [
        "method" => "bestScore",
        "controller" => "App\Controllers\ScoresController"
    ],
    'bestscore'
);


$altoRouter->map(
    'POST',
    '/newscore',
    [
        "method" => "addScore",
        "controller" => "App\Controllers\ScoresController"
    ],
    'add'
);

$matchingRoute = $altoRouter->match();

if ($matchingRoute) {

    //* Si je suis la c'est parce que matchingRoute à trouver une route

    //* je récupère le nom de la méthode que j'ai associé à ma route
    $tableauInfo = $matchingRoute['target'];
    $nomMethode = $tableauInfo['method'];


    //* je récupère les paramètres venant de ma route
    $parametresRoute = $matchingRoute['params'];

    //* Je recupere le nom de mon controller
    $nomController = $matchingRoute['target']['controller'];

    //* J'instancie ma classe 
    $controller = new $nomController();


    //*Je lance ma methode
    $controller->$nomMethode();
} else {
    exit('Page  not found');
}