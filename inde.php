<?php
    function calcEmptyBlocks(
        $blocksField,
        $masterIndex = 0,
        $stepIndex = 1,
        $counter = 0,
        $aggregator = 0
    )
    {
        if (count($blocksField)<=1) {
            return 0;
        }
        $master = $blocksField[$masterIndex];
        $stepBlock = $blocksField[$stepIndex];

        if ($master > $stepBlock) {
            $counter = $counter + ($master - $stepBlock);
        } else {
            $aggregator = $aggregator + $counter;
            $masterIndex = $stepIndex;
            $master = $blocksField[$masterIndex];
            $counter = 0;
        }
        $stepIndex++;

        if ($debug == 1) {
            $debug = ['Aggr'=>$aggregator, 'MasterIndex'=>$masterIndex, 'Master'=>$master, 'StepIndex'=>$stepIndex, 'Step'=>$stepBlock, 'counter'=>$counter];
            print_r($debug);
        }

        if (array_key_exists($stepIndex, $blocksField)) {
            return calcEmptyBlocks($blocksField, $masterIndex, $stepIndex, $counter, $aggregator);
        } else {
            return $aggregator;
        }
    }

    $arrayTeste = [5, 4, 3, 2, 1, 2, 3, 4, 5];
    print_r($arrayTeste);
    echo calcEmptyBlocks($arrayTeste);
    echo "\n";

    $arrayTeste = [7, 10, 2, 5, 13, 3, 4, 10, 5, 9, 4, 2, 6, 5, 18, 6, 8, 6, 15, 4, 20, 4, 8, 9, 5, 21, 4, 7, 19, 2];
    print_r($arrayTeste);
    echo calcEmptyBlocks($arrayTeste);
    echo "\n";

    $arrayTeste = [10];
    print_r($arrayTeste);
    echo calcEmptyBlocks($arrayTeste);
    echo "\n";

    $arrayTeste = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    print_r($arrayTeste);
    echo calcEmptyBlocks($arrayTeste);
    echo "\n";
