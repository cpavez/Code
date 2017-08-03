/*var fs = require('fs');
var https = require('https');


var options = {
    key: fs.readFileSync('./server.key'),
    cert: fs.readFileSync('./server.crt')
};
var serverPort = 3000;

var server = https.createServer(options);
server.listen(3000);
var io = require('socket.io').listen(server);*/

var fs = require('fs');
var https = require('https');

var ioHttp = require('socket.io').listen(3002, {
    'flash policy port': -1
});

initSocket(ioHttp);

var options = {
    key: fs.readFileSync('./server.key'),
    cert: fs.readFileSync('./server.crt'),
    passphrase: 'DEF98765aba',
    requestCert       : true,
    rejectUnauthorized: false
};

var server = https.createServer(options);
server.listen(3001);
var ioHttps = require('socket.io').listen(server);
    /*var ioHttps = require('socket.io').listen(3001, {
                                                    key: fs.readFileSync('./server.key'),
                                                    cert: fs.readFileSync('./server.crt'),
                                                    requestCert: true,
                                                    rejectUnauthorized: false
    });*/

initSocket(ioHttps);


function initSocket(io) {
    io.sockets.on("connection", function(socket) {
        /*socket.emit('updateAgendaDia', { hello: 'world' });
         socket.on('insertAgendaDia', function (data) {
         console.log(data);
         //io.sockets.emit("updateAgendaDia",data);
         });*/
        socket.on("insertAgendaDia", function(data) {
            io.sockets.emit("updateAgendaDia", data);

            socket.on("disconnect", function() {
            });
        });

        socket.on("insertPaciente", function(data) {
            io.sockets.emit("updateBuscaPaciente", data);

            socket.on("disconnect", function() {
            });
        });
    });
}




/*var io = require("socket.io").listen(3000);




io.sockets.on("connection", function(socket) {
    socket.on("insertAgendaDia", function(data) {
        io.sockets.emit("updateAgendaDia", data);

        socket.on("disconnect", function() {
        });
    });

    socket.on("insertPaciente", function(data) {
        io.sockets.emit("updateBuscaPaciente", data);

        socket.on("disconnect", function() {
        });
    });
});*/
