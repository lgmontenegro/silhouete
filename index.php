<?php

    include("Silhouete.php");
    
    if(!isset($argv[1])){
        echo "Informar o arquivo com os dados";
        die();
    }
    $filename = $argv[1];
    $arraySilhouete = file($filename);

    $debug = 0;
    if(isset($argv[2])){
        if(strpos($argv[2], '-d') === 0){
            $debug = 1;
        }
    }

    $puzzle = new Puzzle\Silhouete();
    $puzzle->startPuzzle($arraySilhouete, $filename, $debug);