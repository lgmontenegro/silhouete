<?php
    function calcEmptyBlocks($blocksField, $masterIndex = 0, $stepIndex = 1, $counter = 0, $aggregator = 0)
    {
        if (count($blocksField)<=1) {
            return 0;
        }

        $master = $blocksField[$masterIndex];
        $stepBlock = $blocksField[$stepIndex];

        if ($master > $stepBlock) {
            $counter = $counter + ($master - $stepBlock);
        }

        if ($master <= $stepBlock) {
            $aggregator = $aggregator + $counter;
            $masterIndex = $stepIndex;
            $counter = 0;
        }

        ++$stepIndex;

        $debug = 1;
        if ($debug === 1) {
            $debug = ['Aggr'=>$aggregator, 'MasterIndex'=>$masterIndex, 'Master'=>$master, 'StepIndex'=>$stepIndex, 'Step'=>$stepBlock, 'counter'=>$counter];
            print_r($debug);
        }

        if (array_key_exists($stepIndex, $blocksField)) {
            return calcEmptyBlocks($blocksField, $masterIndex, $stepIndex, $counter, $aggregator);
        } else {
            return $aggregator;
        }
    }

    function readArray($argv)
    {
        $filename = $argv[1];
        $arraySilouete = file($filename);
        $returnArray = [];
        for($i=2; $i<=count($arraySilouete); $i++){
            if(($i%2) == 0){
                if(isset($arraySilouete[$i])){
                    $arrayGrid = explode(' ', $arraySilouete[$i]);
                    $returnArray[$i]=calcEmptyBlocks($arrayGrid) . "\n";
                }
            }
        }
        file_put_contents('result_'.$filename.'_.txt', implode("", $returnArray));
    }

    readArray($argv);