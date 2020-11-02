#!/usr/bin/env php
<?php

require_once './config/serversInfo.php';
require_once './libs/Socket/Websockets.php';
require_once './libs/GameQ/Autoloader.php';

/**
 * CMPSocket class
 * 
 * Note: Do not place the files in your web server's document root -- they are
 * not intended to be ran through a web browser or otherwise directly accessible
 * to the world. They are intended to be ran through PHP's Command Line Interface
 * (CLI).
 */
class CMPSocket extends WebSocketServer {

    /**
     * $SERVERS contains CMP Servers IP:PORT in JSON format
     */
    private $GameQ;         /** GameQ instance @var GameQ */ 
    private $results;       /** Container for the results provided by GameQ queries @var Array */ 

    /**
     * Constructor
     * 
     * Initializes class attributes
     *
     * @param string $addr IP address of the websocket server
     * @param string $port PORT of the websocket server
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
     * This method is called into the main processing loop, run(). 
     * 
     * Place here any process that should happen periodically.
     * Will happen at least once per second, but possibly more often.
     * 
     * Queries game servers using GameQ and sends the results to all users 
     * connected to this socket server.
     * 
     * @return void
     */
    protected function tick() {
        $this->results = $this->GameQ->process();
        $this->send2All(json_encode($this->results, JSON_PRETTY_PRINT));
    }

    /**
     * Sends a message to all the users connectes to this socket server.
     *
     * @param string $message
     * @return void
     */
    private function send2All($message) {
        foreach ($this->users as $currentUser)
            $this->send($currentUser, $message);
    }    

    /**
     * Called immediately when the data is received.
     * 
     * Unused method, but override is required
     * 
     * @param User $user
     * @param string $message
     * @return void
     */
    protected function process($user, $message) {}
    
    /**
     * Called after the handshake response is sent to the client.
     * 
     * Unused method, but override is required
     * 
     * @param User $user
     * @return void
     */
    protected function connected($user) {}

    /**
     * Called after the connection is closed.
     *
     * Unused method, but override is required
     * 
     * @param User $user
     * @return void
     */
    protected function closed($user) {}

}


/**
 * Start socket server
 */
$socket = new CMPSocket('localhost', '8080');

try {
    $socket->run();
}
catch (Exception $e) {
    $socket->stdout($e->getMessage());
}

?>