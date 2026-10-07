<?php

if (isset($_GET['c'])) {
    $data = urldecode($_GET['c']);

    $file = 'log.txt';

    $current_time = date("Y-m-d H:i:s");
    file_put_contents($file, "[$current_time] $data\n", FILE_APPEND);
}
