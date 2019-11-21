#!/usr/bin/env php
<?php

require_once './config/serversInfo.php';
require_once './Socket/Websockets.php';
require_once './GameQ/Autoloader.php';

class CMPSocket extends WebSocketServer {

    /**
     * $SERVERS contains CMP Servers IP:PORT in JSON format
     */
    private $GameQ;         // GameQ instance
    private $results;       // Array

    /**
     * Constructor
     */
    function __construct($addr, $port) {
        parent::__construct($addr, $port);

        global $SERVERS;

        $this->GameQ = new \GameQ\GameQ();
        $this->GameQ->addServers($SERVERS);
        $this->GameQ->setOption('timeout', 10); // seconds
        $this->results = array();
    }

    /**
     * 
     */
    protected function tick() {
        $this->results = $this->GameQ->process();
        $this->send2All(json_encode($this->results, JSON_PRETTY_PRINT));
    }

    /**
     * 
     */
    private function send2All($message) {
        foreach ($this->users as $currentUser)
            $this->send($currentUser, $message);
    }    

    /**
     * Unused methods, but override is required
     */
    protected function process($user, $message) {} 
    protected function connected($user) {}
    protected function closed($user) {}

}


/**
 * Start socket
 */
$socket = new CMPSocket('localhost', '1942');

try {
    $socket->run();
}
catch (Exception $e) {
    $socket->stdout($e->getMessage());
}

?>