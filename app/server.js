// server.js

'use strict';

require('dotenv').config();

// Includes
const path = require('path');
const { exec } = require('child_process');

// Constants
const PORT = process.env.PORT || 1942;
const QUERY_PATH = path.join(__dirname + '/src/api/query.php');


/**
 * Express
 */
const express = require('express');
const app = express();
// Serve compiled Vue app
app.use(express.static(path.join(__dirname, "dist")));
// Serve static html
app.get('/api', (req, res) => {
    res.sendFile(path.join(__dirname, "src/api/client.html"));
});
    
/**
 * HTTP server over Express
 */
const http = require('http').createServer(app);
http.listen(PORT, () => {
    console.log('Listening on port ' + PORT);
});

/**
 * Socket.io over HTTP server
 */
const io = require('socket.io')(http);
io.on('connection', (ws) => {
    console.log('(+) User connected');
    
    setInterval(() => {
        exec('php ' + QUERY_PATH, (error, stdout, stderr) => {
            if (error) {
                console.error(stderr.toString());
            }
            else {
                ws.emit('servers', JSON.parse(stdout));
            }
        });
    }, 5000);

    ws.on('disconnect', () => {
        console.log('(-) User disconnected');
    });
});
