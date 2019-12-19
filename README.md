# APP

This application provides real time information about 
[Forgotten Hope 2](http://forgottenhope.warumdarum.de/) game servers hosted by 
[Collaborative Multiplayer Gaming (CMP)](https://cmp-gaming.com/)

The project is currently under development. In a next version, the appliication will also be able
to record, store and display ingame statistics from Campaigns and Tournaments played in FH2, hosted in CMP servers.

## To run this project:

Run backend/servers.php file as executable:

```bash
    chmod a+x servers.php
    ./servers.php
```

Placed under frontend/ folder: 

```
    npm run serve
```

Navigate to dev server in browser. IP and port shown in console.

## Requirements

* GameQ v3
    * PHP 5.6.40+ - [Tested](https://travis-ci.org/Austinb/GameQ) in PHP 5.6, 7.0, 7.1, 7.2 & 7.3
    * [Bzip2](http://www.php.net/manual/en/book.bzip2.php) - Used for A2S Compressed responses

* npm

<!-- ## Project Structure

    <image>

## Backend

Data from game servers is retrieved by using [GameQ](https://github.com/Austinb/GameQ) library, and sent using a websocket. 

#### GameQ

See GameQ's readme in backend/GameQ or at project's Github site above.

#### PHP JSON API


```php
    some php code
```


## Frontend

```php
require_once('/path/to/src/GameQ/Autoloader.php');
```

## Backend and Frontend communication

Communication between backend and frontend is stablished using webscokets. A Websocket is TCP communication protocol, 
providing full-duplex communication, unlike HTTP.

In overall terms, a websocket is a persistent communicaction link through internet between the services provider (server) and 
the services consumers (users - web browsers). The persistent connection allows us to create a real-time and asynchronous architecture,
so the clients can see changes in the data as soon as they receive the new data, without page reloads.
Also, as it is full-duplex, clients interacctions are sent through the socket as well, so the servers can handle and react to users's actions.

#### WebSocket

Websocket server has been implemented using PHP and [PHP-Websockets](https://github.com/ghedipunk/PHP-Websockets) project, but
it could have been made without any 3rd party software, or in any other server-side programming language.

At client side, a socket is created using Javascript. This socket attempts to connect to the socket we have opened at the server, and as soon
as the connection is stablished, the client starts to receive data from the socket. Data is received and is the time of the VueJS app to act. -->