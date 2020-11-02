// server.js

'use strict';

const PORT = process.env.PORT || 1942;


/**
 * Express
 */
var express = require('express');
var path = require('path');
var app = express();
app.use(express.static(path.join(__dirname, "dist")));
    
/**
 * HTTP server over Express
 */
var http = require('http').createServer(app);
http.listen(PORT, () => {
    console.log('Listening on port ' + PORT);
});

/**
 * Socket.io over HTTP server
 */
var io = require('socket.io')(http);
io.on('connection', (ws) => {
    console.log('(+) User connected');
    ws.on('disconnect', () => {
        console.log('(-) User disconnected');
    });
});
