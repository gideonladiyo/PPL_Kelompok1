<?php 

function insertionSortDesc(&$array, $key) {
    $n = count($array);
    for ($i = 1; $i < $n; $i++) {
        $value = $array[$i];
        $j = $i - 1;
        while ($j >= 0 && $array[$j][$key] < $value[$key]) {
            $array[$j + 1] = $array[$j];
            $j--;
        }
        $array[$j + 1] = $value;
    }
}

function insertionSort(&$array, $key) {
    $n = count($array);
    for ($i = 1; $i < $n; $i++) {
        $value = $array[$i];
        $j = $i - 1;
        while ($j >= 0 && $array[$j][$key] > $value[$key]) {
            $array[$j + 1] = $array[$j];
            $j--;
        }
        $array[$j + 1] = $value;
    }
}

// Fungsi untuk bubble sort
function bubbleSortDesc(&$array, $key) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j][$key] < $array[$j + 1][$key]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

function bubbleSort(&$array, $key) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j][$key] > $array[$j + 1][$key]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

function selectionSort(&$array, $key) {
    $n = count($array);

    for ($i = 0; $i < $n - 1; $i++) {
        // Assume the maximum is the current row
        $maxIndex = $i;

        for ($j = $i + 1; $j < $n; $j++) {
            // Find the row with the largest key value
            if ($array[$j][$key] < $array[$maxIndex][$key]) {
                $maxIndex = $j;
            }
        }

        // Swap the found maximum row with the current row
        if ($maxIndex != $i) {
            $temp = $array[$i];
            $array[$i] = $array[$maxIndex];
            $array[$maxIndex] = $temp;
        }
    }
}

function selectionSortDesc(&$array, $key) {
    $n = count($array);

    for ($i = 0; $i < $n - 1; $i++) {
        // Assume the maximum is the current row
        $maxIndex = $i;

        for ($j = $i + 1; $j < $n; $j++) {
            // Find the row with the largest key value
            if ($array[$j][$key] > $array[$maxIndex][$key]) {
                $maxIndex = $j;
            }
        }

        // Swap the found maximum row with the current row
        if ($maxIndex != $i) {
            $temp = $array[$i];
            $array[$i] = $array[$maxIndex];
            $array[$maxIndex] = $temp;
        }
    }
}

?>