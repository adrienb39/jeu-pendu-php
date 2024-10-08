<?php

use App\JeuPendu;

require_once __DIR__ . "/../vendor/autoload.php";

$jeu = new JeuPendu(__DIR__ ."/test.txt");
$jeu->jouer();