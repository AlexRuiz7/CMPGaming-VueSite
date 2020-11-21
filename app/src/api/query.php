<?php
    require_once __DIR__ . '/config/serversInfo.php';
    require_once __DIR__ . '/vendor/autoload.php';

    global $SERVERS;

    $gameQ = new \GameQ\GameQ();
    $gameQ->addServers($SERVERS);
    $gameQ->setOption('timeout', 5);
    $results = $gameQ->process();

    echo (json_encode($results, JSON_PRETTY_PRINT));
?>