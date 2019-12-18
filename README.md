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