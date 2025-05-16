<?php
function logRequest() {
    $logDir = __DIR__ . '/';
    $logFile = $logDir . 'log.txt';
    
    $logEntry = date('Y-m-d H:i:s') . " - request time\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
    
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($lines) >= 10) { rotateLog($logDir); }
}

function rotateLog($logDir) {
    $i = 0;
    while (file_exists($logDir . "log{$i}.txt")) { $i++; }
    
    rename($logDir . 'log.txt', $logDir . "log{$i}.txt");
}

logRequest();
?>