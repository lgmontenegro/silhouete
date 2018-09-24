<?php

namespace Puzzle;

Class Silhouete
{
    private function calcEmptyBlocks(
        $blocksField, 
        $debug = 0,
        $masterIndex = 0, 
        $stepIndex = 1, 
        $counter = 0, 
        $aggregator = 0
    )
    {
        if (count($blocksField)<=1) {
            return 0;
        }

        $master =  ( int ) $blocksField[$masterIndex];
        $stepBlock = ( int ) $blocksField[$stepIndex];

        if ($master > $stepBlock) {
            $counter = $counter + ($master - $stepBlock);
        }

        if ($master <= $stepBlock) {
            $aggregator = $aggregator + $counter;
            $masterIndex = $stepIndex;
            $counter = 0;
        }

        ++$stepIndex;

        if ($debug === 1) {
            $debug = [
                'Aggr'=>$aggregator, 
                'MasterIndex'=>$masterIndex, 
                'Master'=>$master, 
                'StepIndex'=>$stepIndex, 
                'Step'=>$stepBlock, 
                'counter'=>$counter
            ];

            print_r($debug);
        }

        if (array_key_exists($stepIndex, $blocksField)) {
            return $this->calcEmptyBlocks(
                $blocksField, 
                $debug,
                $masterIndex, 
                $stepIndex, 
                $counter, 
                $aggregator
            );
        } else {
            return $aggregator;
        }
    }

    private function prepareArray($rawArray)
    {
        try{
            $returnArray = [];
            for($i=2; $i<=count($rawArray); $i++){
                if(($i%2) == 0){
                    if(isset($rawArray[$i])){
                        $returnArray[$i] = explode(' ', $rawArray[$i]);
                    }
                }
            }
            return $returnArray;
        }catch(Exception $e){
            var_dump($e);
            return false;
        }
        
    }

    private function readArray($arrayPuzzle, $filename, $debug = 0)
    {
        try{
            if(count($arrayPuzzle)<=0){
                return false;
            }
    
            foreach($arrayPuzzle as $key=>$puzzle){
                $returnArray[$key] = self::calcEmptyBlocks($puzzle, $debug) . "\n";
            }

            file_put_contents('result_'.$filename, implode("", $returnArray));
            return true;

        }catch(Exception $e){
            var_dump($e);
            return false;
        }
    }

    public function startPuzzle($arraySilhouete, $filename = "notGiven", $debug = 0)
    {
        if ($this->readArray($this->prepareArray($arraySilhouete), $filename, $debug)){
            echo "Arquivo Gravado";
        }else{
            echo "Problemas encontrados, reveja seu arquivo";
        }
    }
}